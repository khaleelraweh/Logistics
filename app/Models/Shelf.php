<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }



    public function stockItems()
    {
        return $this->hasManyThrough(
            StockItem::class,       // الموديل النهائي
            RentalShelf::class,     // الجدول الوسيط
            'shelf_id',             // FK في rental_shelves الذي يشير لـ shelves.id
            'rental_shelf_id',      // FK في stock_items الذي يشير لـ rental_shelves.id
            'id',                   // PK في shelves
            'id'                    // PK في rental_shelves
        );
    }


    public function size()
    {
        if ($this->size == 'small')
            return __('general.small');
        else if ($this->size == 'medium')
            return __('general.medium');
        else if ($this->size == 'large') {
            return __('general.large');
        }
    }

    public function rentals()
    {
        return $this->belongsToMany(WarehouseRental::class, 'rental_shelves')
                    ->withPivot(['custom_price', 'custom_start', 'custom_end']);
    }

    public function getIsRentedAttribute()
    {
        // إذا في عقود نشطة متصلة بالرف نعتبره مؤجر
        return $this->rentals()->exists();
    }
}
