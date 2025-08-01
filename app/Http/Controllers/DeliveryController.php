<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\DeliveryRequest;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_deliveries , show_deliveries')) {
            return redirect('admin/index');
        }

        $deliveries = Delivery::query()
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

        return view('admin.deliveries.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_deliveries')) {
            return redirect('admin/index');
        }

        $drivers = Driver::all();
        $packages = Package::whereDoesntHave('delivery')->get();


        return view('admin.deliveries.create',compact('drivers', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_deliveries')) {
            return redirect('admin/index');
        }

        try {
            // تجهيز البيانات
            $input['driver_id']     = $request->driver_id;
            $input['package_id']    = $request->package_id;
            $input['assigned_at']   = $request->assigned_at; // نوعه date
            $input['status']        = $request->status ?? 'assigned'; // default
            $input['note']          = $request->note;
            $input['created_by']    = auth()->user()->name;

            // إنشاء عملية التوصيل
            $delivery = Delivery::create($input);


            // if ($delivery) {
            //     // تحديث حالة الطرد مباشرة
            //     $delivery->package->update(['status' => $input['status']]);

            //     // إضافة سجل في السجل الزمني
            //     $delivery->package->addLog(
            //         'Delivery assigned to driver: ' . ($delivery->driver->name ?? ''),
            //         $delivery->driver_id
            //     );


            // }

            if ($delivery) {
                // تحديث حالة الطرد مباشرة
                $delivery->package->update(['status' => $input['status']]);

                // إضافة سجل في السجل الزمني باستخدام نص مترجم
                $delivery->package->addLog(
                    __('delivery.delivery_assigned_status', [
                        'driver' => $delivery->driver?->name ?? '-'
                    ]),
                    $delivery->driver_id
                );
            }



            if ($delivery) {
                return redirect()->route('admin.deliveries.index')->with([
                    'message'     => __('messages.delivery_created'),
                    'alert-type'  => 'success',
                ]);
            }

            return redirect()->route('admin.deliveries.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.deliveries.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        if (!auth()->user()->ability('admin', 'show_deliveries')) {
            return redirect('admin/index');
        }

        // نحمل العلاقات المهمة مثل السائق والطرد
        $delivery->load(['driver', 'package']);

        return view('admin.deliveries.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit($delivery)
    {
        if (!auth()->user()->ability('admin', 'update_deliveries')) {
            return redirect('admin/index');
        }

        // جلب بيانات عملية التوصيل الحالية
        $delivery = Delivery::findOrFail($delivery);

        // جلب السائقين
        $drivers = Driver::all();

        // جلب الطرود:
        // الطرود التي ليس لديها أي توصيل أو الطرد المرتبط بهذه العملية
        $packages = Package::whereDoesntHave('delivery')
                    ->orWhere('id', $delivery->package_id)
                    ->get();

        return view('admin.deliveries.edit', compact('delivery', 'drivers', 'packages'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        // التحقق من الصلاحيات
        if (!auth()->user()->ability('admin', 'update_deliveries')) {
            return redirect('admin/index');
        }

      try {
        $input = [
            'driver_id'    => $request->driver_id,
            'package_id'   => $request->package_id,
            'assigned_at'  => $request->assigned_at,
            'status'       => $request->status ?? $delivery->status,
            'note'         => $request->note,
            'updated_by'   => auth()->user()->name,
        ];

        // إذا الحالة أصبحت delivered أضف delivered_at
        if ($input['status'] === 'delivered' && !$delivery->delivered_at) {
            $input['delivered_at'] = now();
        } else {
            $input['delivered_at'] = $request->delivered_at ?? $delivery->delivered_at;
        }

        $delivery->update($input);

        // تحديث حالة الطرد أيضًا
        $delivery->package->update(['status' => $input['status']]);

        // إضافة سجل في السجل الزمني
        $delivery->package->addLog(
            __('delivery.delivery_updated_status', [
                'status' => __('package.status_' . $delivery->status),
                'driver' => $delivery->driver->name ?? '-'
            ]),
            $delivery->driver_id
        );

        return redirect()->route('admin.deliveries.index')->with([
            'message'    => __('messages.delivery_updated'),
            'alert-type' => 'success',
        ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.deliveries.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        // التحقق من الصلاحيات
        if (!auth()->user()->ability('admin', 'delete_deliveries')) {
            return redirect('admin/index');
        }

        try {
            $delivery->delete();

            return redirect()->route('admin.deliveries.index')->with([
                'message'    => __('messages.delivery_deleted'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            // يمكن تسجيل الخطأ لو حبيت: \Log::error($e->getMessage());

            return redirect()->route('admin.deliveries.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

}
