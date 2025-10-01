@extends('layouts.driver')

@section('style')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #6f42c1;
        --success-color: #1cc88a;
        --info-color: #36b9cc;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --light-bg: #f8f9fc;
        --dark-color: #5a5c69;
    }

    body {
        background: linear-gradient(135deg, #f5f7fb 0%, #e3e6f0 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 0.5rem 2rem rgba(58, 59, 69, 0.2);
        color: white;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
    }

    .breadcrumb {
        margin-bottom: 0;
        background: transparent;
        padding: 0;
    }

    .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: white;
        transform: translateX(5px);
    }

    .breadcrumb-item.active {
        color: white;
        font-weight: 600;
    }

    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1.5rem rgba(58, 59, 69, 0.1);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 3rem rgba(58, 59, 69, 0.25);
    }

    .card-header {
        border-radius: 1rem 1rem 0 0 !important;
        padding: 1.25rem 2rem;
        font-weight: 700;
        border-bottom: 2px solid #e3e6f0;
        background: linear-gradient(135deg, #f8f9fc 0%, #eaecf4 100%);
        color: var(--dark-color);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 2rem;
    }

    .info-badge {
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
    }

    .detail-row {
        border-bottom: 1px solid #f0f0f0;
        padding: 1rem 0;
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-row:hover {
        background-color: #f8f9fc;
        border-radius: 0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
        margin: 0 -1rem;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        color: #6c757d;
        font-weight: 500;
        text-align: right;
    }

    #pickupMap {
        height: 400px;
        width: 100%;
        border-radius: 0.75rem;
        z-index: 1;
        box-shadow: 0 0.25rem 1rem rgba(58, 59, 69, 0.15);
        border: 2px solid #e3e6f0;
    }

    .map-container {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        margin-top: 1rem;
    }

    .status-badge {
        font-size: 0.9rem;
        padding: 0.6rem 1.2rem;
        border-radius: 0.5rem;
        font-weight: 700;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .icon-container {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        flex-shrink: 0;
        box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .icon-container:hover {
        transform: scale(1.1);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.2);
    }

    .merchant-icon {
        background: linear-gradient(135deg, var(--success-color), #17a673);
        color: white;
    }

    .driver-icon {
        background: linear-gradient(135deg, var(--info-color), #2a96a5);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-action {
        border-radius: 0.75rem;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 140px;
        justify-content: center;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.25);
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 1rem;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stats-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .timeline {
        position: relative;
        padding: 2rem 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
        border-radius: 3px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        padding-left: 70px;
    }

    .timeline-icon {
        position: absolute;
        left: 15px;
        top: 0;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.15);
    }

    .timeline-content {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary-color);
    }

    .custom-popup .leaflet-popup-content-wrapper {
        border-radius: 0.75rem;
        box-shadow: 0 1rem 3rem rgba(58, 59, 69, 0.3);
        border: 2px solid var(--primary-color);
    }

    .legend {
        padding: 1rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 0.75rem;
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 0.5rem;
        gap: 0.75rem;
    }

    .legend-item:hover {
        background: rgba(78, 115, 223, 0.1);
        transform: translateX(5px);
    }

    .legend-color {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.2);
        border: 2px solid white;
    }

    .marker-highlight {
        animation: pulse 2s infinite;
        filter: drop-shadow(0 0 10px currentColor);
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .floating-action {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
    }

    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .floating-btn:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 0.75rem 2rem rgba(0, 0, 0, 0.4);
    }

    .contact-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .contact-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: 0.75rem;
        border: 2px solid #e3e6f0;
        background: white;
        color: var(--dark-color);
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 600;
    }

    .contact-btn:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .icon-container {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .detail-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .detail-value {
            text-align: left;
        }

        .floating-action {
            bottom: 1rem;
            right: 1rem;
        }
    }

    /* تأثيرات جديدة */
    .glow-effect {
        box-shadow: 0 0 20px rgba(78, 115, 223, 0.3);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }

    .gradient-text {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

<style>
    .legend {
        padding: 0.5rem;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 0.5rem;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.15);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 0.75rem;
        max-width: 160px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    .legend h6 {
        font-size: 0.8rem;
        margin-bottom: 0.4rem;
        font-weight: 600;
        color: #5a5c69;
        text-align: center;
    }

    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
        padding: 0.25rem 0.4rem;
        border-radius: 0.25rem;
        gap: 0.4rem;
        font-size: 0.7rem;
    }

    .legend-item:hover {
        background: rgba(78, 115, 223, 0.1);
        transform: translateX(2px);
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.15);
        border: 2px solid white;
        flex-shrink: 0;
    }

    /* تأكد من أن الليجند يظهر فوق عناصر الخريطة الأخرى */
    .leaflet-bottom.leaflet-right {
        z-index: 1000;
    }

    .leaflet-control {
        z-index: 1001;
    }
