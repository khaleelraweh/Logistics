<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Package;
use App\Models\PackageProduct;
use App\Models\StockItem;
use Livewire\Component;

class UpdateProductComponent extends Component
{
    public $package_id ;
    public $products = [];        // المنتجات المضافة للطرد
    public $stockItems = [];      // عناصر المخزون المحملة
    public $merchant_id = null;   // التاجر المختار

    // نستمع للحدث القادم من SelectMerchantComponent
    protected $listeners = ['merchantSelected'];

    public function mount($package_id)
    {
        $this->package_id = $package_id;

          // تحميل الباقة مع المنتجات المرتبطة بها عبر packageProducts
        $package = Package::with('packageProducts')->findOrFail($package_id);

        // نفترض أن لديك حقل merchant_id في الباقة
        $this->merchant_id = $package->merchant_id;

          // تحميل عناصر المخزون لهذا التاجر إن وجد
        if ($this->merchant_id) {
            $this->stockItems = StockItem::with('product')
                ->where('merchant_id', $this->merchant_id)
                ->get();
        }

         // تحويل المنتجات المرتبطة بالباقة إلى نفس شكل $products
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

         // إذا لم يكن هناك منتجات محفوظة → أضف صف فارغ
        if (empty($this->products)) {
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



    }

    /**
     * إضافة صف جديد للمنتجات
     */
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

    /**
     * إزالة صف منتج
     */
    public function removeProduct($index)
    {
        unset($this->products[$index]);
        // إعادة ترتيب الـ index بعد الحذف
        $this->products = array_values($this->products);
    }

    /**
     * عندما يتم اختيار تاجر جديد من الكومبوننت الآخر
     */
    public function merchantSelected($merchantId)
    {
        $this->merchant_id = $merchantId;

        if ($merchantId) {
            // تحميل المخزون الخاص بهذا التاجر
            $this->stockItems = StockItem::with('product')
                                ->where('merchant_id', $merchantId)
                                ->get();
        } else {
            // لم يتم اختيار تاجر → لا يوجد مخزون
            $this->stockItems = [];
            // نحول جميع الصفوف إلى مخصصة
            foreach ($this->products as $product) {
                $product['type'] = 'custom';
                $product['stock_item_id'] = null;
            }
        }
    }




    public function updatedProducts($value, $name)
{
    [$index, $field] = explode('.', $name);

    // نتحقق فقط إذا كان المنتج من المخزون وتم تحديد stock_item_id
    if ($this->products[$index]['type'] === 'stock' && $this->products[$index]['stock_item_id']) {
        $stockItemId = $this->products[$index]['stock_item_id'];
        $stockItem = $this->stockItems->firstWhere('id', $stockItemId);

        if ($stockItem && $stockItem->product) {
            // ✅ لو المستخدم غيّر الـ stock_item_id → نعبي سعر الوحدة واسم المنتج تلقائيًا
            if ($field === 'stock_item_id') {
                $this->products[$index]['price_per_unit'] = (float) $stockItem->product->price;
                $this->products[$index]['custom_name'] = $stockItem->product->name;
            }

            // نحسب مجموع الكميات المطلوبة لهذا الصنف في كل الصفوف
            $totalRequestedQty = 0;
            foreach ($this->products as $i => $product) {
                if ($product['type'] === 'stock' && $product['stock_item_id'] == $stockItemId) {
                    // لو هذا هو الصف الذي نحدثه الآن، نأخذ القيمة الجديدة
                    if ($i == $index && $field == 'quantity') {
                        $totalRequestedQty += (int) $value;
                    } else {
                        $totalRequestedQty += (int) ($product['quantity'] ?? 0);
                    }
                }
            }

            if ($totalRequestedQty > $stockItem->quantity) {
                // نصحح الكمية في هذا الصف بحيث لا يتجاوز المجموع المخزون
                $availableQty = $stockItem->quantity - ($totalRequestedQty - (int) ($this->products[$index]['quantity'] ?? 0));
                $availableQty = max($availableQty, 0);
                $this->products[$index]['quantity'] = $availableQty;

                $this->dispatchBrowserEvent('notify', [
                    'type' => 'warning',
                    'title' => 'تنبيه',
                    'message' => "إجمالي الكمية المطلوبة لهذا المنتج تجاوز المخزون المتاح: {$stockItem->quantity}. تم تصحيح الكمية."
                ]);
            }
        }
    }

    // في جميع الحالات: تحديث السعر الإجمالي
    if (in_array($field, ['quantity', 'price_per_unit', 'stock_item_id'])) {
        $quantity = (float) ($this->products[$index]['quantity'] ?? 0);
        $price = (float) ($this->products[$index]['price_per_unit'] ?? 0);
        $this->products[$index]['total_price'] = $quantity * $price;
    }
}



    public function render()
    {
        return view('livewire.admin.package.update-product-component');
    }
}
