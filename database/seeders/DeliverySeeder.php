<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ============== Create a delivery ==============//
        $package = Package::first();
        $driver = Driver::first(); // Ensure that a package and driver exist before creating a delivery

        Delivery::create([
            'package_id' => $package->id,
            'driver_id' => $driver->id,
            'delivered_at' => now(),
            'note' => 'تم التوصيل بنجاح'
        ]);
    }
}
