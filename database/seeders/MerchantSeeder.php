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
        // 1- create Merchant account
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

        // 2- add user account to merchant
        $merchantUser = User::create([
            'first_name' => $merchant->name,
            'last_name' => $merchant->contact_person,
            'username' => 'alnagah',
            'email' => $merchant->email,
            'email_verified_at' => now(),
            'mobile' => $merchant->phone,
            'password'      => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'layout_preferences'    => json_encode([
                                        "layout"    => "vertical",
                                        "topbar"    => "dark",
                                        "sidebar"   => "dark",
                                        "sidebar_size"  => "default",
                                        "layout_size"   => "fluid",
                                        "preloader" => true,
                                        "rtl"   => true,
                                        "mode"  => "light",
                                        "locale" => session('locale', config('locales.fallback_locale')),
                                    ]),
            'status' => 1,
            'remember_token' => Str::random(10),
            'created_by' => 'Seeder',
        ]);

        // 3- connect merchant account to user account
        $merchant->update(['user_id' => $merchantUser->id]);


        // 4- connect user account of the merchant to the role merchant
        $merchantRole = Role::where('name', 'merchant')->first();

        if (!$merchantUser->hasRole($merchantRole->name)) {
            $merchantUser->attachRole($merchantRole);
        }

        // 5- add merchant permission to the merchant user
        $permissions = Permission::where('name', 'like', 'merchant_%')->get();
        foreach ($permissions as $permission) {
            if (!$merchantRole->hasPermission($permission->name)) {
                $merchantRole->attachPermission($permission);
            }
        }

        // 6- gave a message of successfull
        $this->command->info('تم إنشاء التاجر وربطه بالدور والصلاحيات في جدول users بنجاح!');
    }
}
