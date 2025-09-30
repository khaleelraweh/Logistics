<?php

namespace App\Http\Livewire\Driver\Package;

use Livewire\Component;

class CreateSelectMerchantComponent extends Component
{
    public $merchant_id = null;

    // بيانات التاجر
    public $sender_full_name = '';
    public $sender_email = '';
    public $sender_phone = '';
    public $merchant_name = '';

    public function mount()
    {
        $merchant = auth()->user()->merchant;

        if ($merchant) {
            $this->merchant_id = $merchant->id;

            // تجميع الاسم بالكامل من contact_person
            $this->sender_full_name = $merchant->contact_person ?? '';

            // البريد والهاتف
            $this->sender_email = $merchant->contact_person_email ?? $merchant->email;
            $this->sender_phone = $merchant->contact_person_phone ?? $merchant->phone;

            $this->merchant_name = $merchant->name ?? '';
        }
    }

    public function render()
    {
        return view('livewire.driver.package.create-select-merchant-component');
    }
}
