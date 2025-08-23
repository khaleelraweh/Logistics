<?php

namespace App\Http\Livewire\Admin\Package;

use Livewire\Component;
use App\Models\Merchant;

class UpdateReceiverLocationComponent extends Component
{
    public $package; // إضافة لإحضار بيانات الباكيج عند التعديل
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

    public function mount($package = null)
    {
        $this->package = $package;

        if ($package) {
            // تعبئة الحقول من قاعدة البيانات
            $this->receiver_merchant_id = $package->receiver_merchant_id ? (int)$package->receiver_merchant_id : null;
            $this->receiver_address = $package->receiver_address ?? '';
            $this->receiver_country = $package->receiver_country ?? '';
            $this->receiver_region = $package->receiver_region ?? '';
            $this->receiver_city = $package->receiver_city ?? '';
            $this->receiver_district = $package->receiver_district ?? '';
            $this->receiver_postal_code = $package->receiver_postal_code ?? '';
            $this->latitude = $package->receiver_latitude ?? '';
            $this->longitude = $package->receiver_longitude ?? '';
        } else {
            // بدون باكيج (صفحة create)
            $this->latitude = '';
            $this->longitude = '';
        }
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
                $this->latitude = $merchant->latitude ?? '';
                $this->longitude = $merchant->longitude ?? '';
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

    public function render()
    {
        return view('livewire.admin.package.update-receiver-location-component');
    }
}

