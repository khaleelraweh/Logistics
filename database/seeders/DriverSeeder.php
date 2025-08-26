<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    public function run()
    {
        Driver::create([
            'first_name' => ['ar' => 'خالد', 'en' => 'Khaled'],
            'middle_name' => ['ar' => 'احمد', 'en' => 'Ahmed'],
            'last_name' => ['ar' => 'حمود', 'en' => 'Hammoud'],
            'phone' => '777123456',
            'username' => 'driver_khaled',
            'email' => 'khaled@example.com',
            'password' => Hash::make('password123'),

            'license_number' => 'LIC-123456',
            'vehicle_type' => 'Van',
            'vehicle_number' => 'ABC-9876',
            'vehicle_model' => 'Hyundai H1',
            'vehicle_color' => 'White',

            'license_image' => 'licenses/khaled_license.jpg',
            'id_card_image' => 'id_cards/khaled_id.jpg',
            'license_expiry_date' => now()->addYear(),

            'hired_date' => now()->subMonths(3),

            'total_deliveries' => 28,
            'rating' => 4.6,

            // 'vehicle_capacity_weight' => 1000.00, // كيلوغرام
            // 'vehicle_capacity_volume' => 12.50,   // متر مكعب

            'availability_status' => 'available',
            'last_seen_at' => now(),

            'status' => 'active',
            'reason' => null,
            'published_on' => now(),

            'created_by' => 'system',
            'updated_by' => null,
        ]);
    }
}
