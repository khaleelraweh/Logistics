<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Driver\ReturnRequestRequest;
use App\Models\Driver;
use App\Models\Package;
use App\Models\ReturnRequest;

class ReturnRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // صلاحية الوصول
        if (!auth()->user()->ability('driver', 'driver_manage_return_requests, driver_show_return_requests')) {
            return redirect('driver/index');
        }

        $packages = Package::with('merchant')->get();

        $driver = auth()->user()->driver; // بيانات السائق
        // استعلام Return Requests
        $return_requests = ReturnRequest::with([
                'package.merchant', // بيانات الطرد والتاجر
                'driver'            // بيانات السائق
            ])
            ->where('driver_id', $driver->id) // عرض طلبات الإرجاع الخاصة بالسائق الحالي فقط
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

        return view('driver.return_requests.index', compact('return_requests' , 'packages'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->ability('driver', 'driver_show_return_requests')) {
            return redirect('driver/index');
        }

        $return_request = ReturnRequest::with(['package', 'merchant', 'driver', 'returnItems'])->findOrFail($id);

        return view('driver.return_requests.show', compact('return_request'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnRequest  $returnRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($return_request)
    {
        if (!auth()->user()->ability('driver', 'driver_update_return_requests')) {
            return redirect('driver/index');
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

        return view('driver.return_requests.edit', compact('return_request', 'drivers', 'packages'));
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
        if (!auth()->user()->ability('driver', 'driver_update_deliveries')) {
            return redirect('driver/index');
        }

        try {

            $return_request = ReturnRequest::findOrFail($return_request);

            $return_request->update($request->reason);
            $return_request->updateStatus($request->reason);

            return redirect()->route('driver.return_requests.index')->with([
                'message'    => __('messages.return_request_updated'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            // يمكنك تسجيل الخطأ هنا لو أحببت: \Log::error($e->getMessage());

            return redirect()->route('driver.return_requests.index')->with([
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

    public function destroy($return_request)
    {
        // التحقق من الصلاحيات
        if (!auth()->user()->ability('driver', 'driver_delete_return_requests')) {
            return redirect('driver/index');
        }

        $returnRequest = ReturnRequest::with('returnItems')->where('id', $return_request)->first();

        if (!$returnRequest) {
            return redirect()->route('driver.return_requests.index')->with([
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

            return redirect()->route('driver.return_requests.index')->with([
                'message'    => __('messages.return_request_deleted'),
                'alert-type' => 'success',
            ]);

        } catch (\Exception $e) {
            // يمكن تسجيل الخطأ

            return redirect()->route('driver.return_requests.index')->with([
                'message'    => __('messages.something_went_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

}

