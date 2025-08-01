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
}
