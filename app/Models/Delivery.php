<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Delivery extends Model
{
    use HasFactory , SearchableTrait;


    protected $guarded = [];

    protected $casts = [
        'assigned_at' => 'datetime',
        'delivered_at' => 'datetime',
        'published_on' => 'datetime',
    ];

    protected $searchable = [
        'columns' => [
            // أعمدة جدول التوصيلات
            'deliveries.id'          => 10,
            'deliveries.status'      => 10,
            'deliveries.note'        => 10,
            'deliveries.assigned_at' => 10,
            'deliveries.delivered_at'=> 10,

            // أعمدة جدول الطرود المرتبطة
            'packages.tracking_number'     => 10,
            'packages.sender_first_name'   => 10,
            'packages.sender_last_name'    => 10,
            'packages.receiver_first_name' => 10,
            'packages.receiver_last_name'  => 10,
            'packages.package_content'     => 10,
            'packages.package_note'        => 10,

            // أعمدة جدول السائقين
            'drivers.first_name'       => 10,
            'drivers.middle_name'      => 10,
            'drivers.last_name'        => 10,
            'drivers.phone'            => 10,
            'drivers.vehicle_number'   => 10,
            'drivers.vehicle_type'     => 10,
        ],
        'joins' => [
            'packages' => ['packages.id', 'deliveries.package_id'],
            'drivers'  => ['drivers.id', 'deliveries.driver_id'],
        ],
    ];


    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function availableStatuses()
    {
        $currentStatus = $this->status ?? 'pending'; // افتراضياً pending

        switch ($currentStatus) {
            case 'pending': return ['assigned_to_driver','cancelled'];
            case 'assigned_to_driver': return ['driver_picked_up','cancelled'];
            case 'driver_picked_up': return ['in_transit','delivery_failed'];
            case 'in_transit': return ['arrived_at_hub','delivery_failed'];
            case 'arrived_at_hub': return ['out_for_delivery','returned'];
            case 'out_for_delivery': return ['delivered','delivery_failed'];
            case 'delivery_failed': return ['returned'];
            case 'returned': return ['in_warehouse'];
            default: return [];
        }
    }

    public function availableStatusesForDriver()
    {
        if (auth()->user()->hasRole('driver')) {
            switch ($this->status) {
                case 'assigned_to_driver': return ['driver_picked_up','cancelled'];
                case 'driver_picked_up': return ['in_transit','delivery_failed'];
                case 'in_transit': return ['arrived_at_hub','delivery_failed'];
                case 'out_for_delivery': return ['delivered','delivery_failed'];
                default: return [];
            }
        }

        return $this->availableStatuses(); // باقي المستخدمين
    }


}
