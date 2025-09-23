<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class MerchantPermissionsSeeder extends Seeder
{
    public function run()
    {
        // جلب دور التاجر أو إنشاءه إذا لم يكن موجود
        $merchantRole = Role::firstOrCreate(
            ['name' => 'merchant'],
            [
                'display_name' => 'تاجر', // اسم قابل للعرض
                'description' => 'دور التاجر للوصول لصلاحياته فقط'
            ]
        );



        // مصفوفة صلاحيات التاجر
        $permissions = [
            [
                'name' => 'merchant_show_products',
                'display_name' => ['ar' => 'عرض المنتجات', 'en' => 'Show Products'],
                'route' => 'products',
                'module' => 'products',
                'as' => 'products.index',
                'icon' => 'fas fa-box',
                'parent' => 0,
                'sidebar_link' => 1,
                'appear' => 1,
            ],
            [
                'name' => 'merchant_create_products',
                'display_name' => ['ar' => 'إضافة منتج', 'en' => 'Create Product'],
                'route' => 'products',
                'module' => 'products',
                'as' => 'products.create',
                'icon' => 'fas fa-plus',
                'parent' => 0,
                'sidebar_link' => 0,
                'appear' => 0,
            ],
            [
                'name' => 'merchant_edit_products',
                'display_name' => ['ar' => 'تعديل منتج', 'en' => 'Edit Product'],
                'route' => 'products',
                'module' => 'products',
                'as' => 'products.edit',
                'icon' => 'fas fa-edit',
                'parent' => 0,
                'sidebar_link' => 0,
                'appear' => 0,
            ],
            [
                'name' => 'merchant_delete_products',
                'display_name' => ['ar' => 'حذف منتج', 'en' => 'Delete Product'],
                'route' => 'products',
                'module' => 'products',
                'as' => 'products.destroy',
                'icon' => null,
                'parent' => 0,
                'sidebar_link' => 0,
                'appear' => 0,
            ],

        ];

        // إنشاء الصلاحيات وربطها بدور التاجر
        foreach ($permissions as $permData) {
            $permission = Permission::firstOrCreate(
                ['name' => $permData['name']],
                $permData
            );

            // ربط الدور بالصلاحية إذا لم تكن مرتبطة مسبقاً
            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء صلاحيات التاجر وربطها بالدور بنجاح!');
    }
}
