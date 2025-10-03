<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MenuProperty extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    public $translatable = ['property_value' ];


     // ربط الخصائص بالوحدة
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
