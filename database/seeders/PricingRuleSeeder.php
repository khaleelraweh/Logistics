<?php

namespace Database\Seeders;

use App\Models\PricingRule;
use Illuminate\Database\Seeder;

class PricingRuleSeeder extends Seeder
{
    public function run(): void
    {
        PricingRule::create([
            'name' => [
                'en' => 'Standard Delivery Zone A',
                'ar' => 'توصيل عادي - المنطقة أ'
            ],
            'description' => [
                'en' => 'Applies to deliveries within Zone A for packages up to 4kg',
                'ar' => 'ينطبق على التوصيل داخل المنطقة أ للطرود حتى 4 كجم'
            ],
            'type' => 'delivery',
            'condition' => [
                'weight' => [
                    'from' => 0,
                    'to' => 4
                ],
                'zone' => 'A'
            ],
            'base_price' => 1000,
            'price_per_kg' => 200,
            'status' => true,
            'published_on' => now(),
            'created_by' => 'system',
        ]);

        PricingRule::create([
            'name' => [
                'en' => 'Storage Tier 1',
                'ar' => 'تخزين - المستوى الأول'
            ],
            'description' => [
                'en' => 'Applies for standard shelf storage',
                'ar' => 'ينطبق على التخزين على الرفوف القياسية'
            ],
            'type' => 'storage',
            'condition' => [
                'shelf_type' => 'standard',
                'duration_days' => [
                    'from' => 0,
                    'to' => 30
                ]
            ],
            'base_price' => 500,
            'price_per_kg' => 0,
            'status' => true,
            'published_on' => now(),
            'created_by' => 'system',
        ]);
    }
}
