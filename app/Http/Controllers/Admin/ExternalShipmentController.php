<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ExternalShipmentRequest;
use App\Models\ExternalShipment;
use App\Models\ShippingPartner;
use App\Models\Package;
use Illuminate\Http\Request;

class ExternalShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_external_shipments, show_external_shipments')) {
            return redirect('admin/index');
        }

        $shipments = ExternalShipment::query()
            ->when(request()->keyword != null, function ($query) {
                $query->where('external_tracking_number', 'like', '%' . request()->keyword . '%');
            })
            ->when(request()->status != null, function ($query) {
                $query->where('status', request()->status);
            })
            ->orderByRaw(request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
            ->paginate(request()->limit_by ?? 100);

        return view('admin.external_shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_external_shipments')) {
            return redirect('admin/index');
        }

        $partners = ShippingPartner::all();
        // $packages = Package::whereDoesntHave('externalShipment')->get();

         // نحضر الطرود التي لا تملك شحنة خارجية ولا شحنة داخلية
        $packages = Package::whereDoesntHave('externalShipment')
                        ->whereDoesntHave('delivery')
                        ->get();

        return view('admin.external_shipments.create', compact('partners', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExternalShipmentRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_external_shipments')) {
            return redirect('admin/index');
        }

        try {
            $input = [
                'shipping_partner_id'      => $request->shipping_partner_id,
                'package_id'               => $request->package_id,
                'external_tracking_number' => $request->external_tracking_number,
                'status'                   => $request->status ?? 'pending',
                'delivery_date'            => $request->delivery_date,
                'synced_at'                => $request->synced_at,
                'delivered_at'             => $request->delivered_at,
                'status_visible'           => $request->status_visible ?? true,
                'published_on'             => $request->published_on,
                'created_by'               => auth()->user()->name,
            ];

            $shipment = ExternalShipment::create($input);

            if ($shipment) {
                return redirect()->route('admin.external_shipments.index')->with([
                    'message'     => __('messages.external_shipment_created'),
                    'alert-type'  => 'success',
                ]);
            }

            return redirect()->route('admin.external_shipments.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.external_shipments.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        }
    }

    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'show_external_shipments')) {
            return redirect('admin/index');
        }

        // جلب الشحنة مع بيانات الشريك والشحنة المرتبطة بالطرد
        $shipment = ExternalShipment::with(['shippingPartner', 'package'])->findOrFail($id);

        return view('admin.external_shipments.show', compact('shipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->ability('admin', 'update_external_shipments')) {
            return redirect('admin/index');
        }

        $shipment = ExternalShipment::findOrFail($id);
        $partners = ShippingPartner::all();

        // الطرود التي ليس لديها external shipment أو هذا الطرد نفسه
        // $packages = Package::whereDoesntHave('externalShipment')
        //             ->orWhere('id', $shipment->package_id)
        //             ->get();

        // الطرود التي لا تمتلك شحنة خارجية ولا شحنة داخلية، أو هي الطرد المرتبط بالشحنة الحالية
        $packages = Package::where(function ($query) use ($shipment) {
                            $query->whereDoesntHave('externalShipment')
                                ->whereDoesntHave('delivery');
                        })
                        ->orWhere('id', $shipment->package_id)
                        ->get();


        return view('admin.external_shipments.edit', compact('shipment', 'partners', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExternalShipmentRequest $request, $id)
    {
        if (!auth()->user()->ability('admin', 'update_external_shipments')) {
            return redirect('admin/index');
        }

        try {
            $externalShipment = ExternalShipment::findOrFail($id);

            $input = [
                'shipping_partner_id'      => $request->shipping_partner_id,
                'package_id'               => $request->package_id,
                'external_tracking_number' => $request->external_tracking_number,
                'status'                   => $request->status ?? $externalShipment->status,
                'delivery_date'            => $request->delivery_date,
                'synced_at'                => $request->synced_at,
                'delivered_at'             => $request->delivered_at,
                'status_visible'           => $request->status_visible ?? $externalShipment->status_visible,
                'published_on'             => $request->published_on,
                'updated_by'               => auth()->user()->name,
            ];

            $externalShipment->update($input);

            return redirect()->route('admin.external_shipments.index')->with([
                'message'    => __('messages.external_shipment_updated'),
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.external_shipments.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExternalShipment $externalShipment)
    {
        if (!auth()->user()->ability('admin', 'delete_external_shipments')) {
            return redirect('admin/index');
        }

        try {
            $externalShipment->delete();

            return redirect()->route('admin.external_shipments.index')->with([
                'message'     => __('messages.external_shipment_deleted'),
                'alert-type'  => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.external_shipments.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        }
    }
}
