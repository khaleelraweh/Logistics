<?php

namespace Database\Seeders;

use App\Models\PackageProduct;
use Illuminate\Database\Seeder;

class PackageProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // احصل على أول طرد
        $package = \App\Models\Package::first();
        if (!$package) {
            $this->command->error('No package found. Please run PackageSeeder first.');
            return;
        }

        // ✅ مثال (1): منتج من المخزون
        $stockItem = \App\Models\StockItem::first();
        if ($stockItem) {
            PackageProduct::create([
                'package_id'      => $package->id,
                'type'            => 'stock',
                'stock_item_id'   => $stockItem->id,
                'quantity'        => 3,
                'weight'          => 1.5,
                'price_per_unit'  => 50.00,
                'total_price'     => 150.00,
            ]);
        } else {
            $this->command->warn('No stock item found. Please run StockItemSeeder first.');
        }

        // ✅ مثال (2): منتج مخصص
        PackageProduct::create([
            'package_id'         => $package->id,
            'type'               => 'custom',
            'custom_name'        => 'Custom Printed Mug',
            'quantity'           => 4,
            'weight'             => 0.4,
            'price_per_unit'     => 25.00,
            'total_price'        => 100.00,
        ]);
    }
}
