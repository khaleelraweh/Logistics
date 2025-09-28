@extends('layouts.driver')

@section('content')

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('delivery.edit_delivery') }}</h4>
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver.deliveries.index') }}">{{ __('delivery.manage_deliveries') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('delivery.edit_delivery') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h4 class="card-title mb-1">{{ __('delivery.delivery_info') }}</h4>
                        <p class="text-muted mb-0">{{ __('delivery.update_delivery_status') }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge bg-{{ $delivery->status_color }} fs-6">
                            {{ __('package.status_' . $delivery->status) }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('driver.deliveries.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Delivery Information Cards -->
                    <div class="row">
                        <!-- Receiver Information -->
                        <div class="col-lg-4">
                            <div class="card border-primary mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="ri-user-3-line me-2"></i>
                                        {{ __('package.receiver_info') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="ri-user-line text-primary fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}</h6>
                                            <small class="text-muted">{{ __('package.receiver_name') }}</small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="ri-phone-line text-success fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">
                                                <a href="tel:{{ $delivery->package->receiver_phone ?? '' }}" class="text-decoration-none">
                                                    {{ $delivery->package->receiver_phone ?? '' }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ __('package.receiver_phone') }}</small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="ri-mail-line text-info fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">
                                                <a href="mailto:{{ $delivery->package->receiver_email ?? '' }}" class="text-decoration-none">
                                                    {{ $delivery->package->receiver_email ?? '' }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ __('package.receiver_email') }}</small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="ri-map-pin-line text-danger fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $delivery->package->receiver_district ?? '' }}, {{ $delivery->package->receiver_city ?? '' }}</h6>
                                            <small class="text-muted">
                                                {{ $delivery->package->receiver_region ?? '' }}, {{ $delivery->package->receiver_country ?? '' }}
                                            </small>
                                            @if($delivery->package->receiver_postal_code)
                                            <div class="mt-1">
                                                <small class="text-muted">{{ __('package.postal_code') }}: {{ $delivery->package->receiver_postal_code }}</small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    @if($delivery->package->receiver_latitude && $delivery->package->receiver_longitude)
                                    <div class="text-center mt-3">
                                        <a href="https://maps.google.com/?q={{ $delivery->package->receiver_latitude }},{{ $delivery->package->receiver_longitude }}"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm w-100">
                                            <i class="ri-map-pin-line me-1"></i>
                                            {{ __('delivery.view_on_map') }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Package Information -->
                        <div class="col-lg-4">
                            <div class="card border-success mb-4">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="ri-package-line me-2"></i>
                                        {{ __('package.package_details') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="ri-barcode-line text-success fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">{{ $delivery->package->tracking_number ?? '' }}</h6>
                                            <small class="text-muted">{{ __('package.tracking_number') }}</small>
                                        </div>
                                    </div>

                                    @if($delivery->package->package_content)
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-shrink-0">
                                            <i class="ri-file-list-line text-info fs-4"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ $delivery->package->package_content }}</h6>
                                            <small class="text-muted">{{ __('package.content') }}</small>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <div class="border rounded p-2">
                                                <i class="ri-weight-line text-primary fs-4 d-block"></i>
                                                <small class="text-muted d-block">{{ __('package.weight') }}</small>
                                                <strong>{{ $delivery->package->weight ? $delivery->package->weight . ' جرام' : 'غير محدد' }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="border rounded p-2">
                                                <i class="ri-coupon-line text-warning fs-4 d-block"></i>
                                                <small class="text-muted d-block">{{ __('package.package_type') }}</small>
                                                <strong>{{ __('package.type_' . $delivery->package->package_type) }}</strong>
                                            </div>
                                        </div>
                                    </div>

                                    @if($delivery->package->cod_amount > 0)
                                    <div class="alert alert-warning mb-3 py-2">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-money-dollar-circle-line me-2 fs-5"></i>
                                            <div>
                                                <strong class="d-block">{{ __('package.cod_amount') }}</strong>
                                                <span class="fs-5">{{ number_format($delivery->package->cod_amount, 2) }} ر.س</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Special Attributes -->
                                    @php
                                        $defaultAttributes = [
                                            "is_fragile" => false, "is_returnable" => false, "is_confidential" => false,
                                            "is_express" => false, "is_cod" => false, "is_gift" => false,
                                            "is_oversized" => false, "is_hazardous_material" => false,
                                            "is_temperature_controlled" => false, "is_perishable" => false,
                                            "is_signature_required" => false, "is_inspection_required" => false,
                                            "is_special_handling_required" => false,
                                        ];

                                        $packageAttributes = is_array($delivery->package->attributes)
                                            ? $delivery->package->attributes
                                            : json_decode($delivery->package->attributes ?? '{}', true);

                                        $attrs = array_merge($defaultAttributes, $packageAttributes ?? []);
                                        $activeAttributes = array_filter($attrs, function($value) { return $value === true; });
                                    @endphp

                                    @if(count($activeAttributes) > 0)
                                    <div class="mt-3">
                                        <h6 class="text-muted mb-2">{{ __('delivery.special_instructions') }}:</h6>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($activeAttributes as $key => $value)
                                                @if($value === true)
                                                    <span class="badge bg-{{ [
                                                        'is_fragile' => 'warning',
                                                        'is_hazardous_material' => 'danger',
                                                        'is_confidential' => 'dark',
                                                        'is_temperature_controlled' => 'primary',
                                                        'is_perishable' => 'success',
                                                        'is_signature_required' => 'info',
                                                        'is_special_handling_required' => 'purple',
                                                        'is_express' => 'orange',
                                                        'is_cod' => 'indigo',
                                                        'is_gift' => 'pink',
                                                        'is_oversized' => 'teal'
                                                    ][$key] ?? 'secondary' }}">
                                                        {{ __('package.' . $key) }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Status Update Section -->
                        <div class="col-lg-4">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="card-title mb-0">
                                        <i class="ri-refresh-line me-2"></i>
                                        {{ __('delivery.update_status') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <!-- Current Driver -->
                                    <div class="mb-4">
                                        <label class="form-label text-muted small">{{ __('delivery.driver') }}</label>
                                        <div class="d-flex align-items-center">
                                            <i class="ri-user-line text-primary me-2"></i>
                                            <span class="fw-semibold">{{ $delivery->driver?->driver_full_name ?? __('driver.no_name') }}</span>
                                            <input type="hidden" name="driver_id" value="{{ $delivery->driver_id }}">
                                        </div>
                                    </div>

                                    <!-- Package Reference -->
                                    <div class="mb-4">
                                        <label class="form-label text-muted small">{{ __('delivery.package') }}</label>
                                        <div class="d-flex align-items-center">
                                            <i class="ri-package-line text-success me-2"></i>
                                            <span class="fw-semibold">
                                                {{ $delivery->package->tracking_number ?? '' }} -
                                                {{ $delivery->package->receiver_first_name ?? '' }}
                                            </span>
                                            <input type="hidden" name="package_id" value="{{ $delivery->package_id }}">
                                        </div>
                                    </div>

                                    <!-- Status Selection -->
                                    <div class="mb-4">
                                        <label for="status" class="form-label text-muted small">{{ __('package.status') }}</label>
                                        <select name="status" id="statuss" class="form-select form-select-lg">
                                            @foreach($delivery->availableStatusesForDriver() as $status)
                                                <option value="{{ $status }}" {{ old('status', $delivery->status) == $status ? 'selected' : '' }}>
                                                    {{ __('package.status_' . $status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Delivery Notes -->
                                    <div class="mb-4">
                                        <label for="note" class="form-label text-muted small">{{ __('general.note') }}</label>
                                        <textarea name="note" class="form-control" rows="4"
                                                  placeholder="{{ __('delivery.add_delivery_note_placeholder') }}">{{ old('note', $delivery->note) }}</textarea>
                                        @error('note')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-grid gap-2">
                                        @ability('driver', 'update_deliveries')
                                            <button type="submit" class="btn btn-warning btn-lg">
                                                <i class="ri-save-3-line me-2"></i>
                                                {{ __('delivery.update_delivery') }}
                                            </button>
                                        @endability

                                        <a href="{{ route('driver.deliveries.index') }}" class="btn btn-outline-secondary">
                                            <i class="ri-arrow-go-back-line me-1"></i>
                                            {{ __('panel.cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information (Collapsible) -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a class="d-flex align-items-center text-decoration-none" data-bs-toggle="collapse" href="#additionalInfo">
                                        <i class="ri-information-line me-2"></i>
                                        {{ __('package.additional_information') }}
                                        <i class="ri-arrow-down-s-line ms-auto"></i>
                                    </a>
                                </div>
                                <div class="collapse" id="additionalInfo">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Sender Information -->
                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-3">{{ __('package.sender_info') }}</h6>
                                                <div class="row">
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">{{ __('package.sender_name') }}</small>
                                                        <strong>{{ $delivery->package->sender_first_name ?? '' }} {{ $delivery->package->sender_last_name ?? '' }}</strong>
                                                    </div>
                                                    @if($delivery->package->sender_phone)
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">{{ __('package.sender_phone') }}</small>
                                                        <strong>
                                                            <a href="tel:{{ $delivery->package->sender_phone }}" class="text-decoration-none">
                                                                {{ $delivery->package->sender_phone }}
                                                            </a>
                                                        </strong>
                                                    </div>
                                                    @endif
                                                    @if($delivery->package->sender_city)
                                                    <div class="col-12 mb-2">
                                                        <small class="text-muted d-block">{{ __('package.sender_address') }}</small>
                                                        <strong>{{ $delivery->package->sender_city }}, {{ $delivery->package->sender_district }}</strong>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Package Details -->
                                            <div class="col-md-6">
                                                <h6 class="text-muted mb-3">{{ __('package.package_specifications') }}</h6>
                                                <div class="row">
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">{{ __('package.package_size') }}</small>
                                                        <strong>{{ __('package.size_' . $delivery->package->package_size) }}</strong>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <small class="text-muted d-block">{{ __('package.payment_method') }}</small>
                                                        <strong>{{ __('package.' . $delivery->package->payment_method) }}</strong>
                                                    </div>
                                                    @if($delivery->package->package_note)
                                                    <div class="col-12 mb-2">
                                                        <small class="text-muted d-block">{{ __('package.notes') }}</small>
                                                        <strong>{{ $delivery->package->package_note }}</strong>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid #e3e6f0;
}
.card-header {
    border-bottom: 1px solid #e3e6f0;
    font-weight: 600;
}
.badge {
    font-size: 0.75em;
}
.form-select-lg {
    font-size: 1rem;
    padding: 0.75rem 1rem;
}
.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}
</style>

@endsection
