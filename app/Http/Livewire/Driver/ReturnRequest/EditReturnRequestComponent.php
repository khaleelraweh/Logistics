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
    public $returnQuantities = [];   // الكميات المرتجعة

    // لتخزين الحالة السابقة قبل التحديث
    public $previousStatus;

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

        $this->previousStatus = $returnRequest->status;

        $package = Package::with('packageProducts')->find($this->package_id);
        $this->packageProducts = $package ? $package->packageProducts->toArray() : [];

        // تعبئة returnQuantities من return_items
        foreach ($this->packageProducts as $product) {
            $item = $returnRequest->returnItems
                ->where('type', $product['type'])
                ->when($product['type'] === 'stock', fn($q) => $q->where('stock_item_id', $product['stock_item_id']))
                ->when($product['type'] === 'custom', fn($q) => $q->where('custom_name', $product['custom_name']))
                ->first();

            $this->returnQuantities[$product['id']] = $item ? $item->quantity : 0;
        }
    }

    public function updatedPackageId($value)
    {
        $package = Package::with('packageProducts')->find($value);

        if ($package) {
            $this->packageProducts = $package->packageProducts->toArray();
            $returnRequest = ReturnRequest::with('returnItems')->find($this->returnRequestId);

            foreach ($this->packageProducts as $product) {
                $item = $returnRequest->returnItems
                    ->where('type', $product['type'])
                    ->when($product['type'] === 'stock', fn($q) => $q->where('stock_item_id', $product['stock_item_id']))
                    ->when($product['type'] === 'custom', fn($q) => $q->where('custom_name', $product['custom_name']))
                    ->first();

                $this->returnQuantities[$product['id']] = $item ? $item->quantity : 0;
            }
        } else {
            $this->packageProducts = [];
            $this->returnQuantities = [];
        }

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
            'status' => 'required|in:' . implode(',', ReturnRequest::getStatuses()),
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

        $returnRequest->returnItems()->delete();

        foreach ($this->returnQuantities as $productId => $qty) {
            if ($qty <= 0) continue;

            $product = PackageProduct::with('stockItem')->find($productId);
            if (!$product) continue;

            ReturnItem::create([
                'return_request_id' => $returnRequest->id,
                'type' => $product->type,
                'stock_item_id' => $product->type === 'stock' ? $product->stock_item_id : null,
                'custom_name' => $product->type === 'custom' ? $product->custom_name : optional($product->stockItem)->name,
                'shelf_id' => null,
                'quantity' => $qty,
            ]);

            if ($product->type === 'stock') {
                $stockItem = $product->stockItem;
                if ($stockItem) {
                    $oldStatus = $this->previousStatus;
                    $newStatus = $this->status;

                    if (!in_array($oldStatus, ['received', 'partially_received']) && in_array($newStatus, ['received', 'partially_received'])) {
                        $stockItem->increment('quantity', $qty);
                    }

                    if (in_array($oldStatus, ['received', 'partially_received']) && !in_array($newStatus, ['received', 'partially_received'])) {
                        $stockItem->decrement('quantity', $qty);
                    }
                }
            }
        }

        $this->previousStatus = $this->status;

        session()->flash('success', __('return_request.updated_successfully'));
        return redirect()->route('driver.return_requests.index');
    }

    public function getAvailableStatusesProperty()
    {
        $returnRequest = ReturnRequest::find($this->returnRequestId);
        if (!$returnRequest) return [];

        return $returnRequest->availableStatusesByRole();
    }

    public function render()
    {
        return view('livewire.driver.return-request.edit-return-request-component', [
            'availableStatuses' => $this->availableStatuses,
        ]);
    }
}
