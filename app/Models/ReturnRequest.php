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


    protected $searchable = [
        'columns' => [
            // ---- Return Requests ----
            'return_requests.id'           => 10,
            'return_requests.status'       => 10,
            'return_requests.return_type'  => 10,
            'return_requests.reason'       => 10,
            'return_requests.requested_at' => 10,
            'return_requests.received_at'  => 10,
            'return_requests.target_address' => 10,

            // ---- Packages ----
            'packages.id'                  => 10,
            'packages.tracking_number'     => 10,
            'packages.package_content'     => 10,
            'packages.package_note'        => 10,
            'packages.receiver_first_name' => 10,
            'packages.receiver_last_name'  => 10,
            'packages.receiver_phone'      => 10,

            // ---- Merchants ----
            'merchants.id'                 => 10,
            'merchants.name'               => 10,
            'merchants.phone'              => 10,
            'merchants.email'              => 10,

            // ---- Drivers ----
            'drivers.id'                   => 10,
            'drivers.first_name'           => 10,
            'drivers.last_name'            => 10,
            'drivers.phone'                => 10,
            'drivers.username'             => 10,
        ],
        'joins' => [
            'packages'  => ['packages.id', 'return_requests.package_id'],
            'merchants' => ['merchants.id', 'packages.merchant_id'],
            'drivers'   => ['drivers.id', 'return_requests.driver_id'],
        ],
    ];


    function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }



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
            'requested' =>  __('return_request.status_requested'),
            'assigned_to_driver'    =>  __('return_request.status_assigned_to_driver'),
            'picked_up' =>  __('return_request.status_picked_up'),
            'in_transit'    =>  __('return_request.status_in_transit'),
            'received'  =>  __('return_request.status_received'),
            'rejected'  =>  __('return_request.status_rejected'),
            'partially_received'    =>  __('return_request.status_partially_received'),
            'status_cancelled'  =>  __('return_request.status_status_cancelled'),
            default => __('return_request.unknown'),
        };
    }

}
