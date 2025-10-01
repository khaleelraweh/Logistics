<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;


use App\Models\Driver;
use App\Models\PickupRequest;
use App\Models\Merchant;
use Illuminate\Http\Request;

class PickupRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // public function index()
    // {
    //     if (!auth()->user()->ability('driver', 'manage_pickup_requests, show_pickup_requests')) {
    //         return redirect('driver/index');
    //     }

    //     // جلب السائقين والتجار للفلتر
    //     $drivers   = \App\Models\Driver::all();
    //     $merchants = \App\Models\Merchant::all();

    //     $pickupRequests = \App\Models\PickupRequest::query()
    //         ->when(request()->keyword != null, function ($query) {
    //             $query->search(request()->keyword);
    //         })
    //         ->when(request()->status != null, function ($query) {
    //             $query->where('status', request()->status);
    //         })
    //         ->when(request()->driver_id != null, function ($query) {
    //             $query->where('driver_id', request()->driver_id);
    //         })
    //         ->when(request()->merchant_id != null, function ($query) {
    //             $query->where('merchant_id', request()->merchant_id);
    //         })

    //         // فلترة حسب التواريخ
    //         ->when(request()->date_type != null, function ($query) {
    //             $dateType   = request()->date_type;   // نوع التاريخ (scheduled_at, appointment_date, acceptance_date, completion_date)
    //             $fromDate   = request()->scheduled_from;
    //             $toDate     = request()->scheduled_to;

    //             if ($fromDate && $toDate) {
    //                 // من تاريخ إلى تاريخ
    //                 $query->whereBetween($dateType, [$fromDate, $toDate]);
    //             } elseif ($fromDate && !$toDate) {
    //                 // يوم محدد فقط
    //                 $query->whereDate($dateType, '=', $fromDate);
    //             } elseif (!$fromDate && $toDate) {
    //                 // يوم محدد فقط
    //                 $query->whereDate($dateType, '=', $toDate);
    //             }
    //         })

    //         // ترتيب
    //         ->orderByRaw(
    //             request()->sort_by == 'scheduled_at'
    //                 ? 'scheduled_at IS NULL, scheduled_at ' . (request()->order_by ?? 'desc')
    //                 : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
    //         )
    //         ->paginate(request()->limit_by ?? 20);

    //     return view('driver.pickup_requests.index', compact('pickupRequests', 'drivers', 'merchants'));
    // }

    public function index()
{
    if (!auth()->user()->ability('driver', 'manage_pickup_requests, show_pickup_requests')) {
        return redirect('driver/index');
    }

    // جلب السائقين والتجار للفلتر
    $drivers   = \App\Models\Driver::all();
    $merchants = \App\Models\Merchant::all();

    // 🔥 الإحصائيات الثابتة (غير متأثرة بالبحث)
    $totalRequests = \App\Models\PickupRequest::count();
    $pendingRequests = \App\Models\PickupRequest::where('status', 'pending')->count();
    $acceptedRequests = \App\Models\PickupRequest::where('status', 'accepted')->count();
    $completedRequests = \App\Models\PickupRequest::where('status', 'completed')->count();
    $cancelledRequests = \App\Models\PickupRequest::where('status', 'cancelled')->count();

    // طلبات اليوم (غير متأثرة بالبحث)
    $todayRequests = \App\Models\PickupRequest::whereDate('scheduled_at', today())->count();

    // البيانات المصفاة (للجدول فقط)
    $pickupRequests = \App\Models\PickupRequest::query()
        ->when(request()->keyword != null, function ($query) {
            $query->search(request()->keyword);
        })
        ->when(request()->status != null, function ($query) {
            $query->where('status', request()->status);
        })
        ->when(request()->driver_id != null, function ($query) {
            $query->where('driver_id', request()->driver_id);
        })
        ->when(request()->merchant_id != null, function ($query) {
            $query->where('merchant_id', request()->merchant_id);
        })
        ->when(request()->date_type != null, function ($query) {
            $dateType   = request()->date_type;
            $fromDate   = request()->scheduled_from;
            $toDate     = request()->scheduled_to;

            if ($fromDate && $toDate) {
                $query->whereBetween($dateType, [$fromDate, $toDate]);
            } elseif ($fromDate && !$toDate) {
                $query->whereDate($dateType, '=', $fromDate);
            } elseif (!$fromDate && $toDate) {
                $query->whereDate($dateType, '=', $toDate);
            }
        })
        ->orderByRaw(
            request()->sort_by == 'scheduled_at'
                ? 'scheduled_at IS NULL, scheduled_at ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
        )
        ->paginate(request()->limit_by ?? 20);

    return view('driver.pickup_requests.index', compact(
        'pickupRequests',
        'drivers',
        'merchants',
        'totalRequests',
        'pendingRequests',
        'acceptedRequests',
        'completedRequests',
        'cancelledRequests',
        'todayRequests'
    ));
}


    public function show($id)
    {
        if (!auth()->user()->ability('driver', 'show_pickup_requests')) {
            return redirect('driver/index');
        }

        $pickupRequest = PickupRequest::with(['merchant', 'driver'])->findOrFail($id);

        return view('driver.pickup_requests.show', compact('pickupRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->ability('driver', 'update_pickup_requests')) {
            return redirect('driver/index');
        }

        $pickupRequest = PickupRequest::findOrFail($id);
        $merchants = Merchant::whereStatus(1)->get(['id', 'name','email' , 'contact_person' , 'phone']);
        $drivers = Driver::whereStatus(1)->get();

        return view('driver.pickup_requests.edit', compact('pickupRequest', 'merchants', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->ability('driver', 'update_pickup_requests')) {
            return redirect('driver/index');
        }

        $pickupRequest = PickupRequest::findOrFail($id);

        $validated = $request->validate(['status'       => 'required|in:pending,accepted,completed',]);
        // تحديث الحالة باستخدام دالة الموديل
        $pickupRequest->updateStatus($validated['status']);

        return redirect()->route('driver.pickup_requests.index')->with([
            'message'    => __('messages.pickup_request_updated'),
            'alert-type' => 'success',
        ]);
    }

public function update_status(Request $request, $id)
{
    if (!auth()->user()->ability('driver', 'update_pickup_requests')) {
        return redirect('driver/index');
    }

    $pickupRequest = PickupRequest::findOrFail($id);

    $availableStatuses = $pickupRequest->availableStatusesForDriver();

    $validated = $request->validate([
        'status' => 'required|in:' . implode(',', $availableStatuses)
    ]);

    if (!in_array($validated['status'], $availableStatuses)) {
        return redirect()->back()->with([
            'message' => __('messages.status_transition_not_allowed'),
            'alert-type' => 'error',
        ]);
    }

    try {
        // تحديث الحالة بدون تسجيل النشاط
        $success = $pickupRequest->updateStatus($validated['status'], auth()->id());

        if ($success) {
            // ✅ إزالة جزء activity() نهائياً
            return redirect()->route('driver.pickup_requests.index')->with([
                'message' => __('messages.pickup_request_updated'),
                'alert-type' => 'success',
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('messages.pickup_request_update_failed'),
                'alert-type' => 'error',
            ]);
        }
    } catch (\Exception $e) {
        \Log::error('Error updating pickup request status: ' . $e->getMessage());

        return redirect()->back()->with([
            'message' => __('messages.update_error') . ': ' . $e->getMessage(),
            'alert-type' => 'error',
        ]);
    }
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->ability('driver', 'delete_pickup_requests')) {
            return redirect('driver/index');
        }

        $pickupRequest = PickupRequest::findOrFail($id);
        $pickupRequest->delete();

        return redirect()->route('driver.pickup_requests.index')->with([
            'message' => __('messages.pickup_request_deleted'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Update status via AJAX.
     */
    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $pickupRequest = PickupRequest::findOrFail($request->pickup_request_id);
            $newStatus = $request->status;

            if (in_array($newStatus, ['pending', 'accepted', 'completed'])) {
                $pickupRequest->update(['status' => $newStatus]);
                return response()->json(['status' => $newStatus]);
            }

            return response()->json(['error' => 'Invalid status'], 422);
        }
    }
}
