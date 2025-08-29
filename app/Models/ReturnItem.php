<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function returnRequest()
    {
        return $this->belongsTo(ReturnRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     public function stockItem()
    {
        return $this->belongsTo(\App\Models\StockItem::class, 'stock_item_id');
    }
}
