<?php

namespace App\Models;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;

class PricingRule extends Model
{
    use HasFactory , HasTranslations, HasTranslatableSlug , SearchableTrait;

    protected $guarded = [];
    public $translatable = ['name', 'slug','description'];

       // Cast fields
    protected $casts = [
        'base_price' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'published_on' => 'datetime',
    ];


      protected $searchable = [
        'columns' => [
            'pricing_rules.name' => 10,
            'pricing_rules.description' => 10,
            'pricing_rules.type' => 10,
            'pricing_rules.zone' => 10,
            'pricing_rules.min_weight' => 10,
            'pricing_rules.max_weight' => 10,
            'pricing_rules.max_length' => 10,
            'pricing_rules.max_width' => 10,
            'pricing_rules.max_height' => 10,
            'pricing_rules.base_price' => 10,
            'pricing_rules.price_per_kg' => 10,
            'pricing_rules.extra_fee' => 10,
            'pricing_rules.oversized' => 10,
            'pricing_rules.fragile' => 10,
            'pricing_rules.perishable' => 10,
            'pricing_rules.express' => 10,
            'pricing_rules.same_day' => 10,
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
