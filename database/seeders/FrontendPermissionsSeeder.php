<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class FrontendPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // جلب دور المصمم الواجهات الامامية أو إنشاؤه إذا لم يكن موجود
        $frontendRole = Role::firstOrCreate(
            ['name' => 'frontend_dashboard'],
            [
                'display_name' => 'Frontend Dashboard',
                'description' => 'User is Frontend designer and has his own dashboard',
                'allowed_route' => 'frontend_dashboard',
            ]
        );

         //===== Dashboard =====
        $manageMain = Permission::create(['name' => 'merchant_main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // ربط الصلاحيات بدور التاجر
        $permissions = [
            // Dashboard
            $manageMain,

        ];

        foreach ($permissions as $permission) {
            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات التاجر وربطها بالدور بنجاح!');
    }
}
