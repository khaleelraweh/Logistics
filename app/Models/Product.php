<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];

    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.description' => 5,
        ]
    ];


    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function stockItems()
    {
        return $this->hasMany(StockItem::class);
    }


    public function photos(): MorphMany
    {
        return $this->morphMany(Photo::class, 'imageable');
    }
    public function firstMedia(): MorphOne
    {
        return $this->MorphOne(Photo::class, 'imageable')->orderBy('file_sort', 'asc');
    }
    public function lastMedia(): MorphOne
    {
        return $this->MorphOne(Photo::class, 'imageable')->orderBy('file_sort', 'desc');
    }

    public function status(){
        if($this->status == 1){
            return __('general.active');
        } elseif($this->status == 0){
            return __('general.inactive');
        } else {
            return __('general.unknown');
        }
    }
}
