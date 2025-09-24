<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class MerchantPermissionsSeeder extends Seeder
{
    public function run()
    {
        // جلب دور التاجر أو إنشاؤه إذا لم يكن موجود
        $merchantRole = Role::firstOrCreate(
            ['name' => 'merchant'],
            [
                'display_name' => 'تاجر',
                'description'  => 'دور التاجر للوصول لصلاحياته فقط'
            ]
        );

        // ===== Products =====
        $manageProducts = Permission::create(['name' => 'merchant_manage_products',  'display_name' => ['ar' => 'إدارة المنتجات', 'en' => 'Manage Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fab fa-product-hunt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link'    => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();

        $showProducts = Permission::create([ 'name' => 'merchant_show_products', 'display_name' => ['ar' => 'عرض المنتجات', 'en' => 'Show Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-box', 'parent'  => '0' , 'parent_original' => '0' , 'parent_show' => '0', 'sidebar_link' => '0', 'appear'  => '0',]);

        $createProducts = Permission::create(['name' => 'merchant_create_products', 'display_name' => ['ar' => 'إضافة منتج', 'en' => 'Create Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => 'fas fa-plus','parent' => '0' , 'parent_original' => '0' , 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0',]);

        $editProducts = Permission::create(['name' => 'merchant_edit_products' , 'display_name' => ['ar' => 'تعديل منتج', 'en' => 'Edit Product'] , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.edit' , 'icon' => 'fas fa-edit' , 'parent' => '0' , 'parent_original' => '0' , 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0',]);

        $deleteProducts = Permission::create(['name' => 'merchant_delete_products' , 'display_name' => ['ar' => 'حذف منتج', 'en' => 'Delete Product'] , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.destroy' , 'icon' => null , 'parent' => '0' , 'parent_original' => '0','parent_show' => '0' , 'sidebar_link' => '0' , 'appear' => '0',]);

        // ربط الصلاحيات بدور التاجر
        $permissions = [
            $manageProducts,
            $showProducts,
            $createProducts,
            $editProducts,
            $deleteProducts,
        ];

        foreach ($permissions as $permission) {
            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات التاجر وربطها بالدور بنجاح!');
    }
}
