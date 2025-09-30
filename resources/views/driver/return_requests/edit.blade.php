@extends('layouts.driver')

@section('style')
<!-- مكتبة Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""/>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        border: none;
    }
    .card-header {
        background-color: #4a6fdc;
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
        font-weight: 600;
    }
    .info-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
    .info-value {
        color: #333;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }
    .map-container {
        height: 250px;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
    }
    .map-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #6c757d;
        background-color: #f8f9fa;
    }
    .map-container .leaflet-container {
        height: 100%;
        width: 100%;
    }
    .section-title {
        border-bottom: 2px solid #4a6fdc;
        padding-bottom: 10px;
        margin: 25px 0 15px;
        color: #4a6fdc;
    }
    .coordinates {
        font-family: monospace;
        background-color: #f8f9fa;
        padding: 5px;
        border-radius: 4px;
        font-size: 0.85rem;
    }
    .package-details {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }
    .product-table {
        font-size: 0.9rem;
    }
    .product-table th {
        background-color: #f1f4f9;
    }
    .status-badge {
        font-size: 0.85rem;
        padding: 0.5em 1em;
    }
    .form-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 10px;
        padding: 25px;
        border-left: 4px solid #4a6fdc;
    }
    .edit-icon {
        color: #4a6fdc;
        font-size: 1.1rem;
    }
    .location-card {
        transition: all 0.3s ease;
    }
    .location-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between bg-white p-3 rounded-3 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-truck-return fs-2 text-primary me-3"></i>
                    <div>
                        <h4 class="mb-0 fw-bold">{{ __('return_request.edit_return_request') }}</h4>
                        <p class="text-muted mb-0">{{ __('return_request.edit_return_request_description') }}</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('driver.return_requests.show', $return_request->id) }}" class="btn btn-outline-secondary me-2">
                        <i class="mdi mdi-eye-outline me-1"></i> {{ __('general.view') }}
                    </a>
                    <a href="{{ route('driver.return_requests.index') }}" class="btn btn-outline-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> {{ __('general.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Edit Form Section -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-pencil-outline me-2"></i>
                        {{ __('return_request.update_status_reason') }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('driver.return_requests.update', $return_request->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-section">
                            <!-- Status Field -->
                            <div class="mb-4">
                                <label for="status1" class="form-label fw-semibold">
                                    <i class="mdi mdi-status me-1 edit-icon"></i>
                                    {{ __('return_request.status') }} *
                                </label>
                                <select name="status" id="status1" class="form-select" required>
                                    @foreach($return_request->availableStatusesForCurrentUser() as $status)
                                        <option value="{{ $status }}" {{ old('status', $return_request->status) == $status ? 'selected' : '' }}>
                                            {{ __('return_request.status_' . $status) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">
                                    {{ __('return_request.status_help_text') }}
                                </div>
                            </div>

                            <!-- Reason Field -->
                            <div class="mb-4">
                                <label for="reason" class="form-label fw-semibold">
                                    <i class="mdi mdi-comment-text-outline me-1 edit-icon"></i>
                                    {{ __('return_request.reason') }}
                                </label>
                                <textarea name="reason" id="reason" placeholder="{{ __('return_request.reason_placeholder') }}" class="form-control @error('reason') is-invalid @enderror" rows="4">{{ old('reason', $return_request->reason) }}</textarea>
                                @error('reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">
                                    {{ __('return_request.reason_help_text') }}
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="mdi mdi-content-save-outline me-2"></i>
                                    {{ __('general.update') }}
                                </button>
                                <a href="{{ route('driver.return_requests.show', $return_request->id) }}" class="btn btn-outline-secondary">
                                    <i class="mdi mdi-cancel me-2"></i>
                                    {{ __('general.cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-lightning-bolt-outline me-2"></i>
                        {{ __('general.quick_actions') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('driver.return_requests.show', $return_request->id) }}"
                           class="btn btn-outline-primary text-start">
                            <i class="mdi mdi-eye-outline me-2"></i>
                            {{ __('general.view_details') }}
                        </a>
                        @if($return_request->package)
                        <a href="#" class="btn btn-outline-success text-start">
                            <i class="mdi mdi-map-marker-path me-2"></i>
                            {{ __('general.view_route') }}
                        </a>
                        @endif
                        <a href="tel:{{ $return_request->package->receiver_phone ?? '#' }}"
                           class="btn btn-outline-warning text-start">
                            <i class="mdi mdi-phone-outline me-2"></i>
                            {{ __('general.contact_customer') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Only Information -->
        <div class="col-lg-8">
            <!-- Return Request Summary -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-information-outline me-2"></i>
                        {{ __('return_request.return_request_summary') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-label">{{ __('return_request.id') }}</div>
                            <div class="info-value fw-bold text-primary">#{{ $return_request->id }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">{{ __('return_request.current_status') }}</div>
                            <div class="info-value">{!! $return_request->statusLabel() !!}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">{{ __('return_request.package') }}</div>
                            <div class="info-value">
                                @if($return_request->package)
                                    <span class="badge bg-light text-dark">{{ $return_request->package->tracking_number }}</span>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">{{ __('return_request.return_type') }}</div>
                            <div class="info-value">
                                <span class="badge bg-info status-badge">
                                    {{ __('return_request.type_' . ($return_request->return_type ?? 'unknown')) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="info-label">{{ __('return_request.target_address') }}</div>
                            <div class="info-value">{{ $return_request->target_address ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Information -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-clock-outline me-2"></i>
                        {{ __('return_request.timeline') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-label">{{ __('return_request.requested_at') }}</div>
                            <div class="info-value">
                                @if($return_request->requested_at)
                                    <i class="mdi mdi-calendar-clock-outline me-1 text-success"></i>
                                    {{ $return_request->requested_at->format('Y-m-d H:i') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">{{ __('return_request.received_at') }}</div>
                            <div class="info-value">
                                @if($return_request->received_at)
                                    <i class="mdi mdi-calendar-check-outline me-1 text-primary"></i>
                                    {{ $return_request->received_at->format('Y-m-d H:i') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-label">{{ __('return_request.created_at') }}</div>
                            <div class="info-value">
                                <i class="mdi mdi-calendar-plus-outline me-1 text-info"></i>
                                {{ $return_request->created_at->format('Y-m-d H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Information with Maps -->
            @if($return_request->package)
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white py-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="mdi mdi-package-variant me-2"></i>
                        {{ __('package.package_information') }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Sender Information with Map -->
                        <div class="col-md-6 mb-4">
                            <div class="card location-card h-100">
                                <div class="card-header bg-info text-white py-2">
                                    <i class="mdi mdi-account-outline me-2"></i>
                                    {{ __('package.sender_info') }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.full_name') }}</div>
                                            <div class="info-value">{{ $return_request->package->sender_full_name }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.phone') }}</div>
                                            <div class="info-value">+{{ $return_request->package->sender_phone }}</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="info-label">{{ __('general.address') }}</div>
                                            @php
                                                $senderAddressParts = array_filter([
                                                    $return_request->package->sender_district,
                                                    $return_request->package->sender_city,
                                                    $return_request->package->sender_region,
                                                    $return_request->package->sender_country,
                                                    $return_request->package->sender_postal_code,
                                                ]);
                                                $fullSenderAddress = implode(' ، ', $senderAddressParts);
                                            @endphp
                                            <div class="info-value">{{ $fullSenderAddress }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.city') }}</div>
                                            <div class="info-value">{{ $return_request->package->sender_city }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.region') }}</div>
                                            <div class="info-value">{{ $return_request->package->sender_region }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.latitude') }}</div>
                                            <div class="info-value coordinates">{{ $return_request->package->sender_latitude }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.longitude') }}</div>
                                            <div class="info-value coordinates">{{ $return_request->package->sender_longitude }}</div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="info-label">{{ __('package.sender_location_map') }}</div>
                                            <div id="sender-map-{{ $return_request->package->id }}" class="map-container"
                                                 data-lat="{{ $return_request->package->sender_latitude }}"
                                                 data-lng="{{ $return_request->package->sender_longitude }}">
                                                <div class="map-placeholder">
                                                    <i class="mdi mdi-map-marker-outline me-2"></i>
                                                    {{ __('package.loading_map') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Receiver Information with Map -->
                        <div class="col-md-6 mb-4">
                            <div class="card location-card h-100">
                                <div class="card-header bg-success text-white py-2">
                                    <i class="mdi mdi-account-check-outline me-2"></i>
                                    {{ __('package.receiver_info') }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.full_name') }}</div>
                                            <div class="info-value">{{ $return_request->package->receiver_full_name }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.phone') }}</div>
                                            <div class="info-value">+{{ $return_request->package->receiver_phone }}</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="info-label">{{ __('general.address') }}</div>
                                            @php
                                                $receiverAddressParts = array_filter([
                                                    $return_request->package->receiver_district,
                                                    $return_request->package->receiver_city,
                                                    $return_request->package->receiver_region,
                                                    $return_request->package->receiver_country,
                                                    $return_request->package->receiver_postal_code,
                                                ]);
                                                $fullReceiverAddress = implode(' ، ', $receiverAddressParts);
                                            @endphp
                                            <div class="info-value">{{ $fullReceiverAddress }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.city') }}</div>
                                            <div class="info-value">{{ $return_request->package->receiver_city }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.region') }}</div>
                                            <div class="info-value">{{ $return_request->package->receiver_region }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.latitude') }}</div>
                                            <div class="info-value coordinates">{{ $return_request->package->receiver_latitude }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="info-label">{{ __('general.longitude') }}</div>
                                            <div class="info-value coordinates">{{ $return_request->package->receiver_longitude }}</div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="info-label">{{ __('package.receiver_location_map') }}</div>
                                            <div id="receiver-map-{{ $return_request->package->id }}" class="map-container"
                                                 data-lat="{{ $return_request->package->receiver_latitude }}"
                                                 data-lng="{{ $return_request->package->receiver_longitude }}">
                                                <div class="map-placeholder">
                                                    <i class="mdi mdi-map-marker-outline me-2"></i>
                                                    {{ __('package.loading_map') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package Specifications -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-secondary text-white py-2">
                                    <i class="mdi mdi-information-outline me-2"></i>
                                    {{ __('package.package_specifications') }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="info-label">{{ __('package.package_type') }}</div>
                                            <div class="info-value">{{ __('package.type_' . $return_request->package->package_type) }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-label">{{ __('package.package_size') }}</div>
                                            <div class="info-value">{{ __('package.size_' . $return_request->package->package_size) }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-label">{{ __('package.weight') }}</div>
                                            <div class="info-value">{{ $return_request->package->weight }} {{ __('package.kgm') }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="info-label">{{ __('package.dimensionss') }}</div>
                                            <div class="info-value">
                                                {{ $return_request->package->dimensions['length'] ?? 0 }}x
                                                {{ $return_request->package->dimensions['width'] ?? 0 }}x
                                                {{ $return_request->package->dimensions['height'] ?? 0 }}
                                                {{ __('package.cm') }}
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="info-label">{{ __('package.package_content') }}</div>
                                            <div class="info-value">{{ $return_request->package->package_content ?? '-' }}</div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="info-label">{{ __('package.package_note') }}</div>
                                            <div class="info-value">{{ $return_request->package->package_note ?? '-' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- مكتبة Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // دالة لتهيئة الخرائط
    function initMaps() {
        // البحث عن جميع عناصر الخرائط
        const mapContainers = document.querySelectorAll('.map-container');

        mapContainers.forEach(container => {
            const lat = parseFloat(container.getAttribute('data-lat'));
            const lng = parseFloat(container.getAttribute('data-lng'));
            const mapId = container.id;

            // تأكد من أن الخريطة لم يتم تهيئتها من قبل
            if (container.hasAttribute('data-initialized')) {
                return;
            }

            // تأكد من وجود إحداثيات صحيحة
            if (!isNaN(lat) && !isNaN(lng)) {
                // إزالة العنصر النائب
                container.innerHTML = '';

                // إنشاء الخريطة
                const map = L.map(mapId).setView([lat, lng], 13);

                // إضافة طبقة الخريطة
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // إضافة علامة الموقع
                const marker = L.marker([lat, lng]).addTo(map);

                // تحديد نوع الخريطة بناءً على الـ ID
                if (mapId.includes('sender-map')) {
                    marker.bindPopup('{{ __("package.sender_location") }}').openPopup();
                } else if (mapId.includes('receiver-map')) {
                    marker.bindPopup('{{ __("package.receiver_location") }}').openPopup();
                }

                // وضع علامة أن الخريطة تم تهيئتها
                container.setAttribute('data-initialized', 'true');
            } else {
                // إذا لم تكن هناك إحداثيات صحيحة
                container.innerHTML = `
                    <div class="map-placeholder">
                        <i class="mdi mdi-exclamation-thick me-2"></i>
                        {{ __("package.no_location_data") }}
                    </div>
                `;
                container.setAttribute('data-initialized', 'true');
            }
        });
    }

    // تهيئة الخرائط عند التحميل
    setTimeout(initMaps, 500);

    // إعادة تهيئة الخرائط عند تغيير حجم النافذة
    window.addEventListener('resize', function() {
        // إعادة رسم الخرائط الموجودة
        document.querySelectorAll('.map-container[data-initialized="true"]').forEach(container => {
            const map = L.map(container.id);
            if (map) {
                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            }
        });
    });

    // Status change effect
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            this.className = this.className.replace(/bg-[\w-]*/, '');

            const statusColors = {
                'requested': 'bg-success',
                'assigned_to_driver': 'bg-info',
                'picked_up': 'bg-warning',
                'in_transit': 'bg-warning',
                'received': 'bg-primary',
                'partially_received': 'bg-info',
                'rejected': 'bg-danger',
                'cancelled': 'bg-danger'
            };

            if (statusColors[this.value]) {
                this.classList.add(statusColors[this.value], 'text-white');
            }
        });

        // Trigger change event on load
        statusSelect.dispatchEvent(new Event('change'));
    }

    // Character counter for reason textarea
    const reasonTextarea = document.getElementById('reason');
    if (reasonTextarea) {
        const counter = document.createElement('div');
        counter.className = 'form-text text-end';
        reasonTextarea.parentNode.appendChild(counter);

        function updateCounter() {
            const length = reasonTextarea.value.length;
            counter.textContent = length + ' / 500 ' + "{{ __('general.characters') }}";

            if (length > 500) {
                counter.classList.add('text-danger');
            } else {
                counter.classList.remove('text-danger');
            }
        }

        reasonTextarea.addEventListener('input', updateCounter);
        updateCounter(); // Initialize counter
    }
});
</script>
@endsection
