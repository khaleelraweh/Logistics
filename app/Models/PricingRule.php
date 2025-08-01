<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

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
