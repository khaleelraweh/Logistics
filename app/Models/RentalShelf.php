<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalShelf extends Model
{
    protected $table = 'rental_shelves'; // Because it's not plural by default

    public $timestamps = false; // Only if your table doesn’t have timestamps

    protected $fillable = [
        'warehouse_rental_id',
        'shelf_id',
        'custom_price',
        'custom_start',
        'custom_end',
    ];

    public function rental()
    {
        return $this->belongsTo(WarehouseRental::class, 'warehouse_rental_id');
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }



    public function stockItems()
    {
        return $this->hasMany(StockItem::class);
    }
}
