<?php

namespace App\Http\Livewire\Merchant\Package;

use Livewire\Component;
use App\Models\Package;

class UpdatePackageCollectionComponent extends Component
{
    public $package_id;

    // ⚡ الحقول الحالية
    public $payment_responsibility = 'merchant';
    public $payment_method = 'prepaid';      // طريقة الدفع
    public $collection_method = 'cash';      // طريقة التحصيل

    public $delivery_fee = 0;
    public $insurance_fee = 0;
    public $service_fee = 0;

    public $paid_amount = 0;
    public $cod_amount = 0;

    // ⚡ mount مع تمرير package_id لتحميل البيانات إذا كانت موجودة
    public function mount($package_id = null)
    {
        $this->package_id = $package_id;

        if ($package_id) {
            $package = Package::find($package_id);
            if ($package) {
                $this->payment_responsibility = $package->payment_responsibility ?? 'merchant';
                $this->payment_method = $package->payment_method ?? 'prepaid';
                $this->collection_method = $package->collection_method ?? 'cash';
                $this->delivery_fee = $package->delivery_fee ?? 0;
                $this->insurance_fee = $package->insurance_fee ?? 0;
                $this->service_fee = $package->service_fee ?? 0;
                $this->paid_amount = $package->paid_amount ?? 0;
                $this->cod_amount = $package->cod_amount ?? 0;
            }
        }
    }

    public function render()
    {
        return view('livewire.merchant.package.update-package-collection-component');
    }

    // ⚡ مجموع التكاليف
    public function getTotalFeeProperty()
    {
        return floatval($this->delivery_fee) + floatval($this->insurance_fee) + floatval($this->service_fee);
    }

    // ⚡ المبلغ المتبقي
    public function getRemainingAmountProperty()
    {
        return $this->totalFee - floatval($this->paid_amount);
    }

    // ⚡ حفظ البيانات (اختياري)
    public function saveCollection()
    {
        if (!$this->package_id) return;

        $package = Package::find($this->package_id);
        if (!$package) return;

        $package->update([
            'payment_responsibility' => $this->payment_responsibility,
            'payment_method' => $this->payment_method,
            'collection_method' => $this->collection_method,
            'delivery_fee' => $this->delivery_fee,
            'insurance_fee' => $this->insurance_fee,
            'service_fee' => $this->service_fee,
            'paid_amount' => $this->paid_amount,
            'cod_amount' => $this->cod_amount,
        ]);

        $this->dispatchBrowserEvent('notify', [
            'type' => 'success',
            'title' => 'تم الحفظ',
            'message' => 'تم تحديث بيانات التحصيل بنجاح.'
        ]);
    }
}

