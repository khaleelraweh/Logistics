<?php

namespace Database\Seeders;

use App\Models\ShippingPartner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partner = ShippingPartner::create([
            'name' => ['ar' => 'شريك شحن سريع', 'en' => 'Fast Shipping Partner'],
            'description' => ['ar' => 'شريك شحن سريع', 'en' => 'Fast Shipping Partner'],
            'contact_person' => [ 'ar' =>  'محمد على' , 'en'   =>  'Moamed Ali' ],
            'contact_email' =>  'FastShipping@gmail.com',
            'contact_phone' =>  '772036131',
            'api_url' => 'https://api.fastship.com',
            'api_token' => 'tokentest123'
        ]);
    }
}
