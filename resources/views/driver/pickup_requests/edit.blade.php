@extends('layouts.driver')

@section('content')
<!-- Page Header -->
  <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pickup_request.edit_pickup_request') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('driver.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pickup_request.edit_pickup_request') }}</li>
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
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-data me-2"></i>
                        {{ __('pickup_request.request_details') }}
                    </h5>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-light text-dark border me-2">
                            <i class="bi bi-calendar me-1"></i>
                            {{ $pickupRequest->created_at->format('Y-m-d') }}
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
                            <div class="card mb-4 border">
                                <div class="card-header bg-transparent border-bottom">
                                    <h6 class="mb-0">
                                        <i class="bi bi-building me-2 text-primary"></i>
                                        {{ __('merchant.merchant_info') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label text-muted small mb-1">{{ __('merchant.name') }}</label>
                                            <div class="d-flex align-items-center">
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
                                            <label class="form-label text-muted small mb-1">{{ __('general.created_at') }}</label>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                                    <i class="bi bi-clock text-success"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $pickupRequest->created_at->format('Y-m-d') }}</h6>
                                                    <small class="text-muted">{{ $pickupRequest->created_at->format('H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- الموقع والخرائط -->
                            <div class="card mb-4 border">
                                <div class="card-header bg-transparent border-bottom">
                                    <h6 class="mb-0">
                                        <i class="bi bi-geo-alt me-2 text-danger"></i>
                                        {{ __('general.location_details') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- العنوان -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-2">{{ __('general.address') }}</label>
                                            <div class="d-flex align-items-start">
                                                <div class="bg-info bg-opacity-10 p-2 rounded me-3 mt-1">
                                                    <i class="bi bi-geo text-info"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-1 fs-6">
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
                                            </div>
                                        </div>
                                    </div>

                                    <!-- الخريطة -->
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-2">{{ __('general.location_on_map') }}</label>
                                            <div id="map-container" class="border rounded">
                                                <div id="map" style="width: 100%; height: 300px; border-radius: 6px;"></div>
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
                            <div class="card border">
                                <div class="card-header bg-transparent border-bottom">
                                    <h6 class="mb-0">
                                        <i class="bi bi-info-circle me-2 text-info"></i>
                                        {{ __('general.additional_info') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if($pickupRequest->scheduled_at)
                                        <div class="col-sm-6 mb-3">
                                            <label class="form-label text-muted small mb-1">{{ __('pickup_request.scheduled_at') }}</label>
                                            <div class="d-flex align-items-center">
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

                                        @if($pickupRequest->note)
                                        <div class="col-12">
                                            <label class="form-label text-muted small mb-1">{{ __('delivery.note') }}</label>
                                            <div class="border rounded p-3 bg-light">
                                                <i class="bi bi-chat-left-text me-2 text-muted"></i>
                                                {{ $pickupRequest->note }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- العمود الأيمن: تحديث الحالة -->
                        <div class="col-lg-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">
                                        <i class="bi bi-arrow-repeat me-2"></i>
                                        {{ __('pickup_request.update_status') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- الحالة الحالية -->
                                    <div class="mb-4 text-center">
                                        <label class="form-label text-muted small mb-2">{{ __('general.current_status') }}</label>
                                        <div class="status-badge-lg bg-{{ $pickupRequest->status_color }} text-white py-2 rounded">
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
                                                <option value="{{ $status }}" {{ old('status', $pickupRequest->status) == $status ? 'selected' : '' }}>
                                                    {{ __('pickup_request.status_' . $status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- معلومات التوجيه -->
                                    <div class="alert alert-info border-0">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-info-circle-fill text-info"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <small class="d-block fw-semibold">{{ __('pickup_request.important_note') }}</small>
                                                <small class="text-muted">{{ __('pickup_request.status_change_instruction') }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- أزرار التنفيذ -->
                                    <div class="d-grid gap-2">
                                        @ability('driver', 'update_pickup_requests')
                                            <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center justify-content-center py-2">
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
                            <div class="card border-0 bg-light mt-3">
                                <div class="card-body">
                                    <h6 class="card-title text-dark mb-3">
                                        <i class="bi bi-lightbulb me-2 text-warning"></i>
                                        {{ __('general.quick_tips') }}
                                    </h6>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <small class="text-muted">
                                                <i class="bi bi-check-circle me-2 text-success"></i>
                                                {{ __('pickup_request.tip_accept') }}
                                            </small>
                                        </li>
                                        <li class="mb-2">
                                            <small class="text-muted">
                                                <i class="bi bi-check2-square me-2 text-primary"></i>
                                                {{ __('pickup_request.tip_complete') }}
                                            </small>
                                        </li>
                                        <li>
                                            <small class="text-muted">
                                                <i class="bi bi-exclamation-triangle me-2 text-warning"></i>
                                                {{ __('pickup_request.tip_cancel') }}
                                            </small>
                                        </li>
                                    </ul>
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

<style>
.status-badge-lg {
    font-size: 1.1rem;
    font-weight: 600;
}
.card {
    box-shadow: 0 0.15rem 1rem rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(0, 0, 0, 0.08);
}
.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
}
.bg-pending { background-color: #ffc107 !important; }
.bg-accepted { background-color: #0dcaf0 !important; }
.bg-completed { background-color: #198754 !important; }
.bg-cancelled { background-color: #dc3545 !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // الحصول على القيم من قاعدة البيانات
    var initialLat = {{ $pickupRequest->latitude ?: 'null' }};
    var initialLng = {{ $pickupRequest->longitude ?: 'null' }};

    // إذا كانت الإحداثيات موجودة، نعرض الخريطة
    if (initialLat && initialLng) {
        // إنشاء الخريطة
        var map = L.map('map').setView([initialLat, initialLng], 16);

        // إضافة طبقة OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // إنشاء أيقونة مخصصة
        var pickupIcon = L.divIcon({
            html: '<i class="bi bi-geo-alt-fill text-danger fs-4"></i>',
            iconSize: [30, 30],
            className: 'pickup-marker'
        });

        // إضافة Marker مخصص
        var marker = L.marker([initialLat, initialLng], { icon: pickupIcon }).addTo(map);

        // إضافة Popup للمarker
        marker.bindPopup(`
            <div class="text-center">
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
            </div>
        `).openPopup();

    } else {
        // إذا لم تكن الإحداثيات موجودة، نعرض خريطة افتراضية
        var map = L.map('map').setView([24.7136, 46.6753], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // إضافة رسالة أن الموقع غير متوفر
        L.marker([24.7136, 46.6753]).addTo(map)
            .bindPopup('{{ __('general.location_not_available') }}')
            .openPopup();
    }

    // إضافة تأثير عند تغيير الحالة
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                this.classList.add('border', 'border-2', 'border-primary');
            } else {
                this.classList.remove('border', 'border-2', 'border-primary');
            }
        });
    }
});
</script>
@endsection
