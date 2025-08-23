<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class CreateSelectReceiverMerchantComponent extends Component
{
    public $receiver_merchant_id = null;
    public $merchants = [];

    public $receiver_first_name = '';
    public $receiver_middle_name = '';
    public $receiver_last_name = '';
    public $receiver_email = '';
    public $receiver_phone = '';

    public function mount()
    {
        $this->merchants = Merchant::all();
    }

    public function updatedReceiverMerchantId($value)
    {
        if ($value) {
            $merchant = Merchant::find($value);

            if ($merchant) {
                $names = explode(' ', $merchant->contact_person);
                $this->receiver_first_name = $names[0] ?? '';
                // $this->receiver_middle_name = $names[1] ?? '';

                // $this->receiver_last_name = $names[2] ?? '';
                $this->receiver_last_name = end($names) ?? '';

                // الاسم الأوسط هو كل العناصر بين الأول والأخير
                if (count($names) > 2) {
                    $middleNames = array_slice($names, 1, count($names) - 2);
                    $this->receiver_middle_name = implode(' ', $middleNames);
                } else {
                    $this->receiver_middle_name = '';
                }

                $this->receiver_email = $merchant->email;
                $this->receiver_phone = $merchant->phone;
            }
        } else {
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
        return view('livewire.admin.package.create-select-receiver-merchant-component');
    }
}
