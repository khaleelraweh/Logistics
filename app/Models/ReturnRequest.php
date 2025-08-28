<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ReturnRequest extends Model
{
    use HasFactory;

    protected $guarded = [];


     protected $casts = [
        'requested_at' => 'datetime',
        'received_at' => 'datetime',
        'published_on' => 'datetime',
    ];

    function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // العلاقة مع التاجر عبر الطرد
    // function merchant()
    // {
    //     return $this->hasOneThrough(
    //         Merchant::class,
    //         Package::class,
    //         'id', // المفتاح الخارجي في جدول Packages
    //         'id', // المفتاح الخارجي في جدول Merchants
    //         'package_id', // المفتاح المحلي في هذا الجدول (ReturnRequests)
    //         'merchant_id' // المفتاح المحلي في جدول Packages
    //     );
    // }

    function merchant()
    {
        return $this->hasOneThrough(
            Merchant::class,
            Package::class,
            'merchant_id', // المفتاح الخارجي في جدول Packages (الذي يشير للـMerchant)
            'id',          // المفتاح الخارجي في جدول Merchants (عادة يكون id)
            'package_id',  // المفتاح المحلي في جدول ReturnRequests (foreign key لـPackage)
            'id'           // المفتاح المحلي في جدول Packages (primary key)
        );
    }

    // العلاقة مع رف الإرجاع (إذا كانت الإرجاع إلى رف)
    function targetShelf()
    {
        return $this->belongsTo(Shelf::class, 'target_shelf_id');
    }

    // علاقة (اختيارية) مع عناصر المرتجع إذا وجدت
    function returnItems()
    {
        return $this->hasMany(ReturnItem::class);
    }

        // عرض الحالة
    public function statusLabel()
    {
        return match ($this->status) {
            'requested' => __('return_request.status_requested'),
            'in_transit' => __('return_request.status_in_transit'),
            'received' => __('return_request.status_received'),
            'rejected' => __('return_request.status_rejected'),
            default => __('return_request.unknown'),
        };
    }

}
