<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'custom_start' => 'date',
        'custom_end' => 'date',
        'published_on'  =>  'datetime',

    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function rentalShelf()
    {
        return $this->belongsTo(RentalShelf::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }


}
