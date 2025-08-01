<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ============== Create a merchant ==============//

        //  $merchant = Merchant::create([
        //     'name' => 'متجر التقنية',
        //     'contact_person' => 'أحمد',
        //     'phone' => '777777777',
        //     'address' => 'شارع التحرير - صنعاء',
        //     'api_key' => Str::uuid(),
        // ]);

        //==================== or Create a merchant using the MerchantSeeder ====================//
        $merchant = Merchant::first(); // أو where('name->en', 'Tech Store')->first();


        // Products
        $product = Product::create([
            'merchant_id' => $merchant->id,
            'name' => 'كمبيوتر محمول',
            'description' => 'كمبيوتر محمول عالي الأداء',
            'sku' => 'LPTP-12345',
            'price'     => 25.00,
        ]);
    }
}
