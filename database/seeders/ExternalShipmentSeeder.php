<?php

namespace Database\Seeders;

use App\Models\ExternalShipment;
use App\Models\Package;
use App\Models\ShippingPartner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExternalShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partner = ShippingPartner::first();
        $package = Package::first();

        // if (!$partner) {
        //     $partner = ShippingPartner::create([
        //         'name' => ['ar' => 'شريك الشحن السريع', 'en' => 'Fast Shipping Partner'],
        //         'slug' => ['ar' => 'شريك_الشحن_السريع', 'en' => 'fast_shipping_partner'],
        //         'contact_email' => 'partner@example.com',
        //         'contact_phone' => '777888999',
        //     ]);
        // }

        ExternalShipment::create([
            'shipping_partner_id' => $partner->id,
            'package_id'    =>  $package->id,
            'external_tracking_number' => 'EXT-' . strtoupper(Str::random(10)),
            'status' => 'in_transit',
            'delivery_date' => Carbon::now()->addDays(5),
            'synced_at' => Carbon::now()->addDays(5),
            'delivered_at' => Carbon::now()->addDays(5),
        ]);
    }
}
