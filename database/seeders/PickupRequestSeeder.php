<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\PickupRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PickupRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merchant = Merchant::first(); // أول تاجر موجود في قاعدة البيانات

        PickupRequest::create([
            'merchant_id'     => $merchant->id,
            'driver_id'       => null, // يمكن تعيين سائق هنا إذا أردت، أو تركه فارغًا
            'scheduled_at'    => now()->addDays(2), // وقت مجدول للاستلام بعد يومين من الآن
            'status'          => 'pending', // الحالة الافتراضية
            'status_visible'  => true,
            'note'            => 'يرجى التأكد من وجود شخص لاخذ الطرود في العنوان المحدد.', // ملاحظة توضيحية
            'published_on'    => now(),
            'created_by'      => 'system',
            'updated_by'      => null,
            'deleted_by'      => null,
        ]);
    }
}
