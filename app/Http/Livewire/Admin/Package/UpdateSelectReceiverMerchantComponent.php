<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectReceiverMerchantComponent extends Component
{
    public $receiver_merchant_id = null;
    public $merchants = [];

    public $receiver_first_name = '';
    public $receiver_middle_name = '';
    public $receiver_last_name = '';
    public $receiver_email = '';
    public $receiver_phone = '';

    public function mount($receiver_merchant_id = null)
    {
        $this->receiver_merchant_id = $receiver_merchant_id;
        $this->merchants = Merchant::all();

        // إذا كان هناك تاجر محدد مسبقاً، املأ الحقول تلقائياً
        if ($this->receiver_merchant_id) {
            $this->fillReceiverFields($this->receiver_merchant_id);
        }
    }

    public function updatedReceiverMerchantId($value)
    {
        // عند تغيير التاجر، املأ الحقول تلقائياً
        $this->fillReceiverFields($value);

        // إرسال الحدث للكومبوننت الآخر
        $this->emit('receiverMerchantSelected', $this->receiver_merchant_id);
    }

    private function fillReceiverFields($merchantId)
    {
        if ($merchantId) {
            $merchant = Merchant::find($merchantId);

            if ($merchant) {
                $names = explode(' ', $merchant->contact_person);

                $this->receiver_first_name = $names[0] ?? '';
                $this->receiver_last_name = end($names) ?? '';

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
            // بدون تاجر
            $this->receiver_first_name = '';
            $this->receiver_middle_name = '';
            $this->receiver_last_name = '';
            $this->receiver_email = '';
            $this->receiver_phone = '';
        }
    }

    public function render()
    {
        return view('livewire.admin.package.update-select-receiver-merchant-component');
    }
}
