<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageLog;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ============== Create a package ==============//
        $package = Package::first(); // أو where('tracking_number', '123456')->first();
        if (!$package) {
            // If no package exists, you might want to create one or handle the case
            $this->command->error('No package found. Please run PackageSeeder first.');
            return;
        }

        // Package Log
        PackageLog::create([
            'package_id' => $package->id,
            'status' => 'pending',
            'note' => 'تم انشاء الطلب',
            'logged_at' => Carbon::now(),
        ]);
    }
}
