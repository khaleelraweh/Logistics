<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\RentalShelf;
use App\Models\StockItem;

class StockItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchant = Merchant::first();
        $product = Product::first();
        $rentalShelf = RentalShelf::first();

        if (!$product || !$rentalShelf) {
            $this->command->warn('No product or rental shelf found. Seeding skipped.');
            return;
        }

        StockItem::create([
            'merchant_id'       =>  $merchant->id,
            'product_id'       => $product->id,
            'rental_shelf_id'  => $rentalShelf->id,
            'quantity'         => 100,
            'status'           => true,
            'published_on'     => now(),
            'created_by'       => 'seeder',
        ]);
    }
}
