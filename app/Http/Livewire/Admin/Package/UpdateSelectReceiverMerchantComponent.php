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

    public function mount($receiver_merchant_id)
    {
        $this->receiver_merchant_id = $receiver_merchant_id;
        $this->merchants = Merchant::all();

        // إذا كان هناك تاجر محدد مسبقًا، نعبي الحقول تلقائيًا
        if ($this->receiver_merchant_id) {
            $this->fillReceiverMerchantData($this->receiver_merchant_id);
        }
    }

    public function updatedReceiverreceiverM($value)
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

        // إرسال الحدث للكومبوننت الآخر إذا لزم الأمر
        $this->emit('merchantSelected', $this->receiver_merchant_id);
    }

    private function fillReceiverMerchantData($receiverMerchantId)
    {
        $receiver_merchant = Merchant::find($receiverMerchantId);
        if ($receiver_merchant) {
            $names = explode(' ', $receiver_merchant->contact_person);


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

            $this->receiver_email = $receiver_merchant->email;
            $this->receiver_phone = $receiver_merchant->phone;
        }
    }

    public function render()
    {
        return view('livewire.admin.package.update-select-receiver-merchant-component');
    }
}
