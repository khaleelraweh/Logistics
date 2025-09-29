<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    public function run()
    {
        $driver = Driver::create([
            'first_name' => ['ar' => 'خالد', 'en' => 'Khaled'],
            'middle_name' => ['ar' => 'احمد', 'en' => 'Ahmed'],
            'last_name' => ['ar' => 'حمود', 'en' => 'Hammoud'],
            'phone' => '777123456',
            'username' => 'driver_khaled',
            'email' => 'khaled@example.com',
            'password' => Hash::make('password123'),

            'license_number' => 'LIC-123456',
            'vehicle_type' => 'van',
            'vehicle_number' => 'ABC-9876',
            'vehicle_model' => 'Hyundai H1',
            'vehicle_color' => 'white',

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


        // 2- add user account to driver
        $driverUser = User::create([
            'first_name' => $driver->name,
            'last_name' => $driver->contact_person,
            'username' => 'alnagah',
            'email' => $driver->email,
            'mobile' => $driver->phone,
            'password'      => bcrypt('123123123'),
            'layout_preferences'    => json_encode([
                                        "layout"    => "vertical",
                                        "topbar"    => "dark",
                                        "sidebar"   => "dark",
                                        "sidebar_size"  => "default",
                                        "layout_size"   => "fluid",
                                        "preloader" => true,
                                        "rtl"   => true,
                                        "mode"  => "light",
                                        "locale" => session('locale', config('locales.fallback_locale')),
                                    ]),
            'status' => 1,
            'created_by' => 'Seeder',
        ]);

        // 3- connect driver account to user account
        $driver->update(['user_id' => $driverUser->id]);


        // 4- connect user account of the driver to the role driver
        $driverRole = Role::where('name', 'driver')->first();

        if (!$driverUser->hasRole($driverRole->name)) {
            $driverUser->attachRole($driverRole);
        }

        // 5- add driver permission to the driver user
        $permissions = Permission::where('name', 'like', 'driver_%')->get();
        foreach ($permissions as $permission) {
            if (!$driverRole->hasPermission($permission->name)) {
                $driverRole->attachPermission($permission);
            }
        }

        // 6- gave a message of successfull
        $this->command->info('تم إنشاء السائق وربطه بالدور والصلاحيات في جدول users بنجاح!');

    }
}
