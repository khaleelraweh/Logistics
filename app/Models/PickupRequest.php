<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PickupRequest extends Model
{
    use HasFactory , SearchableTrait;

    protected $guarded = [];


      protected $searchable = [
        'columns' => [
            // أعمدة جدول pickup_requests
            'pickup_requests.id'           => 10,
            'pickup_requests.status'       => 10,
            'pickup_requests.note'         => 10,
            'pickup_requests.country'      => 5,
            'pickup_requests.region'       => 5,
            'pickup_requests.city'         => 5,
            'pickup_requests.district'     => 5,
            'pickup_requests.postal_code'  => 5,
            'pickup_requests.scheduled_at' => 5,
            'pickup_requests.accepted_at'  => 5,
            'pickup_requests.completed_at' => 5,

            // أعمدة جدول merchants المرتبط
            'merchants.name'        => 10,
            'merchants.phone'       => 10,
            'merchants.email'       => 10,
            'merchants.contact_person' => 5,

            // أعمدة جدول drivers المرتبط
            'drivers.first_name'    => 10,
            'drivers.middle_name'   => 5,
            'drivers.last_name'     => 10,
            'drivers.phone'         => 10,
            'drivers.vehicle_number'=> 5,
            'drivers.vehicle_type'  => 5,
        ],
        'joins' => [
            'merchants' => ['merchants.id', 'pickup_requests.merchant_id'],
            'drivers'   => ['drivers.id', 'pickup_requests.driver_id'],
        ],
    ];



    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
