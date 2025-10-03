<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelstatistics;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Dictionary :
     *              01- Roles
     *              02- Users
     *              03- AttachRoles To  Users
     *              04- Create random customer and  AttachRole to customerRole
     *
     *
     * @return void
     */
    public function run()
    {

        //SystemModulesMenus system_modules_menus
        $SystemModulesMenus = Permission::create(['name' => 'frontend_dashboard_manage_system_modules_menus', 'display_name' => ['ar'    =>  'إدارة قائمة وحدات النظام', 'en'   =>  'System Modules Menu'], 'route' => 'system_modules_menus', 'module' => 'system_modules_menus', 'as' => 'system_modules_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $SystemModulesMenus->parent_show = $SystemModulesMenus->id;
        $SystemModulesMenus->save();
        $showImportantLinkMenus    =  Permission::create(['name' => 'frontend_dashboard_show_system_modules_menus',  'display_name' => ['ar'  =>  'إدارة قائمة وحدات النظام',   'en'    =>  'System Modules Menu'], 'route' => 'system_modules_menus', 'module' => 'system_modules_menus', 'as' => 'system_modules_menus.index', 'icon' => 'fas fa-bars', 'parent' => $SystemModulesMenus->id, 'parent_original' => $SystemModulesMenus->id, 'parent_show' => $SystemModulesMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createImportantLinkMenus  =  Permission::create(['name' => 'frontend_dashboard_create_system_modules_menus', 'display_name'  => ['ar'  =>  'إضافة عنصر قائمة وحدات النظام ',   'en'    =>  'Add System Modules Menu Item'], 'route' => 'system_modules_menus', 'module' => 'system_modules_menus', 'as' => 'system_modules_menus.create', 'icon' => null, 'parent' => $SystemModulesMenus->id, 'parent_original' => $SystemModulesMenus->id, 'parent_show' => $SystemModulesMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayImportantLinkMenus =  Permission::create(['name' => 'frontend_dashboard_display_system_modules_menus', 'display_name'  => ['ar'  =>  'عرض عنصر قائمة وحدات النظام ',   'en'    =>  'Display System Modules Menu Item'], 'route' => 'system_modules_menus', 'module' => 'system_modules_menus', 'as' => 'system_modules_menus.show', 'icon' => null, 'parent' => $SystemModulesMenus->id, 'parent_original' => $SystemModulesMenus->id, 'parent_show' => $SystemModulesMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateImportantLinkMenus  =  Permission::create(['name' => 'frontend_dashboard_update_system_modules_menus', 'display_name'  => ['ar'  =>  'تعديل عنصر قائمة وحدات النظام ',   'en'    =>  'Edit System Modules Menu Item'], 'route' => 'system_modules_menus', 'module' => 'system_modules_menus', 'as' => 'system_modules_menus.edit', 'icon' => null, 'parent' => $SystemModulesMenus->id, 'parent_original' => $SystemModulesMenus->id, 'parent_show' => $SystemModulesMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteImportantLinkMenus  =  Permission::create(['name' => 'frontend_dashboard_delete_system_modules_menus', 'display_name'  => ['ar'  =>  'حذف عنصر قائمة وحدات النظام ',   'en'    =>  'Delete System Modules Menu Item'], 'route' => 'system_modules_menus', 'module' => 'system_modules_menus', 'as' => 'system_modules_menus.destroy', 'icon' => null, 'parent' => $SystemModulesMenus->id, 'parent_original' => $SystemModulesMenus->id, 'parent_show' => $SystemModulesMenus->id, 'sidebar_link' => '0', 'appear' => '0']);


    }
}
