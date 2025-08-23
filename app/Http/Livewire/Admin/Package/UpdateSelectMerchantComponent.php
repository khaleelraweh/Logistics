<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectMerchantComponent extends Component
{
    public $merchant_id = null;
    public $merchants = [];

    // الحقول التي سيتم تعبئتها تلقائيًا
    public $sender_first_name = '';
    public $sender_middle_name = '';
    public $sender_last_name = '';
    public $sender_email = '';
    public $sender_phone = '';

    public function mount($merchant_id)
    {
        $this->merchant_id = $merchant_id;
        $this->merchants = Merchant::all();

        // إذا كان هناك تاجر محدد مسبقًا، نعبي الحقول تلقائيًا
        if ($this->merchant_id) {
            $this->fillMerchantData($this->merchant_id);
        }
    }

    public function updatedMerchantId($value)
    {
        if ($value) {
            $this->fillMerchantData($value);
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

    private function fillMerchantData($merchantId)
    {
        $merchant = Merchant::find($merchantId);
        if ($merchant) {
            $names = explode(' ', $merchant->contact_person);


            // الاسم الأول
            $this->sender_first_name = $names[0] ?? '';

            // الاسم الأخير
            $this->sender_last_name = end($names) ?? '';

            // الاسم الأوسط هو كل العناصر بين الأول والأخير
            if (count($names) > 2) {
                $middleNames = array_slice($names, 1, count($names) - 2);
                $this->sender_middle_name = implode(' ', $middleNames);
            } else {
                $this->sender_middle_name = '';
            }

            $this->sender_email = $merchant->email;
            $this->sender_phone = $merchant->phone;
        }
    }

    public function render()
    {
        return view('livewire.admin.package.update-select-merchant-component');
    }
}
