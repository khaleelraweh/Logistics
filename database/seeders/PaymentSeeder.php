<?php

namespace Database\Seeders;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Ensure a merchant exists
        $merchant = \App\Models\Merchant::first();

         // Payment
        Payment::create([
            'merchant_id' => $merchant->id,
            'method'    =>  ['ar' => 'كاش' , 'en' => 'Cash'],
            'amount' => 3000.00,
            'currency' => ['ar' =>  'USD' , 'en'    =>  'USD'],
            'status' => 'paid',
            'paid_on' => Carbon::now(),
        ]);
    }
}
