<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Faker\Factory as Faker;

class AdvertisorSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Faker::create();
        $target = ['_self', '_blank'];

        $slides = [
            [
                'title'       => ['ar' => 'خدمة التوصيل السريع', 'en' => 'Express Delivery Service'],
                'subtitle'    => ['ar' => 'شحن آمن إلى جميع المدن', 'en' => 'Safe shipping to all cities'],
                'description' => ['ar' => 'توصيل سريع وآمن للطرود مع إمكانية التتبع المباشر.', 'en' => 'Fast and secure parcel delivery with real-time tracking.'],
                'btn_title'   => ['ar' => 'ابدأ الآن', 'en' => 'Get Started'],
                'icon'        => 'fas fa-shipping-fast',
            ],
            [
                'title'       => ['ar' => 'حلول التخزين المرن', 'en' => 'Flexible Storage Solutions'],
                'subtitle'    => ['ar' => 'مستودعات مؤمنة بالكامل', 'en' => 'Fully secured warehouses'],
                'description' => ['ar' => 'وفر مساحة لتخزين منتجاتك مع مراقبة دقيقة للمخزون.', 'en' => 'Store your products with precise inventory monitoring.'],
                'btn_title'   => ['ar' => 'احجز مستودعك', 'en' => 'Book Storage'],
                'icon'        => 'fas fa-warehouse',
            ],
            [
                'title'       => ['ar' => 'تتبع الطرود بسهولة', 'en' => 'Easy Parcel Tracking'],
                'subtitle'    => ['ar' => 'اعرف مكان طردك في أي وقت', 'en' => 'Know where your parcel is anytime'],
                'description' => ['ar' => 'نظام تتبع لحظي مع إشعارات فورية لكل عملية تسليم.', 'en' => 'Real-time tracking system with instant delivery updates.'],
                'btn_title'   => ['ar' => 'تتبع الآن', 'en' => 'Track Now'],
                'icon'        => 'fas fa-map-marked-alt',
            ],
        ];

        foreach ($slides as $slide) {
            Slider::create([
                'title'        => $slide['title'],
                'subtitle'     => $slide['subtitle'],
                'description'  => $slide['description'],
                'btn_title'    => $slide['btn_title'],
                'url'          => 'https://' . $faker->domainName,
                'target'       => Arr::random($target),
                'icon'         => $slide['icon'],
                'section'      => 2, // مخصص لقسم الإعلانات
                'created_by'   => 'admin',
                'status'       => true,
                'published_on' => $faker->dateTimeBetween('-6 months', 'now'),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
