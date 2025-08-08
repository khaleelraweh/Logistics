<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory ;

    protected $guarded = [];


      // علاقة Morph إلى الكيان القابل للدفع (طرد، إيجار، خدمة، ... )
    public function payable()
    {
        return $this->morphTo();
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

        // علاقة إلى الفاتورة (invoice)
    // public function invoice()
    // {
    //     return $this->belongsTo(Invoice::class);
    // }

      // (اختياري) علاقة إلى المستخدم الذي أنشأ أو عدل الدفع، إذا كنت تستخدم جدول users
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
