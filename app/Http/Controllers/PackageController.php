<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PackageRequest;
use App\Models\Merchant;
use App\Models\Package;
use App\Models\PackageLog;
use App\Models\PackageProduct;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // في أعلى الكود
use PDF; // إذا تستخدم barryvdh/laravel-dompdf أو أي مكتبة PDF


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_stock_items , show_stock_items')) {
            return redirect('admin/index');
        }

        $packages = Package::with('merchant')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderByRaw(request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
            ->paginate(\request()->limit_by ?? 100);

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_packages')) {
            return redirect('admin/index');
        }

        $merchants = \App\Models\Merchant::select('id', 'name')->get();
        $rentalShelves = \App\Models\RentalShelf::with('shelf.warehouse')->get();
        $packages = \App\Models\Package::select('id', 'tracking_number')->get();

        return view('admin.packages.create', compact('merchants', 'rentalShelves', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     dd($request);
    // }


    public function store(Request $request)
    {
            if (!auth()->user()->ability('admin', 'create_packages')) {
                return redirect('admin/index');
            }

            // dd($request);


            // Sender Information
            $input['sender_first_name'] = $request->sender_first_name;
            $input['sender_middle_name'] = $request->sender_middle_name;
            $input['sender_last_name'] = $request->sender_last_name;
            $input['sender_email'] = $request->sender_email;
            $input['sender_phone'] = $request->sender_phone;
            $input['sender_address'] = $request->sender_address;
            $input['sender_country'] = $request->sender_country;
            $input['sender_region'] = $request->sender_region; // Note the field name difference
            $input['sender_city'] = $request->sender_city;
            $input['sender_district'] = $request->sender_district;
            $input['sender_postal_code'] = $request->sender_postal_code;
            $input['sender_location'] = $request->sender_location;
            $input['sender_others'] = $request->sender_others;

            // Receiver Information
            $input['receiver_first_name'] = $request->receiver_first_name;
            $input['receiver_middle_name'] = $request->receiver_middle_name;
            $input['receiver_last_name'] = $request->receiver_last_name;
            $input['receiver_email'] = $request->receiver_email;
            $input['receiver_phone'] = $request->receiver_phone;
            $input['receiver_address'] = $request->receiver_address;
            $input['receiver_country'] = $request->receiver_country;
            $input['receiver_region'] = $request->receiver_regin; // Note the field name difference
            $input['receiver_city'] = $request->receiver_city;
            $input['receiver_district'] = $request->receiver_district;
            $input['receiver_postal_code'] = $request->receiver_postal_code;
            $input['receiver_location'] = $request->receiver_location;
            $input['receiver_others'] = $request->receiver_others;

            // Package Details
            $input['package_type'] = $request->package_type;
            $input['package_size'] = $request->package_size;
            $input['weight'] = $request->weight;
            $input['dimensions'] = [
                'length' => $request->dimensions['length'],
                'width' => $request->dimensions['width'],
                'height' => $request->dimensions['height']
            ];

            // Delivery Information
            $input['delivery_speed'] = $request->delivery_speed;
            $input['delivery_date'] = $request->delivery_date;
            $input['status'] = $request->status;
            $input['delivery_method'] = $request->delivery_method;
            $input['package_type'] = $request->package_type;
            $input['origin_type'] = $request->origin_type;
            $input['delivery_status_note'] = $request->delivery_status_note;

            // Payment Information
            $input['payment_responsibility'] = $request->payment_responsibility;
            $input['delivery_fee'] = $request->delivery_fee;
            $input['insurance_fee'] = $request->insurance_fee;
            $input['service_fee'] = $request->service_fee;
            $input['paid_amount'] = $request->paid_amount;
            $input['cod_amount'] = $request->cod_amount ?? 0;
            $input['total_fee'] = $request->delivery_fee + $request->insurance_fee + $request->service_fee;

            // Merchant
            $input['merchant_id'] = $request->merchant_id;

            // Package Attributes
            $input['attributes'] = [
                'is_fragile' => $request->has('attributes.is_fragile'),
                'is_returnable' => $request->has('attributes.is_returnable'),
                'is_confidential' => $request->has('attributes.is_confidential'),
                'is_express' => $request->has('attributes.is_express'),
                'is_cod' => $request->has('attributes.is_cod'),
                'is_gift' => $request->has('attributes.is_gift'),
                'is_oversized' => $request->has('attributes.is_oversized'),
                'is_hazardous_material' => $request->has('attributes.is_hazardous_material'),
                'is_temperature_controlled' => $request->has('attributes.is_temperature_controlled'),
                'is_perishable' => $request->has('attributes.is_perishable'),
                'is_signature_required' => $request->has('attributes.is_signature_required'),
                'is_inspection_required' => $request->has('attributes.is_inspection_required'),
                'is_special_handling_required' => $request->has('attributes.is_special_handling_required'),
            ];

            // Create package
            $package = Package::create($input);

            // متغير لتجميع الكمية الكلية
            $totalQuantity = 0;

            //  حفظ المنتجات
            if ($package && $request->has('products') && is_array($request->products)) {
                foreach ($request->products as $productData) {


                    $quantity = $productData['quantity'] ?? 0;
                    $totalQuantity += (int)$quantity;

                    // إنشاء المنتج في PackageProduct
                    $packageProduct = PackageProduct::create([
                        'package_id'            => $package->id,

                        // بيانات المنتج
                        'type'                  => $productData['type'],

                        // إما منتج من المخزون أو مخصص
                        'stock_item_id'         => $productData['type'] === 'stock' ? ($productData['stock_item_id'] ?? null) : null,
                        // 'custom_name'           => $productData['type'] === 'custom' ? ($productData['custom_name'] ?? null) : null,
                        'custom_name'           => $productData['custom_name'] ?? null,

                        // بيانات المنتج
                        'weight' => $productData['weight'] ?? null,
                        'quantity' => $productData['quantity'] ?? 0,
                        'price_per_unit' => $productData['price_per_unit'] ?? 0,
                        'total_price' => $productData['total_price'] ?? 0,
                    ]);

                     // إذا المنتج من المخزون، نقص الكمية من StockItem
                    if ($productData['type'] === 'stock' && !empty($productData['stock_item_id'])) {
                        // استخدم تحديث كمي مع القفل (lockForUpdate) لتجنب مشاكل التزامن
                        DB::transaction(function () use ($productData) {
                            $stockItem = \App\Models\StockItem::lockForUpdate()->find($productData['stock_item_id']);
                            if ($stockItem) {
                                $newQuantity = max(0, $stockItem->quantity - (int)$productData['quantity']);
                                $stockItem->quantity = $newQuantity;
                                $stockItem->save();
                            }
                        });
                    }

                }
            }

             // تحديث حقل quantity في جدول الطرود
            $package->quantity = $totalQuantity;
            $package->save();


            if ($package) {
                $package->addLog(__('package.log_created'));
            }

            // ثم تعيد توجيه المستخدم إلى صفحة الطباعة
            return redirect()->route('admin.packages.print', $package->id);


            // إنشاء فاتورة مرتبطة بالطرد
            $invoice = \App\Models\Invoice::create([
                'invoice_number' => 'INV-' . strtoupper(Str::random(8)), // رقم فاتورة عشوائي
                'merchant_id' => $package->merchant_id,
                'payable_type' => Package::class,   // اسم الموديل للطرد
                'payable_id' => $package->id,
                'total_amount' => $input['total_fee'],  // إجمالي المبلغ من بيانات الطرد
                'currency' => 'USD', // أو استخرج العملة من طلب المستخدم
                'status' => 'unpaid', // أو حسب الحالة الافتراضية
                'due_date' => now()->addDays(15), // مثال: تاريخ الاستحقاق بعد 15 يوم
                'issued_at' => now(),
                'notes' => 'فاتورة طرد رقم ' . $package->id,
            ]);

            if($package){
                return redirect()->route('admin.packages.index')->with([
                    'message' => __('messages.package_created'),
                    'alert-type' => 'success'
                ]);
            }

            return redirect()->route('admin.packages.index')->with([
                'message' => __('messages.something_went_wrong'),
                'alert-type' => 'danger'
            ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $package = Package::with([
    //         'merchant',
    //         'packageProducts.stockItem',       // لو فيه منتجات من المخزون
    //         'packageProducts'                  // كل المنتجات
    //     ])->findOrFail($id);

    //     return view('admin.packages.show', compact('package'));
    // }

    public function show($id)
    {
        $package = Package::with('packageLogs')->findOrFail($id);

        return view('admin.packages.show', compact('package'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($package)
    {
        if (!auth()->user()->ability('admin', 'update_packages')) {
            return redirect('admin/index');
        }

        $merchants = Merchant::whereStatus(1)->get(['id', 'name','email']);

        $package = Package::where('id', $package)->first();

        return view('admin.packages.edit',compact('package','merchants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $package)
    {
        if (!auth()->user()->ability('admin', 'update_packages')) {
            return redirect('admin/index');
        }

        // dd($request);

            $package = Package::where('id', $package)->first();

            // Sender Information
            $input['sender_first_name'] = $request->sender_first_name;
            $input['sender_middle_name'] = $request->sender_middle_name;
            $input['sender_last_name'] = $request->sender_last_name;
            $input['sender_email'] = $request->sender_email;
            $input['sender_phone'] = $request->sender_phone;
            $input['sender_address'] = $request->sender_address;
            $input['sender_country'] = $request->sender_country;
            $input['sender_region'] = $request->sender_region; // Note the field name difference
            $input['sender_city'] = $request->sender_city;
            $input['sender_district'] = $request->sender_district;
            $input['sender_postal_code'] = $request->sender_postal_code;
            $input['sender_location'] = $request->sender_location;
            $input['sender_others'] = $request->sender_others;

            // Receiver Information
            $input['receiver_first_name'] = $request->receiver_first_name;
            $input['receiver_middle_name'] = $request->receiver_middle_name;
            $input['receiver_last_name'] = $request->receiver_last_name;
            $input['receiver_email'] = $request->receiver_email;
            $input['receiver_phone'] = $request->receiver_phone;
            $input['receiver_address'] = $request->receiver_address;
            $input['receiver_country'] = $request->receiver_country;
            $input['receiver_region'] = $request->receiver_region; // Note the field name difference
            $input['receiver_city'] = $request->receiver_city;
            $input['receiver_district'] = $request->receiver_district;
            $input['receiver_postal_code'] = $request->receiver_postal_code;
            $input['receiver_location'] = $request->receiver_location;
            $input['receiver_others'] = $request->receiver_others;

            // Package Details
            $input['package_type'] = $request->package_type;
            $input['package_size'] = $request->package_size;
            $input['weight'] = $request->weight;
            $input['dimensions'] = [
                'length' => $request->dimensions['length'],
                'width' => $request->dimensions['width'],
                'height' => $request->dimensions['height']
            ];

            // Delivery Information
            $input['delivery_speed'] = $request->delivery_speed;
            $input['delivery_date'] = $request->delivery_date;
            $input['status'] = $request->status;
            $input['delivery_method'] = $request->delivery_method;
            $input['package_type'] = $request->package_type;
            $input['origin_type'] = $request->origin_type;
            $input['delivery_status_note'] = $request->delivery_status_note;

            // Payment Information
            $input['payment_responsibility'] = $request->payment_responsibility;
            $input['delivery_fee'] = $request->delivery_fee;
            $input['insurance_fee'] = $request->insurance_fee;
            $input['service_fee'] = $request->service_fee;
            $input['paid_amount'] = $request->paid_amount;
            $input['cod_amount'] = $request->cod_amount ?? 0;
            $input['total_fee'] = $request->delivery_fee + $request->insurance_fee + $request->service_fee;

            // Merchant
            $input['merchant_id'] = $request->merchant_id;

            // Package Attributes
            $input['attributes'] = [
                'is_fragile' => $request->has('attributes.is_fragile'),
                'is_returnable' => $request->has('attributes.is_returnable'),
                'is_confidential' => $request->has('attributes.is_confidential'),
                'is_express' => $request->has('attributes.is_express'),
                'is_cod' => $request->has('attributes.is_cod'),
                'is_gift' => $request->has('attributes.is_gift'),
                'is_oversized' => $request->has('attributes.is_oversized'),
                'is_hazardous_material' => $request->has('attributes.is_hazardous_material'),
                'is_temperature_controlled' => $request->has('attributes.is_temperature_controlled'),
                'is_perishable' => $request->has('attributes.is_perishable'),
                'is_signature_required' => $request->has('attributes.is_signature_required'),
                'is_inspection_required' => $request->has('attributes.is_inspection_required'),
                'is_special_handling_required' => $request->has('attributes.is_special_handling_required'),
            ];

            // Create package
            $package->update($input);

            // dd($request->products);

            foreach($package->packageProducts as $item){

                 // إذا المنتج من المخزون، نقص الكمية من StockItem
                if ($item->type === 'stock' && !empty($item->stock_item_id)) {
                    DB::transaction(function () use ($item) {
                        $stockItem = StockItem::lockForUpdate()->find($item->stock_item_id);
                        if ($stockItem) {
                            $newQuantity = max(0, $stockItem->quantity + (int)$item->quantity);
                            $stockItem->quantity = $newQuantity;
                            $stockItem->save();
                        }
                    });
                }
                $item->delete();
            }

            // dd($package->packageProducts->where('stock_item_id',1));

            //  حفظ المنتجات
            if ($package && $request->has('products') && is_array($request->products)) {
                foreach ($request->products as $productData) {

                    // إنشاء المنتج في PackageProduct
                    $packageProduct = PackageProduct::create([
                        'package_id'            => $package->id,

                        // بيانات المنتج
                        'type'                  => $productData['type'],

                        // إما منتج من المخزون أو مخصص
                        'stock_item_id'         => $productData['type'] === 'stock' ? ($productData['stock_item_id'] ?? null) : null,
                        // 'custom_name'           => $productData['type'] === 'custom' ? ($productData['custom_name'] ?? null) : null,
                        'custom_name'           => $productData['custom_name'] ?? null,

                        // بيانات المنتج
                        'weight' => $productData['weight'] ?? null,
                        'quantity' => $productData['quantity'] ?? 0,
                        'price_per_unit' => $productData['price_per_unit'] ?? 0,
                        'total_price' => $productData['total_price'] ?? 0,
                    ]);

                     // إذا المنتج من المخزون، نقص الكمية من StockItem
                    if ($productData['type'] === 'stock' && !empty($productData['stock_item_id'])) {
                        // استخدم تحديث كمي مع القفل (lockForUpdate) لتجنب مشاكل التزامن
                        DB::transaction(function () use ($productData) {
                            $stockItem = \App\Models\StockItem::lockForUpdate()->find($productData['stock_item_id']);
                            if ($stockItem) {
                                $newQuantity = max(0, $stockItem->quantity - (int)$productData['quantity']);
                                $stockItem->quantity = $newQuantity;
                                $stockItem->save();
                            }
                        });
                    }

                }
            }



            if ($package) {
                $translatedStatus = __('package.status_' . $package->status);
                $note = __('package.log_updated_with_status', ['status' => $translatedStatus]);
                $package->addLog($note);
            }


         if($package){
            return redirect()->route('admin.packages.index')->with([
                'message' => __('messages.package_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.packages.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
      public function destroy($package)
    {
        if (!auth()->user()->ability('admin', 'delete_packages')) {
            return redirect('admin/index');
        }

        $package = Package::where('id', $package)->first();

        foreach($package->packageProducts as $item){
            // إذا المنتج من المخزون، نقص الكمية من StockItem
            if ($item->type === 'stock' && !empty($item->stock_item_id)) {
                DB::transaction(function () use ($item) {
                    $stockItem = StockItem::lockForUpdate()->find($item->stock_item_id);
                    if ($stockItem) {
                        $newQuantity = max(0, $stockItem->quantity + (int)$item->quantity);
                        $stockItem->quantity = $newQuantity;
                        $stockItem->save();
                    }
                });
            }
            $item->delete();
        }


        $package->delete();

        if ($package) {
            $package->addLog('تم حذف الطرد');
        }

        if ($package) {
            return redirect()->route('admin.packages.index')->with([
                'message' => __('messages.package_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.packages.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function printPackage($id)
    {
        $package = Package::findOrFail($id);

        // عرض صفحة الطباعة (HTML)
        return view('admin.packages.print', compact('package'));

        // أو لتحويله إلى PDF و تحميله:
        /*
        $pdf = PDF::loadView('admin.packages.print', compact('package'));
        return $pdf->download('package_'.$package->id.'.pdf');
        */
    }


}
