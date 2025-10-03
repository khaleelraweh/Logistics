<?php

namespace Database\Seeders;

use App\Models\CommonQuestion;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CommonQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $statuses = [true, false];

        $questions = [
            [
                'title' => ['ar' => 'كيف يمكنني تتبع الطرد الخاص بي؟', 'en' => 'How can I track my parcel?'],
                'description' => ['ar' => 'يمكنك تتبع الطرد عن طريق إدخال رقم التتبع في صفحة التتبع الخاصة بنا.', 'en' => 'You can track your parcel by entering the tracking number on our tracking page.'],
            ],
            [
                'title' => ['ar' => 'كم يستغرق توصيل الطرود داخل المدينة؟', 'en' => 'How long does delivery take within the city?'],
                'description' => ['ar' => 'عادةً ما يتم التوصيل خلال 24 ساعة داخل المدينة.', 'en' => 'Usually, delivery is completed within 24 hours inside the city.'],
            ],
            [
                'title' => ['ar' => 'هل توفرون خدمات الشحن الدولي؟', 'en' => 'Do you provide international shipping?'],
                'description' => ['ar' => 'نعم، نقدم خدمات الشحن الدولي لجميع الدول المتاحة.', 'en' => 'Yes, we provide international shipping to all available countries.'],
            ],
            [
                'title' => ['ar' => 'ما هي رسوم التخزين؟', 'en' => 'What are the storage fees?'],
                'description' => ['ar' => 'تختلف رسوم التخزين حسب حجم الطرد ومدة التخزين.', 'en' => 'Storage fees vary depending on the parcel size and storage duration.'],
            ],
            [
                'title' => ['ar' => 'كيف يمكنني تعديل عنوان التوصيل؟', 'en' => 'How can I change the delivery address?'],
                'description' => ['ar' => 'يمكنك تعديل عنوان التوصيل من خلال حسابك قبل الشحن.', 'en' => 'You can change the delivery address through your account before shipping.'],
            ],
        ];

        foreach ($questions as $q) {
            CommonQuestion::create([
                'title' => $q['title'],
                'description' => $q['description'],
                'slug' => [
                    'ar' => $faker->slug(3),
                    'en' => $faker->slug(3)
                ],
                'metadata_title' => $q['title'],
                'metadata_description' => $q['description'],
                'metadata_keywords' => ['ar' => 'سؤال شائع, توصيل, تخزين', 'en' => 'faq, delivery, storage'],
                'status' => Arr::random($statuses),
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'published_on' => $faker->dateTime(),
            ]);
        }
    }
}
