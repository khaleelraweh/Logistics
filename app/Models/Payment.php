<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $casts = [
        'paid_on' => 'datetime',
    ];

    protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function boot()
    {
        parent::boot();

        // أي تعديل أو حذف أو إضافة دفع يقوم بتحديث حالة الفاتورة
        foreach (['created', 'updated', 'deleted'] as $event) {
            static::$event(function ($payment) {
                if ($payment->invoice) {
                    $payment->invoice->updateStatus();
                }
            });
        }
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // (اختياري) علاقة إلى المستخدم الذي أنشأ أو عدل الدفع
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
