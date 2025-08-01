<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\ReturnRequest;
use App\Models\Package;
use App\Models\Shelf;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReturnSeeder extends Seeder
{
    public function run(): void
    {
        $package = Package::first();
        // $shelf = Shelf::first();
        $driver = Driver::first(); // Ensure that a package and driver exist before creating a delivery


        // حالة 1: إرجاع إلى رف في المستودع
        ReturnRequest::create([
            'package_id' => $package->id,
            'driver_id'  => $driver->id,
            'return_type' => 'to_warehouse',
            'reason' => 'المنتج مكسور',
            'status' => 'requested',
            'requested_at' => now(),
            // 'target_shelf_id' => $shelf?->id,
            'published_on' => Carbon::now(),
            'created_by' => 'system',
        ]);

        // حالة 2: إرجاع إلى التاجر مباشرة
        ReturnRequest::create([
            'package_id' => $package->id,
            'return_type' => 'to_merchant',
            'reason' => 'المنتج لا يناسب الطلب',
            'status' => 'in_transit',
            'requested_at' => now()->subDays(1),
            'received_at' => now(),
            'target_address' => 'شارع الزبيري - صنعاء',
            'published_on' => Carbon::now(),
            'created_by' => 'admin',
        ]);
    }
}
