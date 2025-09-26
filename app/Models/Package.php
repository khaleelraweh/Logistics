<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory , SearchableTrait;

    protected $guarded = [];



    // to get full name as property instead of first_name and last_name
    protected $appends = ['sender_full_name' , 'receiver_full_name'];


    // ucfirst : get first alphabet as bigger alpha
    public function getSenderFullNameAttribute(): string
    {
        return ucfirst($this->sender_first_name) . ' ' . ucfirst($this->sender_middle_name) . ' ' . ucfirst($this->sender_last_name);
    }

    // ucfirst : get first alphabet as bigger alpha
    public function getReceiverFullNameAttribute(): string
    {
        return ucfirst($this->receiver_first_name) . ' ' . ucfirst($this->receiver_middle_name) . ' ' . ucfirst($this->receiver_last_name);
    }


    protected $casts = [
        'dimensions' => 'array',
        'attributes' => 'array',
        'origin_address' => 'array',
        'delivery_date' => 'date',
        'expected_delivery_date' => 'date',
        'published_on' => 'datetime',
        'attributes' => 'array',
    ];

       // حالات الطرد
    public const STATUSES = [
        'pending',
        'assigned_to_driver',
        'driver_picked_up',
        'in_transit',
        'arrived_at_hub',
        'out_for_delivery',
        'delivered',
        'delivery_failed',
        'returned',
        'cancelled',
        'in_warehouse',
    ];

    protected $searchable = [
        'columns' => [
            // كل أعمدة packages
            'packages.id'                 => 10,
            'packages.tracking_number'    => 10,
            'packages.status'             => 10,
            'packages.delivery_method'    => 10,
            'packages.package_type'       => 10,
            'packages.package_size'       => 10,
            'packages.origin_type'        => 10,
            'packages.delivery_speed'     => 10,
            'packages.payment_method'     => 10,
            'packages.collection_method'  => 10,

            'packages.sender_first_name'  => 10,
            'packages.sender_middle_name' => 10,
            'packages.sender_last_name'   => 10,
            'packages.sender_phone'       => 10,
            'packages.sender_email'       => 10,
            'packages.sender_country'     => 10,
            'packages.sender_region'      => 10,
            'packages.sender_city'        => 10,
            'packages.sender_district'    => 10,
            'packages.sender_postal_code' => 10,
            'packages.sender_others'      => 10,

            'packages.receiver_first_name'  => 10,
            'packages.receiver_middle_name' => 10,
            'packages.receiver_last_name'   => 10,
            'packages.receiver_phone'       => 10,
            'packages.receiver_email'       => 10,
            'packages.receiver_country'     => 10,
            'packages.receiver_region'      => 10,
            'packages.receiver_city'        => 10,
            'packages.receiver_district'    => 10,
            'packages.receiver_postal_code' => 10,
            'packages.receiver_others'      => 10,

            'packages.package_content'   => 10,
            'packages.package_note'      => 10,
            'packages.delivery_status_note' => 10,

            'packages.weight'            => 10,
            'packages.dimensions'        => 10,
            'packages.quantity'          => 10,

            'packages.delivery_fee'      => 10,
            'packages.insurance_fee'     => 10,
            'packages.service_fee'       => 10,
            'packages.total_fee'         => 10,
            'packages.paid_amount'       => 10,
            'packages.due_amount'        => 10,
            'packages.cod_amount'        => 10,

            // من جدول التجار (المرسل والمستلم)
            'merchants.name'             => 10,
            'merchants.contact_person'   => 10,
            'merchants.email'            => 10,
            'merchants.phone'            => 10,
        ],
        'joins' => [
            'merchants' => ['merchants.id', 'packages.merchant_id'],
            'receiver_merchants' => ['merchants.id', 'packages.receiver_merchant_id'],
        ],
    ];

    public function merchant() {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function receiverMerchant() {
        return $this->belongsTo(Merchant::class, 'receiver_merchant_id');
    }


    public function packageProducts()
    {
        return $this->hasMany(PackageProduct::class);
    }


    public function stockItems()
    {
        return $this->belongsToMany(StockItem::class, 'package_products', 'package_id', 'stock_item_id')
            ->withPivot(['quantity', 'weight', 'price_per_unit', 'total_price', 'type', 'custom_name'])
            ->using(PackageProduct::class);
    }

    public function rentalShelf()
    {
        return $this->belongsTo(RentalShelf::class);
    }

    public function parentPackage()
    {
        return $this->belongsTo(Package::class, 'parent_package_id');
    }

    public function childpackages()
    {
        return $this->hasMany(Package::class, 'parent_package_id');
    }

    public function packageLogs()
    {
        return $this->hasMany(PackageLog::class)->orderBy('logged_at', 'asc');
    }


    public function addLog($note = null, $driver_id = null)
    {
        return $this->packageLogs()->create([
            'status'      => $this->status,
            'note'        => $note,
            'logged_at'   => now(),
            'changed_by'  => auth()->user()?->name ?? 'system',  // اسم المستخدم الحالي
            'driver_id'   => $driver_id
        ]);
    }


    // العلاقة مع عمليات التوصيل
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }


    // العلاقة مع الطلبات المرتجعة
    public function returnRequest()
    {
        return $this->hasOne(ReturnRequest::class);
    }

    public function markAsDelivered()
    {
        $this->update([
            'status' => 'delivered',
            'delivery_date' => now(),
        ]);
    }

    public function externalShipment()
    {
        return $this->hasOne(\App\Models\ExternalShipment::class);
    }





    // Scope methods for package status

    // الطرود المرئية للعميل فقط
    public function scopeVisible($query)
    {
        return $query->where('status_visible', true);
    }

    // حسب حالة الطرد
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // حسب التاجر
    public function scopeForMerchant($query, $merchantId)
    {
        return $query->where('merchant_id', $merchantId);
    }


    // الطرود غير مدفوعة بالكامل
    public function scopeUnpaid($query)
    {
        return $query->whereColumn('paid_amount', '<', 'total_fee');
    }

    // الطرود التي تم دفعها كاملة
    public function scopePaid($query)
    {
        return $query->whereColumn('paid_amount', '>=', 'total_fee');
    }
    // حسب نطاق زمني معين (مثلاً خلال أسبوع)
    public function scopeCreatedBetween($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }
    // الطرود حسب المسؤول عن الدفع
    public function scopePaymentBy($query, $who = 'merchant')
    {
        return $query->where('payment_responsibility', $who);
    }


    // حساب المبلغ المتبقي (احتياطي)
    public function remainingAmount()
    {
        return $this->total_fee - $this->paid_amount;
    }

    // إرجاع أبعاد الطرد كنص
    public function dimensionsText()
    {
        $d = $this->dimensions;
        return "{$d['length']} x {$d['width']} x {$d['height']} سم";
    }

    // حساب الحجم الكلي للطرد (بـ cm³)
    public function volume()
    {
        $d = $this->dimensions;
        return ($d['length'] ?? 0) * ($d['width'] ?? 0) * ($d['height'] ?? 0);
    }

    // هل هناك مبلغ مستحق؟
    public function hasDueAmount()
    {
        return $this->remainingAmount() > 0;
    }

    // نوع التوصيل بشكل قابل للعرض
    public function deliveryMethodLabel()
    {
        return match($this->delivery_method) {
            'standard' => 'توصيل عادي',
            'express' => 'توصيل سريع',
            'pickup' => 'استلام من المتجر',
            'courier' => 'مندوب خاص',
            default => 'غير معروف'
        };
    }


    // لون الحالة (للتلوين في الواجهة)
    public function statusColor()
    {
        return match($this->status) {
            'pending'              => 'warning',
            'assigned_to_driver'   => 'info',
            'driver_picked_up'     => 'primary',
            'in_transit'           => 'info',
            'arrived_at_hub'       => 'secondary',
            'out_for_delivery'     => 'info',
            'delivered'            => 'success',
            'delivery_failed'      => 'danger',
            'returned'             => 'danger',
            'cancelled'            => 'dark',
            'in_warehouse'         => 'secondary',
            default                => 'dark',
        };
    }

    // اسم الحالة بشكل مقروء بالعربي
    public function statusLabel()
    {
        return match($this->status) {
            'pending'              => 'قيد الانتظار',
            'assigned_to_driver'   => 'أُسند إلى السائق',
            'driver_picked_up'     => 'استلمه السائق',
            'in_transit'           => 'في الطريق',
            'arrived_at_hub'       => 'وصل إلى المركز',
            'out_for_delivery'     => 'خارج للتسليم',
            'delivered'            => 'تم التسليم',
            'delivery_failed'      => 'فشل في التسليم',
            'returned'             => 'تم الإرجاع',
            'cancelled'            => 'أُلغي',
            'in_warehouse'         => 'في المستودع',
            default                => 'غير معروف',
        };
    }


    // جميع الحالات المتاحة للطرد
    public static function statuses()
    {
        return [
            'pending'              => __('package.status_pending'),
            'assigned_to_driver'   => __('package.status_assigned_to_driver'),
            'driver_picked_up'     => __('package.status_driver_picked_up'),
            'in_transit'           => __('package.status_in_transit'),
            'arrived_at_hub'       => __('package.status_arrived_at_hub'),
            'out_for_delivery'     => __('package.status_out_for_delivery'),
            'delivered'            => __('package.status_delivered'),
            'delivery_failed'      => __('package.status_delivery_failed'),
            'returned'             => __('package.status_returned'),
            'cancelled'            => __('package.status_cancelled'),
            'in_warehouse'         => __('package.status_in_warehouse'),
        ];
    }


    public function getPaymentMethodTranslatedAttribute()
    {
        $methods = [
            'prepaid' => __('package.payment_prepaid'),
            'cash_on_delivery' => __('package.payment_cod'),
            'exchange' => __('package.payment_exchange'),
            'bring' => __('package.payment_bring'),
        ];

        return $methods[$this->payment_method] ?? '-';
    }



     // Boot (اختياري لتوليد رقم تتبع تلقائي)
    protected static function booted()
    {
        static::creating(function ($package) {
            if (empty($package->tracking_number)) {
                $package->tracking_number = 'PKG-' . strtoupper(Str::random(8));
            }
        });
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    public function invoice()  {
        return $this->morphOne(Invoice::class, 'payable');
    }


    // status statistacs for dashboard
    public static function statusStatistics()
    {
        $stats = [];

        foreach (self::STATUSES as $status) {
            $stats[$status] = [
                'count' => self::where('status', $status)->count(),
                'label' => (new self)->statusLabelFor($status),
                'color' => (new self)->statusColorFor($status),
            ];
        }

        return $stats;
    }

    // تعيد اسم الحالة حسب المفتاح
    public function statusLabelFor($status)
    {
        return match($status) {
            'pending'              => 'قيد الانتظار',
            'assigned_to_driver'   => 'أُسند إلى السائق',
            'driver_picked_up'     => 'استلمه السائق',
            'in_transit'           => 'في الطريق',
            'arrived_at_hub'       => 'وصل إلى المركز',
            'out_for_delivery'     => 'خارج للتسليم',
            'delivered'            => 'تم التسليم',
            'delivery_failed'      => 'فشل في التسليم',
            'returned'             => 'تم الإرجاع',
            'cancelled'            => 'أُلغي',
            'in_warehouse'         => 'في المستودع',
            default                => 'غير معروف',
        };
    }

    // تعيد لون الحالة حسب المفتاح
    public function statusColorFor($status)
    {
        return match($status) {
            'pending'              => 'warning',
            'assigned_to_driver'   => 'info',
            'driver_picked_up'     => 'primary',
            'in_transit'           => 'info',
            'arrived_at_hub'       => 'secondary',
            'out_for_delivery'     => 'info',
            'delivered'            => 'success',
            'delivery_failed'      => 'danger',
            'returned'             => 'danger',
            'cancelled'            => 'dark',
            'in_warehouse'         => 'secondary',
            default                => 'dark',
        };
    }

    // حساب رسوم التوصيل بناءً على قواعد التسعير
    public function calculateDeliveryFee()
    {
        $weight = $this->weight; // بالجرام
        $zone = $this->receiver_city; // أو أي تصنيف zone عندك
        $length = data_get($this->dimensions,'length',0);
        $width  = data_get($this->dimensions,'width',0);
        $height = data_get($this->dimensions,'height',0);
        $isExpress = $this->delivery_speed === 'express';
        $isSameDay = $this->delivery_speed === 'same_day';
        $attributes = $this->attributes ?? [];

        // قاعدة أساسية حسب الوزن والمنطقة
        $rule = \App\Models\PricingRule::where('type','delivery')
            ->where(function($q) use($zone){
                $q->where('zone',$zone)->orWhere('zone','Any');
            })
            ->where('min_weight','<=',$weight)
            ->where(function($q) use($weight){
                $q->whereNull('max_weight')->orWhere('max_weight','>=',$weight);
            })
            ->where('status',true)
            ->first();

        if(!$rule) return 0;

        $price = $rule->base_price;

        // رسوم الوزن الإضافي
        if($weight > $rule->min_weight){
            $extraKg = ceil(($weight - $rule->min_weight)/1000);
            $price += $extraKg * $rule->price_per_kg;
        }

        // رسوم express / same day
        if($isExpress && $rule->express) $price += $rule->extra_fee;
        if($isSameDay && $rule->same_day) $price += $rule->extra_fee;

        // رسوم الطرود الكبيرة جداً
        if($length > ($rule->max_length ?? 9999) || $width > ($rule->max_width ?? 9999) || $height > ($rule->max_height ?? 9999)){
            $price += $rule->extra_fee;
        }

        // خصائص خاصة
        if(!empty($attributes['is_fragile']) && $rule->fragile) $price += $rule->extra_fee;
        if(!empty($attributes['is_perishable']) && $rule->perishable) $price += $rule->extra_fee;

        return $price;
    }




}
