<?php

namespace App\Http\Livewire\Driver\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectReceiverMerchantComponent extends Component
{
    public $package;

    public $receiver_merchant_id = null;
    public $merchants = [];

    public $receiver_first_name = '';
    public $receiver_middle_name = '';
    public $receiver_last_name = '';
    public $receiver_email = '';
    public $receiver_phone = '';

    public function mount($package)
    {
        $this->package = $package;
        $this->receiver_merchant_id = $package->receiver_merchant_id ? (int) $package->receiver_merchant_id : null;
        $this->merchants = Merchant::all();

        // تعبئة الحقول من قاعدة البيانات
        $this->receiver_first_name = $package->receiver_first_name;
        $this->receiver_middle_name = $package->receiver_middle_name;
        $this->receiver_last_name = $package->receiver_last_name;
        $this->receiver_email = $package->receiver_email;
        $this->receiver_phone = $package->receiver_phone;
    }

    public function updatedReceiverMerchantId($value)
    {
        if ($value) {
            $merchant = Merchant::find($value);
            if ($merchant) {
                $names = explode(' ', $merchant->contact_person);
                $this->receiver_first_name = $names[0] ?? '';
                $this->receiver_middle_name = count($names) > 2 ? implode(' ', array_slice($names, 1, count($names)-2)) : '';
                $this->receiver_last_name = end($names) ?? '';
                $this->receiver_email = $merchant->email;
                $this->receiver_phone = $merchant->phone;
            }
        } else {
            // إذا تم مسح الاختيار
            $this->receiver_first_name = '';
            $this->receiver_middle_name = '';
            $this->receiver_last_name = '';
            $this->receiver_email = '';
            $this->receiver_phone = '';
        }

        $this->emit('receiverMerchantSelected', $this->receiver_merchant_id);
    }

    public function render()
    {
        return view('livewire.driver.package.update-select-receiver-merchant-component');
    }
}

