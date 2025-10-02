<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EntrustSeeder::class);

        $this->call(MerchantDashboardRolePermissionsSeeder::class);
        $this->call(DriverDashboardRolePermissionsSeeder::class);
        $this->call(FrontendDashboardRolePermissionsSeeder::class);

        $this->call(TagSeeder::class);
        $this->call(PhotoSeeder::class);

        // Logestics related seeders
        $this->call(MerchantSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(ShelfSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(WarehouseRentalSeeder::class);
        $this->call(StockItemSeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageLogSeeder::class);
        $this->call(PackageProductSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(PickupRequestSeeder::class);
        $this->call(ReturnSeeder::class);
        $this->call(ReturnItemSeeder::class);
        $this->call(ShippingPartnerSeeder::class);
        $this->call(ExternalShipmentSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PricingRuleSeeder::class);

        $this->call(FrontendDashboardManagerSeeder::class);

        //======== Frontend Dashboard related seeders ==========
        $this->call(MainMenuSeeder::class);
        $this->call(ImportantLinkMenuSeeder::class);

        $this->call(MainSliderSeeder::class);
        $this->call(AdvertisorSliderSeeder::class);

        $this->call(PartnerSeeder::class);

        $this->call(PageCategorySeeder::class);
        $this->call(PageSeeder::class);


    }
}
