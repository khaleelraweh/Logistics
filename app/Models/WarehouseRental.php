<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Nicolaslopezj\Searchable\SearchableTrait;

class WarehouseRental extends Model
{
    use HasFactory , SearchableTrait;

    protected $guarded = [];

         // searchable lab
    protected $searchable = [
        'columns' => [
            'warehouse_rentals.price' => 10,
            'warehouse_rentals.rental_start' => 10,
            'warehouse_rentals.rental_end' => 10,
            'warehouse_rentals.warehouse_id' => 10,
            'warehouse_rentals.user_id' => 10,
            'warehouse_rentals.status' => 10,
            'warehouse_rentals.created_at' => 10,]
    ];

    protected $casts = [
        'rental_start' => 'datetime',
        'rental_end' => 'datetime',
    ];

    // اذا تم حذف العقد يتم حذف الفاتورة
    protected static function booted()
    {
        static::deleting(function ($rental) {
            $rental->invoice()?->delete();
        });
    }



    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            0 => "<span class='badge bg-warning text-dark'>" . __('rental.status_inactive') . "</span>",
            1 => "<span class='badge bg-success'>" . __('rental.status_active') . "</span>",
            2 => "<span class='badge bg-danger'>" . __('rental.status_expired') . "</span>",
            default => "<span class='badge bg-secondary'>" . __('rental.status_unknown') . "</span>",
        };
    }


    // change the status to expired if the rental_end date is passed and status is not 2
    public function getStatusAttribute($value)
    {
        if ($value != 2 && now()->gt($this->rental_end)) {
            return 2; // Expired
        }
        return $value;
    }


    function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }


    public function shelves()
    {
        return $this->belongsToMany(Shelf::class, 'rental_shelves')
            ->withPivot(['custom_price', 'custom_start', 'custom_end']);
    }


    public function rentalShelves()
    {
        return $this->hasMany(RentalShelf::class, 'warehouse_rental_id');
    }



    public function warehouses()
    {
        return $this->hasManyThrough(
            Warehouse::class,
            Shelf::class,
            'warehouse_id',   // المفتاح في shelves الذي يشير إلى warehouse
            'id',             // المفتاح في warehouses
            'id',             // المفتاح في warehouse_rentals
            'warehouse_id'    // المفتاح في shelves
        )->distinct();
    }


    public function invoice()  {
        return $this->morphOne(Invoice::class, 'payable');
    }

    public function getPaidAmountAttribute()
    {
        return $this->invoice?->payments()->sum('amount') ?? 0;
    }

    public function getRemainingAmountAttribute()
    {
        return max(($this->invoice?->total_amount ?? $this->price) - $this->paid_amount, 0);
    }




}
