<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Package;
use App\Models\PackageProduct;
use App\Models\Shelf;
use App\Models\StockItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $merchant = Merchant::first();
        $shelf = Shelf::first();

        // ننشئ طرد رئيسي
        $package = Package::create([
            'merchant_id'           => $merchant?->id,
            'sender_first_name'     =>  'خالد',
            'sender_middle_name'    =>  'عبدالله',
            'sender_last_name'     =>  'على',
            'sender_phone'          =>  '772036131',
            'sender_address'        =>  'صنعاء - شارع بغداد',
            'sender_email'          =>  'khaled@gmail.com',

            'receiver_first_name'   => 'خليل',
            'receiver_middle_name'  => 'عبدالله',
            'receiver_last_name'    => 'راوح',
            'receiver_phone'        => '777000111',
            'receiver_address'      => 'عدن - شارع المنصورة',
            'receiver_email'        => 'khaleel@gmail.com',

            'tracking_number' => 'PKG-' . strtoupper(Str::random(8)),

            'status' => 'pending',

            'rental_shelf_id' => $shelf?->id,
            'parent_package_id' => null,

            'weight' => 3000,
            'dimensions' => [
                'length' => 30,
                'width' => 20,
                'height' => 15,
            ],

            'delivery_fee' => 1000.00,
            'insurance_fee' => 200.00,
            'service_fee' => 300.00,
            'total_fee' => 1500.00,
            'paid_amount' => 500.00,
            'due_amount' => 1000.00,
            'cod_amount' => 0.00,

            'attributes' => [
                "is_fragile" => true,
                "is_returnable" => false,
                "is_confidential" => true,
                "is_express" => true,
                "is_cod" => false,
                "is_gift" => true,
                "is_oversized" => false,
                "is_hazardous_material" => false,
                "is_temperature_controlled" => false,
                "is_perishable" => false,
                "is_signature_required" => true,
                "is_inspection_required" => false,
                "is_special_handling_required" => true
            ],

            'payment_responsibility' => 'recipient',

            'delivery_date' => Carbon::now()->addDays(3),
            'delivery_status_note' => 'يحتاج إلى مراجعة قبل التسليم',

            'delivery_method' => 'express',
            'package_type' => 'box',
            'package_size' => 'large',
            'delivery_speed' => 'express',
            'origin_type' => 'warehouse',

            'origin_warehouse_id' => null,

            'created_by' => 'system',
            'updated_by' => null,
            'deleted_by' => null,

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // إضافة منتجات لهذا الطرد
        // نأخذ عنصر من المخزون (إن وجد)
        $stockItem = StockItem::first();

        if ($package) {
            // منتج من المخزون
            if ($stockItem) {
                PackageProduct::create([
                    'package_id'        => $package->id,
                    'type'              => 'stock',
                    'stock_item_id'     => $stockItem->id,
                    'custom_name'       => null,
                    'weight'            => 500,
                    'quantity'          => 2,
                    'price_per_unit'    => 150,
                    'total_price'       => 300,
                ]);

                // يمكننا هنا أيضًا تقليل الكمية من المخزون كتوضيح:
                $stockItem->decrement('quantity', 2);
            }

            // منتج مخصص
            PackageProduct::create([
                'package_id'        => $package->id,
                'type'              => 'custom',
                'stock_item_id'     => null,
                'custom_name'       => 'لوحة فنية مخصصة',
                'weight'            => 200,
                'quantity'          => 1,
                'price_per_unit'    => 500,
                'total_price'       => 500,
            ]);
        }

        // مثال إنشاء طرد فرعي مرتبط بالطرد الرئيسي
        $subPackage = Package::create([
            'merchant_id'           => $merchant?->id,
            'parent_package_id'     => $package->id,
            'sender_first_name'     => 'سامي',
            'sender_middle_name'    => 'أحمد',
            'sender_last_name'      => 'يوسف',
            'sender_phone'         => '777123456',
            'sender_address'      => 'إب - شارع العدين',
            'sender_email'        => 'sami@gmail.com',

            'receiver_first_name'  => 'محمد',
            'receiver_middle_name' => 'علي',
            'receiver_last_name'   => 'سالم',
            'receiver_phone'       => '735000222',
            'receiver_address'     => 'تعز - التحرير',
            'receiver_email'       => 'mohammed@gmail.com',

            'tracking_number' => 'PKG-' . strtoupper(Str::random(8)),

            'status' => 'ready',

            'weight' => 1000,
            'dimensions' => [
                'length' => 20,
                'width' => 10,
                'height' => 5,
            ],

            'delivery_fee' => 800.00,
            'insurance_fee' => 100.00,
            'service_fee' => 200.00,
            'total_fee' => 1100.00,
            'paid_amount' => 1100.00,
            'due_amount' => 0.00,
            'cod_amount' => 0.00,

            'attributes' => [
                "is_fragile" => false,
                "is_returnable" => true,
                "is_confidential" => false,
                "is_express" => false,
                "is_cod" => false,
                "is_gift" => false,
                "is_oversized" => false,
                "is_hazardous_material" => false,
                "is_temperature_controlled" => false,
                "is_perishable" => false,
                "is_signature_required" => false,
                "is_inspection_required" => false,
                "is_special_handling_required" => false
            ],

            'payment_responsibility' => 'sender',

            'delivery_date' => Carbon::now()->addDay(),
            'delivery_status_note' => 'مستعجل للتوصيل صباحًا',

            'delivery_method' => 'standard',
            'package_type' => 'envelope',
            'package_size' => 'small',
            'delivery_speed' => 'standard',
            'origin_type' => 'drop_off',

            'created_by' => 'system',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
