<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $statuses = [true, false];

        $testimonials = [
            [
                'name' => ['ar' => 'شركة أرامكس', 'en' => 'Aramex'],
                'title' => ['ar' => 'شريك موثوق في التوصيل', 'en' => 'Trusted Delivery Partner'],
                'content' => [
                    'ar' => 'نعمل مع هذا النظام لتسريع عمليات التوصيل وتحسين تجربة العملاء.',
                    'en' => 'We collaborate with this system to accelerate deliveries and enhance customer experience.'
                ],
                'image' => 'aramex.jpg',
            ],
            [
                'name' => ['ar' => 'شركة DHL', 'en' => 'DHL'],
                'title' => ['ar' => 'التوصيل الدولي بسرعة', 'en' => 'Fast International Delivery'],
                'content' => [
                    'ar' => 'النظام ساعدنا في تتبع الطرود بدقة عالية وتحسين خدماتنا الدولية.',
                    'en' => 'The system helped us track parcels accurately and improve our international services.'
                ],
                'image' => 'dhl.jpg',
            ],
            [
                'name' => ['ar' => 'هيئة الزكاء السعودية', 'en' => 'Saudi Logistics Authority'],
                'title' => ['ar' => 'تحسين الخدمات اللوجستية', 'en' => 'Enhancing Logistic Services'],
                'content' => [
                    'ar' => 'نظام موثوق يساهم في تحسين إدارة الطرود وتسهيل عمليات التخزين.',
                    'en' => 'A reliable system that enhances parcel management and streamlines warehouse operations.'
                ],
                'image' => 'saudi_authority.jpg',
            ],
            [
                'name' => ['ar' => 'شركة فيديكس', 'en' => 'FedEx'],
                'title' => ['ar' => 'دعم كامل لشحن الطرود', 'en' => 'Complete Support for Parcel Shipping'],
                'content' => [
                    'ar' => 'العمل مع هذا النظام يجعل عملياتنا أسرع وأكثر دقة.',
                    'en' => 'Working with this system makes our operations faster and more accurate.'
                ],
                'image' => 'fedex.jpg',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create([
                'name' => $testimonial['name'],
                'title' => $testimonial['title'],
                'slug' => [
                    'ar' => $faker->unique()->slug(),
                    'en' => $faker->unique()->slug()
                ],
                'content' => $testimonial['content'],
                'image' => $testimonial['image'],
                'metadata_title' => $testimonial['title'],
                'metadata_description' => $testimonial['content'],
                'metadata_keywords' => [
                    'ar' => implode(',', ['شحن','توصيل','لوجستيات','طرود']),
                    'en' => implode(',', ['shipping','delivery','logistics','parcels'])
                ],
                'status' => Arr::random($statuses),
                'published_on' => $faker->dateTime(),
                'created_by' => 'admin',
                'updated_by' => 'admin',
            ]);
        }
    }
}
