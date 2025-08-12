<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Merchant;
use App\Models\Package;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        $merchant = Merchant::first();
        if (!$merchant) {
            $this->command->info('No merchant found, skipping Invoice seeding.');
            return;
        }

        $package = Package::first();
        if (!$package) {
            $this->command->info('No package found, skipping Invoice seeding.');
            return;
        }

        Invoice::create([
            'merchant_id'   => $merchant->id,
            'payable_type'  => 'App\Models\Package',
            'payable_id'    => $package->id,
            'total_amount'  => 350.00,
            'currency'      => 'USD',
            'status'        => 'unpaid',
            'due_date'      => Carbon::now()->addDays(7),
            'issued_at'     => Carbon::now(),
            'notes'         => 'فاتورة مرتبطة بالطرد رقم ' . $package->id,
        ]);
    }
}
