<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // تأكد وجود تاجر
        $merchant = Merchant::first();

        if (!$merchant) {
            $this->command->info('No merchant found, skipping Payment seeding.');
            return;
        }

        // مثال: دفع مرتبط بطرد (Package) مثلا
        $package = \App\Models\Package::first();

        if (!$package) {
            $this->command->info('No package found, skipping Payment seeding.');
            return;
        }

        Payment::create([
            'payable_type' => 'App\Models\Package', // اسم الـ model المرتبط (namespace كامل)
            'payable_id'   => $package->id,
            'merchant_id'  => $merchant->id,
            'method'       => 'cash', // enum
            'amount'       => 3000.00,
            'currency'     => 'USD', // نص 3 حروف
            'status'       => 'paid',
            'paid_on'      => Carbon::now()->toDateString(),
            'for'          => 'combined', // delivery, service_fee, storage, combined
            'reference_note' => 'دفعة تجريبية',
            'payment_reference' => 'REF123456',
            'status_visible' => true,
            'published_on'   => Carbon::now(),
            // يمكنك إضافة created_by أو غيرها إذا تحب
        ]);
    }
}
