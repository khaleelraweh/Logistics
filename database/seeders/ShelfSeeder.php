<?php

namespace Database\Seeders;

use App\Models\Shelf;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ============== Create a warehouse ==============//
        $warehouse = Warehouse::first(); // أو where('name->en', 'Main Warehouse')->first();

        if (!$warehouse) {
            $warehouse = Warehouse::create([
                'name' => ['ar' => 'المستودع الرئيسي', 'en' => 'Main Warehouse'],
                'location' => ['ar' => 'المنطقة الصناعية - صنعاء', 'en' => 'Industrial Area - Sanaa'],
            ]);
        }

        // Shelf
        Shelf::create([
            'warehouse_id' => $warehouse->id,
            'code' => 'SH-A1',
            'size' => 'large',
            'price' => 250,
        ]);
    }
}
