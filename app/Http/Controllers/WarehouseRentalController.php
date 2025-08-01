<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Warehouse;
use App\Models\WarehouseRental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WarehouseRentalController extends Controller
{

    // we have ExpireWarehouseRentals job
    //that Mark expired warehouse rentals based on rental_end date
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_warehouse_rentals , show_warehouse_rentals')) {
            return redirect('admin/index');
        }

        $warehouse_rentals = WarehouseRental::with(['shelves', 'merchant'])
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

        return view('admin.warehouse_rentals.index', compact('warehouse_rentals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = Merchant::all();
        // $warehouses = Warehouse::with('shelves')->get();

        $warehouses = Warehouse::with(['shelves' => function ($query) {
            $query->whereDoesntHave('rentals', function ($q) {
                $q->where('status', 1)
                ->where('rental_end', '>', Carbon::now());
            });
        }])
        ->whereHas('shelves', function ($query) {
            $query->whereDoesntHave('rentals', function ($q) {
                $q->where('status', 1)
                ->where('rental_end', '>', Carbon::now());
            });
        })->get();



        return view('admin.warehouse_rentals.create', compact('warehouses', 'merchants'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'shelves'     => 'required|array',
        ]);

        $rental = WarehouseRental::create([
            'merchant_id'  => $request->merchant_id,
            'rental_start' => $request->rental_start ?? now(),
            'rental_end'   => $request->rental_end ?? now()->addMonth(),
            'status'       => 1,
            'created_by'   => auth()->user()->name ?? 'system',
        ]);

        $totalPrice = 0;

        foreach ($request->shelves as $shelfId => $data) {
            if (!isset($data['selected'])) continue;

            $customPrice = $data['custom_price'] ?? 0;
            $customStart = $data['custom_start'] ?? now();
            $customEnd   = $data['custom_end'] ?? now()->addMonth();

            $totalPrice += $customPrice;

            $rental->shelves()->attach($shelfId, [
                'custom_price' => $customPrice,
                'custom_start' => $customStart,
                'custom_end'   => $customEnd,
            ]);
        }

        // Now update the total price of the rental
        $rental->update(['price' => $totalPrice]);

        return redirect()->route('admin.warehouse_rentals.index')->with('success', 'Rental created.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseRental  $warehouseRental
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseRental $warehouseRental)
    {
        $warehouseRental->load(['merchant', 'shelves.warehouse']); // تحميل العلاقات
        return view('admin.warehouse_rentals.show', compact('warehouseRental'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseRental  $warehouseRental
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $warehouseRental = WarehouseRental::with('shelves')->findOrFail($id);
        $merchants = Merchant::all();

        $warehouses = Warehouse::with(['shelves' => function ($query) use ($warehouseRental) {
            $query->where(function ($q) use ($warehouseRental) {
                // Show shelves that are either:
                // - Not currently rented
                // - Or rented by the current rental (so merchant can still edit it)
                $q->whereDoesntHave('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('status', 1)
                        ->where('rental_end', '>', now());
                })->orWhereHas('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('warehouse_rental_id', $warehouseRental->id);
                });
            });
        }])
        ->whereHas('shelves', function ($query) use ($warehouseRental) {
            $query->where(function ($q) use ($warehouseRental) {
                $q->whereDoesntHave('rentals', function ($rentalQ) {
                    $rentalQ->where('status', 1)
                            ->where('rental_end', '>', now());
                })->orWhereHas('rentals', function ($rentalQ) use ($warehouseRental) {
                    $rentalQ->where('warehouse_rental_id', $warehouseRental->id);
                });
            });
        })->get();

        return view('admin.warehouse_rentals.edit', compact('warehouseRental', 'warehouses', 'merchants'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WarehouseRental  $warehouseRental
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $rental = WarehouseRental::findOrFail($id);

        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'shelves'     => 'required|array',
        ]);

        // Update main rental data
        $rental->update([
            'merchant_id'  => $request->merchant_id,
            // 'rental_start' => now(), // optional or make dynamic if needed
            // 'rental_end'   => now()->addMonth(), // optional or make dynamic if needed
            'rental_start' => $request->rental_start ?? now(),
            'rental_end'   => $request->rental_end ?? now()->addMonth(),
            'updated_by'   => auth()->user()->name ?? 'system',
        ]);

        // Reset shelves - detach all previous first
        $rental->shelves()->detach();

        $totalPrice = 0;

        foreach ($request->shelves as $shelfId => $data) {
            if (!isset($data['selected'])) continue;

            $customPrice = $data['custom_price'] ?? 0;
            $customStart = $data['custom_start'] ?? now();
            $customEnd   = $data['custom_end'] ?? now()->addMonth();

            $totalPrice += $customPrice;

            $rental->shelves()->attach($shelfId, [
                'custom_price' => $customPrice,
                'custom_start' => $customStart,
                'custom_end'   => $customEnd,
            ]);
        }

        // Update the final rental price
        $rental->update(['price' => $totalPrice]);

        return redirect()->route('admin.warehouse_rentals.index')->with('success', 'Rental updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseRental  $warehouseRental
     * @return \Illuminate\Http\Response
     */
    // public function destroy(WarehouseRental $warehouseRental)
    // {
    //     //
    // }

    public function destroy($id)
    {
        $rental = WarehouseRental::findOrFail($id);

        // Optional: detach shelves if you don't want to keep pivot data
        $rental->shelves()->detach();

        // Soft delete the rental
        $rental->delete();

        return redirect()->route('admin.warehouse_rentals.index')
            ->with('success', __('rental.deleted_successfully'));
    }
}
