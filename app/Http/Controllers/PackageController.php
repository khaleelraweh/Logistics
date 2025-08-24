<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PackageRequest;
use App\Models\Invoice;
use App\Models\Merchant;
use App\Models\Package;
use App\Models\PackageLog;
use App\Models\PackageProduct;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\StockItem;
use App\Models\Warehouse;
use App\Models\WarehouseRental;
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


    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_stock_items , show_stock_items')) {
    //         return redirect('admin/index');
    //     }

    //     $packages = Package::with('merchant')
    //         ->when(\request()->keyword != null, function ($query) {
    //             $query->search(\request()->keyword);
    //         })
    //         ->when(\request()->status != null, function ($query) {
    //             $query->where('status', \request()->status);
    //         })
    //         ->orderByRaw(request()->sort_by == 'published_on'
    //             ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //             : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
    //         ->paginate(\request()->limit_by ?? 100);

    //     return view('admin.packages.index', compact('packages'));
    // }


    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_stock_items , show_stock_items')) {
            return redirect('admin/index');
        }

        // جلب جميع التجار للفلاتر
        $merchants = Merchant::all();
         $statuses = Package::statuses();

        $packages = Package::with('merchant')
            ->when(request()->keyword != null, function ($query) {
                $query->search(request()->keyword);
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->when(request()->merchant_id != null, function ($query) {
                $query->where('merchant_id', request()->merchant_id);
            })
            ->when(request()->delivery_method != null, function ($query) {
                $query->where('delivery_method', request()->delivery_method);
            })
            ->when(request()->package_type != null, function ($query) {
                $query->where('package_type', request()->package_type);
            })
            ->when(request()->package_size != null, function ($query) {
                $query->where('package_size', request()->package_size);
            })
            ->when(request()->origin_type != null, function ($query) {
                $query->where('origin_type', request()->origin_type);
            })
            ->when(request()->delivery_speed != null, function ($query) {
                $query->where('delivery_speed', request()->delivery_speed);
            })
            ->when(request()->payment_responsibility != null, function ($query) {
                $query->where('payment_responsibility', request()->payment_responsibility);
            })
            ->when(request()->payment_method != null, function ($query) {
                $query->where('payment_method', request()->payment_method);
            })
            ->when(request()->collection_method != null, function ($query) {
                $query->where('collection_method', request()->collection_method);
            });


        // الترتيب
        if(request()->sort_by == 'merchant_name') {
            $packages->join('merchants', 'packages.merchant_id', '=', 'merchants.id')
                    ->select('packages.*')
                    ->orderBy('merchants.name', request()->order_by ?? 'asc');
        } else {
            $packages->orderByRaw(
                request()->sort_by == 'published_on'
                    ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                    : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
            );
        }

        $packages = $packages->paginate(request()->limit_by ?? 100);

        return view('admin.packages.index', compact('packages', 'merchants','statuses'));
    }


// public function index()
// {
//     if (!auth()->user()->ability('admin', 'manage_stock_items , show_stock_items')) {
//         return redirect('admin/index');
//     }

//     $merchants = Merchant::all();

//     $packages = Package::with(['merchant','receiverMerchant'])
//         ->when(request()->keyword, fn($q) => $q->search(request()->keyword))
//         ->when(request()->merchant_id, fn($q) => $q->where('merchant_id', request()->merchant_id))
//         ->when(request()->receiver_merchant_id, fn($q) => $q->where('receiver_merchant_id', request()->receiver_merchant_id))
//         ->when(request()->sender_name, fn($q) => $q->where(function($q2){
//             $q2->where('sender_first_name', 'like', '%'.request()->sender_name.'%')
//                ->orWhere('sender_middle_name', 'like', '%'.request()->sender_name.'%')
//                ->orWhere('sender_last_name', 'like', '%'.request()->sender_name.'%');
//         }))
//         ->when(request()->sender_city, fn($q) => $q->where('sender_city', 'like', '%'.request()->sender_city.'%'))
//         ->when(request()->receiver_name, fn($q) => $q->where(function($q2){
//             $q2->where('receiver_first_name', 'like', '%'.request()->receiver_name.'%')
//                ->orWhere('receiver_middle_name', 'like', '%'.request()->receiver_name.'%')
//                ->orWhere('receiver_last_name', 'like', '%'.request()->receiver_name.'%');
//         }))
//         ->when(request()->receiver_city, fn($q) => $q->where('receiver_city', 'like', '%'.request()->receiver_city.'%'))
//         ->when(request()->receiver_district, fn($q) => $q->where('receiver_district', 'like', '%'.request()->receiver_district.'%'))
//         ->when(request()->quantity_min, fn($q) => $q->where('quantity', '>=', request()->quantity_min))
//         ->when(request()->quantity_max, fn($q) => $q->where('quantity', '<=', request()->quantity_max))
//         ->when(request()->payment_responsibility, fn($q) => $q->where('payment_responsibility', request()->payment_responsibility))
//         ->when(request()->collection_method, fn($q) => $q->where('collection_method', request()->collection_method))
//         ->when(request()->status, fn($q) => $q->where('status', request()->status));

//     // الترتيب
//     if(request()->sort_by == 'merchant_name'){
//         $packages->join('merchants','packages.merchant_id','=','merchants.id')
//                  ->select('packages.*')
//                  ->orderBy('merchants.name', request()->order_by ?? 'asc');
//     } else {
//         $packages->orderByRaw(
//             request()->sort_by == 'published_on'
//                 ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
//                 : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
//         );
//     }

//     $packages = $packages->paginate(request()->limit_by ?? 100);

//     return view('admin.packages.index', compact('packages','merchants'));
// }










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

    public function create_for_good()
    {
        if (!auth()->user()->ability('admin', 'create_packages')) {
            return redirect('admin/index');
        }

        $merchants = \App\Models\Merchant::select('id', 'name')->get();
        $rentalShelves = \App\Models\RentalShelf::with('shelf.warehouse')->get();
        $packages = \App\Models\Package::select('id', 'tracking_number')->get();

        return view('admin.packages.create_for_good', compact('merchants', 'rentalShelves', 'packages'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (!auth()->user()->ability('admin', 'create_packages')) {
            return redirect('admin/index');
        }

        // نستخدم معاملة كاملة: إنشاء الطرد + المنتجات + تعديل المخزون + الفاتورة + الدفع
        $result = DB::transaction(function () use ($request) {

            // =========================
            // 1) بناء بيانات الطرد
            // =========================

            // Sender
            $input['merchant_id']         = $request->merchant_id; // (المرسل هو التاجر) اختياري
            $input['sender_first_name']   = $request->sender_first_name;
            $input['sender_middle_name']  = $request->sender_middle_name;
            $input['sender_last_name']    = $request->sender_last_name;
            $input['sender_email']        = $request->sender_email;
            $input['sender_phone']        = $request->sender_phone;
            $input['sender_country']      = $request->sender_country;
            $input['sender_region']       = $request->sender_region;
            $input['sender_city']         = $request->sender_city;
            $input['sender_district']     = $request->sender_district;
            $input['sender_postal_code']  = $request->sender_postal_code;
            $input['sender_latitude']     = $request->sender_latitude;
            $input['sender_longitude']     = $request->sender_longitude;
            $input['sender_others']       = $request->sender_others;

            // Receiver  (إصلاح typo: receiver_region)
            $input['receiver_merchant_id'] = $request->receiver_merchant_id; // (المستقبل هو التاجر) اختياري
            $input['receiver_first_name']  = $request->receiver_first_name;
            $input['receiver_middle_name'] = $request->receiver_middle_name;
            $input['receiver_last_name']   = $request->receiver_last_name;
            $input['receiver_email']       = $request->receiver_email;
            $input['receiver_phone']       = $request->receiver_phone;
            $input['receiver_country']     = $request->receiver_country;
            $input['receiver_region']      = $request->receiver_region;
            $input['receiver_city']        = $request->receiver_city;
            $input['receiver_district']    = $request->receiver_district;
            $input['receiver_postal_code'] = $request->receiver_postal_code;
            $input['receiver_latitude']    = $request->receiver_latitude;
            $input['receiver_longitude']    = $request->receiver_longitude;
            $input['receiver_others']      = $request->receiver_others;

            // Package
            $input['package_type']   = $request->package_type;
            $input['package_size']   = $request->package_size;
            $input['weight']         = $request->weight;
            $input['dimensions']     = [
                'length' => data_get($request->dimensions, 'length'),
                'width'  => data_get($request->dimensions, 'width'),
                'height' => data_get($request->dimensions, 'height'),
            ];
            $input['package_content'] = $request->package_content;
            $input['package_note']    = $request->package_note;

            // Delivery
            $input['delivery_speed']      = $request->delivery_speed;
            $input['delivery_date']       = $request->delivery_date;
            $input['status']              = $request->status;
            $input['delivery_method']     = $request->delivery_method;
            $input['origin_type']         = $request->origin_type;
            $input['delivery_status_note']= $request->delivery_status_note;

            // Payment meta on package (ليست سجلات مالية فعلية)
            $input['payment_responsibility'] = $request->payment_responsibility; // (merchant/receiver)
            $input['payment_method']         = $request->payment_method;         // (prepaid/cod/...)
            $input['collection_method']      = $request->collection_method;      // (cash/bank/...)

            $deliveryFee  = (float)($request->delivery_fee   ?? 0);
            $insuranceFee = (float)($request->insurance_fee  ?? 0);
            $serviceFee   = (float)($request->service_fee    ?? 0);
            $totalFee     = $deliveryFee + $insuranceFee + $serviceFee;

            $input['delivery_fee'] = $deliveryFee;
            $input['insurance_fee']= $insuranceFee;
            $input['service_fee']  = $serviceFee;
            $input['cod_amount']   = (float)($request->cod_amount ?? 0);
            $input['total_fee']    = $totalFee;



            // Attributes
            $input['attributes'] = [
                'is_fragile'                   => $request->boolean('attributes.is_fragile'),
                'is_returnable'                => $request->boolean('attributes.is_returnable'),
                'is_confidential'              => $request->boolean('attributes.is_confidential'),
                'is_express'                   => $request->boolean('attributes.is_express'),
                'is_cod'                       => $request->boolean('attributes.is_cod'),
                'is_gift'                      => $request->boolean('attributes.is_gift'),
                'is_oversized'                 => $request->boolean('attributes.is_oversized'),
                'is_hazardous_material'        => $request->boolean('attributes.is_hazardous_material'),
                'is_temperature_controlled'    => $request->boolean('attributes.is_temperature_controlled'),
                'is_perishable'                => $request->boolean('attributes.is_perishable'),
                'is_signature_required'        => $request->boolean('attributes.is_signature_required'),
                'is_inspection_required'       => $request->boolean('attributes.is_inspection_required'),
                'is_special_handling_required' => $request->boolean('attributes.is_special_handling_required'),
            ];

            // 1.1 إنشاء الطرد
            $package = Package::create($input);

            // =========================
            // 2) المنتجات + المخزون
            // =========================
            $totalQuantity = 0;

            if ($package && is_array($request->products)) {
                foreach ($request->products as $productData) {

                    $qty = (int)($productData['quantity'] ?? 0);
                    $totalQuantity += $qty;

                    PackageProduct::create([
                        'package_id'    => $package->id,
                        'type'          => $productData['type'],
                        'stock_item_id' => $productData['type'] === 'stock' ? ($productData['stock_item_id'] ?? null) : null,
                        'custom_name'   => $productData['custom_name'] ?? null,
                        'weight'        => $productData['weight'] ?? null,
                        'quantity'      => $qty,
                        'price_per_unit'=> (float)($productData['price_per_unit'] ?? 0),
                        'total_price'   => (float)($productData['total_price'] ?? 0),
                    ]);

                    // خصم من المخزون
                    if ($productData['type'] === 'stock' && !empty($productData['stock_item_id'])) {
                        $stockItem = StockItem::lockForUpdate()->find($productData['stock_item_id']);
                        if ($stockItem) {
                            $stockItem->quantity = max(0, $stockItem->quantity - $qty);
                            $stockItem->save();
                        }
                    }
                }
            }

            $package->quantity = $totalQuantity;
            $package->save();

            // لوج
            $package->addLog(__('package.log_created'));

            // =========================
            // 3) إنشاء الفاتورة
            // =========================
            $currency = $request->currency ?? 'USD';

            $invoice = Invoice::create([
                'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
                'merchant_id'    => $package->merchant_id,
                'payable_type'   => Package::class,
                'payable_id'     => $package->id,
                'total_amount'   => $totalFee,
                'currency'       => $currency,
                'status'         => 'unpaid', // سيُحدّث بعد تسجيل أي دفعة
                'due_date'       => $request->due_date ? Carbon::parse($request->due_date) : now()->addDays(15),
                'issued_at'      => now(),
                'notes'          => 'فاتورة رسوم الطرد #' . $package->id,
            ]);

            // =========================
            // 4) إنشاء دفعة (إن وُجد مبلغ محصّل)
            // =========================
            $paidNow = (float)($request->paid_amount ?? 0);
            $paidSum = 0.0;

            if ($paidNow > 0) {
                $method = $this->mapPaymentMethod($request->collection_method ?? $request->payment_method);

                Payment::create([
                    'merchant_id'       => $package->merchant_id,
                    'method'            => $method,
                    'status'            => 'completed',
                    'paid_on'           => now(),
                    'amount'            => min($paidNow, $totalFee),
                    'currency'          => $currency,
                    'for'               => 'combined', // رسوم توصيل + خدمات
                    'reference_note'    => $request->reference_note,
                    'payment_reference' => $request->payment_reference,
                    'driver_id'         => $request->driver_id,
                    'invoice_id'        => $invoice->id,
                ]);

                $paidSum = $paidNow;
                $package->addLog('تم تسجيل دفعة أولية بقيمة: ' . number_format($paidNow, 2) . ' ' . $currency);
            }

            // تحديث حالة الفاتورة حسب المدفوع
            $invoice->refresh();
            $paidTotal = (float) $invoice->payments()->sum('amount');
            $invoice->status = $this->resolveInvoiceStatus($invoice->total_amount, $paidTotal);
            $invoice->save();

            // تحديث الطرد من ناحية المبالغ
            if ($package->isFillable('paid_amount')) $package->paid_amount = $paidTotal;
            if ($package->isFillable('due_amount'))  $package->due_amount  = max(0, $totalFee - $paidTotal);
            $package->save();

            return $package->id;
        });

        // بعد النجاح
        return redirect()->route('admin.packages.print', $result)
            ->with(['message' => __('messages.package_created'), 'alert-type' => 'success']);
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
    public function update(Request $request, $packageId)
    {
        if (!auth()->user()->ability('admin', 'update_packages')) {
            return redirect('admin/index');
        }

        DB::transaction(function () use ($request, $packageId) {

            $package = Package::lockForUpdate()->findOrFail($packageId);

            // ========== 1) تحديث بيانات الطرد ==========
            $input['sender_first_name']   = $request->sender_first_name;
            $input['sender_middle_name']  = $request->sender_middle_name;
            $input['sender_last_name']    = $request->sender_last_name;
            $input['sender_email']        = $request->sender_email;
            $input['sender_phone']        = $request->sender_phone;
            $input['sender_country']      = $request->sender_country;
            $input['sender_region']       = $request->sender_region;
            $input['sender_city']         = $request->sender_city;
            $input['sender_district']     = $request->sender_district;
            $input['sender_postal_code']  = $request->sender_postal_code;
            $input['sender_latitude']     = $request->sender_latitude;
            $input['sender_longitude']     = $request->sender_longitude;
            $input['sender_others']       = $request->sender_others;

            $input['receiver_first_name']  = $request->receiver_first_name;
            $input['receiver_middle_name'] = $request->receiver_middle_name;
            $input['receiver_last_name']   = $request->receiver_last_name;
            $input['receiver_email']       = $request->receiver_email;
            $input['receiver_phone']       = $request->receiver_phone;
            $input['receiver_country']     = $request->receiver_country;
            $input['receiver_region']      = $request->receiver_region; // fix
            $input['receiver_city']        = $request->receiver_city;
            $input['receiver_district']    = $request->receiver_district;
            $input['receiver_postal_code'] = $request->receiver_postal_code;
            $input['receiver_latitude']    = $request->receiver_latitude;
            $input['receiver_longitude']    = $request->receiver_longitude;
            $input['receiver_others']      = $request->receiver_others;

            $input['package_type']   = $request->package_type;
            $input['package_size']   = $request->package_size;
            $input['weight']         = $request->weight;
            $input['dimensions']     = [
                'length' => data_get($request->dimensions, 'length'),
                'width'  => data_get($request->dimensions, 'width'),
                'height' => data_get($request->dimensions, 'height'),
            ];
            $input['package_content'] = $request->package_content;
            $input['package_note']    = $request->package_note;

            $input['delivery_speed']      = $request->delivery_speed;
            $input['delivery_date']       = $request->delivery_date;
            $input['status']              = $request->status;
            $input['delivery_method']     = $request->delivery_method;
            $input['origin_type']         = $request->origin_type;
            $input['delivery_status_note']= $request->delivery_status_note;

            $input['payment_responsibility'] = $request->payment_responsibility;
            $input['payment_method']         = $request->payment_method;
            $input['collection_method']      = $request->collection_method;

            $deliveryFee  = (float)($request->delivery_fee   ?? 0);
            $insuranceFee = (float)($request->insurance_fee  ?? 0);
            $serviceFee   = (float)($request->service_fee    ?? 0);
            $totalFee     = $deliveryFee + $insuranceFee + $serviceFee;

            $input['delivery_fee'] = $deliveryFee;
            $input['insurance_fee']= $insuranceFee;
            $input['service_fee']  = $serviceFee;
            $input['cod_amount']   = (float)($request->cod_amount ?? 0);
            $input['total_fee']    = $totalFee;

            $input['merchant_id']  = $request->merchant_id;

            $input['attributes'] = [
                'is_fragile'                   => $request->boolean('attributes.is_fragile'),
                'is_returnable'                => $request->boolean('attributes.is_returnable'),
                'is_confidential'              => $request->boolean('attributes.is_confidential'),
                'is_express'                   => $request->boolean('attributes.is_express'),
                'is_cod'                       => $request->boolean('attributes.is_cod'),
                'is_gift'                      => $request->boolean('attributes.is_gift'),
                'is_oversized'                 => $request->boolean('attributes.is_oversized'),
                'is_hazardous_material'        => $request->boolean('attributes.is_hazardous_material'),
                'is_temperature_controlled'    => $request->boolean('attributes.is_temperature_controlled'),
                'is_perishable'                => $request->boolean('attributes.is_perishable'),
                'is_signature_required'        => $request->boolean('attributes.is_signature_required'),
                'is_inspection_required'       => $request->boolean('attributes.is_inspection_required'),
                'is_special_handling_required' => $request->boolean('attributes.is_special_handling_required'),
            ];

            $package->update($input);

            // ========== 2) إعادة المخزون للقديمة ثم حذف البنود ==========
            foreach ($package->packageProducts as $item) {
                if ($item->type === 'stock' && !empty($item->stock_item_id)) {
                    $stockItem = StockItem::lockForUpdate()->find($item->stock_item_id);
                    if ($stockItem) {
                        $stockItem->quantity = max(0, $stockItem->quantity + (int)$item->quantity);
                        $stockItem->save();
                    }
                }
                $item->delete();
            }

            // ========== 3) إضافة البنود الجديدة + خصم المخزون ==========
            $totalQuantity = 0;

            if (is_array($request->products)) {
                foreach ($request->products as $productData) {
                    $qty = (int)($productData['quantity'] ?? 0);
                    $totalQuantity += $qty;

                    PackageProduct::create([
                        'package_id'    => $package->id,
                        'type'          => $productData['type'],
                        'stock_item_id' => $productData['type'] === 'stock' ? ($productData['stock_item_id'] ?? null) : null,
                        'custom_name'   => $productData['custom_name'] ?? null,
                        'weight'        => $productData['weight'] ?? null,
                        'quantity'      => $qty,
                        'price_per_unit'=> (float)($productData['price_per_unit'] ?? 0),
                        'total_price'   => (float)($productData['total_price'] ?? 0),
                    ]);

                    if ($productData['type'] === 'stock' && !empty($productData['stock_item_id'])) {
                        $stockItem = StockItem::lockForUpdate()->find($productData['stock_item_id']);
                        if ($stockItem) {
                            $stockItem->quantity = max(0, $stockItem->quantity - $qty);
                            $stockItem->save();
                        }
                    }
                }
            }

            $package->quantity = $totalQuantity;
            $package->save();

            // لوج
            $translatedStatus = __('package.status_' . $package->status);
            $package->addLog(__('package.log_updated_with_status', ['status' => $translatedStatus]));

            // ========== 4) الفاتورة: تحديث/إنشاء ==========
            $invoice = Invoice::firstOrNew([
                'payable_type' => Package::class,
                'payable_id'   => $package->id,
            ]);

            if (!$invoice->exists) {
                $invoice->invoice_number = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
                $invoice->issued_at      = now();
            }

            $invoice->merchant_id  = $package->merchant_id;
            $invoice->total_amount = $totalFee;
            $invoice->currency     = $invoice->currency ?: ($request->currency ?? 'USD');
            $invoice->due_date     = $request->due_date ? Carbon::parse($request->due_date) : ($invoice->due_date ?? now()->addDays(15));
            $invoice->notes        = 'فاتورة رسوم الطرد #' . $package->id;
            $invoice->save();

            // ========== 5) دفعة فرق إن زاد paid_amount ==========
            $alreadyPaid = (float) $invoice->payments()->sum('amount');
            $newPaidDesired = (float) ($request->paid_amount ?? $alreadyPaid);

            if ($newPaidDesired > $alreadyPaid) {
                $delta = $newPaidDesired - $alreadyPaid;
                $method = $this->mapPaymentMethod($request->collection_method ?? $request->payment_method);

                Payment::create([
                    'merchant_id'       => $package->merchant_id,
                    'method'            => $method,
                    'status'            => 'completed',
                    'paid_on'           => now(),
                    'amount'            => min($delta, max(0, $invoice->total_amount - $alreadyPaid)),
                    'currency'          => $invoice->currency,
                    'for'               => 'combined',
                    'reference_note'    => $request->reference_note,
                    'payment_reference' => $request->payment_reference,
                    'driver_id'         => $request->driver_id,
                    'invoice_id'        => $invoice->id,
                ]);

                $package->addLog('تم تسجيل دفعة إضافية بقيمة: ' . number_format($delta, 2) . ' ' . $invoice->currency);
            }

            // تحديث حالة الفاتورة
            $paidTotal = (float) $invoice->payments()->sum('amount');
            $invoice->status = $this->resolveInvoiceStatus($invoice->total_amount, $paidTotal);
            $invoice->save();

            // تحديث الطرد مالياً
            if ($package->isFillable('paid_amount')) $package->paid_amount = $paidTotal;
            if ($package->isFillable('due_amount'))  $package->due_amount  = max(0, $invoice->total_amount - $paidTotal);
            $package->save();
        });

        return redirect()->route('admin.packages.index')->with([
            'message' => __('messages.package_updated'),
            'alert-type' => 'success'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    // public function destroy($package)
    // {
    //     if (!auth()->user()->ability('admin', 'delete_packages')) {
    //         return redirect('admin/index');
    //     }

    //     $package = Package::where('id', $package)->first();

    //     if ($package) {
    //             $package->addLog('تم حذف الطرد');
    //         }

    //     foreach($package->packageProducts as $item){
    //         // إذا المنتج من المخزون، نقص الكمية من StockItem
    //         if ($item->type === 'stock' && !empty($item->stock_item_id)) {
    //             DB::transaction(function () use ($item) {
    //                 $stockItem = StockItem::lockForUpdate()->find($item->stock_item_id);
    //                 if ($stockItem) {
    //                     $newQuantity = max(0, $stockItem->quantity + (int)$item->quantity);
    //                     $stockItem->quantity = $newQuantity;
    //                     $stockItem->save();
    //                 }
    //             });
    //         }
    //         $item->delete();
    //     }


    //     $package->delete();



    //     if ($package) {
    //         return redirect()->route('admin.packages.index')->with([
    //             'message' => __('messages.package_deleted'),
    //             'alert-type' => 'success'
    //         ]);
    //     }
    //     return redirect()->route('admin.packages.index')->with([
    //         'message' => __('messages.something_was_wrong'),
    //         'alert-type' => 'danger'
    //     ]);
    // }

    public function destroy($packageId)
    {
        if (!auth()->user()->ability('admin', 'delete_packages')) {
            return redirect('admin/index');
        }

        $package = Package::where('id', $packageId)->first();

        if (!$package) {
            return redirect()->route('admin.packages.index')->with([
                'message' => __('messages.something_was_wrong'),
                'alert-type' => 'danger'
            ]);
        }

        DB::transaction(function () use ($package) {
            // سجل لوج قبل الحذف
            $package->addLog('تم حذف الطرد');

            // تحديث المخزون وحذف المنتجات
            foreach ($package->packageProducts as $item) {
                if ($item->type === 'stock' && !empty($item->stock_item_id)) {
                    $stockItem = StockItem::lockForUpdate()->find($item->stock_item_id);
                    if ($stockItem) {
                        $stockItem->quantity = max(0, $stockItem->quantity + (int)$item->quantity);
                        $stockItem->save();
                    }
                }
                $item->delete();
            }

            // حذف الطرد نفسه
            $package->delete();
        });

        return redirect()->route('admin.packages.index')->with([
            'message' => __('messages.package_deleted'),
            'alert-type' => 'success'
        ]);
    }




    // public function printPackage($id)
    // {
    //     $package = Package::findOrFail($id);

    //     // عرض صفحة الطباعة (HTML)
    //     return view('admin.packages.print', compact('package'));

    //     // أو لتحويله إلى PDF و تحميله:
    //     /*
    //     $pdf = PDF::loadView('admin.packages.print', compact('package'));
    //     return $pdf->download('package_'.$package->id.'.pdf');
    //     */
    // }

    // public function printPackage($id)
    // {
    //     $package = Package::findOrFail($id);

    //     $pdf = PDF::loadView('admin.packages.print', compact('package'));

    //     // تحميل الملف مباشرة
    //     return $pdf->download('package_'.$package->id.'.pdf');
    // }

    public function printPackage($id)
    {
        $package = Package::findOrFail($id);

        $pdf = PDF::loadView('admin.packages.print', compact('package'))
                ->setPaper('a4')
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isRemoteEnabled', true);

        return $pdf->download('package_'.$package->id.'.pdf');
    }


    /**
     * تحويل أي نص طريقة دفع إلى enum المدعوم بجدول payments.
     */
    protected function mapPaymentMethod(?string $method): string
    {
        $m = strtolower(trim((string)$method));

        // تغطية عربي/إنجليزي/اختصارات
        return match(true) {
            str_contains($m, 'cod') || str_contains($m, 'الدفع عند الاستلام') => 'cod',
            str_contains($m, 'cash') || str_contains($m, 'كاش') => 'cash',
            str_contains($m, 'bank') || str_contains($m, 'تحويل') => 'bank_transfer',
            str_contains($m, 'wallet') || str_contains($m, 'محفظ') => 'wallet',
            str_contains($m, 'mada') || str_contains($m, 'مدى') ||
            str_contains($m, 'card') || str_contains($m, 'بطاق') => 'credit_card',
            default => 'cash',
        };
    }

    /**
     * حساب حالة الفاتورة حسب إجمالي المدفوعات.
     */
    protected function resolveInvoiceStatus(float $total, float $paid): string
    {
        if ($paid <= 0) return 'unpaid';
        if ($paid + 0.00001 >= $total) return 'paid';
        return 'partial';
    }


}
