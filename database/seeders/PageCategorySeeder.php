<?php

namespace Database\Seeders;

use App\Models\PageCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PageCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $categories = [
            ['ar' => 'خدماتنا', 'en' => 'Our Services'],
            ['ar' => 'حول الشركة', 'en' => 'About Us'],
            ['ar' => 'الأسئلة الشائعة', 'en' => 'FAQ'],
            ['ar' => 'سياسة الخصوصية', 'en' => 'Privacy Policy'],
            ['ar' => 'الشروط والأحكام', 'en' => 'Terms & Conditions'],
        ];

        foreach ($categories as $category) {
            PageCategory::create([
                'title' => $category,
                'content' => [
                    'ar' => $faker->realText(100),
                    'en' => $faker->realText(100),
                ],
                'metadata_title' => [
                    'ar' => $faker->sentence(6),
                    'en' => $faker->sentence(6),
                ],
                'metadata_description' => [
                    'ar' => $faker->realText(150),
                    'en' => $faker->realText(150),
                ],
                'metadata_keywords' => [
                    'ar' => implode(',', $faker->words(5)),
                    'en' => implode(',', $faker->words(5)),
                ],
                'status' => true,
                'created_by' => 1, // ID افتراضي للمستخدم (ممكن تغيره)
                'updated_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
