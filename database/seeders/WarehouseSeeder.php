<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Warehouses
        $warehouse = Warehouse::create([
            'name' => ['ar' =>  'المستودع الرئيسي', 'en'    =>  "Main Warehouse"],
            'manager' => ['ar' =>   'محمد احمد صالح', 'en'   =>  'Mohamed Ahmed Saleh'],
            'code'  =>  'wa-1',
        ]);
    }
}
