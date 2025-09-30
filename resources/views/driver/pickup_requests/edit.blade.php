@extends('layouts.driver')

@section('content')
<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('pickup_request.view_pickup_request') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('driver.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('driver.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('pickup_request.view_pickup_request') }}</li>
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
                <form action="{{ route('driver.pickup_requests.update', $pickupRequest->id) }}" method="POST">
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
                    <input type="hidden" name="latitude" value="{{ $pickupRequest->latitude }}">
                    <input type="hidden" name="longitude" value="{{ $pickupRequest->longitude }}">
                    <input type="hidden" name="scheduled_at" value="{{ $pickupRequest->scheduled_at }}">
                    <input type="hidden" name="note" value="{{ $pickupRequest->note }}">

                    <!-- Pickup Request Information Section -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-info-circle text-primary"></i>
                            </div>
                            <h5 class="mb-0">{{ __('pickup_request.pickup_request_info') }}</h5>
                        </div>

                        <!-- Merchant Information -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('merchant.name') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light">
                                    <strong>{{ $pickupRequest->merchant->name ?? __('general.not_found') }}</strong>
                                    @if($pickupRequest->merchant)
                                        <br>
                                        <small class="text-muted">{{ $pickupRequest->merchant->email }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Created At -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('general.created_at') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light">
                                    {{ $pickupRequest->created_at->format('Y-m-d H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-geo-alt text-primary"></i>
                            </div>
                            <h5 class="mb-0">{{ __('general.address_details') }}</h5>
                        </div>

                        <!-- Address Details -->
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label">{{ __('general.address') }}</label>
                            <div class="col-md-10">
                                <div class="form-control bg-light">
                                    @if($pickupRequest->country || $pickupRequest->region || $pickupRequest->city || $pickupRequest->district)
                                        {{ implode(', ', array_filter([$pickupRequest->district, $pickupRequest->city, $pickupRequest->region, $pickupRequest->country])) }}
                                    @else
                                        {{ __('general.no_address_provided') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Postal Code -->
                        @if($pickupRequest->postal_code)
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label">{{ __('general.postal_code') }}</label>
                            <div class="col-md-10">
                                <div class="form-control bg-light">
                                    {{ $pickupRequest->postal_code }}
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Geographical Location -->
                        @if($pickupRequest->latitude && $pickupRequest->longitude)
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label">{{ __('general.geographical_location') }}</label>
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-control bg-light mb-2">
                                            <strong>{{ __('general.latitude') }}:</strong> {{ $pickupRequest->latitude }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-control bg-light mb-2">
                                            <strong>{{ __('general.longitude') }}:</strong> {{ $pickupRequest->longitude }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="map" style="width: 100%; height: 300px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Schedule Section -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-calendar-event text-primary"></i>
                            </div>
                            <h5 class="mb-0">{{ __('general.schedule_event') }}</h5>
                        </div>

                        <!-- Scheduled Date -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pickup_request.scheduled_at') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light">
                                    @if($pickupRequest->scheduled_at)
                                        {{ \Carbon\Carbon::parse($pickupRequest->scheduled_at)->format('Y-m-d') }}
                                    @else
                                        {{ __('general.not_scheduled') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Note -->
                        @if($pickupRequest->note)
                        <div class="row mb-4">
                            <label class="col-sm-2 col-form-label">{{ __('delivery.note') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light" style="min-height: 80px;">
                                    {{ $pickupRequest->note }}
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Current Status -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('general.current_status') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light">
                                    @switch($pickupRequest->status)
                                        @case('pending')
                                            <span class="badge bg-warning">{{ __('pickup_request.status_pending') }}</span>
                                            @break
                                        @case('accepted')
                                            <span class="badge bg-info">{{ __('pickup_request.status_accepted') }}</span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success">{{ __('pickup_request.status_completed') }}</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger">{{ __('pickup_request.status_cancelled') }}</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        </div>

                        <!-- Status Update (هذا الحقل فقط يمكن التعديل عليه) -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status1">
                                <strong>{{ __('pickup_request.update_status') }}</strong>
                            </label>
                            <div class="col-sm-10">

                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status1" required>
                                    @foreach($pickupRequest->availableStatusesForDriver() as $status)
                                        <option value="{{ $status }}" {{ old('status', $pickupRequest->status) == $status ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_' . $status) }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted mt-2 d-block">
                                    <i class="bi bi-info-circle me-1"></i>
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end pt-3">
                        @ability('driver', 'update_pickup_requests')
                            <button type="submit" class="btn btn-primary px-4 d-inline-flex align-items-center">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ __('pickup_request.update_status') }}
                            </button>
                        @endability

                        <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="ri-arrow-go-back-line me-1"></i>
                            {{ __('general.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@if($pickupRequest->latitude && $pickupRequest->longitude)
    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // إحداثيات الموقع من قاعدة البيانات
            var initialLat = parseFloat({{ $pickupRequest->latitude }});
            var initialLng = parseFloat({{ $pickupRequest->longitude }});

            // إنشاء الخريطة
            var map = L.map('map').setView([initialLat, initialLng], 15);

            // إضافة طبقة OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // إضافة Marker ثابت (غير قابل للسحب)
            var marker = L.marker([initialLat, initialLng]).addTo(map);

            // إضافة Popup للمarker
            marker.bindPopup(`
                <strong>{{ __('pickup_request.pickup_location') }}</strong><br>
                {{ $pickupRequest->merchant->name ?? __('general.unknown_merchant') }}<br>
                {{ $pickupRequest->district ? $pickupRequest->district . ', ' : '' }}{{ $pickupRequest->city }}
            `).openPopup();
        });
    </script>
@endif
@endsection
