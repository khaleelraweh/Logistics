<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingRule;

class PricingRuleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. داخل الرياض (0 - 5 كجم)
        PricingRule::create([
            'name' => [
                'en' => 'Riyadh Local (0-5kg)',
                'ar' => 'داخل الرياض (0 - 5 كجم)',
            ],
            'description' => [
                'en' => 'Delivery within Riyadh for packages up to 5kg',
                'ar' => 'التوصيل داخل الرياض للطرود حتى 5 كجم',
            ],
            'type' => 'delivery',
            'zone' => 'Riyadh',
            'min_weight' => 0,
            'max_weight' => 5000,
            'base_price' => 25.00,
            'price_per_kg' => 3.00,
            'extra_fee' => 0.00,
            'status' => true,
        ]);

        // 2. خارج الرياض (0 - 5 كجم)
        PricingRule::create([
            'name' => [
                'en' => 'Outside Riyadh (0-5kg)',
                'ar' => 'خارج الرياض (0 - 5 كجم)',
            ],
            'description' => [
                'en' => 'Delivery outside Riyadh for packages up to 5kg',
                'ar' => 'التوصيل خارج الرياض للطرود حتى 5 كجم',
            ],
            'type' => 'delivery',
            'zone' => 'Outside_Riyadh',
            'min_weight' => 0,
            'max_weight' => 5000,
            'base_price' => 35.00,
            'price_per_kg' => 4.00,
            'extra_fee' => 0.00,
            'status' => true,
        ]);

        // 3. المناطق النائية (0 - 10 كجم)
        PricingRule::create([
            'name' => [
                'en' => 'Remote Areas (0-10kg)',
                'ar' => 'المناطق النائية (0 - 10 كجم)',
            ],
            'description' => [
                'en' => 'Delivery to remote areas up to 10kg',
                'ar' => 'التوصيل إلى المناطق النائية حتى 10 كجم',
            ],
            'type' => 'delivery',
            'zone' => 'Remote',
            'min_weight' => 0,
            'max_weight' => 10000,
            'base_price' => 50.00,
            'price_per_kg' => 6.00,
            'extra_fee' => 0.00,
            'status' => true,
        ]);

        // 4. شحن سريع (أي وزن)
        PricingRule::create([
            'name' => [
                'en' => 'Express Delivery',
                'ar' => 'شحن سريع',
            ],
            'description' => [
                'en' => 'Express delivery with additional fee',
                'ar' => 'شحن سريع مع رسوم إضافية',
            ],
            'type' => 'delivery',
            'zone' => 'Any',
            'min_weight' => 0,
            'max_weight' => null, // null = مفتوح
            'base_price' => 10.00,
            'price_per_kg' => 0.00,
            'extra_fee' => 15.00, // رسوم إضافية
            'status' => true,
        ]);

        // 5. التخزين (حتى 30 يوم)
        PricingRule::create([
            'name' => [
                'en' => 'Storage Tier 1',
                'ar' => 'تخزين - المستوى الأول',
            ],
            'description' => [
                'en' => 'Storage on standard shelves up to 30 days',
                'ar' => 'التخزين على الرفوف القياسية حتى 30 يوم',
            ],
            'type' => 'storage',
            'zone' => null,
            'min_weight' => 0,
            'max_weight' => null,
            'base_price' => 500.00,
            'price_per_kg' => 0.00,
            'extra_fee' => 0.00,
            'status' => true,
        ]);
    }
}
