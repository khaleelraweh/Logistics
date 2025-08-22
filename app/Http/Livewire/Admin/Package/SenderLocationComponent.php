<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;
use App\Models\Merchant;

class SenderLocationComponent extends Component
{
    public $merchant_id = null;

    // بيانات الموقع
    public $sender_address = '';
    public $sender_country = '';
    public $sender_region = '';
    public $sender_city = '';
    public $sender_district = '';
    public $sender_postal_code = '';
    public $sender_location = ''; // latitude,longitude

    protected $listeners = ['merchantSelected', 'refreshMapFromBlade'];

    public function mount()
    {
        // يمكن وضع قيم افتراضية لوسط الرياض
        if (!$this->sender_location) {
            $this->sender_location = '24.7136,46.6753';
        }
    }

    // عند اختيار تاجر
    public function merchantSelected($merchantId)
    {
        $this->merchant_id = $merchantId;

        if ($merchantId) {
            $merchant = Merchant::find($merchantId);
            if ($merchant) {
                $this->sender_address = $merchant->address ?? '';
                $this->sender_country = $merchant->country ?? '';
                $this->sender_region = $merchant->region ?? '';
                $this->sender_city = $merchant->city ?? '';
                $this->sender_district = $merchant->district ?? '';
                $this->sender_postal_code = $merchant->postal_code ?? '';
                if($merchant->latitude && $merchant->longitude){
                    $this->sender_location = $merchant->latitude . ',' . $merchant->longitude;
                }
            }
        } else {
            // بدون تاجر
            $this->sender_address = '';
            $this->sender_country = '';
            $this->sender_region = '';
            $this->sender_city = '';
            $this->sender_district = '';
            $this->sender_postal_code = '';
            $this->sender_location = '24.7136,46.6753';
        }

        $this->emit('refreshMap'); // لتحديث الخريطة
    }

    public function render()
    {
        return view('livewire.admin.package.sender-location-component');
    }
}
