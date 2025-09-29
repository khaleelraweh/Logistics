<?php

namespace App\Http\Livewire\Merchant\Package;

use App\Models\Package;
use App\Models\PackageProduct;
use App\Models\StockItem;
use Livewire\Component;

class UpdateProductComponent extends Component
{
    public $package_id;
    public $products = [];
    public $stockItems = [];
    public $merchant_id = null;

    protected $listeners = ['merchantSelected'];

    public function mount($package_id)
    {
        $this->package_id = $package_id;

        // تحميل الباقة مع المنتجات المرتبطة
        $package = Package::with('packageProducts')->findOrFail($package_id);
        $this->merchant_id = $package->merchant_id;

        // تحميل المخزون
        if ($this->merchant_id) {
            $this->stockItems = StockItem::with('product')
                ->where('merchant_id', $this->merchant_id)
                ->get();
        }

        // تحويل المنتجات المرتبطة إلى مصفوفة Livewire
        foreach ($package->packageProducts as $product) {
            $this->products[] = [
                'type' => $product->type,
                'stock_item_id' => $product->stock_item_id,
                'custom_name' => $product->custom_name,
                'weight' => $product->weight,
                'quantity' => $product->quantity,
                'price_per_unit' => $product->price_per_unit,
                'total_price' => $product->total_price,
            ];
        }

        // إذا لم يكن هناك منتجات → أضف صف فارغ
        if (empty($this->products)) {
            $this->addProduct();
        }
    }

    public function addProduct()
    {
        $this->products[] = [
            'type' => 'custom',
            'stock_item_id' => null,
            'custom_name' => '',
            'weight' => '',
            'quantity' => '',
            'price_per_unit' => '',
            'total_price' => '',
        ];
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function merchantSelected($merchantId)
    {
        $this->merchant_id = $merchantId;

        if ($merchantId) {
            $this->stockItems = StockItem::with('product')
                ->where('merchant_id', $merchantId)
                ->get();
        } else {
            $this->stockItems = [];
            foreach ($this->products as &$product) {
                $product['type'] = 'custom';
                $product['stock_item_id'] = null;
            }
        }
    }

    public function updatedProducts($value, $name)
    {
        [$index, $field] = explode('.', $name);

        if ($this->products[$index]['type'] === 'stock' && $this->products[$index]['stock_item_id']) {
            $stockItemId = $this->products[$index]['stock_item_id'];
            $stockItem = $this->stockItems->firstWhere('id', $stockItemId);

            if ($stockItem && $stockItem->product) {
                if ($field === 'stock_item_id') {
                    $this->products[$index]['price_per_unit'] = (float)$stockItem->product->price;
                    $this->products[$index]['custom_name'] = $stockItem->product->name;
                }

                $totalRequestedQty = 0;
                foreach ($this->products as $i => $product) {
                    if ($product['type'] === 'stock' && $product['stock_item_id'] == $stockItemId) {
                        $totalRequestedQty += ($i == $index && $field == 'quantity') ? (int)$value : (int)($product['quantity'] ?? 0);
                    }
                }

                if ($totalRequestedQty > $stockItem->quantity) {
                    $availableQty = max($stockItem->quantity - ($totalRequestedQty - (int)($this->products[$index]['quantity'] ?? 0)), 0);
                    $this->products[$index]['quantity'] = $availableQty;

                    $this->dispatchBrowserEvent('notify', [
                        'type' => 'warning',
                        'title' => 'تنبيه',
                        'message' => "إجمالي الكمية المطلوبة لهذا المنتج تجاوز المخزون المتاح: {$stockItem->quantity}. تم تصحيح الكمية."
                    ]);
                }
            }
        }

        if (in_array($field, ['quantity', 'price_per_unit', 'stock_item_id'])) {
            $quantity = (float)($this->products[$index]['quantity'] ?? 0);
            $price = (float)($this->products[$index]['price_per_unit'] ?? 0);
            $this->products[$index]['total_price'] = $quantity * $price;
        }
    }

    public function render()
    {
        return view('livewire.merchant.package.update-product-component');
    }
}
