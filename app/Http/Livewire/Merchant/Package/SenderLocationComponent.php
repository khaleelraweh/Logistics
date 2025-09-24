<?php

namespace App\Http\Livewire\Merchant\Package;

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

    public $latitude = '';
    public $longitude = '';

    // الموقع الافتراضي للخريطة
    public $defaultLatitude = 24.7136;
    public $defaultLongitude = 46.6753;

    protected $listeners = ['merchantSelected', 'refreshMapFromBlade', 'setMyLocation'];

    public function mount()
    {
        // الحقول تبقى فارغة عند عدم وجود بيانات مسبقة
        $this->latitude = '';
        $this->longitude = '';
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
            $this->sender_address = '';
            $this->sender_country = '';
            $this->sender_region = '';
            $this->sender_city = '';
            $this->sender_district = '';
            $this->sender_postal_code = '';
            $this->latitude = '';
            $this->longitude = '';
        }

        $this->emit('refreshMap'); // لتحديث الخريطة
    }

    // استدعاء عند الضغط على "تحديد موقعي الحالي"
    public function setMyLocation($lat, $lng)
    {
        $this->latitude = $lat;
        $this->longitude = $lng;

        $this->emit('refreshMap'); // تحديث الخريطة بعد تغيير الموقع
    }

    // إعادة رسم الخريطة عند الطلب
    public function refreshMap()
    {
        $this->emit('refreshMap');
        $this->dispatchBrowserEvent('mapInvalidateSize');
    }

    public function render()
    {
        return view('livewire.merchant.package.sender-location-component');
    }
}
