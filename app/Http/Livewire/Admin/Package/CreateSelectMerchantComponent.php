<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class CreateSelectMerchantComponent extends Component
{
    public $merchant_id = null;
    public $merchants = [];

    public function mount()
    {
        $this->merchants = Merchant::all();
    }

    public function updatedMerchantId($value)
    {
        // نرسل الحدث مع القيمة للتعامل معه في الكومبوننت الآخر اختيار المنتجات
        $this->emit('merchantSelected', $this->merchant_id);
    }

    public function render()
    {
        return view('livewire.admin.package.create-select-merchant-component');
    }
}
