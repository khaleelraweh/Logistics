<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class MerchantDashboardRolePermissionsSeeder extends Seeder
{
    public function run()
    {
        // 1- create mercahnt Role
        $merchantRole = Role::create([
            'name' => 'merchant',
            'display_name' => 'Merchant',
            'description' => 'User is merchant and has his own dashboard',
            'allowed_route' => 'merchant',
        ]);

        // 2- Create Merchant Permission

         //===== Dashboard =====
        $manageMain = Permission::create(['name' => 'merchant_main', 'display_name' => ['ar' => 'الرئيسية', 'en'    => 'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fa fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        //===== Packages =====
        //Packages / packages
        $managePackages = Permission::create(['name' => 'merchant_manage_packages', 'display_name' => ['ar'  =>  'إدارة الطرود',  'en'    =>  'Manage Packages'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.index', 'icon' => 'fas fa-boxes', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $managePackages->parent_show = $managePackages->id;
        $managePackages->save();
        $showPackages    =  Permission::create(['name' => 'merchant_show_packages',  'display_name' =>   ['ar'   =>  'الطرود',   'en'        =>  'Packages'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.index', 'icon' => 'fas fa-boxes', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPackages  =  Permission::create(['name' => 'merchant_create_packages', 'display_name'  =>   ['ar'   =>  'إضافة طرد',   'en'       =>  'Add New Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPackages =  Permission::create(['name' => 'merchant_display_packages', 'display_name'  =>   ['ar'   =>  'استعراض طرد',   'en'      =>  'Display Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePackages  =  Permission::create(['name' => 'merchant_update_packages', 'display_name'  =>   ['ar'   =>  'تعديل طرد',   'en'        =>  'Update Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePackages  =  Permission::create(['name' => 'merchant_delete_packages', 'display_name'  =>   ['ar'   =>  'حذف طرد',   'en'          =>  'Delete Package'], 'route' => 'packages', 'module' => 'packages', 'as' => 'packages.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        // ===== Products =====
        $manageProducts = Permission::create(['name' => 'merchant_manage_products',  'display_name' => ['ar' => 'إدارة المنتجات', 'en' => 'Manage Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fab fa-product-hunt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link'    => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();
        $showProducts = Permission::create([ 'name' => 'merchant_show_products', 'display_name' => ['ar' => 'عرض المنتجات', 'en' => 'Show Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-box', 'parent'  => '0' , 'parent_original' => '0' , 'parent_show' => '0', 'sidebar_link' => '0', 'appear'  => '0',]);
        $createProducts = Permission::create(['name' => 'merchant_create_products', 'display_name' => ['ar' => 'إضافة منتج', 'en' => 'Create Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => 'fas fa-plus','parent' => '0' , 'parent_original' => '0' , 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0',]);
        $editProducts = Permission::create(['name' => 'merchant_edit_products' , 'display_name' => ['ar' => 'تعديل منتج', 'en' => 'Edit Product'] , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.edit' , 'icon' => 'fas fa-edit' , 'parent' => '0' , 'parent_original' => '0' , 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0',]);
        $deleteProducts = Permission::create(['name' => 'merchant_delete_products' , 'display_name' => ['ar' => 'حذف منتج', 'en' => 'Delete Product'] , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.destroy' , 'icon' => null , 'parent' => '0' , 'parent_original' => '0','parent_show' => '0' , 'sidebar_link' => '0' , 'appear' => '0',]);


        //PickupRequests / pickupRequests
        $managePickupRequests = Permission::create(['name' => 'merchant_manage_pickup_requests', 'display_name' => ['ar'  =>  'إدارة طلبات الاستلام',  'en'    =>  'Manage Pickup Requests'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.index', 'icon' => 'fas fa-truck-loading', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $managePickupRequests->parent_show = $managePickupRequests->id;
        $managePickupRequests->save();
        $showPickupRequests    =  Permission::create(['name' => 'merchant_show_pickup_requests',  'display_name' =>   ['ar'   =>  'طلبات الاستلام',   'en'        =>  'Pickup Requests'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.index', 'icon' => 'fas fa-truck-loading', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $createPickupRequests  =  Permission::create(['name' => 'merchant_create_pickup_requests', 'display_name'  =>   ['ar'   =>  'إضافة عملية طلب استلام',   'en'       =>  'Add New Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $displayPickupRequests =  Permission::create(['name' => 'merchant_display_pickup_requests', 'display_name'  =>   ['ar'   =>  'استعراض عملية طلب استلام',   'en'      =>  'Display Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $updatePickupRequests  =  Permission::create(['name' => 'merchant_update_pickup_requests', 'display_name'  =>   ['ar'   =>  'تعديل عملية طلب استلام',   'en'        =>  'Update Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        $deletePickupRequests  =  Permission::create(['name' => 'merchant_delete_pickup_requests', 'display_name'  =>   ['ar'   =>  'حذف عملية طلب استلام',   'en'          =>  'Delete Pickup Request'], 'route' => 'pickup_requests', 'module' => 'pickup_requests', 'as' => 'pickup_requests.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);


        // 3- Add Merchant Permission to the Role
        $permissions = [
            // Dashboard
            $manageMain,
            // Packages
            $managePackages,$showPackages,$createPackages,$displayPackages,$updatePackages,$deletePackages,
            // Products
            $manageProducts,$showProducts,$createProducts,$editProducts,$deleteProducts,
        ];

        foreach ($permissions as $permission) {
            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات التاجر وربطها بالدور بنجاح!');


    }
}
