<?php

namespace Database\Seeders;

use App\Models\ReturnRequest;
use App\Models\StockItem;
use App\Models\Shelf;
use App\Models\ReturnItem;
use Illuminate\Database\Seeder;

class ReturnItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $returnRequest = ReturnRequest::first();
        $stockItem = StockItem::first();
        $shelf = Shelf::first();

        // حالة stock
        if ($returnRequest && $stockItem) {
            ReturnItem::create([
                'return_request_id' => $returnRequest->id,
                'type'              => 'stock',
                'stock_item_id'     => $stockItem->id,
                'custom_name'       => null,
                'shelf_id'          => optional($shelf)->id,
                'quantity'          => 2,
            ]);
        }

        // حالة custom
        if ($returnRequest) {
            ReturnItem::create([
                'return_request_id' => $returnRequest->id,
                'type'              => 'custom',
                'stock_item_id'     => null,
                'custom_name'       => 'Custom Product Example',
                'shelf_id'          => optional($shelf)->id,
                'quantity'          => 3,
            ]);
        }
    }
}
