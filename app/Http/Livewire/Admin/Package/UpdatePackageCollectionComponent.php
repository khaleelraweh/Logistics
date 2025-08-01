<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Package;
use Livewire\Component;

class UpdatePackageCollectionComponent extends Component
{

    public $package_id;
    public $payment_responsibility = 'merchant';
    public $delivery_fee = 0;
    public $insurance_fee = 0;
    public $service_fee = 0;

    public $paid_amount = 0 ;
    public $cod_amount = 0;


    public function mount($package_id)
    {
        $this->package_id = $package_id;
        $package = Package::where('id', $this->package_id)->first();

        // Initialize videoLinks
        if ($package->payment_responsibility != null) {
            $this->payment_responsibility = $package->payment_responsibility;
        }
        if ($package->delivery_fee != null) {
            $this->delivery_fee = $package->delivery_fee;
        }
        if ($package->insurance_fee != null) {
            $this->insurance_fee = $package->insurance_fee;
        }
        if ($package->service_fee != null) {
            $this->service_fee = $package->service_fee;
        }
        if ($package->paid_amount != null) {
            $this->paid_amount = $package->paid_amount;
        }
        if ($package->cod_amount != null) {
            $this->cod_amount = $package->cod_amount;
        }


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
