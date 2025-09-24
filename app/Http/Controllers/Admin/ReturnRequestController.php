<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ReturnRequestRequest;
use App\Models\Driver;
use App\Models\Package;
use App\Models\ReturnRequest;
use Illuminate\Http\Request;

class ReturnRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     if (!auth()->user()->ability('admin', 'manage_return_requests , show_return_requests')) {
    //         return redirect('admin/index');
    //     }

    //     $return_requests = ReturnRequest::query()
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

    //     return view('admin.return_requests.index', compact('return_requests'));
    // }


    public function index()
{
    // صلاحية الوصول
    if (!auth()->user()->ability('admin', 'manage_return_requests, show_return_requests')) {
        return redirect('admin/index');
    }

    $drivers = Driver::all();
    $packages = Package::with('merchant')->get();

    // استعلام Return Requests
    $return_requests = ReturnRequest::with([
            'package.merchant', // بيانات الطرد والتاجر
            'driver'            // بيانات السائق
        ])
        // البحث بالكلمة المفتاحية
        ->when(request()->keyword, function ($query) {
            $query->search(request()->keyword);
        })
        // الفلترة حسب الحالة
        ->when(request()->status, function ($query) {
            $query->where('status', request()->status);
        })
        // ترتيب ديناميكي
        ->orderByRaw(
            request()->sort_by == 'published_on'
                ? 'published_on IS NULL, published_on ' . (request()->order_by ?? 'desc')
                : (request()->sort_by ?? 'created_at') . ' ' . (request()->order_by ?? 'desc')
        )
        // تحديد عدد النتائج لكل صفحة
        ->paginate(request()->limit_by ?? 100)
        ->withQueryString(); // للحفاظ على الـ filters في روابط الصفحات

    return view('admin.return_requests.index', compact('return_requests', 'drivers' , 'packages'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (!auth()->user()->ability('admin', 'create_return_requests')) {
            return redirect('admin/index');
        }

        $drivers = Driver::all();
        // $packages = Package::whereDoesntHave('returnRequest')->get();


        return view('admin.return_requests.create',compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReturnRequestRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_return_requests')) {
            return redirect('admin/index');
        }

        try {
            // تجهيز البيانات
            $input['package_id']    = $request->package_id;
            $input['driver_id']     = $request->driver_id;

            $input['return_type']           = $request->return_type;
            $input['target_address']        = $request->target_address;
            $input['requested_at']          = $request->requested_at;
            $input['status']                = $request->status;
            $input['received_at']           = $request->received_at;
            $input['reason']                = $request->reason;

            $input['created_by']    = auth()->user()->name;

            // إنشاء مرتجع
            $return_request = ReturnRequest::create($input);

            if ($return_request) {
                return redirect()->route('admin.return_requests.index')->with([
                    'message'     => __('messages.return_request_created'),
                    'alert-type'  => 'success',
                ]);
            }

            return redirect()->route('admin.return_requests.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.return_requests.index')->with([
                'message'     => __('messages.something_went_wrong'),
                'alert-type'  => 'danger',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'show_return_requests')) {
            return redirect('admin/index');
        }

        $return_request = ReturnRequest::with(['package', 'merchant', 'driver', 'returnItems'])->findOrFail($id);

        return view('admin.return_requests.show', compact('return_request'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($return_request)
    {
        if (!auth()->user()->ability('admin', 'update_return_requests')) {
            return redirect('admin/index');
        }

        // جلب بيانات عملية التوصيل الحالية
        $return_request = ReturnRequest::findOrFail($return_request);

        // جلب السائقين
        $drivers = Driver::all();

        // جلب الطرود:
        // الطرود التي ليس لديها أي توصيل أو الطرد المرتبط بهذه العملية
        $packages = Package::whereDoesntHave('returnRequest')
                    ->orWhere('id', $return_request->package_id)
                    ->get();

        return view('admin.return_requests.edit', compact('return_request', 'drivers', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function update(ReturnRequestRequest $request,  $return_request)
    {
        // التحقق من الصلاحيات
        if (!auth()->user()->ability('admin', 'update_deliveries')) {
            return redirect('admin/index');
        }

        try {

            $return_request = ReturnRequest::where('id' , $return_request)->first();

            // تجهيز البيانات
            $input['package_id']    = $request->package_id;
            $input['driver_id']     = $request->driver_id;

            $input['return_type']           = $request->return_type;
            $input['target_address']        = $request->target_address;
            $input['requested_at']          = $request->requested_at;
            $input['status']                = $request->status;
            $input['received_at']           = $request->received_at;
            $input['reason']                = $request->reason;

            $input['updated_by']    = auth()->user()->name;

            // تحديث السجل
            $return_request->update($input);

            return redirect()->route('admin.return_requests.index')->with([
                'message'    => __('messages.return_request_updated'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            // يمكنك تسجيل الخطأ هنا لو أحببت: \Log::error($e->getMessage());

            return redirect()->route('admin.return_requests.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */


    // public function destroy($return_request)
    // {
    //     // التحقق من الصلاحيات
    //     if (!auth()->user()->ability('admin', 'delete_return_requests')) {
    //         return redirect('admin/index');
    //     }

    //     $return_request = ReturnRequest::where('id' , $return_request)->first();

    //     try {
    //         $return_request->delete();

    //         return redirect()->route('admin.return_requests.index')->with([
    //             'message'    => __('messages.return_request_deleted'),
    //             'alert-type' => 'success',
    //         ]);

    //     } catch (\Exception $e) {
    //         // يمكن تسجيل الخطأ لو حبيت: \Log::error($e->getMessage());

    //         return redirect()->route('admin.return_requests.index')->with([
    //             'message'    => __('messages.something_went_wrong'),
    //             'alert-type' => 'danger',
    //         ]);
    //     }
    // }


    public function destroy($return_request)
    {
        // التحقق من الصلاحيات
        if (!auth()->user()->ability('admin', 'delete_return_requests')) {
            return redirect('admin/index');
        }

        $returnRequest = ReturnRequest::with('returnItems')->where('id', $return_request)->first();

        if (!$returnRequest) {
            return redirect()->route('admin.return_requests.index')->with([
                'message'    => __('messages.return_request_not_found'),
                'alert-type' => 'warning',
            ]);
        }

        try {
            // إذا كانت الحالة تستدعي تعديل المخزون
            if (in_array($returnRequest->status, ['received', 'partially_received'])) {
                foreach ($returnRequest->returnItems as $item) {
                    if ($item->type == 'stock' && $item->stock_item_id) {
                        $stockItem = \App\Models\StockItem::find($item->stock_item_id);
                        if ($stockItem) {
                            $stockItem->decrement('quantity', $item->quantity);
                        }
                    }
                }
            }

            // حذف الطلب
            $returnRequest->delete();

            return redirect()->route('admin.return_requests.index')->with([
                'message'    => __('messages.return_request_deleted'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            // يمكن تسجيل الخطأ

            return redirect()->route('admin.return_requests.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

}
