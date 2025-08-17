<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ShelfRequeust;
use App\Models\Shelf;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_shelves , show_shelves')) {
    //         return redirect('admin/index');
    //     }

    //     $shelves = Shelf::query()
    //         ->when(\request()->keyword != null, function ($query) {
    //             $query->search(\request()->keyword);
    //         })
    //         ->when(\request()->status != null, function ($query) {
    //             $query->where('status', \request()->status);
    //         })
    //         ->orderByRaw(request()->sort_by == 'published_on'
    //             ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //             : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
    //         ->paginate(\request()->limit_by ?? 100);

    //     return view('admin.shelves.index', compact('shelves'));
    // }


    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_shelves , show_shelves')) {
    //         return redirect('admin/index');
    //     }

    //     $shelves = Shelf::query()
    //         // فلترة بالكلمة المفتاحية
    //         ->when(request()->keyword != null, function ($query) {
    //             $query->search(request()->keyword);
    //         })
    //         // فلترة الحالة (نشط / غير نشط)
    //         ->when(request()->status != null, function ($query) {
    //             $query->where('status', request()->status);
    //         })
    //         // فلترة المستودع
    //         ->when(request()->warehouse_id != null, function ($query) {
    //             $query->where('warehouse_id', request()->warehouse_id);
    //         })
    //         // فلترة التأجير (مؤجر / غير مؤجر)
    //         ->when(request()->rented != null, function ($query) {
    //             if(request()->rented == '1'){
    //                 // مؤجر
    //                 $query->whereHas('rentals', function($q){
    //                     $q->where('end_date', '>=', now());
    //                 });
    //             } else {
    //                 // غير مؤجر
    //                 $query->whereDoesntHave('rentals', function($q){
    //                     $q->where('end_date', '>=', now());
    //                 });
    //             }
    //         })
    //         // الترتيب
    //         ->orderByRaw(request()->sort_by == 'published_on'
    //             ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
    //             : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
    //         ->paginate(request()->limit_by ?? 100);

    //     // كل المستودعات للفلاتر في الـ view
    //     $warehouses = Warehouse::all();

    //     return view('admin.shelves.index', compact('shelves', 'warehouses'));
    // }


public function index()
{
    if (!auth()->user()->ability('admin', 'manage_shelves, show_shelves')) {
        return redirect('admin/index');
    }

    $warehouses = \App\Models\Warehouse::all(); // لجلب المستودعات للفلاتر

    $shelves = \App\Models\Shelf::query()
        // فلتر الكلمة المفتاحية
        ->when(request()->keyword != null, function ($query) {
            $query->where('code', 'like', '%' . request()->keyword . '%')
                  ->orWhere('description', 'like', '%' . request()->keyword . '%');
        })
        // فلتر الحالة (نشط/غير نشط)
        ->when(request()->status != null, function ($query) {
            $query->where('status', request()->status);
        })
        // فلتر المستودع
        ->when(request()->warehouse_id != null, function ($query) {
            $query->where('warehouse_id', request()->warehouse_id);
        })
        // فلتر المؤجرة / غير المؤجرة
        ->when(request()->rented != null, function ($query) {
            if(request()->rented == '1'){ // مؤجرة
                $query->whereHas('rentals', function($q){
                    $q->where(function($q2){
                        $q2->whereDate('custom_end', '>=', now())
                           ->orWhereDate('rental_end', '>=', now());
                    });
                });
            } else { // غير مؤجرة
                $query->whereDoesntHave('rentals', function($q){
                    $q->where(function($q2){
                        $q2->whereDate('custom_end', '>=', now())
                           ->orWhereDate('rental_end', '>=', now());
                    });
                });
            }
        })
        // ترتيب
        ->orderByRaw(request()->sort_by == 'published_on'
            ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
            : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc'))
        ->paginate(request()->limit_by ?? 100);

    return view('admin.shelves.index', compact('shelves', 'warehouses'));
}





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_shelves')) {
            return redirect('admin/index');
        }

        $warehouses = Warehouse::whereStatus(1)->get(['id', 'name','code']);

        return view('admin.shelves.create',compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShelfRequeust $request)
    {

        if (!auth()->user()->ability('admin', 'create_shelves')) {
            return redirect('admin/index');
        }

        // dd($request);

        $input['warehouse_id']       =   $request->warehouse_id;
        $input['code']              =   $request->code;
        $input['description']       =   $request->description;
        $input['size']               =   $request->size;
        $input['price']               =   $request->price;
        $input['status']            =   $request->status=='on' ? true : false;

        $shelf = Shelf::create($input);


        if($shelf){
            return redirect()->route('admin.shelves.index')->with([
                'message' => __('messages.shelf_created'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.shelves.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function show(Shelf $shelf)
    {
        if (!auth()->user()->ability('admin', 'show_shelves')) {
            return redirect('admin/index');
        }

        // تحميل العلاقات الصحيحة لتقليل عدد الاستعلامات
        $shelf->load([
            'warehouse',
            'stockItems',
            'rentals.merchant',      // بيانات المستأجر لكل عقد
            'rentals.invoice.payments' // المدفوعات عبر الفاتورة المرتبطة بالعقد
        ]);

        return view('admin.shelves.show', compact('shelf'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function edit($shelf)
    {
        if (!auth()->user()->ability('admin', 'update_shelves')) {
            return redirect('admin/index');
        }

        $warehouses = Warehouse::whereStatus(1)->get(['id', 'name','code']);

        $shelf = Shelf::where('id', $shelf)->first();

        return view('admin.shelves.edit',compact('shelf','warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function update(ShelfRequeust $request, $shelf)
    {
        if (!auth()->user()->ability('admin', 'update_shelves')) {
            return redirect('admin/index');
        }

        $shelf = Shelf::where('id', $shelf)->first();

        // dd($request);

        $input['warehouse_id']              =   $request->warehouse_id;
        $input['code']                      =   $request->code;
        $input['description']               =   $request->description;
        $input['size']                      =   $request->size;
        $input['price']                     =   $request->price;
        $input['status']                    =   $request->status=='on' ? true : false;

        $input['updated_by']                =   auth()->user()->id;
        $shelf->update($input);



        if($shelf){
            return redirect()->route('admin.shelves.index')->with([
                'message' => __('messages.shelf_updated'),
                'alert-type' => 'success'
            ]);

        }

        return redirect()->route('admin.shelves.index')->with([
            'message' => __('messages.something_went_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shelf  $shelf
     * @return \Illuminate\Http\Response
     */
    public function destroy($shelf)
    {
        if (!auth()->user()->ability('admin', 'delete_shelves')) {
            return redirect('admin/index');
        }

        $shelf = Shelf::where('id', $shelf)->first();

        $shelf->delete();

        if ($shelf) {
            return redirect()->route('admin.shelves.index')->with([
                'message' => __('messages.shelf_deleted'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.shelves.index')->with([
            'message' => __('messages.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function updateShelveStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Shelf::where('id', $data['shelf_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'shelf_id' => $data['shelf_id']]);
        }
    }
}
