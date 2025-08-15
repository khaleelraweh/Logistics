<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LocaleController as AdminLocaleController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExternalShipmentController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\ShippingPartnerController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseRentalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
// لايقاف الديباجر نضيف هذا الكود
app('debugbar')->disable();

//Frontend
Route::get('/',         [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/index',    [FrontendController::class, 'index'])->name('frontend.index');


Route::get('/change-language/{locale}',     [AdminLocaleController::class, 'switch'])->name('change.language');


Route::get('/download-pdf/{filename}', function ($filename) {
    $pathToFile = public_path('assets/document_archives/' . $filename);

    if (!file_exists($pathToFile)) {
        abort(404, 'File not found');
    }

    // Customize the download name
    $downloadName = 'custom_' . $filename;

    return response()->download($pathToFile, $downloadName);
});


//Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    //guest to website
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login');
        Route::get('/register', [AdminController::class, 'register'])->name('register');
        Route::get('/recover-password', [AdminController::class, 'recover_password'])->name('recover-password');
    });

    //uthenticate to website
    Route::group(['middleware' => ['roles', 'role:admin|supervisor' , 'admin.locked']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index2');
    Route::get('/index', [AdminController::class, 'index'])->name('index');

    Route::get('/lock-screen', [AdminController::class, 'lock_screen'])->name('lock-screen');
    Route::post('/unlock', [AdminController::class, 'unlock'])->name('unlock');


    // ==============   Layout preferances customize by page    ==============  //
    Route::get('layout-customizer', [ProfileController::class, 'layoutCustomizer'])->name('profile.layout-customizer');
    // ==============   Layout preferances customize by rightbar panel   ==============  //
    Route::post('/user/layout-preferences', [ProfileController::class, 'updateModeFromRightBar'])->name('profile.updateModeFromRightBar');
    // ==============   Language customize by topbar panel   ==============  //
    Route::post('/update-language-preference', [ProfileController::class, 'updateLanguagePreference'])->name('profile.updatelanguagepreference')->middleware(['auth']);


    // ==============   Admin Profile Tab   ==============  //
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('admin/profile/remove-image', [ProfileController::class, 'remove_image'])->name('profile.remove_image');
    Route::patch('/profile', [ProfileController::class, 'update_profile'])->name('profile.update');

    //======================== Add Logestics Route Here ====================================//
    // ==============   Merchants Tab   ==============  //
    Route::post('merchants/update-merchants-status', [MerchantController::class, 'updateMerchantStatus'])->name('merchants.update_merchants_status');
    Route::post('merchant/remove-image', [MerchantController::class, 'remove_image'])->name('merchants.remove_image');
    Route::resource('merchants', MerchantController::class);

    Route::get('merchants/{merchant}/showbackup', [MerchantController::class, 'showBackup'])->name('merchants.showbackup');

    // ==============   Products Tab   ==============  //
    Route::post('products/update-products-status', [ProductController::class, 'updateProductstatus'])->name('products.update_merchants_status');
    Route::post('product/remove-image', [ProductController::class, 'remove_image'])->name('products.remove_image');
    Route::resource('products', ProductController::class);

    // ==============   Warehouses Tab   ==============  //
    Route::post('warehouses/update-warehouses-status', [WarehouseController::class, 'updateWarehouseStatus'])->name('warehouses.update_warehouses_status');
    Route::post('warehouse/remove-image', [WarehouseController::class, 'remove_image'])->name('warehouses.remove_image');
    Route::resource('warehouses', WarehouseController::class);

    // ==============   Shelves Tab   ==============  //
    Route::post('shelves/update-shelves-status', [ShelfController::class, 'updateshelvestatus'])->name('shelves.update_shelves_status');
    Route::post('shelve/remove-image', [ShelfController::class, 'remove_image'])->name('shelves.remove_image');
    Route::resource('shelves', ShelfController::class);

    // ==============   Warehouse Rentals Tab   ==============  //
      Route::post('warehouse-rentals/{rental}/pay-invoice', [WarehouseRentalController::class, 'payInvoice'])->name('warehouse_rentals.pay_invoice');
    Route::post('warehouse-rentals/update-warehouse-rentals-status', [WarehouseRentalController::class, 'updateWarehouseRentalStatus'])->name('warehouse_rentals.update_warehouse_rentals_status'); // not working yet
    Route::post('warehouse-rentals/remove-image', [WarehouseRentalController::class, 'remove_image'])->name('warehouse_rentals.remove_image');// not working yet
    Route::resource('warehouse_rentals', WarehouseRentalController::class);

    // ==============   Stock Items Tab   ==============  //
    Route::post('stock-items/update-stock-items-status', [StockItemController::class, 'updateStockItemStatus'])->name('stock_items.update_stock_items_status');
    Route::post('stock-items/remove-image', [StockItemController::class, 'remove_image'])->name('stock_items.remove_image');
    Route::get('stock_items/fetch-merchant-data', [StockItemController::class, 'fetchMerchantData'])->name('stock_items.fetch_merchant_data');
    Route::resource('stock_items', StockItemController::class);


    // ==============   Packages Tab   ==============  //
    Route::post('packages/update-packages-status', [PackageController::class, 'updatePackageStatus'])->name('packages.update_packages_status');
    Route::post('package/remove-image', [PackageController::class, 'remove_image'])->name('packages.remove_image');
    Route::get('admin/packages/{id}/print', [PackageController::class, 'printPackage'])->name('packages.print');
    Route::resource('packages', PackageController::class);

    // ==============   Drivers Tab   ==============  //
    Route::post('driver/remove-driver-image', [DriverController::class, 'remove_driver_image'])->name('drivers.remove_driver_image');
    Route::post('driver/remove-vehicle-image', [DriverController::class, 'remove_vehicle_image'])->name('drivers.remove_vehicle_image');
    Route::post('driver/remove-license-image', [DriverController::class, 'remove_license_image'])->name('drivers.remove_license_image');
    Route::post('driver/remove-id-card-image', [DriverController::class, 'remove_id_card_image'])->name('drivers.remove_id_card_image');
    Route::resource('drivers', DriverController::class);

    // ==============   Deliveries Tab   ==============  //
    Route::resource('deliveries', DeliveryController::class);

    // ==============   Pickup Requests Tab   ==============  //
    Route::resource('pickup_requests', PickupRequestController::class);

    // ==============   return Requests Tab   ==============  //
    Route::resource('return_requests', ReturnRequestController::class);

    // ==============   Pickup Requests Tab   ==============  //
    Route::post('shipping-partners/update-shipping-partners-status', [ShippingPartnerController::class, 'updateShippingPartnerStatus'])->name('shipping_partners.update_shipping_partners_status');
    Route::post('shipping-partner/remove-image', [ShippingPartnerController::class, 'remove_image'])->name('shipping_partners.remove_image');
    Route::resource('shipping_partners', ShippingPartnerController::class);

    // ==============   External Shipment   ==============  //
    Route::resource('external_shipments', ExternalShipmentController::class);

    // ==============   invoices   ==============  //
    Route::resource('invoices', InvoiceController::class);

    // ==============   Payments   ==============  //
    // Route::resource('payments', PaymentController::class);




    // ==============   Tags Tab   ==============  //
    Route::post('tags/update-tag-status', [TagController::class, 'updateTagStatus'])->name('tags.update_tag_status');
    Route::resource('tags', TagController::class);


    });
});
