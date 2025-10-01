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
        $manageMain = Permission::create(['name' => 'frontend_dashboard_main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        // Main Menus
        $manageMainMenus = Permission::create(['name' => 'frontend_dashboard_manage_main_menus', 'display_name' => ['ar' => 'إدارة القوائم', 'en' => 'Manage Menus'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.index', 'icon' => 'fa fa-list-ul', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '85',]);
        $manageMainMenus->parent_show = $manageMainMenus->id;
        $manageMainMenus->save();
        $showMainMenus    =  Permission::create(['name' => 'frontend_dashboard_show_main_menus',  'display_name' => ['ar'     => 'إدارة القائمة الرئيسية', 'en'  =>   'Main Menu'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createMainMenus  =  Permission::create(['name' => 'frontend_dashboard_create_main_menus', 'display_name'  => ['ar'     => 'إضافة عنصر قائمة رئيسية', 'en'  =>  'Add Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.create', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayMainMenus =  Permission::create(['name' => 'frontend_dashboard_display_main_menus', 'display_name'  => ['ar'     => 'عرض عنصر قائمة رئيسية', 'en'  =>  'Display Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.show', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateMainMenus  =  Permission::create(['name' => 'frontend_dashboard_update_main_menus', 'display_name'  => ['ar'     => 'تعديل عنصر قائمة رئيسية', 'en'  =>  'Edit Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.edit', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteMainMenus  =  Permission::create(['name' => 'frontend_dashboard_delete_main_menus', 'display_name'  => ['ar'     => 'حذف عنصر قائمة رئيسية', 'en'  =>  'Delete Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.destroy', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);


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
