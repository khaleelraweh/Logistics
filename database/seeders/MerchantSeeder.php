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
            'name' => ['ar' =>  'متجر النجاح', 'en' =>  'Al nagah Store'],
            'address' => ['ar'  =>  'صنعاء - شارع الزبيري', 'en'    =>  'Sanaa - Alzobayra Street'],
            'contact_person' =>['ar'    =>   'أحمد محمد', 'en'  =>  'Ahmed Mohamed' ],
            'phone' => '777777777',
            'email' =>  'Alnagah@gmail.com',
            'api_key' => Str::uuid(),
        ]);

    }
}
