<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectMerchantComponent extends Component
{
    public $merchant_id = null;
    public $merchants = [];

    public function mount($merchant_id)
    {
        $this->merchant_id = $merchant_id;
        $this->merchants = Merchant::all();

    }

    public function updatedMerchantId($value)
    {
        // نرسل الحدث مع القيمة للتعامل معه في الكومبوننت الآخر
        $this->emit('merchantSelected', $this->merchant_id);
    }


    public function render()
    {
        return view('livewire.admin.package.update-select-merchant-component');
    }
}
