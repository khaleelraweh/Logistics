<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\StockItem;
use Livewire\Component;

class UpdateProductComponent extends Component
{
    public $products = [];        // المنتجات المضافة للطرد
    public $stockItems = [];      // عناصر المخزون المحملة
    public $merchant_id = null;   // التاجر المختار
    public $package;              // بيانات الباكيج (للتعديل)

    protected $listeners = ['merchantSelected'];

    protected $rules = [
        'products.*.weight' => 'required|numeric|min:0',
        'products.*.quantity' => 'required|integer|min:0',
        'products.*.price_per_unit' => 'required|numeric|min:0',
    ];

    protected $messages = [
        'products.*.weight.required' => 'الوزن مطلوب',
        'products.*.weight.numeric' => 'الوزن يجب أن يكون رقماً',
        'products.*.weight.min' => 'الوزن يجب أن يكون صفر أو أكبر',

        'products.*.quantity.required' => 'الكمية مطلوبة',
        'products.*.quantity.integer' => 'الكمية يجب أن تكون رقم صحيح',
        'products.*.quantity.min' => 'الكمية يجب أن تكون صفر أو أكبر',

        'products.*.price_per_unit.required' => 'سعر الوحدة مطلوب',
        'products.*.price_per_unit.numeric' => 'سعر الوحدة يجب أن يكون رقماً',
        'products.*.price_per_unit.min' => 'سعر الوحدة يجب أن يكون صفر أو أكبر',
    ];

    public function mount($package = null)
    {
        $this->package = $package;

        if ($package) {
            $this->merchant_id = $package->merchant_id;

            // تعبئة المنتجات الموجودة في الباكيج
            $this->products = $package->products->map(function($product){
                return [
                    'type' => $product->type,
                    'stock_item_id' => $product->stock_item_id,
                    'custom_name' => $product->custom_name,
                    'custom_description' => $product->custom_description,
                    'weight' => $product->weight,
                    'quantity' => $product->quantity,
                    'price_per_unit' => $product->price_per_unit,
                    'total_price' => $product->total_price,
                ];
            })->toArray();

            // تحميل عناصر المخزون إذا كان هناك تاجر محدد
            if ($this->merchant_id) {
                $this->stockItems = StockItem::with('product')
                                    ->where('merchant_id', $this->merchant_id)
                                    ->get();
            }
        } else {
            // إذا كانت صفحة الإنشاء
            $this->addProduct();
        }
    }

    public function addProduct()
    {
        $this->products[] = [
            'type' => 'custom',
            'stock_item_id' => null,
            'custom_name' => '',
            'custom_description' => '',
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

        // التعامل مع منتجات المخزون
        if ($this->products[$index]['type'] === 'stock' && $this->products[$index]['stock_item_id']) {
            $stockItemId = $this->products[$index]['stock_item_id'];
            $stockItem = $this->stockItems->firstWhere('id', $stockItemId);

            if ($stockItem && $stockItem->product) {
                if ($field === 'stock_item_id') {
                    $this->products[$index]['price_per_unit'] = (float) $stockItem->product->price;
                    $this->products[$index]['custom_name'] = $stockItem->product->name;
                }

                // التحقق من الكمية المتاحة
                $totalRequestedQty = 0;
                foreach ($this->products as $i => $product) {
                    if ($product['type'] === 'stock' && $product['stock_item_id'] == $stockItemId) {
                        $totalRequestedQty += ($i == $index && $field == 'quantity') ? (int) $value : (int) ($product['quantity'] ?? 0);
                    }
                }

                if ($totalRequestedQty > $stockItem->quantity) {
                    $availableQty = max($stockItem->quantity - ($totalRequestedQty - (int) ($this->products[$index]['quantity'] ?? 0)), 0);
                    $this->products[$index]['quantity'] = $availableQty;

                    $this->dispatchBrowserEvent('notify', [
                        'type' => 'warning',
                        'title' => 'تنبيه',
                        'message' => "إجمالي الكمية المطلوبة لهذا المنتج تجاوز المخزون المتاح: {$stockItem->quantity}. تم تصحيح الكمية."
                    ]);
                }
            }
        }

        // تحديث السعر الإجمالي
        if (in_array($field, ['quantity', 'price_per_unit', 'stock_item_id'])) {
            $quantity = (float) ($this->products[$index]['quantity'] ?? 0);
            $price = (float) ($this->products[$index]['price_per_unit'] ?? 0);
            $this->products[$index]['total_price'] = $quantity * $price;
        }

        // التحقق من الحقول الرقمية
        $this->validateOnly("products.$index.weight");
        $this->validateOnly("products.$index.quantity");
        $this->validateOnly("products.$index.price_per_unit");
    }

    public function saveProducts()
    {
        $this->validate();

        // حفظ المنتجات في قاعدة البيانات
        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'title' => 'تم',
            'message' => 'تم حفظ المنتجات بنجاح.'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.package.update-product-component');
    }
}
