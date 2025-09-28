<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class DriverDashboardPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // جلب دور المصمم الواجهات الامامية أو إنشاؤه إذا لم يكن موجود
        $driverRole = Role::firstOrCreate(
            ['name' => 'driver'],
            [
                'display_name' => 'driver',
                'description' => 'User is driver and has his own dashboard',
                'allowed_route' => 'driver',
            ]
        );

         //===== Dashboard =====
        $manageMain = Permission::create(['name' => 'driver_main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // ربط الصلاحيات بدور التاجر
        $permissions = [
            // Dashboard
            $manageMain,

        ];

        foreach ($permissions as $permission) {
            if (!$driverRole->hasPermission($permission->name)) {
                $driverRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات التاجر وربطها بالدور بنجاح!');
    }
}
