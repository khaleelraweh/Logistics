<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\Component;

class UpdatePackageCollectionComponent extends Component
{
    public $package_id;
    public $payment_responsibility = 'merchant';
    public $payment_method = 'prepaid';
    public $collection_method = 'cash';

    public $delivery_fee = 0;
    public $insurance_fee = 0;
    public $service_fee = 0;

    public $paid_amount = 0;
    public $cod_amount = 0;

    public function mount($package_id)
    {
        $this->package_id = $package_id;
        $package = Package::findOrFail($this->package_id);

        $this->payment_responsibility = $package->payment_responsibility ?? 'merchant';
        $this->payment_method = $package->payment_method ?? 'prepaid';
        $this->collection_method = $package->collection_method ?? 'cash';
        $this->delivery_fee = $package->delivery_fee ?? 0;
        $this->insurance_fee = $package->insurance_fee ?? 0;
        $this->service_fee = $package->service_fee ?? 0;
        $this->paid_amount = $package->paid_amount ?? 0;
        $this->cod_amount = $package->cod_amount ?? 0;
    }

    public function render()
    {
        return view('livewire.admin.package.update-package-collection-component');
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
