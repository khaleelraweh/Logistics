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

    // عناصر الفاتورة
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
