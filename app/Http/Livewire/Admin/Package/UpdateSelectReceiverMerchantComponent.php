<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectReceiverMerchantComponent extends Component
{
    public $receiver_merchant_id = null;
    public $merchants = [];

    // الحقول التي سيتم تعبئتها تلقائيًا
    public $receiver_first_name = '';
    public $receiver_middle_name = '';
    public $receiver_last_name = '';
    public $receiver_email = '';
    public $receiver_phone = '';

    public function mount($receiver_merchant_id = null, $receiver_first_name = '', $receiver_middle_name = '', $receiver_last_name = '', $receiver_email = '', $receiver_phone = '')
    {
        $this->merchants = Merchant::all();
        $this->receiver_merchant_id = $receiver_merchant_id;

        // إذا كانت هناك بيانات موجودة مسبقًا، نعبي الحقول
        $this->receiver_first_name = $receiver_first_name;
        $this->receiver_middle_name = $receiver_middle_name;
        $this->receiver_last_name = $receiver_last_name;
        $this->receiver_email = $receiver_email;
        $this->receiver_phone = $receiver_phone;
    }

    public function updatedReceiverMerchantId($value)
    {
        if ($value) {
            $this->fillReceiverMerchantData($value);
        } else {
            // بدون تاجر
            $this->receiver_first_name = '';
            $this->receiver_middle_name = '';
            $this->receiver_last_name = '';
            $this->receiver_email = '';
            $this->receiver_phone = '';
        }

        $this->emit('receiverMerchantSelected', $this->receiver_merchant_id);
    }

    private function fillReceiverMerchantData($merchantId)
    {
        $merchant = Merchant::find($merchantId);
        if ($merchant) {
            $names = explode(' ', $merchant->contact_person);

            // الاسم الأول
            $this->receiver_first_name = $names[0] ?? '';

            // الاسم الأخير
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
    }

    public function render()
    {
        return view('livewire.admin.package.update-select-receiver-merchant-component');
    }
}
