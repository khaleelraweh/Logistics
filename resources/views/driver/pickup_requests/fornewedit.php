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

                    <!-- Pickup Request Information Section -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                <i class="bi bi-info-circle text-primary"></i>
                            </div>
                            <h5 class="mb-0">{{ __('pickup_request.pickup_request_info') }}</h5>
                        </div>

                        <!-- Merchant Information (عرض فقط) -->
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

                        <!-- Driver Information (عرض فقط) -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pickup_request.assigned_driver') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light">
                                    <strong>{{ $pickupRequest->driver->driver_full_name ?? __('driver.no_name') }}</strong>
                                    @if($pickupRequest->driver)
                                        <br>
                                        <small class="text-muted">
                                            {{ $pickupRequest->driver->phone ?? __('driver.no_phone') }} -
                                            {{ $pickupRequest->driver->vehicle_type ? __('driver.vehicle_type_' . $pickupRequest->driver->vehicle_type) : __('driver.no_vehicle_type') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Request Number -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">{{ __('pickup_request.request_number') }}</label>
                            <div class="col-sm-10">
                                <div class="form-control bg-light">
                                    <strong>#{{ $pickupRequest->id }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section (عرض فقط) -->
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

                        <!-- send data hidden  -->
                        <input name="country" class="form-control" id="country" type="hidden" value="{{ old('country', $pickupRequest->country) }}" placeholder="{{ __('general.country') }}">
                        <input name="region" class="form-control" id="region" type="hidden" value="{{ old('region' , $pickupRequest->region) }}" placeholder="{{ __('general.region') }}">
                        <input name="city" class="form-control" id="city" type="hidden" value="{{ old('city' , $pickupRequest->city) }}" placeholder="{{ __('general.city') }}">
                        <input name="district" class="form-control" id="district" type="hidden" value="{{ old('district' , $pickupRequest->district) }}" placeholder="{{ __('general.district') }}">

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
                            <!-- send data hidden  -->
                            <input name="postal_code" class="form-control" id="postal_code" type="hidden" value="{{ old('postal_code' , $pickupRequest->postal_code) }}" placeholder="{{ __('general.postal_code') }}">

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

                            <!-- send data hidden  -->
                            <input type="hidden" id="latitude" name="latitude" class="form-control mb-2" placeholder="{{ __('general.latitude') }}" value="{{ old('latitude', $pickupRequest->latitude ?? '') }}">
                            <input type="hidden" id="longitude" name="longitude" class="form-control mb-2" placeholder="{{ __('general.longitude') }}" value="{{ old('longitude', $pickupRequest->longitude ?? '') }}">
                        </div>
                        @endif
                    </div>

                    <!-- Schedule Section (عرض فقط) -->
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
                                <!-- send data hidden  -->
                                <input name="scheduled_at" class="form-control" id="scheduled_at" type="hidden"
                                    value="{{ old('scheduled_at', $pickupRequest->scheduled_at ? \Carbon\Carbon::parse($pickupRequest->scheduled_at)->toDateString() : '') }}">

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

                        <!-- Status (هذا الحقل فقط يمكن التعديل عليه) -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status1">{{ __('general.status') }}</label>
                            <div class="col-sm-10">
                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status1" required>
                                    <option value="pending" {{ old('status', $pickupRequest->status) == 'pending' ? 'selected' : '' }}>
                                        {{ __('pickup_request.status_pending') }}
                                    </option>
                                    <option value="accepted" {{ old('status', $pickupRequest->status) == 'accepted' ? 'selected' : '' }}>
                                        {{ __('pickup_request.status_accepted') }}
                                    </option>
                                    <option value="completed" {{ old('status', $pickupRequest->status) == 'completed' ? 'selected' : '' }}>
                                        {{ __('pickup_request.status_completed') }}
                                    </option>
                                    <option value="cancelled" {{ old('status', $pickupRequest->status) == 'cancelled' ? 'selected' : '' }}>
                                        {{ __('pickup_request.status_cancelled') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">{{ __('pickup_request.status_change_note') }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end pt-3">
                        @ability('driver', 'update_pickup_requests')
                            <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                <i class="bi bi-save me-2"></i>
                                {{ __('pickup_request.update_status') }}
                            </button>
                        @endability

                        <a href="{{ route('driver.pickup_requests.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="ri-arrow-go-back-line me-1"></i>
                            {{ __('panel.back') }}
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
