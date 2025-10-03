<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $partners = [
            [
                'name' => ['ar' => 'أرامكس', 'en' => 'Aramex'],
                'description' => [
                    'ar' => 'شركة عالمية متخصصة في حلول النقل والشحن السريع واللوجستيات.',
                    'en' => 'A global provider of transport, express shipping, and logistics solutions.'
                ],
                'partner_image' => 'aramex.png',
            ],
            [
                'name' => ['ar' => 'دي إتش إل', 'en' => 'DHL Express'],
                'description' => [
                    'ar' => 'شركة رائدة في خدمات التوصيل السريع والشحن الدولي.',
                    'en' => 'A leading company in express delivery and international shipping.'
                ],
                'partner_image' => 'dhl.png',
            ],
            [
                'name' => ['ar' => 'فيديكس', 'en' => 'FedEx'],
                'description' => [
                    'ar' => 'تقدم حلول متكاملة للشحن الجوي والبحري والتخزين.',
                    'en' => 'Providing integrated solutions for air, sea freight, and warehousing.'
                ],
                'partner_image' => 'fedex.png',
            ],
            [
                'name' => ['ar' => 'البريد السعودي (سبل)', 'en' => 'Saudi Post (SPL)'],
                'description' => [
                    'ar' => 'مؤسسة حكومية تقدم خدمات البريد والتوصيل المحلي والدولي.',
                    'en' => 'A governmental organization providing postal and delivery services locally and internationally.'
                ],
                'partner_image' => 'spl.png',
            ],
            [
                'name' => ['ar' => 'هيئة الزكاة والضريبة والجمارك السعودية', 'en' => 'Saudi Zakat, Tax and Customs Authority'],
                'description' => [
                    'ar' => 'الجهة الرسمية المنظمة والمشرفة على عمليات الجمارك والضرائب.',
                    'en' => 'The official authority regulating customs and tax operations in Saudi Arabia.'
                ],
                'partner_image' => 'zatca.png',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create([
                'name'         => $partner['name'],
                'description'  => $partner['description'],
                'partner_image'=> $partner['partner_image'],
                'status'       => true,
                'created_by'   => 'system',
                'updated_by'   => 'system',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
