<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\ShelfController;
use App\Http\Controllers\Admin\WarehouseRentalController;
use App\Http\Controllers\Admin\StockItemController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\PickupRequestController;
use App\Http\Controllers\Admin\ReturnRequestController;
use App\Http\Controllers\Admin\ShippingPartnerController;
use App\Http\Controllers\Admin\ExternalShipmentController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PricingRuleController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['roles', 'role:admin|supervisor', 'admin.locked']], function () {


    Route::get('/', [AdminController::class, 'index'])->name('index2');
    Route::get('/index', [AdminController::class, 'index'])->name('index');

    // Lock Screen
    Route::get('/lock-screen', [AdminController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [AdminController::class, 'unlock'])->name('unlock');

    // Profile & Settings
    Route::get('layout-customizer', [ProfileController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    Route::post('/user/layout-preferences', [ProfileController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    Route::post('/update-language-preference', [ProfileController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('admin/profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');

    // Resources
    Route::post('merchants/update-merchants-status', [MerchantController::class, 'updateMerchantStatus'])->name('merchants.update_merchants_status');
    Route::post('merchant/remove-image', [MerchantController::class, 'remove_image'])->name('merchants.remove_image');
    Route::resource('merchants', MerchantController::class);
    Route::get('merchants/{merchant}/showbackup', [MerchantController::class, 'showBackup'])->name('merchants.showbackup');

    Route::post('products/update-products-status', [ProductController::class, 'updateProductstatus'])->name('products.update_merchants_status');
    Route::post('product/remove-image', [ProductController::class, 'remove_image'])->name('products.remove_image');
    Route::resource('products', ProductController::class);

    Route::post('warehouses/update-warehouses-status', [WarehouseController::class, 'updateWarehouseStatus'])->name('warehouses.update_warehouses_status');
    Route::post('warehouse/remove-image', [WarehouseController::class, 'remove_image'])->name('warehouses.remove_image');
    Route::resource('warehouses', WarehouseController::class);

    Route::post('shelves/update-shelves-status', [ShelfController::class, 'updateshelvestatus'])->name('shelves.update_shelves_status');
    Route::post('shelve/remove-image', [ShelfController::class, 'remove_image'])->name('shelves.remove_image');
    Route::resource('shelves', ShelfController::class);

    Route::get('/contracts/{id}/view', [WarehouseRentalController::class, 'view'])->name('warehouse_rentals.contracts.view');
    Route::get('/contracts/{id}/download', [WarehouseRentalController::class, 'download'])->name('warehouse_rentals.contracts.download');

    Route::post('warehouse-rentals/{rental}/pay-invoice', [WarehouseRentalController::class, 'payInvoice'])->name('warehouse_rentals.pay_invoice');
    Route::post('warehouse-rentals/update-warehouse-rentals-status', [WarehouseRentalController::class, 'updateWarehouseRentalStatus'])->name('warehouse_rentals.update_warehouse_rentals_status'); // not working yet
    Route::post('warehouse-rentals/remove-image', [WarehouseRentalController::class, 'remove_image'])->name('warehouse_rentals.remove_image');// not working yet
    Route::resource('warehouse_rentals', WarehouseRentalController::class);

    Route::post('stock-items/update-stock-items-status', [StockItemController::class, 'updateStockItemStatus'])->name('stock_items.update_stock_items_status');
    Route::post('stock-items/remove-image', [StockItemController::class, 'remove_image'])->name('stock_items.remove_image');
    Route::get('stock_items/fetch-merchant-data', [StockItemController::class, 'fetchMerchantData'])->name('stock_items.fetch_merchant_data');
    Route::resource('stock_items', StockItemController::class);

    Route::get('packages/create_for_good', [PackageController::class, 'create_for_good'])->name('packages.create_for_good');
    Route::post('packages/update-packages-status', [PackageController::class, 'updatePackageStatus'])->name('packages.update_packages_status');
    Route::post('package/remove-image', [PackageController::class, 'remove_image'])->name('packages.remove_image');
    Route::get('admin/packages/{id}/print', [PackageController::class, 'printPackage'])->name('packages.print');
    Route::resource('packages', PackageController::class);

    Route::post('driver/remove-driver-image', [DriverController::class, 'remove_driver_image'])->name('drivers.remove_driver_image');
    Route::post('driver/remove-vehicle-image', [DriverController::class, 'remove_vehicle_image'])->name('drivers.remove_vehicle_image');
    Route::post('driver/remove-license-image', [DriverController::class, 'remove_license_image'])->name('drivers.remove_license_image');
    Route::post('driver/remove-id-card-image', [DriverController::class, 'remove_id_card_image'])->name('drivers.remove_id_card_image');
    Route::resource('drivers', DriverController::class);

    Route::resource('deliveries', DeliveryController::class);

    Route::resource('pickup_requests', PickupRequestController::class);

    Route::resource('return_requests', ReturnRequestController::class);

    Route::post('shipping-partners/update-shipping-partners-status', [ShippingPartnerController::class, 'updateShippingPartnerStatus'])->name('shipping_partners.update_shipping_partners_status');
    Route::post('shipping-partner/remove-image', [ShippingPartnerController::class, 'remove_image'])->name('shipping_partners.remove_image');
    Route::resource('shipping_partners', ShippingPartnerController::class);

    Route::resource('external_shipments', ExternalShipmentController::class);

    Route::get('admin/invoices/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay.create');
    Route::post('invoices/{invoice}/pay', [InvoiceController::class, 'payInvoice'])->name('invoices.pay');
    Route::resource('invoices', InvoiceController::class);

    Route::resource('pricing_rules', PricingRuleController::class);

    Route::resource('payments', PaymentController::class);

    Route::post('tags/update-tag-status', [TagController::class, 'updateTagStatus'])->name('tags.update_tag_status');
    Route::resource('tags', TagController::class);

    Route::post('supervisors/remove-image', [SupervisorController::class, 'remove_image'])->name('supervisors.remove_image');
    Route::resource('supervisors',SupervisorController::class);

});
