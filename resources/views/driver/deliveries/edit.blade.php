@extends('layouts.driver')

@section('style')
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        --warning-gradient: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        --info-gradient: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    }

    .card-header-gradient {
        background: var(--primary-gradient);
        color: white;
        border: none;
    }

    .card-header-success {
        background: var(--success-gradient);
        color: white;
        border: none;
    }

    .card-header-warning {
        background: var(--warning-gradient);
        color: white;
        border: none;
    }

    .card-header-info {
        background: var(--info-gradient);
        color: white;
        border: none;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        padding: 0.75rem;
        border-radius: 10px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .info-item .icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.25rem;
    }

    .info-item .icon-primary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .info-item .icon-success {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .info-item .icon-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .info-item .icon-info {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }

    .info-item .icon-warning {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .info-content h6 {
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .info-content small {
        color: #6c757d;
        font-size: 0.8rem;
    }

    .status-badge-large {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
    }

    .attribute-badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        margin: 0.25rem;
        display: inline-block;
    }

    .map-button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .map-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .stats-card {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        border: 1px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .stats-card .icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stats-card .value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stats-card .label {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .form-control-lg-custom {
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
        border-radius: 10px;
        border: 2px solid #e3e6f0;
        transition: all 0.3s ease;
    }

    .form-control-lg-custom:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-update {
        background: var(--warning-gradient);
        border: none;
        border-radius: 10px;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
    }

    .collapse-section {
        border-radius: 10px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .collapse-header {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid #e3e6f0;
    }

    .collapse-header:hover {
        background: #e9ecef;
    }

    .collapse-header[aria-expanded="true"] {
        background: #667eea;
        color: white;
    }

    .package-avatar {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }

    @media (max-width: 768px) {
        .info-item {
            flex-direction: column;
            text-align: center;
        }

        .info-item .icon {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }

        .package-avatar {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }
</style>
@endsection

@section('content')

<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="package-avatar">
                    <i class="ri-truck-line"></i>
                </div>
                <div>
                    <h4 class="mb-0 font-size-18">{{ __('delivery.edit_delivery') }}</h4>
                    <p class="text-muted mb-0">{{ __('delivery.update_delivery_status') }}</p>
                </div>
            </div>
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
                <!-- Header Status -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div>
                                <h4 class="card-title mb-1">{{ __('delivery.delivery_info') }}</h4>
                                <p class="text-muted mb-0">#{{ $delivery->id }} - {{ $delivery->package->tracking_number ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="status-badge-large bg-{{ $delivery->status_color }}">
                            <i class="ri-checkbox-circle-line me-2"></i>
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
                            <div class="card mb-4">
                                <div class="card-header card-header-gradient">
                                    <h5 class="card-title mb-0">
                                        <i class="ri-user-3-line me-2"></i>
                                        {{ __('package.receiver_info') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <div class="icon icon-primary">
                                            <i class="ri-user-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>{{ $delivery->package->receiver_first_name ?? '' }} {{ $delivery->package->receiver_last_name ?? '' }}</h6>
                                            <small>{{ __('package.receiver_name') }}</small>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="icon icon-success">
                                            <i class="ri-phone-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>
                                                <a href="tel:{{ $delivery->package->receiver_phone ?? '' }}" class="text-decoration-none text-dark">
                                                    {{ $delivery->package->receiver_phone ?? '' }}
                                                </a>
                                            </h6>
                                            <small>{{ __('package.receiver_phone') }}</small>
                                        </div>
                                    </div>

                                    @if($delivery->package->receiver_email)
                                    <div class="info-item">
                                        <div class="icon icon-info">
                                            <i class="ri-mail-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>
                                                <a href="mailto:{{ $delivery->package->receiver_email ?? '' }}" class="text-decoration-none text-dark">
                                                    {{ $delivery->package->receiver_email ?? '' }}
                                                </a>
                                            </h6>
                                            <small>{{ __('package.receiver_email') }}</small>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="info-item">
                                        <div class="icon icon-danger">
                                            <i class="ri-map-pin-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>{{ $delivery->package->receiver_district ?? '' }}, {{ $delivery->package->receiver_city ?? '' }}</h6>
                                            <small>
                                                {{ $delivery->package->receiver_region ?? '' }}, {{ $delivery->package->receiver_country ?? '' }}
                                                @if($delivery->package->receiver_postal_code)
                                                <br>{{ __('package.postal_code') }}: {{ $delivery->package->receiver_postal_code }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>

                                    @if($delivery->package->receiver_latitude && $delivery->package->receiver_longitude)
                                    <div class="text-center mt-3">
                                        <a href="https://maps.google.com/?q={{ $delivery->package->receiver_latitude }},{{ $delivery->package->receiver_longitude }}"
                                           target="_blank"
                                           class="map-button w-100">
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
                            <div class="card mb-4">
                                <div class="card-header card-header-success">
                                    <h5 class="card-title mb-0">
                                        <i class="ri-package-line me-2"></i>
                                        {{ __('package.package_details') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="info-item">
                                        <div class="icon icon-success">
                                            <i class="ri-barcode-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>{{ $delivery->package->tracking_number ?? '' }}</h6>
                                            <small>{{ __('package.tracking_number') }}</small>
                                        </div>
                                    </div>

                                    @if($delivery->package->package_content)
                                    <div class="info-item">
                                        <div class="icon icon-info">
                                            <i class="ri-file-list-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>{{ Str::limit($delivery->package->package_content, 30) }}</h6>
                                            <small>{{ __('package.content') }}</small>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <div class="stats-card">
                                                <div class="icon text-primary">
                                                    <i class="ri-weight-line"></i>
                                                </div>
                                                <div class="value">{{ $delivery->package->weight ? $delivery->package->weight . 'g' : 'N/A' }}</div>
                                                <div class="label">{{ __('package.weight') }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stats-card">
                                                <div class="icon text-warning">
                                                    <i class="ri-coupon-line"></i>
                                                </div>
                                                <div class="value">{{ __('package.type_' . $delivery->package->package_type) }}</div>
                                                <div class="label">{{ __('package.package_type') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($delivery->package->cod_amount > 0)
                                    <div class="alert alert-warning mb-3 py-2 border-0" style="background: rgba(255, 193, 7, 0.1);">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-money-dollar-circle-line me-2 fs-5 text-warning"></i>
                                            <div>
                                                <strong class="d-block">{{ __('package.cod_amount') }}</strong>
                                                <span class="fs-5 text-dark">{{ number_format($delivery->package->cod_amount, 2) }} ر.س</span>
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

                                        $attributeColors = [
                                            'is_fragile' => 'warning',
                                            'is_hazardous_material' => 'danger',
                                            'is_confidential' => 'dark',
                                            'is_temperature_controlled' => 'primary',
                                            'is_perishable' => 'success',
                                            'is_signature_required' => 'info',
                                            'is_special_handling_required' => 'secondary',
                                            'is_express' => 'warning',
                                            'is_cod' => 'primary',
                                            'is_gift' => 'info',
                                            'is_oversized' => 'success'
                                        ];
                                    @endphp

                                    @if(count($activeAttributes) > 0)
                                    <div class="mt-3">
                                        <h6 class="text-muted mb-2">
                                            <i class="ri-information-line me-1"></i>
                                            {{ __('delivery.special_instructions') }}
                                        </h6>
                                        <div class="d-flex flex-wrap">
                                            @foreach($activeAttributes as $key => $value)
                                                @if($value === true)
                                                    <span class="attribute-badge bg-{{ $attributeColors[$key] ?? 'secondary' }} text-white">
                                                        <i class="ri-checkbox-circle-line me-1"></i>
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
                            <div class="card">
                                <div class="card-header card-header-warning">
                                    <h5 class="card-title mb-0">
                                        <i class="ri-refresh-line me-2"></i>
                                        {{ __('delivery.update_status') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <!-- Current Driver -->
                                    <div class="info-item mb-3">
                                        <div class="icon icon-primary">
                                            <i class="ri-user-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>{{ $delivery->driver?->driver_full_name ?? __('driver.no_name') }}</h6>
                                            <small>{{ __('delivery.driver') }}</small>
                                        </div>
                                        <input type="hidden" name="driver_id" value="{{ $delivery->driver_id }}">
                                    </div>

                                    <!-- Package Reference -->
                                    <div class="info-item mb-3">
                                        <div class="icon icon-success">
                                            <i class="ri-package-line"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>{{ $delivery->package->tracking_number ?? '' }}</h6>
                                            <small>{{ __('delivery.package') }}</small>
                                        </div>
                                        <input type="hidden" name="package_id" value="{{ $delivery->package_id }}">
                                    </div>

                                    <!-- Status Selection -->
                                    <div class="mb-4">
                                        <label for="status" class="form-label text-muted small">{{ __('package.status') }}</label>
                                        <select name="status" id="statuss" class="form-control-lg-custom w-100">
                                            @foreach($delivery->availableStatusesForDriver() as $status)
                                                <option value="{{ $status }}" {{ old('status', $delivery->status) == $status ? 'selected' : '' }}>
                                                    {{ __('package.status_' . $status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="text-danger small mt-1">
                                                <i class="ri-error-warning-line me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Delivery Notes -->
                                    <div class="mb-4">
                                        <label for="note" class="form-label text-muted small">{{ __('general.note') }}</label>
                                        <textarea name="note" class="form-control-lg-custom w-100" rows="4" style="resize: vertical;"
                                                placeholder="{{ __('delivery.add_delivery_note_placeholder') }}">{{ old('note', $delivery->note) }}</textarea>
                                        @error('note')
                                            <div class="text-danger small mt-1">
                                                <i class="ri-error-warning-line me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-grid gap-2">
                                        @ability('driver', 'update_deliveries')
                                            <button type="submit" class="btn-update w-100">
                                                <i class="ri-save-3-line me-2"></i>
                                                {{ __('delivery.update_delivery') }}
                                            </button>
                                        @endability

                                        <a href="{{ route('driver.deliveries.index') }}" class="btn btn-outline-secondary btn-lg w-100">
                                            <i class="ri-arrow-go-back-line me-1"></i>
                                            {{ __('panel.cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information (Collapsible) -->
                    <div class="collapse-section">
                        <div class="collapse-header d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#additionalInfo">
                            <i class="ri-information-line me-2"></i>
                            {{ __('package.additional_information') }}
                            <i class="ri-arrow-down-s-line ms-auto transition"></i>
                        </div>
                        <div class="collapse" id="additionalInfo">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Sender Information -->
                                    <div class="col-md-6">
                                        <h6 class="text-muted mb-3">
                                            <i class="ri-user-share-line me-2"></i>
                                            {{ __('package.sender_info') }}
                                        </h6>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="info-item">
                                                    <div class="icon icon-primary">
                                                        <i class="ri-user-line"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <h6>{{ $delivery->package->sender_first_name ?? '' }} {{ $delivery->package->sender_last_name ?? '' }}</h6>
                                                        <small>{{ __('package.sender_name') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($delivery->package->sender_phone)
                                            <div class="col-12 mb-3">
                                                <div class="info-item">
                                                    <div class="icon icon-success">
                                                        <i class="ri-phone-line"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <h6>
                                                            <a href="tel:{{ $delivery->package->sender_phone }}" class="text-decoration-none text-dark">
                                                                {{ $delivery->package->sender_phone }}
                                                            </a>
                                                        </h6>
                                                        <small>{{ __('package.sender_phone') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($delivery->package->sender_city)
                                            <div class="col-12">
                                                <div class="info-item">
                                                    <div class="icon icon-danger">
                                                        <i class="ri-map-pin-line"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <h6>{{ $delivery->package->sender_city }}, {{ $delivery->package->sender_district }}</h6>
                                                        <small>{{ __('package.sender_address') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Package Details -->
                                    <div class="col-md-6">
                                        <h6 class="text-muted mb-3">
                                            <i class="ri-file-list-line me-2"></i>
                                            {{ __('package.package_specifications') }}
                                        </h6>
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="info-item">
                                                    <div class="icon icon-info">
                                                        <i class="ri-ruler-line"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <h6>{{ __('package.size_' . $delivery->package->package_size) }}</h6>
                                                        <small>{{ __('package.package_size') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="info-item">
                                                    <div class="icon icon-warning">
                                                        <i class="ri-bank-card-line"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <h6>{{ __('package.' . $delivery->package->payment_method) }}</h6>
                                                        <small>{{ __('package.payment_method') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($delivery->package->package_note)
                                            <div class="col-12">
                                                <div class="info-item">
                                                    <div class="icon icon-secondary">
                                                        <i class="ri-sticky-note-line"></i>
                                                    </div>
                                                    <div class="info-content">
                                                        <h6>{{ $delivery->package->package_note }}</h6>
                                                        <small>{{ __('package.notes') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
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

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تحريك سلس للقسم القابل للطي
        const collapseHeader = document.querySelector('.collapse-header');
        const collapseIcon = document.querySelector('.collapse-header .ri-arrow-down-s-line');

        if (collapseHeader) {
            collapseHeader.addEventListener('click', function() {
                collapseIcon.classList.toggle('rotate-180');
            });
        }

        // تأثيرات تفاعلية للحقول
        const formControls = document.querySelectorAll('.form-control-lg-custom');
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            control.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });

        // تحريك سلس للعناصر
        const infoItems = document.querySelectorAll('.info-item');
        infoItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
    });
</script>
@endsection

@endsection
