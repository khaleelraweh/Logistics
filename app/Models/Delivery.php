<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $casts = [
        'assigned_at' => 'datetime',
        'delivered_at' => 'datetime',
        'published_on' => 'datetime',
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

}
