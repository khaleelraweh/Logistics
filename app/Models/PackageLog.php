<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
