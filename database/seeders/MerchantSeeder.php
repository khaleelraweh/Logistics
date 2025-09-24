<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MerchantSeeder extends Seeder
{
    public function run()
    {
        // إنشاء التاجر
        $merchant = Merchant::create([
            'name' => ['ar' => 'متجر النجاح', 'en' => 'Al Nagah Store'],
            'slug' => ['ar' => 'متجر-النجاح', 'en' => 'al-nagah-store'],
            'country' => 'اليمن',
            'region' => 'صنعاء',
            'city' => 'صنعاء',
            'district' => 'الزبيري',
            'postal_code' => '11111',
            'latitude' => 15.3547,
            'longitude' => 44.2066,
            'others' => 'ملاحظات إضافية عن موقع المتجر',
            'contact_person' => ['ar' => 'أحمد محمد', 'en' => 'Ahmed Mohamed'],
            'phone' => '777777777',
            'email' => 'alnagah@gmail.com',
            'api_key' => Str::uuid(),
            'logo' => null,
            'facebook' => 'https://facebook.com/alnagah',
            'twitter' => 'https://twitter.com/alnagah',
            'instagram' => 'https://instagram.com/alnagah',
            'linkedin' => null,
            'youtube' => null,
            'website' => 'https://alnagahstore.com',
            'status' => true,
            'published_on' => Carbon::now(),
            'created_by' => 'Seeder',
        ]);

        // جلب أو إنشاء دور التاجر
        $merchantRole = Role::firstOrCreate(
            ['name' => 'merchant'],
            [
                'display_name' => 'تاجر',
                'description' => 'دور التاجر للوصول لصلاحياته فقط'
            ]
        );

        // ربط التاجر بالدور
        if (!$merchant->hasRole($merchantRole->name)) {
            $merchant->attachRole($merchantRole);
        }

        // صلاحيات التاجر
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

        // إنشاء الصلاحيات وربطها بالدور
        foreach ($permissions as $permData) {
            $permission = Permission::firstOrCreate(['name' => $permData['name']], $permData);

            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء التاجر وربطه بالدور والصلاحيات بنجاح!');
    }
}
