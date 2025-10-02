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
        $manageMainMenus = Permission::create(['name' => 'frontend_dashboard_manage_main_menus', 'display_name' => ['ar' => 'إدارة القوائم', 'en' => 'Manage Menus'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.index', 'icon' => 'fa fa-list-ul', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageMainMenus->parent_show = $manageMainMenus->id;
        $manageMainMenus->save();
        $showMainMenus    =  Permission::create(['name' => 'frontend_dashboard_show_main_menus',  'display_name' => ['ar'     => 'إدارة القائمة الرئيسية', 'en'  =>   'Main Menu'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createMainMenus  =  Permission::create(['name' => 'frontend_dashboard_create_main_menus', 'display_name'  => ['ar'     => 'إضافة عنصر قائمة رئيسية', 'en'  =>  'Add Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.create', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayMainMenus =  Permission::create(['name' => 'frontend_dashboard_display_main_menus', 'display_name'  => ['ar'     => 'عرض عنصر قائمة رئيسية', 'en'  =>  'Display Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.show', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateMainMenus  =  Permission::create(['name' => 'frontend_dashboard_update_main_menus', 'display_name'  => ['ar'     => 'تعديل عنصر قائمة رئيسية', 'en'  =>  'Edit Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.edit', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteMainMenus  =  Permission::create(['name' => 'frontend_dashboard_delete_main_menus', 'display_name'  => ['ar'     => 'حذف عنصر قائمة رئيسية', 'en'  =>  'Delete Main Menu Item'], 'route' => 'main_menus', 'module' => 'main_menus', 'as' => 'main_menus.destroy', 'icon' => null, 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'parent_show' => $manageMainMenus->id, 'sidebar_link' => '0', 'appear' => '0']);


        //importantlink menu
        $manageImportantLinkMenus = Permission::create(['name' => 'frontend_dashboard_manage_important_link_menus', 'display_name' => ['ar'    =>  'إدارة قائمة روابط مهمة', 'en'   =>  'Important Link Menu'], 'route' => 'important_link_menus', 'module' => 'important_link_menus', 'as' => 'important_link_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageMainMenus->id, 'parent_original' => $manageMainMenus->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageImportantLinkMenus->parent_show = $manageImportantLinkMenus->id;
        $manageImportantLinkMenus->save();
        $showImportantLinkMenus    =  Permission::create(['name' => 'frontend_dashboard_show_important_link_menus',  'display_name' => ['ar'  =>  'إدارة قائمة روابط مهمة',   'en'    =>  'Important Link Menu'], 'route' => 'important_link_menus', 'module' => 'important_link_menus', 'as' => 'important_link_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageImportantLinkMenus->id, 'parent_original' => $manageImportantLinkMenus->id, 'parent_show' => $manageImportantLinkMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createImportantLinkMenus  =  Permission::create(['name' => 'frontend_dashboard_create_important_link_menus', 'display_name'  => ['ar'  =>  'إضافة عنصر قائمة روابط مهمة ',   'en'    =>  'Add Important Link Menu Item'], 'route' => 'important_link_menus', 'module' => 'important_link_menus', 'as' => 'important_link_menus.create', 'icon' => null, 'parent' => $manageImportantLinkMenus->id, 'parent_original' => $manageImportantLinkMenus->id, 'parent_show' => $manageImportantLinkMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayImportantLinkMenus =  Permission::create(['name' => 'frontend_dashboard_display_important_link_menus', 'display_name'  => ['ar'  =>  'عرض عنصر قائمة روابط مهمة ',   'en'    =>  'Display Important Link Menu Item'], 'route' => 'important_link_menus', 'module' => 'important_link_menus', 'as' => 'important_link_menus.show', 'icon' => null, 'parent' => $manageImportantLinkMenus->id, 'parent_original' => $manageImportantLinkMenus->id, 'parent_show' => $manageImportantLinkMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateImportantLinkMenus  =  Permission::create(['name' => 'frontend_dashboard_update_important_link_menus', 'display_name'  => ['ar'  =>  'تعديل عنصر قائمة روابط مهمة ',   'en'    =>  'Edit Important Link Menu Item'], 'route' => 'important_link_menus', 'module' => 'important_link_menus', 'as' => 'important_link_menus.edit', 'icon' => null, 'parent' => $manageImportantLinkMenus->id, 'parent_original' => $manageImportantLinkMenus->id, 'parent_show' => $manageImportantLinkMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteImportantLinkMenus  =  Permission::create(['name' => 'frontend_dashboard_delete_important_link_menus', 'display_name'  => ['ar'  =>  'حذف عنصر قائمة روابط مهمة ',   'en'    =>  'Delete Important Link Menu Item'], 'route' => 'important_link_menus', 'module' => 'important_link_menus', 'as' => 'important_link_menus.destroy', 'icon' => null, 'parent' => $manageImportantLinkMenus->id, 'parent_original' => $manageImportantLinkMenus->id, 'parent_show' => $manageImportantLinkMenus->id, 'sidebar_link' => '0', 'appear' => '0']);



            //main sliders
        $manageMainSliders = Permission::create(['name' => 'frontend_dashboard_manage_main_sliders', 'display_name' => ['ar'    =>  'إدارة عارض الشرائح', 'en' =>  'Manage Slide Viewer'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.index', 'icon' => 'fas fa-sliders-h', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageMainSliders->parent_show = $manageMainSliders->id;
        $manageMainSliders->save();
        $showMainSliders    =  Permission::create(['name' => 'frontend_dashboard_show_main_sliders', 'display_name'    =>  ['ar'    =>  ' عارض الشرائح الرئيسي',   'en'    =>  'Main Slide Viewer'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.index', 'icon' => 'fas  fa-sliders-h', 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createMainSliders  =  Permission::create(['name' => 'frontend_dashboard_create_main_sliders', 'display_name'    =>  ['ar'    =>  'إضافة شريحة جديد',   'en'    =>  'Add Slide'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.create', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayMainSliders =  Permission::create(['name' => 'frontend_dashboard_display_main_sliders', 'display_name'    =>  ['ar'    =>  'عرض الشريحة',   'en'    =>  'Display Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.show', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateMainSliders  =  Permission::create(['name' => 'frontend_dashboard_update_main_sliders', 'display_name'    =>  ['ar'    =>  'تعديل الشريحة',   'en'    =>  'Edit Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.edit', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteMainSliders  =  Permission::create(['name' => 'frontend_dashboard_delete_main_sliders', 'display_name'    =>  ['ar'    =>  'حذف الشريحة',   'en'    =>  'Delete Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.destroy', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Advertisor sliders
        $manageAdvertisorSliders = Permission::create(['name' => 'frontend_dashboard_manage_advertisor_sliders', 'display_name' => ['ar'    =>  'عارض شرائح الإعلانات', 'en'   =>  'Adv Slide Viewer'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageMainSliders->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageAdvertisorSliders->parent_show = $manageAdvertisorSliders->id;
        $manageAdvertisorSliders->save();
        $showAdvertisorSliders    =  Permission::create(['name' => 'frontend_dashboard_show_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'عارض شرائح الإعلانات',   'en'    =>  'Adv Slide Viewer'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createAdvertisorSliders  =  Permission::create(['name' => 'frontend_dashboard_create_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'إضافة شريحة جديد',   'en'    =>  'Add Adv Slide'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.create', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayAdvertisorSliders =  Permission::create(['name' => 'frontend_dashboard_display_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'عرض الشريحة',   'en'    =>  'Display Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.show', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateAdvertisorSliders  =  Permission::create(['name' => 'frontend_dashboard_update_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'تعديل الشريحة',   'en'    =>  'Edit Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.edit', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteAdvertisorSliders  =  Permission::create(['name' => 'frontend_dashboard_delete_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'حذف الشريحة',   'en'    =>  'Delete Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.destroy', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);


        // Partners
        $managePartners = Permission::create(['name' => 'manage_partners', 'display_name' => ['ar'  =>  'شركاؤنا',    'en'    =>  'Our Partners'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.index', 'icon' => 'far fa-handshake', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
        $managePartners->parent_show = $managePartners->id;
        $managePartners->save();
        $showPartners   =  Permission::create(['name'  => 'show_partners', 'display_name'       =>  ['ar'   =>  'شركاؤنا',   'en'    =>  'Our Partners'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.index', 'icon' => 'far fa-handshake', 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
        $createPartners =  Permission::create(['name'  => 'create_partners', 'display_name'     =>  ['ar'   =>  'إنشاء شريك',   'en'    =>  'Create Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.create', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPartners =  Permission::create(['name' => 'display_partners', 'display_name'    =>  ['ar'   =>  'عرض شريك',   'en'    =>  'Display Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.show', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePartners  =  Permission::create(['name' => 'update_partners', 'display_name'     =>  ['ar'   =>  'تعديل شريك',   'en'    =>  'Edit Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.edit', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePartners =  Permission::create(['name'  => 'delete_partners', 'display_name'     =>  ['ar'   =>  'حذف شريك',   'en'    =>  'Delete Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.destroy', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);


        // 3- attatch role to permssions
        $permissions = [
            // Dashboard
            $manageMain,
            // Main Menus
            $manageMainMenus,$showMainMenus,$createMainMenus,$displayMainMenus,$updateMainMenus,$deleteMainMenus,
            // Important Link Menus
            $manageImportantLinkMenus,$showImportantLinkMenus,$createImportantLinkMenus,$displayImportantLinkMenus,$updateImportantLinkMenus,$deleteImportantLinkMenus,
            // Main Sliders
            $manageMainSliders,$showMainSliders,$createMainSliders,$displayMainSliders,$updateMainSliders,$deleteMainSliders,
            // Advertisor Sliders
            $manageAdvertisorSliders,$showAdvertisorSliders,$createAdvertisorSliders,$displayAdvertisorSliders,$updateAdvertisorSliders,$deleteAdvertisorSliders,
            // Partners
            $managePartners,$showPartners,$createPartners,$displayPartners,$updatePartners,$deletePartners,

        ];

        foreach ($permissions as $permission) {
            if (!$frontendRole->hasPermission($permission->name)) {
                $frontendRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات واجهة التحكم frontend  وربطها بالدور بنجاح!');
    }
}
