<?php

namespace App\Http\Controllers;

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
        if (!auth()->user()->ability('admin', 'manage_pickup_requests, show_pickup_requests')) {
            return redirect('admin/index');
        }

        $pickupRequests = PickupRequest::query()
            ->when(request()->keyword != null, function ($query) {
                $query->where('pickup_address', 'like', '%' . request()->keyword . '%');
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->orderByRaw(request()->sort_by == 'scheduled_at'
                ? 'scheduled_at IS NULL, scheduled_at ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
            ->paginate(request()->limit_by ?? 20);

        return view('admin.pickup_requests.index', compact('pickupRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_pickup_requests')) {
            return redirect('admin/index');
        }

        $merchants = Merchant::whereStatus(1)->get(['id', 'name','contact_person','email','phone']);
        $drivers = Driver::whereStatus(1)->get(); // جلب السائقين النشطين فقط

        return view('admin.pickup_requests.create', compact('merchants','drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->ability('admin', 'create_pickup_requests')) {
            return redirect('admin/index');
        }

        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'pickup_address' => 'required|string|max:255',
            'scheduled_at' => 'nullable|date',
            'status' => 'required|in:pending,accepted,completed',
            'note' => 'nullable|string|max:255',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        $pickupRequest = PickupRequest::create([
            'merchant_id' => $request->merchant_id,
            'pickup_address' => $request->pickup_address,
            'scheduled_at' => $request->scheduled_at,
            'status' => $request->status,
            'note' => $request->note,
            'driver_id' => $request->driver_id,  // تعيين السائق هنا إذا موجود
        ]);

        if ($pickupRequest) {
            return redirect()->route('admin.pickup_requests.index')->with([
                'message' => __('messages.pickup_request_created'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.pickup_requests.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'show_pickup_requests')) {
            return redirect('admin/index');
        }

        $pickupRequest = PickupRequest::with(['merchant', 'driver'])->findOrFail($id);

        return view('admin.pickup_requests.show', compact('pickupRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_pickup_requests')) {
            return redirect('admin/index');
        }

        $pickupRequest = PickupRequest::findOrFail($id);
        $merchants = Merchant::whereStatus(1)->get(['id', 'name','email']);
        $drivers = Driver::whereStatus(1)->get(['id', 'name']);

        return view('admin.pickup_requests.edit', compact('pickupRequest', 'merchants', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_pickup_requests')) {
            return redirect('admin/index');
        }

        $pickupRequest = PickupRequest::findOrFail($id);

        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'pickup_address' => 'required|string|max:255',
            'scheduled_at' => 'nullable|date',
            'status' => 'required|in:pending,accepted,completed',
            'note' => 'nullable|string|max:255',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        $pickupRequest->update([
            'merchant_id' => $request->merchant_id,
            'pickup_address' => $request->pickup_address,
            'scheduled_at' => $request->scheduled_at,
            'status' => $request->status,
            'note' => $request->note,
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->route('admin.pickup_requests.index')->with([
            'message' => __('messages.pickup_request_updated'),
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!auth()->user()->ability('admin', 'delete_pickup_requests')) {
            return redirect('admin/index');
        }

        $pickupRequest = PickupRequest::findOrFail($id);
        $pickupRequest->delete();

        return redirect()->route('admin.pickup_requests.index')->with([
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
