@extends('layouts.driver')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('pickup_request.edit_pickup_request') }}</h4>

            <!-- Breadcrumb محسن -->
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}" class="text-muted">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver.pickup_requests.index') }}" class="text-muted">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                        <li class="breadcrumb-item active text-primary fw-semibold">#{{ $pickupRequest->id }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                            <i class="bi bi-clipboard-data text-primary fs-5"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ __('pickup_request.request_details') }}</h5>
                            <small class="text-muted">#{{ $pickupRequest->id }}</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $pickupRequest->created_at->format('Y-m-d') }}
                        </span>

                        <span class="badge bg-{{ $pickupRequest->status_color }} text-white">
                            <i class="bi bi-{{ $pickupRequest->status_icon }} me-1"></i>
                            {{ __('pickup_request.status_' . $pickupRequest->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('driver.pickup_requests.update', $pickupRequest->id) }}" method="POST" id="statusForm">
                    @csrf
                    @method('PUT')

                    <!-- الحقول المخفية -->
                    <input type="hidden" name="merchant_id" value="{{ $pickupRequest->merchant_id }}">
                    <input type="hidden" name="driver_id" value="{{ $pickupRequest->driver_id }}">
                    <input type="hidden" name="country" value="{{ $pickupRequest->country }}">
                    <input type="hidden" name="region" value="{{ $pickupRequest->region }}">
                    <input type="hidden" name="city" value="{{ $pickupRequest->city }}">
                    <input type="hidden" name="district" value="{{ $pickupRequest->district }}">
                    <input type="hidden" name="postal_code" value="{{ $pickupRequest->postal_code }}">
                    <input type="hidden" name="latitude" value="{{ $pickupRequest->latitude ?? '' }}">
                    <input type="hidden" name="longitude" value="{{ $pickupRequest->longitude ?? '' }}">
                    <input type="hidden" name="scheduled_at" value="{{ $pickupRequest->scheduled_at }}">
                    <input type="hidden" name="note" value="{{ $pickupRequest->note }}">

                    <div class="row">
                        <!-- العمود الأيسر: معلومات الطلب -->
                        <div class="col-lg-8">
                            <!-- معلومات التاجر -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h6 class="mb-0 d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded me-2">
                                            <i class="bi bi-building text-primary"></i>
                                        </div>
                                        {{ __('merchant.merchant_info') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label text-muted small mb-2">{{ __('merchant.name') }}</label>
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-person-circle text-primary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $pickupRequest->merchant->name ?? __('general.not_found') }}</h6>
                                                    @if($pickupRequest->merchant)
                                                        <small class="text-muted">{{ $pickupRequest->merchant->email }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label text-muted small mb-2">{{ __('general.phone') }}</label>
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-telephone text-success"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $pickupRequest->merchant->phone ?? __('general.not_available') }}</h6>
                                                    <small class="text-muted">{{ __('merchant.contact_number') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- أزرار التواصل -->
                                    @if($pickupRequest->merchant && ($pickupRequest->merchant->phone || $pickupRequest->merchant->email))
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="d-flex gap-2">
                                                @if($pickupRequest->merchant->phone)
                                                <a href="tel:{{ $pickupRequest->merchant->phone }}" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                                    <i class="bi bi-telephone me-2"></i>
                                                    {{ __('general.call') }}
                                                </a>
                                                @endif
                                                @if($pickupRequest->merchant->email)
                                                <a href="mailto:{{ $pickupRequest->merchant->email }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                                    <i class="bi bi-envelope me-2"></i>
                                                    {{ __('general.email') }}
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- الموقع والخرائط -->
                            <div class="card mb-4 border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h6 class="mb-0 d-flex align-items-center">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded me-2">
                                            <i class="bi bi-geo-alt text-danger"></i>
                                        </div>
                                        {{ __('general.location_details') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- العنوان -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-2">{{ __('general.address') }}</label>
                                            <div class="d-flex align-items-start p-3 bg-light rounded">
                                                <div class="bg-info bg-opacity-10 p-2 rounded me-3 mt-1">
                                                    <i class="bi bi-geo text-info"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1 fs-6 fw-semibold">
                                                        @if($pickupRequest->country || $pickupRequest->region || $pickupRequest->city || $pickupRequest->district)
                                                            {{ implode(' • ', array_filter([$pickupRequest->district, $pickupRequest->city, $pickupRequest->region, $pickupRequest->country])) }}
                                                        @else
                                                            <span class="text-muted">{{ __('general.no_address_provided') }}</span>
                                                        @endif
                                                    </p>
                                                    @if($pickupRequest->postal_code)
                                                        <small class="text-muted">
                                                            <i class="bi bi-postcard me-1"></i>
                                                            {{ __('general.postal_code') }}: {{ $pickupRequest->postal_code }}
                                                        </small>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-outline-primary btn-sm" id="copyAddress">
                                                    <i class="bi bi-clipboard"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- الخريطة -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <label class="form-label text-muted small mb-0">{{ __('general.location_on_map') }}</label>
                                                @if($pickupRequest->latitude && $pickupRequest->longitude)
                                                <button type="button" class="btn btn-outline-secondary btn-sm" id="openInMaps">
                                                    <i class="bi bi-compass me-1"></i>
                                                    {{ __('general.open_in_maps') }}
                                                </button>
                                                @endif
                                            </div>
                                            <div id="map-container" class="border rounded overflow-hidden">
                                                <div id="map" style="width: 100%; height: 300px;"></div>
                                                @if(!$pickupRequest->latitude || !$pickupRequest->longitude)
                                                    <div class="alert alert-warning m-3 text-center">
                                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                                        {{ __('general.location_not_available') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- المعلومات الإضافية -->
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-transparent border-bottom py-3">
                                    <h6 class="mb-0 d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 p-2 rounded me-2">
                                            <i class="bi bi-info-circle text-info"></i>
                                        </div>
                                        {{ __('general.additional_info') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if($pickupRequest->scheduled_at)
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label text-muted small mb-2">{{ __('pickup_request.scheduled_at') }}</label>
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="bg-warning bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-calendar-check text-warning"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ \Carbon\Carbon::parse($pickupRequest->scheduled_at)->format('Y-m-d') }}</h6>
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($pickupRequest->scheduled_at)->format('H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label text-muted small mb-2">{{ __('general.created_at') }}</label>
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="bg-secondary bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-clock text-secondary"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $pickupRequest->created_at->format('Y-m-d') }}</h6>
                                                    <small class="text-muted">{{ $pickupRequest->created_at->format('H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        @if($pickupRequest->note)
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-2">{{ __('delivery.note') }}</label>
                                            <div class="border rounded p-3 bg-light">
                                                <div class="d-flex align-items-start">
                                                    <i class="bi bi-chat-left-text me-2 text-muted mt-1"></i>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0">{{ $pickupRequest->note }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- العمود الأيمن: تحديث الحالة -->
                        <div class="col-lg-4">
                            <div class="card border-primary shadow">
                                <div class="card-header bg-primary text-white py-3">
                                    <h6 class="mb-0 d-flex align-items-center">
                                        <i class="bi bi-arrow-repeat me-2 fs-5"></i>
                                        {{ __('pickup_request.update_status') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- الحالة الحالية -->
                                    <div class="mb-4 text-center">
                                        <label class="form-label text-muted small mb-2">{{ __('general.current_status') }}</label>
                                        <div class="status-badge-lg bg-{{ $pickupRequest->status_color }} text-white py-2 rounded shadow-sm">
                                            <i class="bi bi-{{ $pickupRequest->status_icon }} me-2"></i>
                                            {{ __('pickup_request.status_' . $pickupRequest->status) }}
                                        </div>
                                    </div>

                                    <!-- تحديث الحالة -->
                                    <div class="mb-4">
                                        <label for="status1" class="form-label text-dark fw-semibold">
                                            <i class="bi bi-pencil-square me-1"></i>
                                            {{ __('pickup_request.change_status') }}
                                        </label>
                                        <select name="status" class="form-select form-select-lg @error('status') is-invalid @enderror" id="status1" required>
                                            <option value="">{{ __('pickup_request.select_status') }}</option>
                                            @foreach($pickupRequest->availableStatusesForDriver() as $status)
                                                <option value="{{ $status }}"
                                                    {{ old('status', $pickupRequest->status) == $status ? 'selected' : '' }}
                                                    data-description="{{ __('pickup_request.status_description_' . $status) }}">
                                                    {{ __('pickup_request.status_' . $status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <!-- وصف الحالة -->
                                        <div id="statusDescription" class="mt-2 p-2 bg-light rounded small text-muted" style="display: none;"></div>
                                    </div>

                                    <!-- معلومات التوجيه -->
                                    <div class="alert alert-info border-0 bg-light">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-info-circle text-info fs-5"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <small class="d-block fw-semibold text-dark">{{ __('pickup_request.important_note') }}</small>
                                                <small class="text-muted">{{ __('pickup_request.status_change_instruction') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- أزرار التنفيذ -->
                                    <div class="d-grid gap-2">
                                        @ability('driver', 'update_pickup_requests')
                                            <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center justify-content-center py-2 shadow-sm">
                                                <i class="bi bi-check2-circle me-2 fs-5"></i>
                                                {{ __('pickup_request.confirm_update') }}
                                            </button>
                                        @endability

                                        <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center py-2">
                                            <i class="bi bi-arrow-left me-2"></i>
                                            {{ __('general.back_to_list') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- معلومات سريعة -->
                            <div class="card border-0 bg-gradient-light mt-3 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title text-dark mb-3 d-flex align-items-center">
                                        <i class="bi bi-lightbulb me-2 text-warning fs-5"></i>
                                        {{ __('general.quick_tips') }}
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2 p-2 rounded hover-light">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-check-circle me-2 text-success"></i>
                                                {{ __('pickup_request.tip_accept') }}
                                            </small>
                                        </li>
                                        <li class="mb-2 p-2 rounded hover-light">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-check2-square me-2 text-primary"></i>
                                                {{ __('pickup_request.tip_complete') }}
                                            </small>
                                        </li>
                                        <li class="p-2 rounded hover-light">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-exclamation-triangle me-2 text-warning"></i>
                                                {{ __('pickup_request.tip_cancel') }}
                                            </small>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- إحصائيات سريعة -->
                            <div class="card border-0 bg-light mt-3 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-title text-dark mb-3 d-flex align-items-center">
                                        <i class="bi bi-speedometer2 me-2 text-primary fs-5"></i>
                                        {{ __('general.quick_stats') }}
                                    </h6>
                                    <div class="row text-center">
                                        <div class="col-6 mb-2">
                                            <div class="p-2 bg-white rounded">
                                                <small class="text-muted d-block">{{ __('general.request_id') }}</small>
                                                <strong class="text-primary">#{{ $pickupRequest->id }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="p-2 bg-white rounded">
                                                <small class="text-muted d-block">{{ __('general.duration') }}</small>
                                                <strong class="text-info">{{ $pickupRequest->created_at->diffForHumans() }}</strong>
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
@endsection

@section('script')
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.status-badge-lg {
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}
.card {
    box-shadow: 0 0.15rem 1rem rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.card:hover {
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
}
.hover-light:hover {
    background-color: rgba(0, 0, 0, 0.02);
}
.bg-gradient-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
.pickup-marker {
    background: transparent;
    border: none;
}
.legend {
    background: white;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // تهيئة الخريطة
    initializeMap();

    // إضافة التفاعلات
    initializeInteractions();

    // إدارة حالة النموذج
    initializeFormManagement();

    function initializeMap() {
        const initialLat = {{ $pickupRequest->latitude ?: 'null' }};
        const initialLng = {{ $pickupRequest->longitude ?: 'null' }};

        if (initialLat && initialLng) {
            const map = L.map('map').setView([initialLat, initialLng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // أيقونة مخصصة مع تأثير
            const pickupIcon = L.divIcon({
                html: '<div class="text-danger"><i class="bi bi-geo-alt-fill fs-3 shadow"></i><div class="pulse-effect"></div></div>',
                iconSize: [30, 30],
                className: 'pickup-marker'
            });

            const marker = L.marker([initialLat, initialLng], {
                icon: pickupIcon,
                riseOnHover: true
            }).addTo(map);

            // Popup تفاعلي
            marker.bindPopup(`
                <div class="text-center" style="min-width: 200px;">
                    <h6 class="mb-2 text-danger">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        {{ __('pickup_request.pickup_location') }}
                    </h6>
                    <p class="mb-1 small"><strong>{{ $pickupRequest->merchant->name ?? __('general.unknown_merchant') }}</strong></p>
                    <p class="mb-1 small text-muted">
                        {{ $pickupRequest->district ? $pickupRequest->district . ', ' : '' }}{{ $pickupRequest->city }}
                    </p>
                    <hr class="my-2">
                    <p class="mb-0 small">
                        <i class="bi bi-geo me-1"></i>
                        ${initialLat.toFixed(6)}, ${initialLng.toFixed(6)}
                    </p>
                    <button class="btn btn-sm btn-outline-primary mt-2 w-100" onclick="openNavigation(${initialLat}, ${initialLng})">
                        <i class="bi bi-compass me-1"></i>
                        {{ __('general.navigate') }}
                    </button>
                </div>
            `).openPopup();

            // إضافة دائرة نصف قطرها
            L.circle([initialLat, initialLng], {
                color: '#dc3545',
                fillColor: '#dc3545',
                fillOpacity: 0.1,
                radius: 100
            }).addTo(map);

        } else {
            // خريطة افتراضية مع رسالة أفضل
            const map = L.map('map').setView([24.7136, 46.6753], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([24.7136, 46.6753]).addTo(map)
                .bindPopup(`
                    <div class="text-center text-warning">
                        <i class="bi bi-exclamation-triangle fs-4 d-block mb-2"></i>
                        {{ __('general.location_not_available') }}
                    </div>
                `)
                .openPopup();
        }
    }

    function initializeInteractions() {
        // نسخ العنوان
        document.getElementById('copyAddress')?.addEventListener('click', function() {
            const address = `{{ implode(', ', array_filter([$pickupRequest->district, $pickupRequest->city, $pickupRequest->region, $pickupRequest->country])) }}`;

            navigator.clipboard.writeText(address).then(() => {
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="bi bi-check2 text-success"></i>';
                this.classList.add('btn-success');

                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.classList.remove('btn-success');
                }, 2000);
            });
        });

        // فتح في التطبيقات
        document.getElementById('openInMaps')?.addEventListener('click', function() {
            openNavigation({{ $pickupRequest->latitude ?: 0 }}, {{ $pickupRequest->longitude ?: 0 }});
        });

        // وصف الحالة
        const statusSelect = document.getElementById('status');
        const statusDescription = document.getElementById('statusDescription');

        statusSelect?.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const description = selectedOption.dataset.description;

            if (description && selectedOption.value) {
                statusDescription.style.display = 'block';
                statusDescription.innerHTML = `<i class="bi bi-info-circle me-1"></i>${description}`;
                this.classList.add('border', 'border-2', 'border-primary', 'shadow-sm');
            } else {
                statusDescription.style.display = 'none';
                this.classList.remove('border', 'border-2', 'border-primary', 'shadow-sm');
            }
        });

        // تشغيل الحدث الأولي
        if (statusSelect?.value) {
            statusSelect.dispatchEvent(new Event('change'));
        }
    }

    function initializeFormManagement() {
        const form = document.getElementById('statusForm');

        form?.addEventListener('submit', function(e) {
            const statusSelect = document.getElementById('status');
            const currentStatus = '{{ $pickupRequest->status }}';
            const newStatus = statusSelect.value;

            if (currentStatus === newStatus) {
                e.preventDefault();
                Swal.fire({
                    icon: 'info',
                    title: '{{ __("general.no_changes") }}',
                    text: '{{ __("pickup_request.same_status_message") }}',
                    confirmButtonText: '{{ __("general.ok") }}'
                });
                return;
            }

            // إظهار تأكيد للحالات الحرجة
            if (newStatus === 'cancelled') {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: '{{ __("pickup_request.confirm_cancellation") }}',
                    text: '{{ __("pickup_request.cancellation_warning") }}',
                    showCancelButton: true,
                    confirmButtonText: '{{ __("general.yes_confirm") }}',
                    cancelButtonText: '{{ __("general.cancel") }}',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    }
});

// فتح التطبيقات
function openNavigation(lat, lng) {
    if (!lat || !lng) return;

    // روابط للتطبيقات المختلفة
    const googleMapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
    const appleMapsUrl = `https://maps.apple.com/?daddr=${lat},${lng}&dirflg=d`;

    // اكتشاف الجهاز
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
    const isAndroid = /Android/.test(navigator.userAgent);

    Swal.fire({
        title: '{{ __("general.open_in_maps") }}',
        text: '{{ __("general.choose_navigation_app") }}',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: isIOS ? 'Apple Maps' : (isAndroid ? 'Google Maps' :  '{{ __("general.open_in_maps") }}'),
        cancelButtonText: '{{ __("general.cancel") }}',
        showDenyButton: true,
        denyButtonText: isIOS ? 'Google Maps' : (isAndroid ? 'Other Apps' :  '{{ __("general.copy_coordinates") }}')
    }).then((result) => {
        if (result.isConfirmed) {
            window.open(isIOS ? appleMapsUrl : googleMapsUrl, '_blank');
        } else if (result.isDenied) {
            if (isIOS) {
                window.open(googleMapsUrl, '_blank');
            } else {
                // نسخ الإحداثيات
                navigator.clipboard.writeText(`${lat}, ${lng}`);
                Swal.fire({
                    icon: 'success',
                    title: '{{ __("general.coordinates_copied") }}',
                    text: '{{ __("general.paste_in_maps_app") }}',
                    timer: 2000
                });
            }
        }
    });
}
</script>
@endsection
