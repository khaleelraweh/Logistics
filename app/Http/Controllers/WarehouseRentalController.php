<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Warehouse;
use App\Models\WarehouseRental;
use App\Models\Invoice;
use App\Models\Shelf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf; // مكتبة PDF

class WarehouseRentalController extends Controller
{
    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_warehouse_rentals , show_warehouse_rentals')) {
    //         return redirect('admin/index');
    //     }

    //     $warehouses = Warehouse::all(); // لجلب المستودعات للفلاتر
    //     $merchants = Merchant::all(); // لجلب التجار للفلاتر


    //     $warehouse_rentals = WarehouseRental::with(['shelves', 'merchant'])
    //         ->when(request()->keyword != null, function ($query) {
    //             $query->search(request()->keyword);
    //         })
    //         ->when(request()->status != null, function ($query) {
    //             $query->where('status', request()->status);
    //         })
    //         ->orderByRaw(request()->sort_by == 'published_on'
    //             ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //             : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
    //         ->paginate(request()->limit_by ?? 100);

    //     return view('admin.warehouse_rentals.index', compact('warehouse_rentals' , 'warehouses', 'merchants'));
    // }


    public function index()
    {
        // صلاحيات الوصول
        if (!auth()->user()->ability('admin', 'manage_warehouse_rentals , show_warehouse_rentals')) {
            return redirect('admin/index');
        }

        // لجلب بيانات الفلاتر
        $warehouses = Warehouse::all();
        $merchants = Merchant::all();

        // الاستعلام الأساسي مع الفلاتر
        $warehouse_rentals = WarehouseRental::with(['shelves', 'merchant'])
            ->when(request()->keyword != null, function ($query) {
                $query->search(request()->keyword);
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->when(request()->warehouse_id != null, function ($query) {
                $query->whereHas('shelves', function ($q) {
                    $q->where('warehouse_id', request()->warehouse_id);
                });
            })
            ->when(request()->merchant_id != null, function ($query) {
                $query->where('merchant_id', request()->merchant_id);
            })
            // فلترة حسب مدة الإيجار من – إلى
            ->when(request()->rental_start != null, function ($query) {
                $query->whereDate('rental_start', '>=', request()->rental_start);
            })
            ->when(request()->rental_end != null, function ($query) {
                $query->whereDate('rental_end', '<=', request()->rental_end);
            });

        // الترتيب
        if (request()->sort_by == 'warehouse_name') {
        $warehouse_rentals->join('rental_shelves', 'warehouse_rentals.id', '=', 'rental_shelves.warehouse_rental_id')
            ->join('shelves', 'rental_shelves.shelf_id', '=', 'shelves.id')
            ->join('warehouses', 'shelves.warehouse_id', '=', 'warehouses.id')
            ->select('warehouse_rentals.*') // مهم لاختيار أعمدة العقد فقط
            ->distinct() // إزالة التكرار
            ->orderBy('warehouses.name', request()->order_by ?? 'asc');

        }
        elseif(request()->sort_by == 'merchant_name') {
        $warehouse_rentals->join('merchants', 'warehouse_rentals.merchant_id', '=', 'merchants.id')
            ->select('warehouse_rentals.*') // مهم للحفاظ على بيانات العقود فقط
            ->orderBy('merchants.name', request()->order_by ?? 'asc');

        }

        else {
            $warehouse_rentals->orderByRaw(
                request()->sort_by == 'published_on'
                    ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                    : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
            );
        }

        // التقطيع للصفحات
        $warehouse_rentals = $warehouse_rentals->paginate(request()->limit_by ?? 100);

        // إرجاع الـ View مع البيانات
        return view('admin.warehouse_rentals.index', compact('warehouse_rentals', 'warehouses', 'merchants'));
    }





    // هنا يعرض حتي المستودعات التي ليس فيها رفوف ويوضح بانه لا يوجه هناك رفوف فارغة
    // public function create()
    // {
    //     $merchants = Merchant::all();
    //     $warehouses = Warehouse::with(['shelves' => function ($query) {
    //         $query->whereDoesntHave('rentals', function ($q) {
    //             $q->where('status', 1)
    //               ->where('rental_end', '>', Carbon::now());
    //         });
    //     }])->get();



    //     return view('admin.warehouse_rentals.create', compact('warehouses', 'merchants'));
    // }


    public function create()
    {
        $merchants = Merchant::all();
        $now = Carbon::now();

        // نفس شرط "الرف المتاح" يُستخدم داخل with() و whereHas()
        $availableShelvesScope = function ($q) use ($now) {
            $q->whereDoesntHave('rentals', function ($rq) use ($now) {
                $rq->where('status', 1) // عقد إيجار نشط
                ->where(function ($rq2) use ($now) {
                    // يعتبر الرف محجوزًا إذا كان تاريخ نهاية العقد أو نهاية المدة المخصصة >= الآن
                    $rq2->whereDate('warehouse_rentals.rental_end', '>=', $now)
                        ->orWhereDate('rental_shelves.custom_end', '>=', $now);
                });
            });
        };

        $warehouses = Warehouse::query()
            // ❗ لا تُرجع إلا المستودعات التي فيها على الأقل رف واحد "متاح"
            ->whereHas('shelves', $availableShelvesScope)
            // ❗ وعند جلب الرفوف، اجلب فقط المتاحة
            ->with(['shelves' => $availableShelvesScope])
            ->get();

        return view('admin.warehouse_rentals.create', compact('warehouses', 'merchants'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'merchant_id'  => 'required|exists:merchants,id',
            'shelves'      => 'required|array',
            'rental_start' => 'required|date',
            'rental_end'   => 'required|date|after_or_equal:rental_start',
        ]);

        // ✅ تحقق من أن هناك رف واحد على الأقل مختار
        $selectedShelves = collect($request->shelves)->filter(fn($shelf) => isset($shelf['selected']));
        if ($selectedShelves->isEmpty()) {
            return back()->withErrors(['shelves' => __('يجب اختيار رف واحد على الأقل')])->withInput();
        }

        $rental = WarehouseRental::create([
            'merchant_id'  => $request->merchant_id,
            'rental_start' => Carbon::parse($request->rental_start),
            'rental_end'   => Carbon::parse($request->rental_end),
            'status'       => 1,
            'created_by'   => auth()->user()->name ?? 'system',
        ]);

        $totalPrice = 0;

        foreach ($request->shelves as $shelfId => $data) {
            if (!isset($data['selected'])) continue;

            // ✅ إذا لم يدخل سعر → نستخدم سعر الرف من الجدول
            $shelf = Shelf::findOrFail($shelfId);
            // $customPrice = $data['custom_price'] ?? 0;

            $customPrice = !empty($data['custom_price']) ? $data['custom_price'] : $shelf->price;

            $customStart = Carbon::parse($data['custom_start'] ?? $request->rental_start);
            $customEnd   = Carbon::parse($data['custom_end'] ?? $request->rental_end);

            $days = $customEnd->diffInDays($customStart) + 1;
            $shelfTotal = $customPrice * $days;
            $totalPrice += $shelfTotal;

            $rental->shelves()->attach($shelfId, [
                'custom_price' => $customPrice,
                'custom_start' => $customStart,
                'custom_end'   => $customEnd,
                'total_price'  => $shelfTotal,
            ]);
        }

        $rental->update(['price' => $totalPrice]);

        // إنشاء الفاتورة المرتبطة
        $rental->invoice()->create([
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'merchant_id'    => $rental->merchant_id,
            'total_amount'   => $totalPrice,
            'currency'       => 'SAR',
            'status'         => 'unpaid',
            'due_date'       => Carbon::now()->addDays(15),
            'issued_at'      => Carbon::now(),
            'notes'          => 'فاتورة إيجار رفوف #' . $rental->id,
        ]);

        return redirect()->route('admin.warehouse_rentals.index')
            ->with('success', 'Rental created with invoice.');
    }

    public function show(WarehouseRental $warehouseRental)
    {
        $warehouseRental->load(['merchant', 'shelves.warehouse']);
        return view('admin.warehouse_rentals.show', compact('warehouseRental'));
    }

    // هنا يعرض حتي المستودعات التي ليس فيها رفوف ويوضح بانه لا يوجد بها رفوف
    // public function edit($id)
    // {
    //     $warehouseRental = WarehouseRental::with('shelves')->findOrFail($id);
    //     $merchants = Merchant::all();

    //     $warehouses = Warehouse::with(['shelves' => function ($query) use ($warehouseRental) {
    //         $query->where(function ($q) use ($warehouseRental) {
    //             $q->whereDoesntHave('rentals', function ($rentalQ) use ($warehouseRental) {
    //                 $rentalQ->where('status', 1)
    //                     ->where('rental_end', '>', now());
    //             })->orWhereHas('rentals', function ($rentalQ) use ($warehouseRental) {
    //                 $rentalQ->where('warehouse_rental_id', $warehouseRental->id);
    //             });
    //         });
    //     }])->get();

    //     return view('admin.warehouse_rentals.edit', compact('warehouseRental', 'warehouses', 'merchants'));
    // }

    public function edit($id)
    {
        $warehouseRental = WarehouseRental::with('shelves')->findOrFail($id);
        $merchants = Merchant::all();

        $warehouses = Warehouse::whereHas('shelves', function ($query) use ($warehouseRental) {
            $query->where(function ($q) use ($warehouseRental) {
                $q->whereDoesntHave('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('status', 1)
                        ->where('rental_end', '>', now());
                })->orWhereHas('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('warehouse_rental_id', $warehouseRental->id);
                });
            });
        })
        ->with(['shelves' => function ($query) use ($warehouseRental) {
            $query->where(function ($q) use ($warehouseRental) {
                $q->whereDoesntHave('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('status', 1)
                        ->where('rental_end', '>', now());
                })->orWhereHas('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('warehouse_rental_id', $warehouseRental->id);
                });
            });
        }])
        ->get();

        return view('admin.warehouse_rentals.edit', compact('warehouseRental', 'warehouses', 'merchants'));
    }


    public function update(Request $request, $id)
    {
        $rental = WarehouseRental::findOrFail($id);

        $request->validate([
            'merchant_id'  => 'required|exists:merchants,id',
            'shelves'      => 'required|array',
            'rental_start' => 'required|date',
            'rental_end'   => 'required|date|after_or_equal:rental_start',
        ]);

        // ✅ تحقق من أن هناك رف واحد على الأقل مختار
        $selectedShelves = collect($request->shelves)->filter(fn($shelf) => isset($shelf['selected']));
        if ($selectedShelves->isEmpty()) {
            return back()->withErrors(['shelves' => __('يجب اختيار رف واحد على الأقل')])->withInput();
        }

        $rental->update([
            'merchant_id'  => $request->merchant_id,
            'rental_start' => Carbon::parse($request->rental_start),
            'rental_end'   => Carbon::parse($request->rental_end),
            'updated_by'   => auth()->user()->name ?? 'system',
        ]);

        $rental->shelves()->detach();
        $totalPrice = 0;

        foreach ($request->shelves as $shelfId => $data) {
            if (!isset($data['selected'])) continue;

             // ✅ لو السعر غير مدخل → ناخذ سعر الرف من الجدول
            $shelf = \App\Models\Shelf::findOrFail($shelfId);
            $customPrice = !empty($data['custom_price']) ? $data['custom_price'] : $shelf->price;


            // $customPrice = $data['custom_price'] ?? 0;
            $customStart = Carbon::parse($data['custom_start'] ?? $request->rental_start);
            $customEnd   = Carbon::parse($data['custom_end'] ?? $request->rental_end);

            $days = $customEnd->diffInDays($customStart) + 1;
            $shelfTotal = $customPrice * $days;
            $totalPrice += $shelfTotal;

            $rental->shelves()->attach($shelfId, [
                'custom_price' => $customPrice,
                'custom_start' => $customStart,
                'custom_end'   => $customEnd,
                'total_price'  => $shelfTotal,
            ]);
        }

        $rental->update(['price' => $totalPrice]);

        if ($rental->invoice) {
            $rental->invoice->update([
                'total_amount' => $totalPrice,
                'due_date'     => Carbon::now()->addDays(15),
                'notes'        => 'فاتورة إيجار رفوف #' . $rental->id,
            ]);
        }

        return redirect()->route('admin.warehouse_rentals.index')
            ->with('success', 'Rental updated with invoice.');
    }

    public function destroy($id)
    {
        $rental = WarehouseRental::findOrFail($id);

        // حذف الفاتورة المرتبطة إذا كانت موجودة
        if ($rental->invoice) {
            $rental->invoice->delete();
        }
        // حذف جميع الرفوف المرتبطة بالإيجار
        $rental->shelves()->detach();
        $rental->delete();

        return redirect()->route('admin.warehouse_rentals.index')
            ->with('success', __('rental.deleted_successfully'));
    }

     public function updateWarehouseRentalStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            WarehouseRental::where('id', $data['warehouse_rental_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'warehouse_rental_id' => $data['warehouse_rental_id']]);
        }
    }

    /**
     * Handle payment for the invoice of a rental.
     *
     * @param Request $request
     * @param int $rentalId
     * @return \Illuminate\Http\RedirectResponse
     */
    // تأكيد الدفع للفواتير
    // يجب أن يكون هناك علاقة بين الإيجار والفاتورة
    public function payInvoice(Request $request, $rentalId)
    {
        $rental = WarehouseRental::with('invoice')->findOrFail($rentalId);
        $invoice = $rental->invoice;

        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . ($invoice->total_amount - $invoice->payments()->sum('amount')),
            'method' => 'required|in:cash,credit_card,bank_transfer,wallet,cod',
            'reference_note' => 'nullable|string',
            'payment_reference' => 'nullable|string',
        ]);

        $payment = $invoice->payments()->create([
            'merchant_id' => $rental->merchant_id,
            'amount' => $request->amount,
            'currency' => $invoice->currency,
            'method' => $request->method,
            'status' => 'paid',
            'paid_on' => now(),
            'for' => 'storage', // لأننا ندفع إيجار التخزين
            'reference_note' => $request->reference_note,
            'payment_reference' => $request->payment_reference,
            'created_by' => auth()->user()->name ?? 'system',
        ]);

        // تحديث حالة الفاتورة إذا تم دفع كامل المبلغ
        $totalPaid = $invoice->payments()->sum('amount');
        if ($totalPaid >= $invoice->total_amount) {
            $invoice->update(['status' => 'paid']);
        }

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }

    //======= عرض تفاصيل العقد وطباعته =======//
     // عرض العقد كوثيقة رسمية داخل المتصفح
    // public function view($id)
    // {
    //     $contract = WarehouseRental::with(['merchant', 'shelves'])->findOrFail($id);

    //     // $pdf = Pdf::loadView('contracts.document', compact('contract'));
    //     $pdf = Pdf::loadView('admin.warehouse_rentals.document', compact('contract'));
    //     // return $pdf->stream("contract_{$id}.pdf"); // عرض فقط
    //     return $pdf->stream("contract_{$id}.pdf", ["Attachment" => false]);
    // }

   public function view($id)
{
    $contract = WarehouseRental::with([
        'merchant',
        'shelves.warehouse',
        'invoice.payments'
    ])->findOrFail($id);

    return view('admin.warehouse_rentals.document', compact('contract'));
}


      // تنزيل العقد كوثيقة PDF
    public function download($id)
    {
        // $contract = WarehouseRental::with(['merchant', 'shelves'])->findOrFail($id);

        $contract = WarehouseRental::with([
            'merchant',
            'shelves.warehouse',
            'invoice.payments'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('admin.warehouse_rentals.document', compact('contract'));
        return $pdf->download("contract_{$id}.pdf"); // تنزيل
    }

}
