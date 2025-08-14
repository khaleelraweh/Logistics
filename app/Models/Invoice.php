<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    // توليد الفاتورة برقم فريد عند إنشائها بشكل تلقائي
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->invoice_number = 'INV-' . str_pad(self::max('id') + 1, 6, '0', STR_PAD_LEFT);
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

    public function updateStatus()
    {
        $paidAmount = $this->payments()->where('status', 'paid')->sum('amount');

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

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

}
