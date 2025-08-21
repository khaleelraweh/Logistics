<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class CreateSelectMerchantComponent extends Component
{
    public $merchant_id = null;
    public $merchants = [];

    // الحقول التي سيتم تعبئتها تلقائيًا
    public $sender_first_name = '';
    public $sender_middle_name = '';
    public $sender_last_name = '';
    public $sender_email = '';
    public $sender_phone = '';

    public function mount()
    {
        $this->merchants = Merchant::all();
    }

    // تحديث الحقول عند اختيار التاجر
    public function updatedMerchantId($value)
    {
        if ($value) {
            $merchant = Merchant::find($value);

            if ($merchant) {
                $names = explode(' ', $merchant->name);
                $this->sender_first_name = $names[0] ?? '';
                $this->sender_middle_name = $names[1] ?? '';
                $this->sender_last_name = $names[2] ?? '';
                $this->sender_email = $merchant->email;
                $this->sender_phone = $merchant->phone;
            }
        } else {
            // بدون تاجر
            $this->sender_first_name = '';
            $this->sender_middle_name = '';
            $this->sender_last_name = '';
            $this->sender_email = '';
            $this->sender_phone = '';
        }

        // إرسال الحدث للكومبوننت الآخر إذا لزم الأمر
        $this->emit('merchantSelected', $this->merchant_id);
    }

    public function render()
    {
        return view('livewire.admin.package.create-select-merchant-component');
    }
}
