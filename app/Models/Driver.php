<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Driver extends Model
{
    use HasFactory, HasTranslations , SearchableTrait;

    protected $guarded = [];


    protected $searchable = [
        'columns' => [
            // كل أعمدة drivers
            'drivers.first_name'        => 10,
            'drivers.middle_name'       => 10,
            'drivers.last_name'     => 10,
            'drivers.phone'     => 10,
            'drivers.username'      => 10,
            'drivers.email'     => 10,
            'drivers.country'       => 10,
            'drivers.region'        => 10,
            'drivers.city'      => 10,
            'drivers.district'      => 10,
            'drivers.latitude'      => 10,
            'drivers.longitude'     => 10,
            'drivers.license_number'        => 10,
            'drivers.vehicle_type'      => 10,
            'drivers.vehicle_number'        => 10,
            'drivers.vehicle_model'     => 10,
            'drivers.vehicle_color'     => 10,
            'drivers.vehicle_capacity_weight'       => 10,
            'drivers.vehicle_capacity_volume'       => 10,
            'drivers.license_expiry_date'       => 10,
            'drivers.hired_date'        => 10,
            'drivers.supervisor_id'     => 10,
            'drivers.total_deliveries'      => 10,
            'drivers.availability_status'       => 10,
            'drivers.status'        => 10,


            // من جدول التجار (المرسل والمستلم)
            'users.first_name'             => 10,
            'users.last_name'             => 10,
            'users.email'             => 10,
            'users.mobile'             => 10,

        ],
        'joins' => [
            'users' => ['users.id', 'drivers.supervisor_id'],
        ],
    ];



    public $translatable = ['first_name', 'middle_name', 'last_name'];

    // to get full name as property instead of first_name and last_name
    protected $appends = ['driver_full_name'];


    // ucfirst : get first alphabet as bigger alpha
    public function getDriverFullNameAttribute(): string
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->middle_name) . ' ' . ucfirst($this->last_name);
    }


    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function return_requests()
    {
        return $this->hasMany(ReturnRequest::class);
    }

    public function pickupRequests()
    {
        return $this->hasMany(PickupRequest::class);
    }


    public function packageLogs()
    {
        return $this->hasMany(PackageLog::class);
    }

    public function currentPackages()
    {
        return $this->hasMany(Package::class)
                    ->whereIn('status', ['assigned_to_driver', 'in_transit', 'out_for_delivery']);
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }


}
