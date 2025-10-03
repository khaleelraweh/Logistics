<?php

namespace Database\Seeders;

use App\Models\Slider;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MainSliderSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker  = Faker::create();
        $target = ['_self', '_blank'];

        $slides = [
            [
                'title'       => ['ar' => 'خدمات التوصيل السريع', 'en' => 'Fast & Reliable Delivery'],
                'subtitle'    => ['ar' => 'توصيل في نفس اليوم للمناطق المختارة', 'en' => 'Same-day delivery in selected areas'],
                'description' => [
                    'ar' => 'خدمات توصيل سريعة وآمنة مع تتبع لحظي وإمكانية اختيار مواعيد التسليم.',
                    'en' => 'Fast, secure deliveries with real-time tracking and delivery time options.',
                ],
                'btn_title'   => ['ar' => 'اطلب الآن', 'en' => 'Order Now'],
            ],
            [
                'title'       => ['ar' => 'تخزين آمن ومرن', 'en' => 'Secure & Flexible Storage'],
                'subtitle'    => ['ar' => 'مستودعات مؤمّنة وموزعة جغرافيًا', 'en' => 'Secure warehouses distributed geographically'],
                'description' => [
                    'ar' => 'خدمات تخزين مرنة مع إدارة مخزون متقدمة ومستويات أمان عالية تناسب التجار.',
                    'en' => 'Flexible storage with advanced inventory management and high security levels for merchants.',
                ],
                'btn_title'   => ['ar' => 'احجز مساحة', 'en' => 'Reserve Space'],
            ],
            [
                'title'       => ['ar' => 'تتبع الطرود لحظة بلحظة', 'en' => 'Real-time Parcel Tracking'],
                'subtitle'    => ['ar' => 'اعرف حالة الشحنة في كل مرحلة', 'en' => 'Know your shipment status at every step'],
                'description' => [
                    'ar' => 'لوحة تحكم متقدمة للتتبع، إشعارات لحظية وسجل حركة كامل لكل طرد.',
                    'en' => 'Advanced tracking dashboard, instant notifications and full activity log per parcel.',
                ],
                'btn_title'   => ['ar' => 'تتبع طردك', 'en' => 'Track Your Parcel'],
            ],
            [
                'title'       => ['ar' => 'حلول متكاملة للتجار', 'en' => 'Integrated Solutions for Merchants'],
                'subtitle'    => ['ar' => 'إدارة المخزون، الشحن والفوترة من مكان واحد', 'en' => 'Inventory, shipping and billing from one place'],
                'description' => [
                    'ar' => 'APIs للربط، تقارير مبيعات وفوترة أوتوماتيكية لتسهيل عمليات المتاجر.',
                    'en' => 'APIs for integration, reports and automated billing to simplify merchant operations.',
                ],
                'btn_title'   => ['ar' => 'انضم كتاجر', 'en' => 'Join as Merchant'],
            ],
        ];

        foreach ($slides as $s) {
            Slider::create([
                'title'        => $s['title'],
                'subtitle'     => $s['subtitle'],
                'slug'         => [
                    'ar' => $faker->unique()->slug(3),
                    'en' => $faker->unique()->slug(3),
                ],
                'description'  => $s['description'],
                'url'          => [
                    'ar' => 'https://' . $faker->domainName,
                    'en' => 'https://' . $faker->domainName,
                ],
                'btn_title'    => $s['btn_title'],
                'target'       => Arr::random($target),
                'published_on' => $faker->dateTimeBetween('-6 months', 'now'),
                'created_by'   => 'seeder',
                'updated_by'   => 'seeder',
                'deleted_at'   => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
