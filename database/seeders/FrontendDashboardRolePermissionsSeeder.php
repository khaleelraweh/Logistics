<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class FrontendDashboardRolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1- create frontend dashboard role
       $frontendRole = Role::create([
            'name' => 'frontend_dashboard',
            'display_name' => 'Frontend Dashboard',
            'description' => 'User is Frontend designer and has his own dashboard',
            'allowed_route' => 'frontend_dashboard',
        ]);

        // 2- create frontend dashboard permissions
         //===== Dashboard =====
        $manageMain = Permission::create(['name' => 'frontend_main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // 3- attatch role to permssions
        $permissions = [
            // Dashboard
            $manageMain,

        ];

        foreach ($permissions as $permission) {
            if (!$frontendRole->hasPermission($permission->name)) {
                $frontendRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات واجهة التحكم frontend  وربطها بالدور بنجاح!');
    }
}
