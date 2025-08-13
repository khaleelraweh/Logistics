<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;

class CreatePackageCollectionComponent extends Component
{
    public $payment_responsibility = 'merchant';
    public $payment_method = 'prepaid';      // طريقة الدفع
    public $collection_method = 'cash';      // طريقة التحصيل

    public $delivery_fee = 0;
    public $insurance_fee = 0;
    public $service_fee = 0;

    public $paid_amount = 0;
    public $cod_amount = 0;

    public function render()
    {
        return view('livewire.admin.package.create-package-collection-component');
    }

    public function getTotalFeeProperty()
    {
        return floatval($this->delivery_fee) + floatval($this->insurance_fee) + floatval($this->service_fee);
    }

    public function getRemainingAmountProperty()
    {
        return $this->totalFee - floatval($this->paid_amount);
    }
}
