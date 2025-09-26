<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Nicolaslopezj\Searchable\SearchableTrait;

class PricingRule extends Model
{
    use HasFactory , HasTranslations;

    protected $guarded = [];
    public $translatable = ['name','description'];

       // Cast fields
    protected $casts = [
        'condition' => 'array',
        'base_price' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'published_on' => 'datetime',
    ];

    protected $searchable = [
        'columns' => [
            'pricing_rules.name' => 10,
            'pricing_rules.description' => 5,
            'pricing_rules.zone' => 3,
            'pricing_rules.type' => 2,
        ],
    ];


    // Example Accessor: full display name
    public function getDisplayNameAttribute()
    {
        return $this->name . ' - ' . ucfirst($this->type);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }


}
