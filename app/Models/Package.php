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



    protected $searchable = [
        'columns' => [
            'packages.receiver_first_name' => 10,
            'packages.receiver_address' => 5,
        ]
    ];

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


    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function packageProducts()
    {
        return $this->hasMany(PackageProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'package_products')
            ->withPivot(['quantity', 'weight', 'price_per_unit', 'total_price'])
            ->using(PackageProduct::class);
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

    public function childPackages()
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


    // العلاقة مع المدفوعات
    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }

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

    // حسب تاريخ التوصيل المتوقع
    public function scopeExpectedBefore($query, $date)
    {
        return $query->whereDate('expected_delivery_date', '<=', $date);
    }

    // حسب نوع التوصيل (standard, express, pickup, courier)
    public function scopeDeliveryMethod($query, $method)
    {
        return $query->where('delivery_method', $method);
    }

    // حسب سرعة التوصيل (standard, express, same_day, next_day)
    public function scopeDeliverySpeed($query, $speed)
    {
        return $query->where('delivery_speed', $speed);
    }

    // حسب نوع الطرد
    public function scopePackageType($query, $type)
    {
        return $query->where('package_type', $type);
    }

    // حسب الحجم
    public function scopePackageSize($query, $size)
    {
        return $query->where('package_size', $size);
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

    // الطرود الجاهزة للتوصيل
    public function scopeReadyForDelivery($query)
    {
        return $query->where('status', 'pending')
                    ->whereColumn('paid_amount', '>=', 'total_fee');
    }

    // حسب المدينة الأصلية (بافتراض وجود علاقة)
    public function scopeFromCity($query, $cityId)
    {
        return $query->where('origin_city_id', $cityId);
    }

    // حسب نطاق زمني معين (مثلاً خلال أسبوع)
    public function scopeCreatedBetween($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }

    // الطرود التي لم يتم نشرها بعد
    public function scopeUnpublished($query)
    {
        return $query->whereNull('published_on');
    }

    // الطرود حسب المسؤول عن الدفع
    public function scopePaymentBy($query, $who = 'merchant')
    {
        return $query->where('payment_responsibility', $who);
    }

    // الطرود حسب نوع المصدر
    public function scopeOriginType($query, $type)
    {
        return $query->where('origin_type', $type);
    }

    // الطرود القابلة للتوصيل اليوم
    public function scopeDeliverableToday($query)
    {
        return $query->whereDate('expected_delivery_date', now()->toDateString());
    }



    // Helper methods for package attributes
    // هل الطرد هش؟
    public function isFragile()
    {
        return $this->attributes['is_fragile'] ?? false;
    }

    // هل الطرد قابل للإرجاع؟
    public function isReturnable()
    {
        return $this->attributes['is_returnable'] ?? false;
    }

    // هل الطرد فيه معلومات سرية؟
    public function isConfidential()
    {
        return $this->attributes['is_confidential'] ?? false;
    }

    // هل هو توصيل سريع؟
    public function isExpress()
    {
        return $this->delivery_speed === 'express' || ($this->attributes['is_express'] ?? false);
    }

    // هل الدفع عند الاستلام مفعل؟
    public function isCOD()
    {
        return $this->attributes['is_cod'] ?? false;
    }

    // هل الطرد بحاجة توقيع؟
    public function isSignatureRequired()
    {
        return $this->attributes['is_signature_required'] ?? false;
    }

    // هل الطرد مؤمن عليه؟
    public function isInsured()
    {
        return $this->insurance_fee > 0;
    }

    // هل الطرد مدفوع بالكامل؟
    public function isFullyPaid()
    {
        return $this->paid_amount >= $this->total_fee;
    }

    // هل الطرد متأخر عن التوصيل المتوقع؟
    public function isDeliveryOverdue()
    {
        return $this->expected_delivery_date && now()->gt($this->expected_delivery_date) && $this->status !== 'delivered';
    }

    // هل الطرد موجود في المستودع؟
    public function isInWarehouse()
    {
        return $this->status === 'in_warehouse';
    }

    // هل الطرد تم تسليمه؟
    public function isDelivered()
    {
        return $this->status === 'delivered';
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
}
