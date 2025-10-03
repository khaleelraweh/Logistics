<?php

namespace Database\Seeders;

use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemModulesMenuSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $links = [
            [
                'title' => ['ar' => 'تتبع الشحنة', 'en' => 'Track Shipment'],
                'link'  => ['ar' => 'tracking', 'en' => 'tracking'],
                'icon'  => 'fa fa-map-marker-alt',
            ],
            [
                'title' => ['ar' => 'حساب تكلفة الشحن', 'en' => 'Shipping Rates'],
                'link'  => ['ar' => 'rates', 'en' => 'rates'],
                'icon'  => 'fa fa-calculator',
            ],
            [
                'title' => ['ar' => 'مراكز التخزين', 'en' => 'Warehouses'],
                'link'  => ['ar' => 'warehouses', 'en' => 'warehouses'],
                'icon'  => 'fa fa-warehouse',
            ],
            [
                'title' => ['ar' => 'بوابة التاجر', 'en' => 'Merchant Portal'],
                'link'  => ['ar' => 'merchant/portal', 'en' => 'merchant/portal'],
                'icon'  => 'fa fa-store',
            ],
            [
                'title' => ['ar' => 'اتصل بنا', 'en' => 'Contact Us'],
                'link'  => ['ar' => 'contact', 'en' => 'contact'],
                'icon'  => 'fa fa-envelope',
            ],
        ];

        foreach ($links as $item) {
            Menu::create([
                'title'        => $item['title'],
                'icon'         => $item['icon'],
                'link'         => $item['link'],
                'created_by'   => 'admin',
                'status'       => true,
                'section'      => 3,
                'published_on' => $faker->dateTimeBetween('-6 months', 'now'),
                'parent_id'    => null,
            ]);
        }
    }
}
