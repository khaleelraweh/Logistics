<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    protected $casts = [
        'issued_at' => 'datetime',
        'due_date'  => 'datetime',
    ];


    protected $guarded = [];



    protected $searchable = [
        'columns' => [
            // ---- فواتير ----
            'invoices.id'            => 10,
            'invoices.invoice_number'=> 10,
            'invoices.total_amount'  => 10,
            'invoices.paid_amount'   => 10,
            'invoices.currency'      => 10,
            'invoices.status'        => 10,
            'invoices.notes'         => 10,
            'invoices.issued_at'     => 10,
            'invoices.due_date'      => 10,

            // ---- المدفوعات ----
            'payments.id'             => 10,
            'payments.amount'         => 10,
            'payments.currency'       => 10,
            'payments.method'         => 10,
            'payments.status'         => 10,
            'payments.paid_on'        => 10,
            'payments.reference_note' => 10,
            'payments.payment_reference' => 10,

            // ---- المتاجر ----
            'merchants.id'         => 10,
            'merchants.name'       => 10,
            'merchants.slug'       => 10,
            'merchants.country'    => 10,
            'merchants.region'     => 10,
            'merchants.city'       => 10,
            'merchants.district'   => 10,
            'merchants.postal_code'=> 10,
            'merchants.phone'      => 10,
            'merchants.email'      => 10,
            'merchants.website'    => 10,

            // ---- إيجارات المستودعات ----
            'warehouse_rentals.id'           => 10,
            'warehouse_rentals.rental_start' => 10,
            'warehouse_rentals.rental_end'   => 10,
            'warehouse_rentals.price'        => 10,
            'warehouse_rentals.status'       => 10,
        ],
        'joins' => [
            'merchants'       => ['merchants.id', 'invoices.merchant_id'], // لجميع الجداول المرتبطة بالتاجر
            'payments'        => ['payments.invoice_id', 'invoices.id'],   // ربط المدفوعات بالفواتير
            'warehouse_rentals'=> ['warehouse_rentals.merchant_id', 'merchants.id'],
        ],
    ];


    // توليد رقم الفاتورة برقم فريد عند الإنشاء
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (!$invoice->invoice_number) {
                $nextId = (self::max('id') ?? 0) + 1;
                $invoice->invoice_number = 'INV-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    // العلاقة مع التاجر
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // العلاقة مع الدفع
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // تحديث حالة الفاتورة بناءً على المدفوعات
    public function updateStatus()
    {
        $paidAmount = (float) $this->payments()
            ->where('status', 'paid')
            ->sum(DB::raw('ROUND(amount, 2)'));

        $this->paid_amount = $paidAmount; // حفظ المبلغ المدفوع لو أضفت العمود في الجدول

        if ($paidAmount >= $this->total_amount) {
            $this->status = 'paid';
        } elseif ($paidAmount > 0) {
            $this->status = 'partial';
        } else {
            $this->status = 'unpaid';
        }

        $this->save();
    }

    // العلاقة polymorphic مع الطرد أو الإيجار
    public function payable()
    {
        return $this->morphTo();
    }

    // داخل نموذج Invoice
    public function getPaidAmountAttribute()
    {
        return $this->payments()->where('status', 'paid')->sum('amount');
    }

    public function getRemainingAmountAttribute()
    {
        return max($this->total_amount - $this->paid_amount, 0);
    }

    // عناصر الفاتورة
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
