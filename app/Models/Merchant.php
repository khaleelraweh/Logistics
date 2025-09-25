<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mindscms\Entrust\Traits\EntrustUserTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Merchant extends Model
{
    use HasFactory, HasTranslations, HasTranslatableSlug, SearchableTrait ,  EntrustUserTrait;

    protected $guarded = [];

    public $translatable = ['name', 'slug' , 'contact_person' ];



    protected $searchable = [
        'columns' => [
            'merchants.name' => 10,
            'merchants.contact_person' => 10,
            'merchants.country' => 10,
            'merchants.region' => 10,
            'merchants.city' => 10,
            'merchants.district' => 10,
            'merchants.phone' => 10,
            'merchants.email' => 10,
        ]
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;
        $slugString = $this->getSlugSourceString();

        $slug = $this->getTranslations($slugField)[$this->getLocale()] ?? null;

        $slugGeneratedFromCallable = is_callable($this->slugOptions->generateSlugFrom);
        $hasCustomSlug = $this->hasCustomSlugBeenUsed() && !empty($slug);
        $hasNonChangedCustomSlug = !$slugGeneratedFromCallable && !empty($slug) && !$this->slugIsBasedOnTitle();

        if ($hasCustomSlug || $hasNonChangedCustomSlug) {
            $slugString = $slug;
        }

        return MySlugHelper::slug($slugString);
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function status()
    {
        return $this->status ? __('panel.status_active') : __('panel.status_inactive');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'merchant_id'); // الطرود المُرسلة
    }

    public function receivedPackages()
    {
        return $this->hasMany(Package::class, 'receiver_merchant_id'); // الطرود المُستلمة
    }

    public function returnRequests()
    {
        return $this->hasManyThrough(
            ReturnRequest::class,  // النموذج النهائي الذي تريد الوصول إليه
            Package::class,        // النموذج الوسيط (الطرد)
            'merchant_id',         // المفتاح الخارجي في جدول Packages الذي يشير إلى Merchant
            'package_id',          // المفتاح الخارجي في جدول ReturnRequests الذي يشير إلى Package
            'id',                  // المفتاح المحلي في جدول Merchants
            'id'                   // المفتاح المحلي في جدول Packages
        );
    }


    public function warehouseRentals()
    {
        return $this->hasMany(WarehouseRental::class);
    }

    public function rentalShelves()
    {
        return $this->hasManyThrough(
            RentalShelf::class,
            WarehouseRental::class,
            'merchant_id',
            'warehouse_rental_id',
            'id',
            'id'
        );
    }

    // public function shelves()
    // {
    //     return $this->hasManyThrough(
    //         Shelf::class,
    //         RentalShelf::class,
    //         'warehouse_rental_id',
    //         'id',
    //         'id',
    //         'shelf_id'
    //     );
    // }


    public function shelves()
    {
        return $this->belongsToMany(Shelf::class, 'rental_shelves')
                    ->withPivot(['custom_price', 'custom_start', 'custom_end']);
    }

    public function warehouses()
    {
        return $this->hasManyThrough(
            Warehouse::class,
            Shelf::class,
            'warehouse_id',
            'id',
            'id',
            'warehouse_id'
        )->distinct();
    }







    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

     function stockItems()
    {
        return $this->hasMany(StockItem::class);
    }

}
