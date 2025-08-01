<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;

class Warehouse extends Model
{
    use HasFactory, SearchableTrait ,HasTranslations;

    protected $guarded = [];
        public $translatable = ['name','location','manager'];

    protected $searchable = [
        'columns' => [
            'warehouses.name' => 10,
            'warehouses.location' => 10,
            'warehouses.manager' => 10,
        ]
    ];


    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function shelves()
    {
        return $this->hasMany(Shelf::class);
    }

    // public function rentals()
    // {
    //     return $this->hasMany(WarehouseRental::class);
    // }

   public function rentals()
    {
        return WarehouseRental::whereHas('rentalShelves.shelf', function($q) {
            $q->where('warehouse_id', $this->id);
        });
    }

}
