<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Driver extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];
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
