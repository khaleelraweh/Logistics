<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuProperty;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuPropertySeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // جلب جميع وحدات النظام
        $modules = Menu::where('section', 3)->get();

        $propertiesData = [
            ['ar' => 'الإرجاع عبر قنوات متعددة', 'en' => 'Multi-channel Returns'],
            ['ar' => 'تجميع المرتجعات', 'en' => 'Returns Consolidation'],
            ['ar' => 'التتبع الحي', 'en' => 'Live Tracking'],
            ['ar' => 'التسوية المالية', 'en' => 'Financial Settlement'],
        ];

        foreach ($modules as $module) {
            foreach ($propertiesData as $prop) {
                MenuProperty::create([
                    'menu_id'        => $module->id,
                    'property_value' => $prop,
                    'created_by'     => 'admin',
                    'status'         => true,
                    'published_on'   => $faker->dateTimeBetween('-6 months', 'now'),
                ]);
            }
        }
    }
}
