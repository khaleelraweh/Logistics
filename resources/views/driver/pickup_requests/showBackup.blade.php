@extends('layouts.driver')

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
    <div class="row ">
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
                        <p><strong>{{ __('driver.vehicle_type') }}:</strong> {{__('driver.vehicle_type_' . $pickupRequest->driver->vehicle_type ) ?? '-' }}</p>
                        <p><strong>{{ __('driver.vehicle_color') }}:</strong> {{ __('driver.vehicle_color_' . $pickupRequest->driver->vehicle_color) ?? '-' }}</p>
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
            // document.addEventListener('DOMContentLoaded', function () {
            //     // إحداثيات الموقع الرئيسي للطلب
            //     var pickupLat = {{ $pickupRequest->latitude }};
            //     var pickupLng = {{ $pickupRequest->longitude }};

            //     var map = L.map('pickupMap').setView([pickupLat, pickupLng], 13);

            //     // إضافة خريطة OpenStreetMap
            //     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //         attribution: '&copy; OpenStreetMap contributors'
            //     }).addTo(map);

            //     // مصفوفة لتخزين جميع الماركرات
            //     var markers = [];

            //     // دبوس الطلب
            //     var pickupMarker = L.marker([pickupLat, pickupLng]).addTo(map)
            //         .bindPopup("{{ __('pickup_request.pickup_location') }}");
            //     markers.push(pickupMarker);

            //     // دبوس التاجر إذا كانت لديه إحداثيات
            //     @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
            //         var merchantMarker = L.marker([{{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }}], {icon: L.icon({iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149059.png', iconSize: [30, 30]})})
            //             .addTo(map)
            //             .bindPopup("{{ __('merchant.merchant_location') }}: {{ $pickupRequest->merchant->name }}");
            //         markers.push(merchantMarker);
            //     @endif

            //     // دبوس السائق إذا كانت لديه إحداثيات
            //     @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
            //         var driverMarker = L.marker([{{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }}], {icon: L.icon({iconUrl: 'https://cdn-icons-png.flaticon.com/512/61/61112.png', iconSize: [30, 30]})})
            //             .addTo(map)
            //             .bindPopup("{{ __('driver.driver_location') }}: {{ $pickupRequest->driver->first_name }}");
            //         markers.push(driverMarker);
            //     @endif

            //     // ضبط حدود الخريطة لتشمل جميع الماركرات
            //     var group = new L.featureGroup(markers);
            //     map.fitBounds(group.getBounds().pad(0.2));
            // });

            // document.addEventListener('DOMContentLoaded', function () {
            //     var map = L.map('pickupMap').setView([24.7136, 46.6753], 6);
            //     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //         attribution: '&copy; OpenStreetMap contributors'
            //     }).addTo(map);

            //     // أيقونات مخصصة
            //     var pickupIcon = L.divIcon({ html: '<i class="fas fa-box" style="font-size:24px; color:#ffc107;"></i>', className: '', iconSize:[30,30], iconAnchor:[15,15] });
            //     var merchantIcon = L.divIcon({ html: '<i class="fas fa-store" style="font-size:24px; color:#28a745;"></i>', className: '', iconSize:[30,30], iconAnchor:[15,15] });
            //     var driverIcon = L.divIcon({ html: '<i class="fas fa-car" style="font-size:24px; color:#007bff;"></i>', className: '', iconSize:[30,30], iconAnchor:[15,15] });

            //     var markers = [];

            //     // دبوس الطلب
            //     @if($pickupRequest->latitude && $pickupRequest->longitude)
            //         var pickupMarker = L.marker([{{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }}], {icon: pickupIcon})
            //             .addTo(map)
            //             .bindPopup("{{ __('pickup_request.pickup_location') }}");
            //         markers.push(pickupMarker);
            //     @endif

            //     // دبوس التاجر
            //     @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
            //         var merchantMarker = L.marker([{{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }}], {icon: merchantIcon})
            //             .addTo(map)
            //             .bindPopup("{{ __('merchant.merchant_location') }}: {{ $pickupRequest->merchant->name }}");
            //         markers.push(merchantMarker);
            //     @endif

            //     // دبوس السائق
            //     @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
            //         var driverMarker = L.marker([{{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }}], {icon: driverIcon})
            //             .addTo(map)
            //             .bindPopup("{{ __('driver.driver_location') }}: {{ $pickupRequest->driver->first_name }}");
            //         markers.push(driverMarker);
            //     @endif

            //     // ضبط حدود الخريطة لتشمل جميع الماركرات
            //     if(markers.length > 0){
            //         var group = L.featureGroup(markers);
            //         map.fitBounds(group.getBounds().pad(0.2));
            //     }
            // });

            document.addEventListener('DOMContentLoaded', function () {

            // إعداد الخريطة
            var map = L.map('pickupMap').setView([24.7136, 46.6753], 6);

            // إضافة خريطة OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // تعريف أيقونات
            var pickupIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png', // أيقونة الطلب
                iconSize: [35, 35]
            });

            var merchantIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149059.png', // أيقونة التاجر
                iconSize: [30, 30]
            });

            var driverIcon = L.divIcon({
                html: '<i class="fas fa-car" style="font-size:24px; color:#007bff;"></i>',
                className: 'custom-car-icon',
                iconSize: [30, 30],
                iconAnchor: [15, 15],
                popupAnchor: [0, -15]
            });

            // مصفوفة لتخزين الماركرات
            var markers = [];

            // لتجنب تداخل الإحداثيات: تخزين المواقع المكررة
            var positions = {};
            function getOffsetLatLng(lat, lng) {
                var key = lat.toFixed(6) + ',' + lng.toFixed(6);
                if (positions[key]) {
                    positions[key] += 0.0002; // إزاحة بسيطة على خط العرض
                } else {
                    positions[key] = 0;
                }
                return [lat + positions[key], lng];
            }

            // دبوس الطلب
            @if($pickupRequest->latitude && $pickupRequest->longitude)
                var [lat, lng] = getOffsetLatLng({{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }});
                var pickupMarker = L.marker([lat, lng], {icon: pickupIcon})
                    .addTo(map)
                    .bindPopup("{{ __('pickup_request.pickup_location') }}");
                markers.push(pickupMarker);
            @endif

            // دبوس التاجر
            @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                var [lat, lng] = getOffsetLatLng({{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }});
                var merchantMarker = L.marker([lat, lng], {icon: merchantIcon})
                    .addTo(map)
                    .bindPopup("{{ __('merchant.merchant_location') }}: {{ $pickupRequest->merchant->name }}");
                markers.push(merchantMarker);
            @endif

            // دبوس السائق
            @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
                var [lat, lng] = getOffsetLatLng({{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }});
                var driverMarker = L.marker([lat, lng], {icon: driverIcon})
                    .addTo(map)
                    .bindPopup("{{ __('driver.driver_location') }}: {{ $pickupRequest->driver->first_name }}");
                markers.push(driverMarker);
            @endif

            // ضبط حدود الخريطة لتشمل جميع الماركرات
            if(markers.length > 0){
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.2));
            }

        });


        </script>
    @endif
@endsection