</style>


@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h4 class="mb-3"><i class="fas fa-truck-loading me-3"></i>{{ __('pickup_request.view_pickup_request') }}</h4>
            <p class="mb-0 opacity-75">طلب #{{ $pickupRequest->id }} - {{ __('pickup_request.status_' . $pickupRequest->status) }}</p>
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-md-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('driver.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                    <li class="breadcrumb-item active">#{{ $pickupRequest->id }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <!-- معلومات الطلب -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card hover-lift">
            <div class="card-header">
                <i class="fas fa-clipboard-list me-3"></i>
                {{ __('pickup_request.request_info') }}
            </div>
            <div class="card-body">
                <div class="detail-row">
                    <span class="detail-label">
                        <i class="fas fa-store text-primary"></i>
                        {{ __('merchant.merchant') }}
                    </span>
                    <span class="detail-value">{{ $pickupRequest->merchant->name ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <i class="fas fa-tag text-warning"></i>
                        {{ __('pickup_request.status') }}
                    </span>
                    <span class="detail-value">
                        <span class="status-badge bg-{{ $pickupRequest->status_color }} text-white">
                            <i class="fas fa-{{ $pickupRequest->status_icon }} me-1"></i>
                            {{ __('pickup_request.status_' . $pickupRequest->status) }}
                        </span>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <i class="fas fa-sticky-note text-info"></i>
                        {{ __('pickup_request.note') }}
                    </span>
                    <span class="detail-value">{{ $pickupRequest->note ?? __('general.no_notes') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">
                        <i class="fas fa-clock text-success"></i>
                        {{ __('pickup_request.scheduled_at') }}
                    </span>
                    <span class="detail-value">{{ $pickupRequest->scheduled_at ? $pickupRequest->scheduled_at->format('Y-m-d h:i A') : '-' }}</span>
                </div>

                <!-- Timeline للتحديثات -->
                <div class="timeline mt-4">
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="timeline-content">
                            <strong>{{ __('general.created_at') }}</strong>
                            <p class="mb-0">{{ $pickupRequest->created_at->format('Y-m-d h:i A') }}</p>
                        </div>
                    </div>

                    @if($pickupRequest->accepted_at)
                    <div class="timeline-item">
                        <div class="timeline-icon" style="background: var(--success-color);">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <strong>{{ __('pickup_request.accepted_at') }}</strong>
                            <p class="mb-0">{{ $pickupRequest->accepted_at->format('Y-m-d h:i A') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($pickupRequest->completed_at)
                    <div class="timeline-item">
                        <div class="timeline-icon" style="background: var(--info-color);">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <div class="timeline-content">
                            <strong>{{ __('pickup_request.completed_at') }}</strong>
                            <p class="mb-0">{{ $pickupRequest->completed_at->format('Y-m-d h:i A') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- بيانات الموقع + الخريطة -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card hover-lift">
            <div class="card-header">
                <i class="fas fa-map-marked-alt me-3"></i>
                {{ __('pickup_request.location_info') }}
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-globe-americas text-primary"></i>
                                {{ __('general.country') }}
                            </div>
                            <div class="detail-value">{{ $pickupRequest->country ?? '-' }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-map text-success"></i>
                                {{ __('general.region') }}
                            </div>
                            <div class="detail-value">{{ $pickupRequest->region ?? '-' }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-city text-info"></i>
                                {{ __('general.city') }}
                            </div>
                            <div class="detail-value">{{ $pickupRequest->city ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-location-dot text-warning"></i>
                                {{ __('general.district') }}
                            </div>
                            <div class="detail-value">{{ $pickupRequest->district ?? '-' }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label">
                                <i class="fas fa-mail-bulk text-danger"></i>
                                {{ __('general.postal_code') }}
                            </div>
                            <div class="detail-value">{{ $pickupRequest->postal_code ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                @if($pickupRequest->latitude && $pickupRequest->longitude)
                <div class="map-container">
                    <div id="pickupMap"></div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-map-marker-alt fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">{{ __('pickup_request.no_location_available') }}</h5>
                    <p class="text-muted">{{ __('pickup_request.contact_merchant_for_location') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- التاجر والسائق -->
<div class="row">
    <!-- التاجر -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card hover-lift">
            <div class="card-header">
                <i class="fas fa-store me-3"></i>
                {{ __('merchant.merchant_info') }}
            </div>
            <div class="card-body">
                @if($pickupRequest->merchant)
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-container merchant-icon">
                            <i class="fas fa-store fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 gradient-text">{{ $pickupRequest->merchant->name }}</h5>
                            <p class="text-muted mb-0">{{ __('merchant.merchant') }}</p>
                        </div>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-phone text-primary"></i>
                            {{ __('merchant.phone') }}
                        </span>
                        <span class="detail-value">{{ $pickupRequest->merchant->phone }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-envelope text-success"></i>
                            {{ __('merchant.email') }}
                        </span>
                        <span class="detail-value">{{ $pickupRequest->merchant->email }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-user text-info"></i>
                            {{ __('merchant.contact_person') }}
                        </span>
                        <span class="detail-value">{{ $pickupRequest->merchant->contact_person ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">
                            <i class="fas fa-location-dot text-warning"></i>
                            {{ __('merchant.address') }}
                        </div>
                        <div class="detail-value">
                            {{ $pickupRequest->merchant->city ?? '-' }}, {{ $pickupRequest->merchant->region ?? '-' }}, {{ $pickupRequest->merchant->country ?? '-' }}
                        </div>
                    </div>

                    <!-- أزرار التواصل -->
                    <div class="contact-buttons">
                        @if($pickupRequest->merchant->phone)
                        <a href="tel:{{ $pickupRequest->merchant->phone }}" class="contact-btn">
                            <i class="fas fa-phone"></i>
                            {{ __('general.call') }}
                        </a>
                        @endif
                        @if($pickupRequest->merchant->email)
                        <a href="mailto:{{ $pickupRequest->merchant->email }}" class="contact-btn">
                            <i class="fas fa-envelope"></i>
                            {{ __('general.email') }}
                        </a>
                        @endif
                    </div>

                    @if($pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                        <div class="alert alert-success mt-3 mb-0 py-2 glow-effect">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ __('pickup_request.merchant_location_available') }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-store fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ __('pickup_request.no_merchant') }}</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- السائق -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card hover-lift">
            <div class="card-header">
                <i class="fas fa-user-tie me-3"></i>
                {{ __('driver.driver_info') }}
            </div>
            <div class="card-body">
                @if($pickupRequest->driver)
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-container driver-icon">
                            <i class="fas fa-user-tie fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 gradient-text">
                                {{ $pickupRequest->driver->first_name ?? '' }}
                                {{ $pickupRequest->driver->middle_name ?? '' }}
                                {{ $pickupRequest->driver->last_name ?? '' }}
                            </h5>
                            <p class="text-muted mb-0">{{ __('driver.driver') }}</p>
                        </div>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-phone text-primary"></i>
                            {{ __('driver.phone') }}
                        </span>
                        <span class="detail-value">{{ $pickupRequest->driver->phone ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-car text-success"></i>
                            {{ __('driver.vehicle_number') }}
                        </span>
                        <span class="detail-value">{{ $pickupRequest->driver->vehicle_number ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-truck text-info"></i>
                            {{ __('driver.vehicle_type') }}
                        </span>
                        <span class="detail-value">{{ __('driver.vehicle_type_' . $pickupRequest->driver->vehicle_type ) ?? '-' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-palette text-warning"></i>
                            {{ __('driver.vehicle_color') }}
                        </span>
                        <span class="detail-value">{{ __('driver.vehicle_color_' . $pickupRequest->driver->vehicle_color) ?? '-' }}</span>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-user-tie fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ __('pickup_request.no_driver_assigned') }}</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="floating-action">
    <button class="floating-btn" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

@endsection

@section('script')
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

@if($pickupRequest->latitude && $pickupRequest->longitude)
    <script>
        // تعريف المتغيرات العالمية
        let map;
        let markerReferences = {};

        document.addEventListener('DOMContentLoaded', function () {
            // إعداد الخريطة
            map = L.map('pickupMap').setView([{{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }}], 15);

            // إضافة خريطة OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // تعريف أيقونات مخصصة
            var pickupIcon = L.divIcon({
                html: '<div style="background: linear-gradient(135deg, #4e73df, #6f42c1); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white; box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.3); font-size: 1rem;"><i class="fas fa-box"></i></div>',
                className: 'custom-marker',
                iconSize: [35, 35],
                iconAnchor: [17, 17]
            });

            var merchantIcon = L.divIcon({
                html: '<div style="background: linear-gradient(135deg, #1cc88a, #17a673); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white; box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.3); font-size: 1rem;"><i class="fas fa-store"></i></div>',
                className: 'custom-marker',
                iconSize: [35, 35],
                iconAnchor: [17, 17]
            });

            var driverIcon = L.divIcon({
                html: '<div style="background: linear-gradient(135deg, #36b9cc, #2a96a5); width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white; box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.3); font-size: 1rem;"><i class="fas fa-car"></i></div>',
                className: 'custom-marker',
                iconSize: [35, 35],
                iconAnchor: [17, 17]
            });

            // مصفوفة لتخزين الماركرات
            var markers = [];
            markerReferences = {};

            // دبوس الطلب
            var pickupMarker = L.marker([{{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }}], {icon: pickupIcon})
                .addTo(map)
                .bindPopup(`
                    <div style="min-width: 200px;">
                        <h6 class="mb-2 text-primary"><i class="fas fa-box me-2"></i>{{ __('pickup_request.pickup_location') }}</h6>
                        <p class="mb-1"><strong>{{ $pickupRequest->merchant->name ?? __('general.unknown_merchant') }}</strong></p>
                        <p class="mb-2 text-muted small">
                            <i class="fas fa-location-dot me-1"></i>
                            {{ $pickupRequest->district ? $pickupRequest->district . ', ' : '' }}{{ $pickupRequest->city }}
                        </p>
                        <button class="btn btn-sm btn-primary w-100" onclick="navigateToLocation({{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }})">
                            <i class="fas fa-directions me-1"></i>{{ __('general.navigate') }}
                        </button>
                    </div>
                `);
            markers.push(pickupMarker);
            markerReferences['pickup'] = pickupMarker;

            // دبوس التاجر إذا كانت لديه إحداثيات
            @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                var merchantMarker = L.marker([{{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }}], {icon: merchantIcon})
                    .addTo(map)
                    .bindPopup(`
                        <div style="min-width: 200px;">
                            <h6 class="mb-2 text-success"><i class="fas fa-store me-2"></i>{{ __('merchant.merchant_location') }}</h6>
                            <p class="mb-1"><strong>{{ $pickupRequest->merchant->name }}</strong></p>
                            <p class="mb-2 text-muted small">
                                <i class="fas fa-phone me-1"></i>{{ $pickupRequest->merchant->phone }}
                            </p>
                            <button class="btn btn-sm btn-success w-100" onclick="navigateToLocation({{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }})">
                                <i class="fas fa-directions me-1"></i>{{ __('general.navigate') }}
                            </button>
                        </div>
                    `);
                markers.push(merchantMarker);
                markerReferences['merchant'] = merchantMarker;
            @endif

            // دبوس السائق إذا كانت لديه إحداثيات
            @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
                var driverMarker = L.marker([{{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }}], {icon: driverIcon})
                    .addTo(map)
                    .bindPopup(`
                        <div style="min-width: 200px;">
                            <h6 class="mb-2 text-info"><i class="fas fa-car me-2"></i>{{ __('driver.driver_location') }}</h6>
                            <p class="mb-1"><strong>{{ $pickupRequest->driver->first_name }} {{ $pickupRequest->driver->last_name }}</strong></p>
                            <p class="mb-2 text-muted small">
                                <i class="fas fa-phone me-1"></i>{{ $pickupRequest->driver->phone }}
                            </p>
                            <button class="btn btn-sm btn-info w-100" onclick="navigateToLocation({{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }})">
                                <i class="fas fa-directions me-1"></i>{{ __('general.navigate') }}
                            </button>
                        </div>
                    `);
                markers.push(driverMarker);
                markerReferences['driver'] = driverMarker;
            @endif

            // إضافة مقياس الخريطة
            L.control.scale({metric: true, imperial: false}).addTo(map);

            // إضافة دليل الخريطة في أقصى اليمين من الأسفل
            var legend = L.control({position: 'bottomright'});
            legend.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');

                var html = '<h6 class="mb-2" style="font-size: 0.8rem; font-weight: 600; color: #5a5c69;"><i class="fas fa-key me-1"></i>{{ __("general.map_legend") }}</h6>' +
                    '<div class="legend-item" onclick="focusOnMarker(\'pickup\')" style="font-size: 0.75rem; padding: 0.3rem 0.5rem; margin-bottom: 0.3rem; border-radius: 0.3rem;">' +
                    '<div class="legend-color" style="width: 12px; height: 12px; background: linear-gradient(135deg, #4e73df, #6f42c1); margin-left: 0.5rem; border: 2px solid white;"></div> <span style="color: #5a5c69;">{{ __("pickup_request.pickup_location") }}</span></div>';

                @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                    html += '<div class="legend-item" onclick="focusOnMarker(\'merchant\')" style="font-size: 0.75rem; padding: 0.3rem 0.5rem; margin-bottom: 0.3rem; border-radius: 0.3rem;">' +
                    '<div class="legend-color" style="width: 12px; height: 12px; background: linear-gradient(135deg, #1cc88a, #17a673); margin-left: 0.5rem; border: 2px solid white;"></div> <span style="color: #5a5c69;">{{ __("merchant.merchant") }}</span></div>';
                @endif

                @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
                    html += '<div class="legend-item" onclick="focusOnMarker(\'driver\')" style="font-size: 0.75rem; padding: 0.3rem 0.5rem; margin-bottom: 0.3rem; border-radius: 0.3rem;">' +
                    '<div class="legend-color" style="width: 12px; height: 12px; background: linear-gradient(135deg, #36b9cc, #2a96a5); margin-left: 0.5rem; border: 2px solid white;"></div> <span style="color: #5a5c69;">{{ __("driver.driver") }}</span></div>';
                @endif

                div.innerHTML = html;
                return div;
            };
            legend.addTo(map);

            // ضبط حدود الخريطة لتشمل جميع الماركرات
            if(markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            }

            // فتح popup تلقائيًا للموقع الرئيسي
            pickupMarker.openPopup();
        });

        // دالة للتركيز على الماركر المحدد
        function focusOnMarker(markerType) {
            if (markerReferences && markerReferences[markerType]) {
                // إزالة التأثير السابق من جميع الماركرات
                document.querySelectorAll('.custom-marker').forEach(function(el) {
                    el.classList.remove('marker-highlight');
                });

                // إضافة تأثير النبض للماركر المحدد
                var markerElement = markerReferences[markerType].getElement();
                if (markerElement) {
                    markerElement.classList.add('marker-highlight');

                    // إزالة التأثير بعد 3 ثوانٍ
                    setTimeout(function() {
                        markerElement.classList.remove('marker-highlight');
                    }, 3000);
                }

                // فتح البوب أب والتركيز على الماركر
                markerReferences[markerType].openPopup();
                map.setView(markerReferences[markerType].getLatLng(), 16);
            }
        }

        // دالة للتنقل إلى الموقع
        function navigateToLocation(lat, lng) {
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
            const url = isIOS ?
                `http://maps.apple.com/?daddr=${lat},${lng}` :
                `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;

            window.open(url, '_blank');
        }

        // دالة للتمرير إلى الأعلى
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
@endif

<script>
    // إضافة تأثيرات تفاعلية إضافية
    document.addEventListener('DOMContentLoaded', function() {
        // تأثيرات للبطاقات عند التمرير
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // تطبيق التأثير على جميع البطاقات
        document.querySelectorAll('.card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // إضافة تأثير للزر العائم
        const floatingBtn = document.querySelector('.floating-btn');
        if (floatingBtn) {
            floatingBtn.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1)';
            });

            floatingBtn.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        }
    });
</script>
@endsection
