<?php

namespace App\Http\Livewire\Merchant\Package;

use App\Models\Merchant;
use Livewire\Component;

class UpdateSelectMerchantComponent extends Component
{
    public $package;

    public $merchant_id = null;
    public $merchants = [];

    // بيانات التاجر
    public $sender_full_name = '';
    public $sender_email = '';
    public $sender_phone = '';
    public $merchant_name = '';

    public function mount($package)
    {
        $this->package = $package;

        // إذا كان الطرد يحتوي على merchant_id استخدمه، وإلا استخدم التاجر المرتبط بالمستخدم الحالي
        $merchant = $package->merchant ?? auth()->user()->merchant;

        if ($merchant) {
            $this->merchant_id = $merchant->id;

            // الاسم الكامل
            $this->sender_full_name = $merchant->contact_person ?? '';

            // البريد والهاتف
            $this->sender_email = $merchant->contact_person_email ?? $merchant->email;
            $this->sender_phone = $merchant->contact_person_phone ?? $merchant->phone;

            $this->merchant_name = $merchant->name ?? '';
        }

        // إذا كان الطرد يحتوي على بيانات قديمة للحقول، استخدمها كأولوية
        $this->sender_full_name = $package->sender_full_name ?? $this->sender_full_name;
        $this->sender_email = $package->sender_email ?? $this->sender_email;
        $this->sender_phone = $package->sender_phone ?? $this->sender_phone;

        $this->merchants = Merchant::all();
    }

    // تحديث البيانات عند تغيير التاجر
    public function updatedMerchantId($value)
    {
        if ($value) {
            $merchant = Merchant::find($value);
            if ($merchant) {
                $this->sender_full_name = $merchant->contact_person ?? '';
                $this->sender_email = $merchant->email ?? '';
                $this->sender_phone = $merchant->phone ?? '';
                $this->merchant_name = $merchant->name ?? '';
            }
        }
    }

    public function render()
    {
        return view('livewire.merchant.package.update-select-merchant-component');
    }
}
