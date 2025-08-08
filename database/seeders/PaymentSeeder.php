<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Merchant;
use App\Models\Package;
use App\Models\Driver;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        // الحصول على تاجر موجود
        $merchant = Merchant::first();
        if (!$merchant) {
            $this->command->info('No merchant found, skipping Payment seeding.');
            return;
        }

        // الحصول على طرد كمثال للدفع المرتبط (payable)
        $package = Package::first();
        if (!$package) {
            $this->command->info('No package found, skipping Payment seeding.');
            return;
        }

        // الحصول على سائق (مثال للدفع عند الاستلام)
        $driver = Driver::first();

        // مثال 1: دفع نقدي (cash) مرتبط بطرد
        Payment::create([
            'payable_type'      => 'App\Models\Package',
            'payable_id'        => $package->id,
            'merchant_id'       => $merchant->id,
            'method'            => 'cash',
            'amount'            => 150.00,
            'currency'          => 'USD',
            'status'            => 'paid',
            'paid_on'           => Carbon::now(),
            'for'               => 'delivery',
            'reference_note'    => 'دفعة نقدية كاملة',
            'payment_reference' => 'REF-001',
            'status_visible'    => true,
            'published_on'      => Carbon::now(),
            'created_by'        => 'system',
        ]);

        // مثال 2: دفع عند الاستلام (COD) مرتبط بطرد، مع ربط السائق
        if ($driver) {
            Payment::create([
                'payable_type'      => 'App\Models\Package',
                'payable_id'        => $package->id,
                'merchant_id'       => $merchant->id,
                'method'            => 'cod',
                'amount'            => 200.00,
                'currency'          => 'USD',
                'status'            => 'pending',
                'paid_on'           => null,
                'for'               => 'delivery',
                'reference_note'    => 'الدفع عند الاستلام للسائق',
                'payment_reference' => null,
                'driver_id'         => $driver->id,
                'status_visible'    => true,
                'published_on'      => Carbon::now(),
                'created_by'        => 'system',
            ]);
        } else {
            $this->command->info('No driver found, skipping COD payment example.');
        }
    }
}
