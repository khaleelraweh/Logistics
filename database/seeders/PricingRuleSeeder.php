<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingRule;

class PricingRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            [
                'name' => ['en'=>'Riyadh Local (0-5kg)','ar'=>'داخل الرياض (0 - 5 كجم)'],
                'description'=>['en'=>'Delivery within Riyadh up to 5kg','ar'=>'التوصيل داخل الرياض للطرود حتى 5 كجم'],
                'type'=>'delivery','zone'=>'Riyadh','min_weight'=>0,'max_weight'=>5000,
                'base_price'=>25,'price_per_kg'=>3,'extra_fee'=>0
            ],
            [
                'name' => ['en'=>'Outside Riyadh (0-5kg)','ar'=>'خارج الرياض (0 - 5 كجم)'],
                'description'=>['en'=>'Delivery outside Riyadh up to 5kg','ar'=>'التوصيل خارج الرياض للطرود حتى 5 كجم'],
                'type'=>'delivery','zone'=>'Outside_Riyadh','min_weight'=>0,'max_weight'=>5000,
                'base_price'=>35,'price_per_kg'=>4,'extra_fee'=>0
            ],
            [
                'name'=>['en'=>'Remote Areas (0-10kg)','ar'=>'المناطق النائية (0 - 10 كجم)'],
                'description'=>['en'=>'Delivery to remote areas up to 10kg','ar'=>'التوصيل إلى المناطق النائية حتى 10 كجم'],
                'type'=>'delivery','zone'=>'Remote','min_weight'=>0,'max_weight'=>10000,
                'base_price'=>50,'price_per_kg'=>6,'extra_fee'=>0
            ],
            [
                'name'=>['en'=>'Express Delivery','ar'=>'شحن سريع'],
                'description'=>['en'=>'Express delivery','ar'=>'شحن سريع'],
                'type'=>'delivery','zone'=>'Any','min_weight'=>0,'max_weight'=>null,
                'base_price'=>10,'price_per_kg'=>0,'extra_fee'=>15,'express'=>true
            ],
            [
                'name'=>['en'=>'Same Day Delivery','ar'=>'توصيل نفس اليوم'],
                'description'=>['en'=>'Delivery on the same day','ar'=>'التوصيل في نفس اليوم'],
                'type'=>'delivery','zone'=>'Any','min_weight'=>0,'max_weight'=>null,
                'base_price'=>0,'price_per_kg'=>0,'extra_fee'=>25,'same_day'=>true
            ],
            [
                'name'=>['en'=>'Storage Tier 1','ar'=>'تخزين - المستوى الأول'],
                'description'=>['en'=>'Storage up to 30 days','ar'=>'التخزين على الرفوف القياسية حتى 30 يوم'],
                'type'=>'storage','zone'=>null,'min_weight'=>0,'max_weight'=>null,
                'base_price'=>500,'price_per_kg'=>0,'extra_fee'=>0
            ]
        ];

        foreach($rules as $rule){
            PricingRule::create($rule);
        }
    }
}
