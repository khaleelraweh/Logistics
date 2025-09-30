{{-- resources/views/driver/return_requests/partials/receiver-info.blade.php --}}
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="info-label">{{ __('general.full_name') }}</div>
        <div class="info-value fw-semibold">{{ $package->receiver_full_name }}</div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="info-label">{{ __('general.phone') }}</div>
        <div class="info-value">
            <i class="mdi mdi-phone-outline me-2"></i>
            +{{ $package->receiver_phone }}
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="info-label">{{ __('general.email') }}</div>
        <div class="info-value">
            <i class="mdi mdi-email-outline me-2"></i>
            {{ $package->receiver_email ?? '-' }}
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="info-label">{{ __('general.address') }}</div>
        @php
            $receiverAddressParts = array_filter([
                $package->receiver_district,
                $package->receiver_city,
                $package->receiver_region,
                $package->receiver_country,
                $package->receiver_postal_code,
            ]);
            $fullReceiverAddress = implode(' ، ', $receiverAddressParts);
        @endphp
        <div class="info-value">
            <i class="mdi mdi-map-marker-outline me-2"></i>
            {{ $fullReceiverAddress }}
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="info-label">{{ __('general.city') }}</div>
        <div class="info-value">{{ $package->receiver_city }}</div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="info-label">{{ __('general.region') }}</div>
        <div class="info-value">{{ $package->receiver_region }}</div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="info-label">{{ __('general.country') }}</div>
        <div class="info-value">{{ $package->receiver_country }}</div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="info-label">{{ __('general.latitude') }}</div>
        <div class="info-value coordinates">{{ $package->receiver_latitude }}</div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="info-label">{{ __('general.longitude') }}</div>
        <div class="info-value coordinates">{{ $package->receiver_longitude }}</div>
    </div>
    @if($package->receiver_notes)
    <div class="col-12 mt-3">
        <div class="alert alert-light border">
            <div class="info-label">{{ __('general.notes') }}</div>
            <div class="info-value">{{ $package->receiver_notes }}</div>
        </div>
    </div>
    @endif
</div>
