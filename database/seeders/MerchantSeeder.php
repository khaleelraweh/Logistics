<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MerchantSeeder extends Seeder
{
    public function run()
    {
        // إنشاء التاجر في جدول merchants
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
            'username'      => 'alnagah',
            'password'      => bcrypt('123123123'), // تغيير لاحقًا
        ]);

        // إنشاء نسخة في جدول users
        $user = User::create([
            'first_name' => $merchant->name,
            'last_name' => $merchant->contact_person,
            'username' => $merchant->username,
            'email' => $merchant->email,
            'mobile' => $merchant->phone,
            'password' => $merchant->password,
            'status' => 1,
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

        // ربط المستخدم بالدور
        if (!$user->hasRole($merchantRole->name)) {
            $user->attachRole($merchantRole);
        }

        // صلاحيات التاجر من جدول الصلاحيات (إذا كانت موجودة مسبقًا)
        $permissions = Permission::where('name', 'like', 'merchant_%')->get();
        foreach ($permissions as $permission) {
            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        $this->command->info('تم إنشاء التاجر وربطه بالدور والصلاحيات في جدول users بنجاح!');
    }
}
