<?php

namespace App\Http\Livewire\Driver\ReturnRequest;

use App\Models\Driver;
use App\Models\Package;
use App\Models\ReturnRequest;
use App\Models\ReturnItem;
use App\Models\PackageProduct;
use Livewire\Component;

class EditReturnRequestComponent extends Component
{
    public $returnRequestId;

    public $package_id;
    public $driver_id;
    public $return_type;
    public $target_address;
    public $requested_at;
    public $received_at;
    public $status;
    public $reason;

    public $packages = [];
    public $drivers = [];

    public $packageProducts = [];    // المنتجات الأصلية للطرد
    public $returnQuantities = [];   // الكميات المرتجعة (معبأة من return_items)

    // لتخزين الحالة السابقة قبل التحديث
    public $previousStatus;

    // ترتيب الحالات المنطقي
    protected $statuses = [
        'requested',
        'cancelled',
        'in_transit',
        'rejected',
        'received',
        'partially_received',
    ];

    public function mount($id)
    {
        $this->returnRequestId = $id;

        $this->packages = Package::all();
        $this->drivers = Driver::all();

        $returnRequest = ReturnRequest::with('returnItems')->findOrFail($id);

        $this->package_id = $returnRequest->package_id;
        $this->driver_id = $returnRequest->driver_id;
        $this->return_type = $returnRequest->return_type;
        $this->target_address = $returnRequest->target_address;
        $this->requested_at = optional($returnRequest->requested_at)->format('Y-m-d');
        $this->received_at = optional($returnRequest->received_at)->format('Y-m-d');
        $this->status = $returnRequest->status;
        $this->reason = $returnRequest->reason;

        // تخزين الحالة السابقة
        $this->previousStatus = $returnRequest->status;

        // تحميل منتجات الطرد
        $package = Package::with('packageProducts')->find($this->package_id);
        $this->packageProducts = $package ? $package->packageProducts->toArray() : [];

        // تعبئة returnQuantities من return_items
        foreach ($this->packageProducts as $product) {
            $item = $returnRequest->returnItems
                ->where('type', $product['type'])
                ->where('type', 'stock')
                ->where('stock_item_id', $product['stock_item_id'])
                ->first();

            if (!$item && $product['type'] === 'custom') {
                $item = $returnRequest->returnItems
                    ->where('type', 'custom')
                    ->where('custom_name', $product['custom_name'])
                    ->first();
            }

            $this->returnQuantities[$product['id']] = $item ? $item->quantity : 0;
        }
    }


    // في مكون EditReturnRequestComponent
    public function updatedPackageId($value)
    {
        $package = Package::with('packageProducts')->find($value);

        if ($package) {
            $this->packageProducts = $package->packageProducts->toArray();

            // جلب الطلب المرتجع الحالي
            $returnRequest = ReturnRequest::with('returnItems')->find($this->returnRequestId);

            foreach ($this->packageProducts as $product) {
                $item = null;

                if ($product['type'] === 'stock') {
                    $item = $returnRequest->returnItems
                        ->where('type', 'stock')
                        ->where('stock_item_id', $product['stock_item_id'])
                        ->first();
                } elseif ($product['type'] === 'custom') {
                    $item = $returnRequest->returnItems
                        ->where('type', 'custom')
                        ->where('custom_name', $product['custom_name'])
                        ->first();
                }

                $this->returnQuantities[$product['id']] = $item ? $item->quantity : 0;
            }

        } else {
            $this->packageProducts = [];
            $this->returnQuantities = [];
        }

        // إعادة تحميل الخرائط بعد تحديث البيانات
        $this->dispatchBrowserEvent('refreshMaps');
    }

    public function update()
    {
        $this->validate([
            'package_id' => 'required|exists:packages,id',
            'driver_id' => 'required|exists:drivers,id',
            'return_type' => 'required|in:to_warehouse,to_merchant,to_both',
            'target_address' => 'nullable|string',
            'requested_at' => 'required|date',
            'received_at' => 'nullable|date|after_or_equal:requested_at',
            'status' => 'required|in:requested,assigned_to_driver,picked_up,in_transit,received,rejected,partially_received,cancelled',
            'reason' => 'nullable|string',
        ]);

        $returnRequest = ReturnRequest::findOrFail($this->returnRequestId);

        $returnRequest->update([
            'package_id' => $this->package_id,
            'driver_id' => $this->driver_id,
            'return_type' => $this->return_type,
            'target_address' => $this->target_address,
            'requested_at' => $this->requested_at,
            'received_at' => $this->received_at,
            'status' => $this->status,
            'reason' => $this->reason,
        ]);

        // حذف العناصر القديمة وإعادة إنشاءها
        $returnRequest->returnItems()->delete();

        foreach ($this->returnQuantities as $productId => $qty) {
            if ($qty > 0) {
                $product = PackageProduct::with('stockItem')->find($productId);
                if ($product) {
                    ReturnItem::create([
                        'return_request_id' => $returnRequest->id,
                        'type' => $product->type,
                        'stock_item_id' => $product->type == 'stock' ? $product->stock_item_id : null,
                        'custom_name' => $product->type == 'custom'
                            ? $product->custom_name
                            : optional($product->stockItem)->name,
                        'shelf_id' => null,
                        'quantity' => $qty,
                    ]);

                    // تحديث المخزون بناءً على تغير الحالة
                    if ($product->type == 'stock') {
                        $stockItem = $product->stockItem;

                        if ($stockItem) {
                            $oldStatus = $this->previousStatus;
                            $newStatus = $this->status;

                            // زيادة المخزون إذا تغيرنا من حالة غير مستلمة إلى مستلمة أو جزئيا مستلمة
                            if (!in_array($oldStatus, ['received', 'partially_received']) && in_array($newStatus, ['received', 'partially_received'])) {
                                $stockItem->increment('quantity', $qty);
                            }

                            // تقليل المخزون إذا تغيرنا من حالة مستلمة إلى حالة غير مستلمة
                            if (in_array($oldStatus, ['received', 'partially_received']) && !in_array($newStatus, ['received', 'partially_received'])) {
                                $stockItem->decrement('quantity', $qty);
                            }
                        }
                    }
                }
            }
        }

        // تحديث الحالة السابقة للحالة الجديدة للاستخدام لاحقًا
        $this->previousStatus = $this->status;

        session()->flash('success', __('return_request.updated_successfully'));
        return redirect()->route('driver.return_requests.index');
    }

    // خاصية حسابية تعرض الحالات المتاحة بناءً على الحالة الحالية
    public function getAvailableStatusesProperty()
    {
        if (!$this->status) {
            return $this->statuses;
        }

        $currentIndex = array_search($this->status, $this->statuses);

        if ($currentIndex === false) {
            return $this->statuses;
        }

        // إرجاع الحالات من الحالة الحالية فصاعدًا
        return array_slice($this->statuses, $currentIndex);
    }




    public function render()
    {
        return view('livewire.driver.return-request.edit-return-request-component', [
            'availableStatuses' => $this->availableStatuses,

        ]);
    }
}
