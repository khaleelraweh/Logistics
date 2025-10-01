<?php

namespace Database\Seeders;

use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // الرئيسية
        $main = Menu::create([
            'title'  => ['ar' => 'الرئيسية', 'en' => 'Home'],
            'icon'   => 'fa fa-home',
            'link'   => 'index',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);

        // عن الشركة
        $about = Menu::create([
            'title'  => ['ar' => 'عن الشركة', 'en' => 'About Us'],
            'icon'   => 'fa fa-info-circle',
            'link'   => ['ar' => 'about', 'en' => 'about'],
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);
        Menu::create([
            'title'  => ['ar' => 'رؤيتنا', 'en' => 'Our Vision'],
            'icon'   => 'fa fa-eye',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $about->id
        ]);
        Menu::create([
            'title'  => ['ar' => 'مهمتنا', 'en' => 'Our Mission'],
            'icon'   => 'fa fa-bullseye',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $about->id
        ]);

        // خدماتنا
        $services = Menu::create([
            'title'  => ['ar' => 'خدماتنا', 'en' => 'Services'],
            'icon'   => 'fa fa-truck',
            'link'   => ['ar' => 'services', 'en' => 'services'],
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);
        Menu::create([
            'title'  => ['ar' => 'الشحن السريع', 'en' => 'Express Delivery'],
            'icon'   => 'fa fa-bolt',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $services->id
        ]);
        Menu::create([
            'title'  => ['ar' => 'التخزين', 'en' => 'Storage'],
            'icon'   => 'fa fa-warehouse',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $services->id
        ]);
        Menu::create([
            'title'  => ['ar' => 'التتبع المباشر', 'en' => 'Live Tracking'],
            'icon'   => 'fa fa-map-marker-alt',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $services->id
        ]);

        // مميزاتنا
        $features = Menu::create([
            'title'  => ['ar' => 'مميزاتنا', 'en' => 'Features'],
            'icon'   => 'fa fa-star',
            'link'   => ['ar' => 'features', 'en' => 'features'],
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);
        Menu::create([
            'title'  => ['ar' => 'توصيل سريع', 'en' => 'Fast Delivery'],
            'icon'   => 'fa fa-shipping-fast',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $features->id
        ]);
        Menu::create([
            'title'  => ['ar' => 'دعم 24/7', 'en' => '24/7 Support'],
            'icon'   => 'fa fa-headset',
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => $features->id
        ]);

        // تواصل معنا
        $contact = Menu::create([
            'title'  => ['ar' => 'تواصل معنا', 'en' => 'Contact Us'],
            'icon'   => 'fa fa-envelope',
            'link'   => ['ar' => 'contact', 'en' => 'contact'],
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);

        // الأسئلة الشائعة
        $faq = Menu::create([
            'title'  => ['ar' => 'الأسئلة الشائعة', 'en' => 'FAQ'],
            'icon'   => 'fa fa-question-circle',
            'link'   => ['ar' => 'faq', 'en' => 'faq'],
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);

        // سياسة الخصوصية
        $privacy = Menu::create([
            'title'  => ['ar' => 'سياسة الخصوصية', 'en' => 'Privacy Policy'],
            'icon'   => 'fa fa-user-secret',
            'link'   => ['ar' => 'privacy', 'en' => 'privacy'],
            'created_by' => 'admin',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'parent_id' => null
        ]);
    }
}
