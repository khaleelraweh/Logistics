<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ExternalShipment extends Model
{
    use HasFactory , HasTranslations;

    protected $guarded = [];
    public $translatable = ['receiver_name', 'receiver_address'];

    protected $casts = [
        'delivery_date' => 'datetime',
        'delivered_at'  => 'datetime',
        'synced_at'     => 'datetime',
        'published_on'  => 'datetime',
    ];

    public function shippingPartner()
    {
        return $this->belongsTo(ShippingPartner::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }


}
