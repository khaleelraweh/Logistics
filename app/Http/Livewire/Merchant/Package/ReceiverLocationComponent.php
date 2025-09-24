<?php

namespace App\Http\Livewire\Merchant\Package;

use Livewire\Component;
use App\Models\Merchant;

class ReceiverLocationComponent extends Component
{
    public $receiver_merchant_id = null;

    // بيانات الموقع للمستقبل
    public $receiver_address = '';
    public $receiver_country = '';
    public $receiver_region = '';
    public $receiver_city = '';
    public $receiver_district = '';
    public $receiver_postal_code = '';

    public $latitude = '';
    public $longitude = '';

    // الموقع الافتراضي للخريطة
    public $defaultLatitude = 24.7136;
    public $defaultLongitude = 46.6753;

    protected $listeners = ['receiverMerchantSelected', 'refreshReceiverMap', 'setReceiverLocation'];

    public function mount()
    {
        // الحقول تبقى فارغة
        $this->latitude = '';
        $this->longitude = '';
    }

    // عند اختيار تاجر المستقبل
    public function receiverMerchantSelected($merchantId)
    {
        $this->receiver_merchant_id = $merchantId;

        if ($merchantId) {
            $merchant = Merchant::find($merchantId);
            if ($merchant) {
                $this->receiver_address = $merchant->address ?? '';
                $this->receiver_country = $merchant->country ?? '';
                $this->receiver_region = $merchant->region ?? '';
                $this->receiver_city = $merchant->city ?? '';
                $this->receiver_district = $merchant->district ?? '';
                $this->receiver_postal_code = $merchant->postal_code ?? '';

                if ($merchant->latitude && $merchant->longitude) {
                    $this->latitude = $merchant->latitude;
                    $this->longitude = $merchant->longitude;
                } else {
                    $this->latitude = '';
                    $this->longitude = '';
                }
            }
        } else {
            // بدون تاجر
            $this->receiver_address = '';
            $this->receiver_country = '';
            $this->receiver_region = '';
            $this->receiver_city = '';
            $this->receiver_district = '';
            $this->receiver_postal_code = '';
            $this->latitude = '';
            $this->longitude = '';
        }

        $this->emit('refreshReceiverMap');
    }

    // لتحديد الموقع يدويًا (GPS أو زر "موقعي")
    public function setReceiverLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;

        $this->emit('refreshReceiverMap');
    }

    public function refreshReceiverMap()
    {
        // مجرد مستمع لتحديث الخريطة
    }

    // إعادة رسم الخريطة عند الطلب
    public function refreshMap()
    {
        $this->emit('refreshReceiverMap');
        $this->dispatchBrowserEvent('mapInvalidateSize');
    }

    public function render()
    {
        return view('livewire.merchant.package.receiver-location-component');
    }
}
