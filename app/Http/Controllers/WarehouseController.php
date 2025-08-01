<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\WarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_warehouses , show_warehouses')) {
            return redirect('admin/index');
        }

        $warehouses = Warehouse::query()
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

        return view('admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_warehouses')) {
            return redirect('admin/index');
        }

        return view('admin.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_warehouses')) {
            return redirect('admin/index');
        }

        // dd($request);

        $input['name']              =   $request->name;
        $input['location']          =   $request->location;
        $input['code']              =   $request->code;
        $input['manager']           =   $request->manager;
        $input['phone']             =   $request->phone;
        $input['email']             =   $request->email;

        $input['status']            =   $request->status=='on' ? true : false;


        $warehouse = Warehouse::create($input);


        if($warehouse){
            return redirect()->route('admin.warehouses.index')->with([
                'message' => __('messages.warehouse_created'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.warehouses.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show($warehouseId)
    {
        // جلب المستودع مع بيانات الرفوف (shelves) واللازم من العلاقات الأخرى لو تحتاجها
        $warehouse = Warehouse::with('shelves')->findOrFail($warehouseId);

        // جلب العقود المتعلقة بالمستودع عن طريق العلاقة المخصصة rentals()
        $rentals = $warehouse->rentals()->with('merchant')->get();

        return view('admin.warehouses.show', compact('warehouse', 'rentals'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    // public function edit(Warehouse $warehouse)
    public function edit($warehouse)
    {
        if (!auth()->user()->ability('admin', 'update_warehouses')) {
            return redirect('admin/index');
        }

        $warehouse = Warehouse::where('id', $warehouse)->first();

        return view('admin.warehouses.edit',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseRequest $request, $warehouse)
    {
        if (!auth()->user()->ability('admin', 'update_warehouses')) {
            return redirect('admin/index');
        }

        $warehouse = Warehouse::where('id', $warehouse)->first();


         $input['name']              =   $request->name;
        $input['location']          =   $request->location;
        $input['code']              =   $request->code;
        $input['manager']           =   $request->manager;
        $input['phone']             =   $request->phone;
        $input['email']             =   $request->email;

        $input['status']            =   $request->status=='on' ? true : false;


        $warehouse->update($input);


        if($warehouse){
            return redirect()->route('admin.warehouses.index')->with([
                'message' => __('messages.warehouse_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.warehouses.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($warehouse)
    {
        if (!auth()->user()->ability('admin', 'delete_warehouses')) {
            return redirect('admin/index');
        }

        $warehouse = Warehouse::where('id', $warehouse)->first();

        $warehouse->delete();

        if ($warehouse) {
            return redirect()->route('admin.warehouses.index')->with([
                'message' => __('messages.merchant_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.warehouses.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function updateWarehouseStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Warehouse::where('id', $data['warehouse_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'warehouse_id' => $data['warehouse_id']]);
        }
    }
}
