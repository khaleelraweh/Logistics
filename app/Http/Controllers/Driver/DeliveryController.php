<?php

namespace App\Http\Controllers\Driver;

use App\Helper\DeliveryHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Driver\DeliveryRequest;
use App\Models\Delivery;
use App\Models\Driver;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     if (!auth()->user()->ability('driver', 'driver_manage_deliveries, driver_show_deliveries')) {
    //         return redirect('driver/index');
    //     }

    //     // جلب السائقين للفلتر
    //     $drivers = Driver::all();

    //     $deliveries = Delivery::query()
    //         ->when(request()->keyword != null, function ($query) {
    //             $query->search(request()->keyword);
    //         })
    //         ->when(request()->status != null, function ($query) {
    //             $query->where('status', request()->status);
    //         })
    //         ->when(request()->driver_id != null, function ($query) {
    //             $query->where('driver_id', request()->driver_id);
    //         })
    //         ->when(request()->package_id != null, function ($query) {
    //             $query->where('package_id', request()->package_id);
    //         })
    //         ->when(request()->delivered_from != null, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereDate('delivered_at', '>=', request()->delivered_from)
    //                 ->orWhereDate('assigned_at', '>=', request()->delivered_from);
    //             });
    //         })
    //         ->when(request()->delivered_to != null, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereDate('delivered_at', '<=', request()->delivered_to)
    //                 ->orWhereDate('assigned_at', '<=', request()->delivered_to);
    //             });
    //         })
    //         ->orderByRaw(
    //             request()->sort_by == 'published_on'
    //                 ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //                 : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
    //         )
    //         ->paginate(request()->limit_by ?? 100);

    //     return view('driver.deliveries.index', compact('deliveries', 'drivers'));
    // }


    // public function index()
    // {
    //     if (!auth()->user()->ability('driver', 'driver_manage_deliveries, driver_show_deliveries')) {
    //         return redirect('driver/index');
    //     }

    //     // جلب السائق الحالي
    //     $driver = auth()->user()->driver;

    //     // لو السائق غير مرتبط بسجل Driver
    //     if (!$driver) {
    //         return redirect()->back()->with('error', __('لا يوجد حساب سائق مرتبط'));
    //     }

    //     $deliveries = Delivery::query()
    //         ->where('driver_id', $driver->id) // 🔴 أهم شيء: قصر النتائج على هذا السائق فقط
    //         ->when(request()->keyword != null, function ($query) {
    //             $query->search(request()->keyword);
    //         })
    //         ->when(request()->status != null, function ($query) {
    //             $query->where('status', request()->status);
    //         })
    //         ->when(request()->package_id != null, function ($query) {
    //             $query->where('package_id', request()->package_id);
    //         })
    //         ->when(request()->delivered_from != null, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereDate('delivered_at', '>=', request()->delivered_from)
    //                 ->orWhereDate('assigned_at', '>=', request()->delivered_from);
    //             });
    //         })
    //         ->when(request()->delivered_to != null, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereDate('delivered_at', '<=', request()->delivered_to)
    //                 ->orWhereDate('assigned_at', '<=', request()->delivered_to);
    //             });
    //         })
    //         ->orderByRaw(
    //             request()->sort_by == 'published_on'
    //                 ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //                 : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
    //         )
    //         ->paginate(request()->limit_by ?? 100);

    //     return view('driver.deliveries.index', compact('deliveries'));
    // }

    // public function index()
    // {
    //     if (!auth()->user()->ability('driver', 'driver_manage_deliveries, driver_show_deliveries')) {
    //         return redirect('driver/index');
    //     }

    //     // جلب السائق الحالي
    //     $driver = auth()->user()->driver;

    //     // لو السائق غير مرتبط بسجل Driver
    //     if (!$driver) {
    //         return redirect()->back()->with('error', __('لا يوجد حساب سائق مرتبط'));
    //     }

    //     // الاستعلام الأساسي للتسليمات
    //     $deliveriesQuery = Delivery::where('driver_id', $driver->id);

    //     // 🔴 إحصائيات منفصلة - مهم جداً
    //     $totalDeliveries = (clone $deliveriesQuery)->count();
    //     $pendingDeliveries = (clone $deliveriesQuery)->where('status', 'pending')->count();
    //     $assignedDeliveries = (clone $deliveriesQuery)->where('status', 'assigned_to_driver')->count();
    //     $pickedUpDeliveries = (clone $deliveriesQuery)->where('status', 'driver_picked_up')->count();
    //     $inTransitDeliveries = (clone $deliveriesQuery)->where('status', 'in_transit')->count();
    //     $arrivedAtHubDeliveries = (clone $deliveriesQuery)->where('status', 'arrived_at_hub')->count();
    //     $outForDeliveryDeliveries = (clone $deliveriesQuery)->where('status', 'out_for_delivery')->count();
    //     $deliveredDeliveries = (clone $deliveriesQuery)->where('status', 'delivered')->count();
    //     $failedDeliveries = (clone $deliveriesQuery)->where('status', 'delivery_failed')->count();
    //     $returnedDeliveries = (clone $deliveriesQuery)->where('status', 'returned')->count();
    //     $cancelledDeliveries = (clone $deliveriesQuery)->where('status', 'cancelled')->count();
    //     $inWarehouseDeliveries = (clone $deliveriesQuery)->where('status', 'in_warehouse')->count();

    //     // تسليمات اليوم
    //     $todayDeliveries = (clone $deliveriesQuery)
    //         ->whereDate('assigned_at', today())
    //         ->orWhereDate('created_at', today())
    //         ->count();

    //     // تطبيق الفلاتر على الاستعلام الرئيسي
    //     $deliveries = $deliveriesQuery
    //         ->when(request()->keyword != null, function ($query) {
    //             $query->search(request()->keyword);
    //         })
    //         ->when(request()->status != null, function ($query) {
    //             $query->where('status', request()->status);
    //         })
    //         ->when(request()->package_id != null, function ($query) {
    //             $query->where('package_id', request()->package_id);
    //         })
    //         ->when(request()->delivered_from != null, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereDate('delivered_at', '>=', request()->delivered_from)
    //                 ->orWhereDate('assigned_at', '>=', request()->delivered_from);
    //             });
    //         })
    //         ->when(request()->delivered_to != null, function ($query) {
    //             $query->where(function ($q) {
    //                 $q->whereDate('delivered_at', '<=', request()->delivered_to)
    //                 ->orWhereDate('assigned_at', '<=', request()->delivered_to);
    //             });
    //         })
    //         ->orderByRaw(
    //             request()->sort_by == 'published_on'
    //                 ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //                 : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
    //         )
    //         ->with(['package', 'driver']) // تحميل العلاقات
    //         ->paginate(request()->limit_by ?? 100);

    //     return view('driver.deliveries.index', compact(
    //         'deliveries',
    //         'totalDeliveries',
    //         'pendingDeliveries',
    //         'assignedDeliveries',
    //         'pickedUpDeliveries',
    //         'inTransitDeliveries',
    //         'arrivedAtHubDeliveries',
    //         'outForDeliveryDeliveries',
    //         'deliveredDeliveries',
    //         'failedDeliveries',
    //         'returnedDeliveries',
    //         'cancelledDeliveries',
    //         'inWarehouseDeliveries',
    //         'todayDeliveries'
    //     ));
    // }


    public function index()
{
    if (!auth()->user()->ability('driver', 'driver_manage_deliveries, driver_show_deliveries')) {
        return redirect('driver/index');
    }

    // جلب السائق الحالي
    $driver = auth()->user()->driver;

    if (!$driver) {
        return redirect()->back()->with('error', __('لا يوجد حساب سائق مرتبط'));
    }

    // الاستعلام الأساسي للتسليمات
    $deliveriesQuery = Delivery::where('driver_id', $driver->id)
        ->with(['package', 'driver']);

    // 🔴 إحصائيات منفصلة - مهم جداً
    $totalDeliveries = (clone $deliveriesQuery)->count();
    $pendingDeliveries = (clone $deliveriesQuery)->where('status', 'pending')->count();
    $assignedDeliveries = (clone $deliveriesQuery)->where('status', 'assigned_to_driver')->count();
    $pickedUpDeliveries = (clone $deliveriesQuery)->where('status', 'driver_picked_up')->count();
    $inTransitDeliveries = (clone $deliveriesQuery)->where('status', 'in_transit')->count();
    $arrivedAtHubDeliveries = (clone $deliveriesQuery)->where('status', 'arrived_at_hub')->count();
    $outForDeliveryDeliveries = (clone $deliveriesQuery)->where('status', 'out_for_delivery')->count();
    $deliveredDeliveries = (clone $deliveriesQuery)->where('status', 'delivered')->count();
    $failedDeliveries = (clone $deliveriesQuery)->where('status', 'delivery_failed')->count();
    $returnedDeliveries = (clone $deliveriesQuery)->where('status', 'returned')->count();
    $cancelledDeliveries = (clone $deliveriesQuery)->where('status', 'cancelled')->count();
    $inWarehouseDeliveries = (clone $deliveriesQuery)->where('status', 'in_warehouse')->count();

    // تسليمات اليوم
    $todayDeliveries = (clone $deliveriesQuery)
        ->whereDate('assigned_at', today())
        ->orWhereDate('created_at', today())
        ->count();

    // تسليمات قيد التنفيذ (جميع الحالات النشطة)
    $activeDeliveries = $assignedDeliveries + $pickedUpDeliveries + $inTransitDeliveries +
                       $arrivedAtHubDeliveries + $outForDeliveryDeliveries;

    // تطبيق الفلاتر على الاستعلام الرئيسي
    $deliveries = $deliveriesQuery
        ->when(request()->keyword != null, function ($query) {
            $query->search(request()->keyword);
        })
        ->when(request()->status != null, function ($query) {
            $query->where('status', request()->status);
        })
        ->when(request()->package_id != null, function ($query) {
            $query->where('package_id', request()->package_id);
        })
        ->when(request()->date_from != null, function ($query) {
            $query->whereDate('assigned_at', '>=', request()->date_from);
        })
        ->when(request()->date_to != null, function ($query) {
            $query->whereDate('assigned_at', '<=', request()->date_to);
        })
        ->when(request()->sort_by == 'nearest', function ($query) {
            // يمكن إضافة منطق الفرز حسب المسافة هنا
            $query->orderBy('created_at', 'desc');
        })
        ->orderByRaw(
            request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
        )
        ->paginate(request()->limit_by ?? 20);

    return view('driver.deliveries.index', compact(
        'deliveries',
        'totalDeliveries',
        'pendingDeliveries',
        'assignedDeliveries',
        'pickedUpDeliveries',
        'inTransitDeliveries',
        'arrivedAtHubDeliveries',
        'outForDeliveryDeliveries',
        'deliveredDeliveries',
        'failedDeliveries',
        'returnedDeliveries',
        'cancelledDeliveries',
        'inWarehouseDeliveries',
        'todayDeliveries',
        'activeDeliveries'
    ));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('driver', 'driver_create_deliveries')) {
            return redirect('driver/index');
        }

        $drivers = Driver::all();
        $packages = Package::whereDoesntHave('delivery')->get();


        return view('driver.deliveries.create',compact('drivers', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request)
    {
        if (!auth()->user()->ability('driver', 'driver_create_deliveries')) {
            return redirect('driver/index');
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

            return redirect()->route('driver.deliveries.index')->with([
                'message'    => __('messages.delivery_created'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            return redirect()->route('driver.deliveries.index')->with([
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
        if (!auth()->user()->ability('driver', 'driver_show_deliveries')) {
            return redirect('driver/index');
        }

        $deliveryHelper = new DeliveryHelper();
        // نحمل العلاقات المهمة مثل السائق والطرد
        $delivery->load(['driver', 'package']);

        return view('driver.deliveries.show', compact('delivery' , 'deliveryHelper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit($delivery)
    {
        // التحقق من صلاحية السائق
        if (!auth()->user()->ability('driver', 'driver_update_deliveries')) {
            return redirect('driver/index');
        }

        // جلب بيانات عملية التوصيل الحالية مع الطرد المرتبط
        $delivery = Delivery::with('package')->findOrFail($delivery);

        // لا نعرض الطرود الأخرى ولا السائق، السائق هو المستخدم الحالي
        return view('driver.deliveries.edit', compact('delivery'));
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
        if (!auth()->user()->ability('driver', 'driver_update_deliveries')) {
            return redirect('driver/index');
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

            return redirect()->route('driver.deliveries.index')->with([
                'message'    => __('messages.delivery_updated'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            return redirect()->route('driver.deliveries.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }



    /**
     * Update delivery status with comprehensive validation and logging
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request, Delivery $delivery)
    {
        if (!auth()->user()->ability('driver', 'driver_update_deliveries')) {
            return redirect('driver/index');
        }

        // التحقق من أن السائق الحالي هو صاحب التسليم
        $driver = auth()->user()->driver;
        if (!$driver || $delivery->driver_id != $driver->id) {
            return response()->json([
                'success' => false,
                'message' => __('delivery.unauthorized_status_update')
            ], 403);
        }

        $request->validate([
            'status' => 'required|in:' . implode(',', $delivery->availableStatusesForDriver())
        ]);

        $newStatus = $request->status;
        $oldStatus = $delivery->status;

        try {
            DB::beginTransaction();

            // تحديث حالة التسليم
            $updateData = [
                'status' => $newStatus,
                'updated_by' => auth()->user()->full_name,
            ];

            // إضافة التواريخ التلقائية بناءً على الحالة
            switch ($newStatus) {
                case 'driver_picked_up':
                    $updateData['picked_up_at'] = now();
                    break;

                case 'in_transit':
                    $updateData['in_transit_at'] = now();
                    break;

                case 'arrived_at_hub':
                    $updateData['arrived_at_hub_at'] = now();
                    break;

                case 'out_for_delivery':
                    $updateData['out_for_delivery_at'] = now();
                    break;

                case 'delivered':
                    $updateData['delivered_at'] = now();
                    $updateData['delivery_attempts'] = ($delivery->delivery_attempts ?? 0) + 1;
                    break;

                case 'delivery_failed':
                    $updateData['delivery_failed_at'] = now();
                    $updateData['delivery_attempts'] = ($delivery->delivery_attempts ?? 0) + 1;
                    break;

                case 'returned':
                    $updateData['returned_at'] = now();
                    break;

                case 'cancelled':
                    $updateData['cancelled_at'] = now();
                    break;
            }

            $delivery->update($updateData);

            // تحديث حالة الطرد المرتبط
            if ($delivery->package) {
                $delivery->package->update(['status' => $newStatus]);

                // إضافة سجل في السجل الزمني للطرد
                $this->addPackageLog($delivery, $oldStatus, $newStatus);
            }

            // إضافة إشعار إذا لزم الأمر
            $this->sendStatusUpdateNotification($delivery, $oldStatus, $newStatus);

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => __('delivery.status_updated_successfully'),
                    'data' => [
                        'id' => $delivery->id,
                        'status' => $newStatus,
                        'status_text' => __('delivery.status_' . $newStatus),
                        'status_badge' => $this->getStatusBadgeHtml($newStatus),
                        'updated_at' => $delivery->updated_at->diffForHumans(),
                        'timestamps' => [
                            'delivered_at' => $delivery->delivered_at?->format('Y-m-d H:i:s'),
                            'picked_up_at' => $delivery->picked_up_at?->format('Y-m-d H:i:s'),
                        ]
                    ]
                ]);
            }

            return redirect()->back()->with([
                'message' => __('delivery.status_updated_successfully'),
                'alert-type' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delivery status update failed: ' . $e->getMessage(), [
                'delivery_id' => $delivery->id,
                'new_status' => $newStatus,
                'user_id' => auth()->id()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => __('messages.something_went_wrong')
                ], 500);
            }

            return redirect()->back()->with([
                'message' => __('messages.something_went_wrong'),
                'alert-type' => 'danger'
            ]);
        }
    }

    /**
     * Add detailed log entry for package status change
     */
    private function addPackageLog(Delivery $delivery, $oldStatus, $newStatus)
    {
        $logMessages = [
            'driver_picked_up' => __('delivery.log_driver_picked_up', [
                'driver' => $delivery->driver->driver_full_name ?? '-',
                'time' => now()->format('H:i')
            ]),
            'in_transit' => __('delivery.log_in_transit', [
                'driver' => $delivery->driver->driver_full_name ?? '-'
            ]),
            'arrived_at_hub' => __('delivery.log_arrived_at_hub'),
            'out_for_delivery' => __('delivery.log_out_for_delivery'),
            'delivered' => __('delivery.log_delivered', [
                'time' => now()->format('Y-m-d H:i'),
                'driver' => $delivery->driver->driver_full_name ?? '-'
            ]),
            'delivery_failed' => __('delivery.log_delivery_failed', [
                'attempt' => $delivery->delivery_attempts ?? 1
            ]),
            'returned' => __('delivery.log_returned'),
            'cancelled' => __('delivery.log_cancelled')
        ];

        $logMessage = $logMessages[$newStatus] ?? __('delivery.log_status_changed', [
            'from' => __('delivery.status_' . $oldStatus),
            'to' => __('delivery.status_' . $newStatus)
        ]);

        if ($delivery->package && method_exists($delivery->package, 'addLog')) {
            $delivery->package->addLog($logMessage, $delivery->driver_id);
        }
    }



    /**
     * Send notifications for important status changes
     */
    private function sendStatusUpdateNotification(Delivery $delivery, $oldStatus, $newStatus)
    {
        $importantStatuses = ['delivered', 'delivery_failed', 'cancelled'];

        if (in_array($newStatus, $importantStatuses)) {
            // يمكنك إضافة نظام الإشعارات هنا
            // Example: Notification::send($users, new DeliveryStatusUpdated($delivery));

            Log::info('Delivery status changed to important status', [
                'delivery_id' => $delivery->id,
                'new_status' => $newStatus,
                'package_id' => $delivery->package_id
            ]);
        }
    }




    /**
     * Generate HTML for status badge (for AJAX responses)
     */
    private function getStatusBadgeHtml($status)
    {
        $statusClasses = [
            'pending' => 'badge-pending',
            'assigned_to_driver' => 'badge-assigned_to_driver',
            'driver_picked_up' => 'badge-driver_picked_up',
            'in_transit' => 'badge-in_transit',
            'arrived_at_hub' => 'badge-arrived_at_hub',
            'out_for_delivery' => 'badge-out_for_delivery',
            'delivered' => 'badge-delivered',
            'delivery_failed' => 'badge-delivery_failed',
            'returned' => 'badge-returned',
            'cancelled' => 'badge-cancelled',
            'in_warehouse' => 'badge-in_warehouse'
        ];

        $statusIcons = [
            'pending' => 'clock-outline',
            'assigned_to_driver' => 'truck-check',
            'driver_picked_up' => 'package-variant',
            'in_transit' => 'truck-delivery',
            'arrived_at_hub' => 'warehouse',
            'out_for_delivery' => 'walk',
            'delivered' => 'check-circle',
            'delivery_failed' => 'alert-circle',
            'returned' => 'package-up',
            'cancelled' => 'cancel',
            'in_warehouse' => 'archive'
        ];

        $badgeClass = $statusClasses[$status] ?? 'badge-secondary';
        $icon = $statusIcons[$status] ?? 'help-circle';

        return '<span class="status-badge ' . $badgeClass . ' d-flex align-items-center">
                <i class="mdi mdi-' . $icon . ' me-1"></i>
                ' . __('delivery.status_' . $status) . '
            </span>';
    }


        /**
     * Get available statuses for a specific delivery (for AJAX)
     */
    public function get_available_statuses(Delivery $delivery)
    {
        if (!auth()->user()->ability('driver', 'driver_update_deliveries')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $availableStatuses = $delivery->availableStatusesForDriver();
        $statusOptions = [];

        foreach ($availableStatuses as $status) {
            $statusOptions[] = [
                'value' => $status,
                'text' => __('delivery.status_' . $status),
                'icon' => 'mdi-' . $this->getStatusIcon($status),
                'color' => $this->getStatusColor($status)
            ];
        }

        return response()->json([
            'available_statuses' => $statusOptions,
            'current_status' => $delivery->status
        ]);
    }

        private function getStatusIcon($status)
    {
        $icons = [
            'pending' => 'clock-outline',
            'assigned_to_driver' => 'truck-check',
            'driver_picked_up' => 'package-variant',
            'in_transit' => 'truck-delivery',
            'arrived_at_hub' => 'warehouse',
            'out_for_delivery' => 'walk',
            'delivered' => 'check-circle',
            'delivery_failed' => 'alert-circle',
            'returned' => 'package-up',
            'cancelled' => 'cancel'
        ];

        return $icons[$status] ?? 'help-circle';
    }

        private function getStatusColor($status)
    {
        $colors = [
            'pending' => '#6c757d',
            'assigned_to_driver' => '#17a2b8',
            'driver_picked_up' => '#fd7e14',
            'in_transit' => '#007bff',
            'arrived_at_hub' => '#6610f2',
            'out_for_delivery' => '#ffc107',
            'delivered' => '#28a745',
            'delivery_failed' => '#dc3545',
            'returned' => '#e83e8c',
            'cancelled' => '#343a40'
        ];

        return $colors[$status] ?? '#6c757d';
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
        if (!auth()->user()->ability('driver', 'driver_delete_deliveries')) {
            return redirect('driver/index');
        }

        try {
            $delivery->delete();

            return redirect()->route('driver.deliveries.index')->with([
                'message'    => __('messages.delivery_deleted'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            // يمكن تسجيل الخطأ لو حبيت: \Log::error($e->getMessage());

            return redirect()->route('driver.deliveries.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

}
