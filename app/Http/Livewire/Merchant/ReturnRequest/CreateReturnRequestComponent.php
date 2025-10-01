<?php

namespace App\Http\Livewire\Merchant\ReturnRequest;

use App\Models\Package;
use App\Models\ReturnRequest;
use App\Models\ReturnItem;
use App\Models\PackageProduct;
use Livewire\Component;

class CreateReturnRequestComponent extends Component
{
    public $package_id;
    public $return_type = 'to_warehouse';
    public $target_address;
    public $requested_at;
    public $received_at;
    public $status = 'requested';
    public $reason;

    public $packages = [];

    public $packageProducts = [];      // منتجات الطرد
    public $returnQuantities = [];     // كميات المرتجع لكل منتج

    public function mount()
    {
        $this->packages = Package::whereDoesntHave('returnRequest')->get();
        $this->requested_at = now()->format('Y-m-d');
        $this->received_at = now()->format('Y-m-d');
    }

    public function updatedPackageId($value)
    {
        $package = Package::with('packageProducts')->find($value);

        if ($package) {
            $this->packageProducts = $package->packageProducts->toArray();

            foreach ($this->packageProducts as $product) {
                $this->returnQuantities[$product['id']] = 0;
            }
        } else {
            $this->packageProducts = [];
            $this->returnQuantities = [];
        }
    }

    public function store()
    {
        $this->validate([
            'package_id' => 'required|exists:packages,id',
            'return_type' => 'required|in:to_warehouse,to_merchant,to_both',
            'target_address' => 'nullable|string',
            'requested_at' => 'required|date',
            'received_at' => 'nullable|date|after_or_equal:requested_at',
            'status' => 'required|in:requested,in_transit,received,rejected',
            'reason' => 'nullable|string',
        ]);

        // إنشاء طلب المرتجع
        $returnRequest = ReturnRequest::create([
            'package_id' => $this->package_id,
            'return_type' => $this->return_type,
            'target_address' => $this->target_address,
            'requested_at' => $this->requested_at,
            'received_at' => $this->received_at,
            'status' => $this->status,
            'reason' => $this->reason,
        ]);

        // حفظ تفاصيل المنتجات المرتجعة
        foreach ($this->returnQuantities as $productId => $qty) {
            if ($qty > 0) {
                $product = PackageProduct::with('stockItem')->find($productId);

                if ($product) {
                    ReturnItem::create([
                    'return_request_id' => $returnRequest->id,
                    'type'              => $product->type,
                    'stock_item_id'     => $product->type == 'stock' ? $product->stock_item_id : null,
                    'custom_name'       => $product->type == 'custom'
                                            ? $product->custom_name
                                            : optional($product->stockItem)->name,
                    'shelf_id'          => null,
                    'quantity'          => $qty,
                    ]);

                    //  إذا المنتج من المخزون والحالة received أو partially_received → نرجع الكمية للمخزون
                    //=============================================
                    if ($product->type == 'stock' && in_array($this->status, ['received', 'partially_received'])) {
                        $stockItem = $product->stockItem;
                        if ($stockItem) {
                            $stockItem->increment('quantity', $qty);
                        }
                    }
                    //==============================================

                }
            }
        }

        session()->flash('success', __('return_request.created_successfully'));

        return redirect()->route('merchant.return_requests.index');
    }

    public function render()
    {
        return view('livewire.merchant.return-request.create-return-request-component');
    }
}
