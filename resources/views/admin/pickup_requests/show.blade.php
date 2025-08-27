@extends('layouts.admin')

@section('style')

<style>
    /* أضف هذا في CSS الخاص بك */
#pickupMap {
    height: 400px;
    width: 100%;
    z-index: 1;
}
</style>

@endsection

@section('content')

<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ __('pickup_request.details') }} #{{ $pickupRequest->id }}</h4>
            <a href="{{ route('admin.pickup_requests.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> {{ __('general.back') }}
            </a>
        </div>
    </div>

    <div class="row">
        <!-- معلومات الطلب -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    {{ __('pickup_request.request_info') }}
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-0">
                        <tr>
                            <th>{{ __('merchant.merchant') }}</th>
                            <td>{{ $pickupRequest->merchant->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.status') }}</th>
                            <td>
                                @php $status = $pickupRequest->status; @endphp
                                @if($status == 'pending')
                                    <span class="badge bg-warning">{{ __('pickup_request.status_pending') }}</span>
                                @elseif($status == 'accepted')
                                    <span class="badge bg-info">{{ __('pickup_request.status_accepted') }}</span>
                                @elseif($status == 'completed')
                                    <span class="badge bg-success">{{ __('pickup_request.status_completed') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $status }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.note') }}</th>
                            <td>{{ $pickupRequest->note ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.scheduled_at') }}</th>
                            <td>{{ $pickupRequest->scheduled_at ? $pickupRequest->scheduled_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.accepted_at') }}</th>
                            <td>{{ $pickupRequest->accepted_at ? $pickupRequest->accepted_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('pickup_request.completed_at') }}</th>
                            <td>{{ $pickupRequest->completed_at ? $pickupRequest->completed_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.created_at') }}</th>
                            <td>{{ $pickupRequest->created_at ? $pickupRequest->created_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.updated_at') }}</th>
                            <td>{{ $pickupRequest->updated_at ? $pickupRequest->updated_at->format('Y-m-d h:i A') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- بيانات الموقع + الخريطة -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    {{ __('pickup_request.location_info') }}
                </div>
                <div class="card-body">
                    <table class="table table-borderless mb-3">
                        <tr>
                            <th>{{ __('general.country') }}</th>
                            <td>{{ $pickupRequest->country ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.region') }}</th>
                            <td>{{ $pickupRequest->region ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.city') }}</th>
                            <td>{{ $pickupRequest->city ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.district') }}</th>
                            <td>{{ $pickupRequest->district ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.postal_code') }}</th>
                            <td>{{ $pickupRequest->postal_code ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.latitude') }}</th>
                            <td>{{ $pickupRequest->latitude ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('general.longitude') }}</th>
                            <td>{{ $pickupRequest->longitude ?? '-' }}</td>
                        </tr>
                    </table>

                    @if($pickupRequest->latitude && $pickupRequest->longitude)
                    <div id="pickupMap" style="height: 400px;"></div>
                    @else
                    <p class="text-muted">{{ __('pickup_request.no_location_available') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- التاجر والسائق -->
    <div class="row">
        <!-- التاجر -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    {{ __('merchant.merchant_info') }}
                </div>
                <div class="card-body">
                    @if($pickupRequest->merchant)
                        <p><strong>{{ __('merchant.name') }}:</strong> {{ $pickupRequest->merchant->name }}</p>
                        <p><strong>{{ __('merchant.phone') }}:</strong> {{ $pickupRequest->merchant->phone }}</p>
                        <p><strong>{{ __('merchant.email') }}:</strong> {{ $pickupRequest->merchant->email }}</p>
                        <p><strong>{{ __('merchant.contact_person') }}:</strong> {{ $pickupRequest->merchant->contact_person ?? '-' }}</p>
                        <p><strong>{{ __('merchant.address') }}:</strong>
                            {{ $pickupRequest->merchant->city ?? '-' }}, {{ $pickupRequest->merchant->region ?? '-' }}, {{ $pickupRequest->merchant->country ?? '-' }}
                        </p>
                        @if($pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                            <p class="text-success">{{ __('pickup_request.merchant_location_available') }}</p>
                        @endif
                    @else
                        <p class="text-muted">{{ __('pickup_request.no_merchant') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- السائق -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header bg-info text-white">
                    {{ __('driver.driver_info') }}
                </div>
                <div class="card-body">
                    @if($pickupRequest->driver)
                        <p><strong>{{ __('driver.name') }}:</strong>
                            {{ $pickupRequest->driver->first_name ?? '' }}
                            {{ $pickupRequest->driver->middle_name ?? '' }}
                            {{ $pickupRequest->driver->last_name ?? '' }}
                        </p>
                        <p><strong>{{ __('driver.phone') }}:</strong> {{ $pickupRequest->driver->phone ?? '-' }}</p>
                        <p><strong>{{ __('driver.vehicle_number') }}:</strong> {{ $pickupRequest->driver->vehicle_number ?? '-' }}</p>
                        <p><strong>{{ __('driver.vehicle_type') }}:</strong> {{ $pickupRequest->driver->vehicle_type ?? '-' }}</p>
                        <p><strong>{{ __('driver.vehicle_color') }}:</strong> {{ $pickupRequest->driver->vehicle_color ?? '-' }}</p>
                    @else
                        <p class="text-muted">{{ __('pickup_request.no_driver_assigned') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')
    @if($pickupRequest->latitude && $pickupRequest->longitude)
    <!-- تأكد من أن الروابط صحيحة وغير محجوبة -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // إحداثيات الموقع الرئيسي للطلب
                var pickupLat = {{ $pickupRequest->latitude }};
                var pickupLng = {{ $pickupRequest->longitude }};

                var map = L.map('pickupMap').setView([pickupLat, pickupLng], 13);

                // إضافة خريطة OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // مصفوفة لتخزين جميع الماركرات
                var markers = [];

                // دبوس الطلب
                var pickupMarker = L.marker([pickupLat, pickupLng]).addTo(map)
                    .bindPopup("{{ __('pickup_request.pickup_location') }}");
                markers.push(pickupMarker);

                // دبوس التاجر إذا كانت لديه إحداثيات
                @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                    var merchantMarker = L.marker([{{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }}], {icon: L.icon({iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149059.png', iconSize: [30, 30]})})
                        .addTo(map)
                        .bindPopup("{{ __('merchant.merchant_location') }}: {{ $pickupRequest->merchant->name }}");
                    markers.push(merchantMarker);
                @endif

                // دبوس السائق إذا كانت لديه إحداثيات
                @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
                    var driverMarker = L.marker([{{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }}], {icon: L.icon({iconUrl: 'https://cdn-icons-png.flaticon.com/512/61/61112.png', iconSize: [30, 30]})})
                        .addTo(map)
                        .bindPopup("{{ __('driver.driver_location') }}: {{ $pickupRequest->driver->first_name }}");
                    markers.push(driverMarker);
                @endif

                // ضبط حدود الخريطة لتشمل جميع الماركرات
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.2));
            });
        </script>
    @endif
@endsection
