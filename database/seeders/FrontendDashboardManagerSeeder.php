<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrontendDashboardManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 2- add user account to frontend manager
        $frontendDashboardManager = User::create([
            'first_name' => ['ar'   =>  'واجهة امامية' , 'en'   => 'Frontend'],
            'last_name' => ['ar'    => 'مدير' , 'en'    =>  'Manager'],
            'username' => 'frontend_manager',
            'email' => 'frontend_manager@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036166',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
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
            'remember_token' => Str::random(10),
        ]);




        // 4- connect user account of the frontend manager to the role frontend_dashboard
        $frontendDashboardRole = Role::where('name', 'frontend_dashboard')->first();

        if (!$frontendDashboardManager->hasRole($frontendDashboardRole->name)) {
            $frontendDashboardManager->attachRole($frontendDashboardRole);
        }

        // 5- add driver permission to the driver user
        $permissions = Permission::where('name', 'like', 'frontend_dashboard_%')->get();
        foreach ($permissions as $permission) {
            if (!$frontendDashboardRole->hasPermission($permission->name)) {
                $frontendDashboardRole->attachPermission($permission);
            }
        }

        // 6- gave a message of successfull
        $this->command->info('تم إنشاء مدير لوحة تحكم الواجهة الامامية  وربطه بالدور والصلاحيات في جدول users بنجاح!');

    }
}
