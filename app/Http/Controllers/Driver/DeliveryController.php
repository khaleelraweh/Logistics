<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
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
        if (!auth()->user()->ability('admin', 'manage_deliveries, show_deliveries')) {
            return redirect('admin/index');
        }

        // جلب السائقين للفلتر
        $drivers = Driver::all();

        $deliveries = Delivery::query()
            ->when(request()->keyword != null, function ($query) {
                $query->search(request()->keyword);
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->when(request()->driver_id != null, function ($query) {
                $query->where('driver_id', request()->driver_id);
            })
            ->when(request()->package_id != null, function ($query) {
                $query->where('package_id', request()->package_id);
            })
            ->when(request()->delivered_from != null, function ($query) {
                $query->where(function ($q) {
                    $q->whereDate('delivered_at', '>=', request()->delivered_from)
                    ->orWhereDate('assigned_at', '>=', request()->delivered_from);
                });
            })
            ->when(request()->delivered_to != null, function ($query) {
                $query->where(function ($q) {
                    $q->whereDate('delivered_at', '<=', request()->delivered_to)
                    ->orWhereDate('assigned_at', '<=', request()->delivered_to);
                });
            })
            ->orderByRaw(
                request()->sort_by == 'published_on'
                    ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                    : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
            )
            ->paginate(request()->limit_by ?? 100);

        return view('admin.deliveries.index', compact('deliveries', 'drivers'));
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
            $input = [
                'driver_id'   => $request->driver_id,
                'package_id'  => $request->package_id,
                'assigned_at' => $request->assigned_at ?? now(), // تعبئة تلقائية إذا لم يُحدد
                'status'      => $request->status ?? 'assigned_to_driver', // default
                'note'        => $request->note,
                'created_by'  => auth()->user()->full_name,
            ];

            // إنشاء عملية التوصيل
            $delivery = Delivery::create($input);

            if ($delivery) {
                // تحديث حالة الطرد مباشرة
                $delivery->package->update(['status' => $input['status']]);

                // إضافة سجل في السجل الزمني
                $delivery->package->addLog(
                    __('delivery.delivery_assigned_status', [
                        'driver' => $delivery->driver?->driver_full_name ?? '-'
                    ]),
                    $delivery->driver_id
                );
            }

            return redirect()->route('admin.deliveries.index')->with([
                'message'    => __('messages.delivery_created'),
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
        if (!auth()->user()->ability('admin', 'update_deliveries')) {
            return redirect('admin/index');
        }

        try {
            $input = [
                'package_id'  => $request->package_id,
                'assigned_at' => $delivery->assigned_at, // الحفاظ على وقت الإسناد
                'status'      => $request->status ?? $delivery->status,
                'note'        => $request->note,
                'updated_by'  => auth()->user()->full_name,
            ];

            // 1. التحقق إذا تغير السائق
            if ($delivery->driver_id != $request->driver_id) {
                $oldDriver = $delivery->driver?->driver_full_name ?? '-';
                $newDriver = Driver::find($request->driver_id)?->driver_full_name ?? '-';
                $input['driver_id'] = $request->driver_id;

                // تسجيل تغيير السائق في السجل الزمني
                $delivery->package->addLog(
                    __('delivery.driver_changed', [
                        'old_driver' => $oldDriver,
                        'new_driver' => $newDriver,
                    ]),
                    $request->driver_id
                );
            }

            // 2. إذا الحالة أصبحت delivered لأول مرة، نملأ delivered_at
            if ($input['status'] === 'delivered' && !$delivery->delivered_at) {
                $input['delivered_at'] = now();
            }

            // 3. تحديث التوصيل
            $delivery->update($input);

            // 4. تحديث حالة الطرد
            $delivery->package->update(['status' => $input['status']]);

            // 5. تسجيل تحديث الحالة في السجل الزمني
            $delivery->package->addLog(
                __('delivery.delivery_updated_status', [
                    'status' => __('package.status_' . $delivery->status),
                    'driver' => $delivery->driver?->driver_full_name ?? '-'
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
