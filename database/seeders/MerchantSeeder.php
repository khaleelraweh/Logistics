<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
