<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $statuses = [true, false];

        $statistics = [
            [
                'title' => ['ar' => 'الطرود المسلَّمة', 'en' => 'Parcels Delivered'],
                'icon' => 'fas fa-box',
                'statistic_number' => rand(1000, 5000),
            ],
            [
                'title' => ['ar' => 'الشحنات قيد النقل', 'en' => 'Shipments In Transit'],
                'icon' => 'fas fa-truck',
                'statistic_number' => rand(200, 1000),
            ],
            [
                'title' => ['ar' => 'الشركاء اللوجستيون', 'en' => 'Logistic Partners'],
                'icon' => 'fas fa-handshake',
                'statistic_number' => rand(5, 20),
            ],
            [
                'title' => ['ar' => 'مراكز التخزين', 'en' => 'Warehouses'],
                'icon' => 'fas fa-warehouse',
                'statistic_number' => rand(10, 50),
            ],
        ];

        foreach ($statistics as $stat) {
            Statistic::create([
                'title' => $stat['title'],
                'slug' => [
                    'ar' => $faker->unique()->slug(3),
                    'en' => $faker->unique()->slug(3),
                ],
                'statistic_number' => $stat['statistic_number'],
                'icon' => $stat['icon'],
                'metadata_title' => $stat['title'],
                'metadata_description' => [
                    'ar' => "إحصائية حول {$stat['title']['ar']}",
                    'en' => "Statistics about {$stat['title']['en']}",
                ],
                'metadata_keywords' => [
                    'ar' => 'إحصائيات, لوجستيات, توصيل, تخزين',
                    'en' => 'statistics, logistics, delivery, storage',
                ],
                'status' => Arr::random($statuses),
                'created_by' => 'admin',
                'updated_by' => 'admin',
                'published_on' => $faker->dateTime(),
            ]);
        }
    }
}
