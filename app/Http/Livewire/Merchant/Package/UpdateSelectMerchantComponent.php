<?php

namespace App\Http\Livewire\Merchant\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectMerchantComponent extends Component
{
    public $package;

    public $merchant_id = null;
    public $merchants = [];

    // الحقول التي سيتم تعبئتها تلقائيًا
    public $sender_first_name = '';
    public $sender_middle_name = '';
    public $sender_last_name = '';
    public $sender_email = '';
    public $sender_phone = '';

    public function mount($package)
    {
        $this->package = $package;
        $this->merchant_id = $package->merchant_id ? (int) $package->merchant_id : null;
        $this->merchants = Merchant::all();

        // تعبئة الحقول من قاعدة البيانات
        $this->sender_first_name = $package->sender_first_name;
        $this->sender_middle_name = $package->sender_middle_name;
        $this->sender_last_name = $package->sender_last_name;
        $this->sender_email = $package->sender_email;
        $this->sender_phone = $package->sender_phone;
    }

    public function updatedMerchantId($value)
    {
        if ($value) {
            $merchant = Merchant::find($value);
            if ($merchant) {
                $names = explode(' ', $merchant->contact_person);
                $this->sender_first_name = $names[0] ?? '';
                $this->sender_middle_name = count($names) > 2 ? implode(' ', array_slice($names, 1, count($names)-2)) : '';
                $this->sender_last_name = end($names) ?? '';
                $this->sender_email = $merchant->email;
                $this->sender_phone = $merchant->phone;
            }
        } else {
            // إذا تم مسح الاختيار
            $this->sender_first_name = '';
            $this->sender_middle_name = '';
            $this->sender_last_name = '';
            $this->sender_email = '';
            $this->sender_phone = '';
        }

        $this->emit('merchantSelected', $this->merchant_id);
    }

    public function render()
    {
        return view('livewire.merchant.package.update-select-merchant-component');
    }
}
