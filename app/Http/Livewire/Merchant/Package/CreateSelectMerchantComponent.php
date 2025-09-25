<?php

namespace App\Http\Livewire\Merchant\Package;

use Livewire\Component;

class CreateSelectMerchantComponent extends Component
{
    public $merchant_id = null;

    // الحقول التي سيتم تعبئتها تلقائيًا
    public $sender_first_name = '';
    public $sender_middle_name = '';
    public $sender_last_name = '';
    public $sender_email = '';
    public $sender_phone = '';

    public function mount()
    {
        $merchant = auth()->user()->merchant;

        if ($merchant) {
            $this->merchant_id = $merchant->id;

            // تقسيم الاسم الكامل للمسؤول (contact_person_name)
            $names = explode(' ', $merchant->contact_person);
            $this->sender_first_name = $names[0] ?? '';
            $this->sender_last_name = end($names) ?? '';

            if (count($names) > 2) {
                $middleNames = array_slice($names, 1, count($names) - 2);
                $this->sender_middle_name = implode(' ', $middleNames);
            }

            // باقي البيانات
            $this->sender_email = $merchant->contact_person_email ?? $merchant->email;
            $this->sender_phone = $merchant->contact_person_phone ?? $merchant->phone;
        }
    }

    public function render()
    {
        return view('livewire.merchant.package.create-select-merchant-component');
    }
}
