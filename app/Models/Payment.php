<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Payment extends Model
{
    use HasFactory , HasTranslations;

    protected $guarded = [];
    public $translatable = ['method', 'currency'];


    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
