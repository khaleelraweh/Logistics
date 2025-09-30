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


    public function index()
    {
        if (!auth()->user()->ability('driver', 'manage_pickup_requests, show_pickup_requests')) {
            return redirect('driver/index');
        }

        // جلب السائقين والتجار للفلتر
        $drivers   = \App\Models\Driver::all();
        $merchants = \App\Models\Merchant::all();

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

            // فلترة حسب التواريخ
            ->when(request()->date_type != null, function ($query) {
                $dateType   = request()->date_type;   // نوع التاريخ (scheduled_at, appointment_date, acceptance_date, completion_date)
                $fromDate   = request()->scheduled_from;
                $toDate     = request()->scheduled_to;

                if ($fromDate && $toDate) {
                    // من تاريخ إلى تاريخ
                    $query->whereBetween($dateType, [$fromDate, $toDate]);
                } elseif ($fromDate && !$toDate) {
                    // يوم محدد فقط
                    $query->whereDate($dateType, '=', $fromDate);
                } elseif (!$fromDate && $toDate) {
                    // يوم محدد فقط
                    $query->whereDate($dateType, '=', $toDate);
                }
            })

            // ترتيب
            ->orderByRaw(
                request()->sort_by == 'scheduled_at'
                    ? 'scheduled_at IS NULL, scheduled_at ' . (request()->order_by ?? 'desc')
                    : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
            )
            ->paginate(request()->limit_by ?? 20);

        return view('driver.pickup_requests.index', compact('pickupRequests', 'drivers', 'merchants'));
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
    // public function update(Request $request, $id)
    // {
    //     if (!auth()->user()->ability('driver', 'update_pickup_requests')) {
    //         return redirect('driver/index');
    //     }


    //     $pickupRequest = PickupRequest::findOrFail($id);

    //     $request->validate([
    //         'merchant_id' => 'required|exists:merchants,id',

    //         'country' => 'nullable|string|max:255',
    //         'region' => 'nullable|string|max:255',
    //         'city' => 'nullable|string|max:255',
    //         'district' => 'nullable|string|max:255',
    //         'postal_code' => 'nullable|string|max:255',
    //         'latitude' => 'nullable|string|max:255',
    //         'longitude' => 'nullable|string|max:255',

    //         'scheduled_at' => 'nullable|date',
    //         'status' => 'required|in:pending,accepted,completed',
    //         'note' => 'nullable|string|max:255',
    //         'driver_id' => 'nullable|exists:drivers,id',
    //     ]);




    //         $input['merchant_id'] =  $request->merchant_id ;
    //         $input['driver_id'] =    $request->driver_id ;

    //         $input['country']        =   $request->country ;
    //         $input['region']         =   $request->region ;
    //         $input['city']           =   $request->city ;
    //         $input['district']       =   $request->district ;
    //         $input['postal_code']    =   $request->postal_code ;
    //         $input['latitude']       =   $request->latitude ;
    //         $input['longitude']      =   $request->longitude ;

    //         $input['scheduled_at'] =     $request->scheduled_at ;
    //         $input['status'] =   $request->status ;
    //         $input['note'] =     $request->note ;

    //         // 2. إذا الحالة أصبحت accepted لأول مرة، نملأ accepted_at
    //         if ($input['status'] === 'accepted' && !$pickupRequest->accepted_at) {
    //             $input['accepted_at'] = now();
    //         }
    //         // 3. إذا الحالة أصبحت completed لأول مرة، نملأ completed_at
    //         if ($input['status'] === 'completed' && !$pickupRequest->completed_at) {
    //             $input['completed_at'] = now();
    //         }

    //         $pickupRequest->update($input);





    //     return redirect()->route('driver.pickup_requests.index')->with([
    //         'message' => __('messages.pickup_request_updated'),
    //         'alert-type' => 'success'
    //     ]);
    // }

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
