<?php

namespace Database\Seeders;

use App\Models\Menu;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SystemFeaturesMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $features = [
            [
                'title' => ['ar' => 'تتبع الشحنة', 'en' => 'Track Shipment'],
                'link'  => ['ar' => 'tracking', 'en' => 'tracking'],
                'icon'  => 'fa fa-map-marker-alt',
                'description' => [
                    'ar' => 'تابع شحنتك في الوقت الحقيقي وكن مطمئنًا لمعرفة مكانها دائمًا.',
                    'en' => 'Track your shipment in real-time and stay informed about its location at all times.'
                ]
            ],
            [
                'title' => ['ar' => 'حساب تكلفة الشحن', 'en' => 'Shipping Rates'],
                'link'  => ['ar' => 'rates', 'en' => 'rates'],
                'icon'  => 'fa fa-calculator',
                'description' => [
                    'ar' => 'احسب تكلفة شحنتك بسهولة قبل الإرسال لتجنب أي مفاجآت.',
                    'en' => 'Easily calculate your shipping cost in advance to avoid surprises.'
                ]
            ],
            [
                'title' => ['ar' => 'مراكز التخزين', 'en' => 'Warehouses'],
                'link'  => ['ar' => 'warehouses', 'en' => 'warehouses'],
                'icon'  => 'fa fa-warehouse',
                'description' => [
                    'ar' => 'نحن نملك مراكز تخزين متعددة لضمان سلامة البضائع وتسليمها في الوقت المحدد.',
                    'en' => 'We have multiple warehouses to ensure the safety of goods and timely delivery.'
                ]
            ],
            [
                'title' => ['ar' => 'بوابة التاجر', 'en' => 'Merchant Portal'],
                'link'  => ['ar' => 'merchant/portal', 'en' => 'merchant/portal'],
                'icon'  => 'fa fa-store',
                'description' => [
                    'ar' => 'لوحة تحكم سهلة للتجار لإدارة شحناتهم ومتابعة الطلبات.',
                    'en' => 'An easy-to-use dashboard for merchants to manage shipments and track orders.'
                ]
            ],
            [
                'title' => ['ar' => 'خدمة العملاء', 'en' => 'Customer Support'],
                'link'  => ['ar' => 'support', 'en' => 'support'],
                'icon'  => 'fa fa-headset',
                'description' => [
                    'ar' => 'دعم متواصل للإجابة عن استفساراتك وحل أي مشكلة بسرعة.',
                    'en' => '24/7 support to answer your questions and resolve issues quickly.'
                ]
            ],
            [
                'title' => ['ar' => 'تقارير الشحن', 'en' => 'Shipping Reports'],
                'link'  => ['ar' => 'reports', 'en' => 'reports'],
                'icon'  => 'fa fa-chart-line',
                'description' => [
                    'ar' => 'احصل على تقارير مفصلة عن شحناتك لاتخاذ قرارات أفضل.',
                    'en' => 'Get detailed reports on your shipments for better decision-making.'
                ]
            ],
            [
                'title' => ['ar' => 'تسليم سريع وموثوق', 'en' => 'Fast & Reliable Delivery'],
                'link'  => ['ar' => 'fast-delivery', 'en' => 'fast-delivery'],
                'icon'  => 'fa fa-truck',
                'description' => [
                    'ar' => 'نضمن وصول شحنتك بسرعة وبأمان إلى وجهتها.',
                    'en' => 'We ensure your shipment reaches its destination quickly and safely.'
                ]
            ],
        ];

        foreach ($features as $item) {
            Menu::create([
                'title'        => $item['title'],
                'icon'         => $item['icon'],
                'link'         => $item['link'],
                'created_by'   => 'admin',
                'status'       => true,
                'section'      => 2,
                'published_on' => $faker->dateTimeBetween('-6 months', 'now'),
                'parent_id'    => null,
                'description'  => $item['description'], // إضافة نصوص معبرة
            ]);
        }
    }
}
