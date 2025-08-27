@extends('layouts.admin')
@section('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #6f42c1;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-bg: #f8f9fc;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            color: white;
        }

        .breadcrumb {
            margin-bottom: 0;
            background-color: transparent;
            padding: 0;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }

        .card-header {
            border-radius: 0.75rem 0.75rem 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
            border-bottom: 1px solid #e3e6f0;
            background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
            color: #5a5c69;
        }

        .card-body {
            padding: 1.5rem;
        }

        .info-badge {
            font-size: 0.85rem;
            padding: 0.35rem 0.65rem;
            border-radius: 0.35rem;
            font-weight: 600;
        }

        .detail-row {
            border-bottom: 1px solid #e3e6f0;
            padding: 0.75rem 0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #5a5c69;
        }

        .detail-value {
            color: #858796;
        }

        #pickupMap {
            height: 400px;
            width: 100%;
            border-radius: 0.5rem;
            z-index: 1;
            box-shadow: 0 0.15rem 0.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .map-container {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            font-weight: 600;
        }

        .icon-container {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .merchant-icon {
            background-color: rgba(28, 200, 138, 0.2);
            color: var(--success-color);
        }

        .driver-icon {
            background-color: rgba(54, 185, 204, 0.2);
            color: var(--info-color);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-action {
            border-radius: 0.5rem;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .icon-container {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        .custom-popup .leaflet-popup-content-wrapper {
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 2rem rgba(58, 59, 69, 0.2);
        }

        .legend {
            padding: 10px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
            padding: 5px;
            border-radius: 3px;
        }

        .legend-item:hover {
            background-color: #f8f9fa;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-left: 10px;
        }

        /* تأثيرات للعناصر عند النقر عليها */
        .marker-highlight {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-0"><i class="fas fa-truck-loading me-2"></i>{{ __('pickup_request.view_pickup_request') }}</h4>
                </div>
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-md-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pickup_request.view_pickup_request') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- معلومات الطلب -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ __('pickup_request.request_info') }}
                    </div>
                    <div class="card-body">
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('merchant.merchant') }}</span>
                            <span class="detail-value">{{ $pickupRequest->merchant->name ?? '-' }}</span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('pickup_request.status') }}</span>
                            <span class="detail-value">
                                @php $status = $pickupRequest->status; @endphp
                                @if($status == 'pending')
                                    <span class="status-badge bg-warning text-dark">{{ __('pickup_request.status_pending') }}</span>
                                @elseif($status == 'accepted')
                                    <span class="status-badge bg-info">{{ __('pickup_request.status_accepted') }}</span>
                                @elseif($status == 'completed')
                                    <span class="status-badge bg-success">{{ __('pickup_request.status_completed') }}</span>
                                @else
                                    <span class="status-badge bg-secondary">{{ $status }}</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('pickup_request.note') }}</span>
                            <span class="detail-value">{{ $pickupRequest->note ?? '-' }}</span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('pickup_request.scheduled_at') }}</span>
                            <span class="detail-value">{{ $pickupRequest->scheduled_at ? $pickupRequest->scheduled_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('pickup_request.accepted_at') }}</span>
                            <span class="detail-value">{{ $pickupRequest->accepted_at ? $pickupRequest->accepted_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('pickup_request.completed_at') }}</span>
                            <span class="detail-value">{{ $pickupRequest->completed_at ? $pickupRequest->completed_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('general.created_at') }}</span>
                            <span class="detail-value">{{ $pickupRequest->created_at ? $pickupRequest->created_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>
                        <div class="detail-row d-flex justify-content-between">
                            <span class="detail-label">{{ __('general.updated_at') }}</span>
                            <span class="detail-value">{{ $pickupRequest->updated_at ? $pickupRequest->updated_at->format('Y-m-d h:i A') : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- بيانات الموقع + الخريطة -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ __('pickup_request.location_info') }}
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.country') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->country ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.region') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->region ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.city') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->city ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.district') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->district ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.postal_code') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->postal_code ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.latitude') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->latitude ?? '-' }}</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">{{ __('general.longitude') }}</div>
                                    <div class="detail-value">{{ $pickupRequest->longitude ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        @if($pickupRequest->latitude && $pickupRequest->longitude)
                        <div class="map-container">
                            <div id="pickupMap"></div>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">{{ __('pickup_request.no_location_available') }}</p>
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
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-store me-2"></i>
                        {{ __('merchant.merchant_info') }}
                    </div>
                    <div class="card-body">
                        @if($pickupRequest->merchant)
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-container merchant-icon">
                                    <i class="fas fa-store fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $pickupRequest->merchant->name }}</h5>
                                    <p class="text-muted mb-0">{{ __('merchant.merchant') }}</p>
                                </div>
                            </div>

                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('merchant.phone') }}</span>
                                <span class="detail-value">{{ $pickupRequest->merchant->phone }}</span>
                            </div>
                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('merchant.email') }}</span>
                                <span class="detail-value">{{ $pickupRequest->merchant->email }}</span>
                            </div>
                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('merchant.contact_person') }}</span>
                                <span class="detail-value">{{ $pickupRequest->merchant->contact_person ?? '-' }}</span>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">{{ __('merchant.address') }}</div>
                                <div class="detail-value">
                                    {{ $pickupRequest->merchant->city ?? '-' }}, {{ $pickupRequest->merchant->region ?? '-' }}, {{ $pickupRequest->merchant->country ?? '-' }}
                                </div>
                            </div>
                            @if($pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                                <div class="alert alert-success mt-3 mb-0 py-2">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ __('pickup_request.merchant_location_available') }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-store fa-3x text-muted mb-3"></i>
                                <p class="text-muted">{{ __('pickup_request.no_merchant') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- السائق -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="fas fa-user-tie me-2"></i>
                        {{ __('driver.driver_info') }}
                    </div>
                    <div class="card-body">
                        @if($pickupRequest->driver)
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-container driver-icon">
                                    <i class="fas fa-user-tie fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">
                                        {{ $pickupRequest->driver->first_name ?? '' }}
                                        {{ $pickupRequest->driver->middle_name ?? '' }}
                                        {{ $pickupRequest->driver->last_name ?? '' }}
                                    </h5>
                                    <p class="text-muted mb-0">{{ __('driver.driver') }}</p>
                                </div>
                            </div>

                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('driver.phone') }}</span>
                                <span class="detail-value">{{ $pickupRequest->driver->phone ?? '-' }}</span>
                            </div>
                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('driver.vehicle_number') }}</span>
                                <span class="detail-value">{{ $pickupRequest->driver->vehicle_number ?? '-' }}</span>
                            </div>
                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('driver.vehicle_type') }}</span>
                                <span class="detail-value">{{__('driver.vehicle_type_' . $pickupRequest->driver->vehicle_type ) ?? '-' }}</span>
                            </div>
                            <div class="detail-row d-flex justify-content-between">
                                <span class="detail-label">{{ __('driver.vehicle_color') }}</span>
                                <span class="detail-value">{{ __('driver.vehicle_color_' . $pickupRequest->driver->vehicle_color) ?? '-' }}</span>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
                                <p class="text-muted">{{ __('pickup_request.no_driver_assigned') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- أزرار الإجراءات -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="action-buttons">
                            <a href="{{ route('admin.pickup_requests.index') }}" class="btn btn-secondary btn-action">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('general.back') }}
                            </a>
                            @if($pickupRequest->status == 'pending')
                            <button class="btn btn-success btn-action">
                                <i class="fas fa-check me-2"></i>{{ __('pickup_request.accept') }}
                            </button>
                            <button class="btn btn-danger btn-action">
                                <i class="fas fa-times me-2"></i>{{ __('pickup_request.reject') }}
                            </button>
                            @endif
                            @if($pickupRequest->status == 'accepted')
                            <button class="btn btn-primary btn-action">
                                <i class="fas fa-check-circle me-2"></i>{{ __('pickup_request.mark_completed') }}
                            </button>
                            @endif
                            <a href="#" class="btn btn-info btn-action ms-auto">
                                <i class="fas fa-print me-2"></i>{{ __('general.print') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            document.addEventListener('DOMContentLoaded', function () {
                // إعداد الخريطة
                var map = L.map('pickupMap').setView([{{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }}], 13);

                // إضافة خريطة OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                // تعريف أيقونات مخصصة
                var pickupIcon = L.divIcon({
                    html: '<div style="background-color: #4e73df; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3);"><i class="fas fa-box"></i></div>',
                    className: 'custom-marker',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });

                var merchantIcon = L.divIcon({
                    html: '<div style="background-color: #1cc88a; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3);"><i class="fas fa-store"></i></div>',
                    className: 'custom-marker',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });

                var driverIcon = L.divIcon({
                    html: '<div style="background-color: #36b9cc; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3);"><i class="fas fa-car"></i></div>',
                    className: 'custom-marker',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });

                // مصفوفة لتخزين الماركرات
                var markers = [];

                // كائن لتخزين المراجع
                var markerReferences = {};

                // دبوس الطلب
                var pickupMarker = L.marker([{{ $pickupRequest->latitude }}, {{ $pickupRequest->longitude }}], {icon: pickupIcon})
                    .addTo(map)
                    .bindPopup("<b>{{ __('pickup_request.pickup_location') }}</b><br>{{ $pickupRequest->city ?? '' }}, {{ $pickupRequest->region ?? '' }}");
                markers.push(pickupMarker);
                markerReferences['pickup'] = pickupMarker;

                // دبوس التاجر إذا كانت لديه إحداثيات
                @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                    var merchantMarker = L.marker([{{ $pickupRequest->merchant->latitude }}, {{ $pickupRequest->merchant->longitude }}], {icon: merchantIcon})
                        .addTo(map)
                        .bindPopup("<b>{{ __('merchant.merchant_location') }}</b><br>{{ $pickupRequest->merchant->name }}");
                    markers.push(merchantMarker);
                    markerReferences['merchant'] = merchantMarker;
                @endif

                // دبوس السائق إذا كانت لديه إحداثيات
                @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
                    var driverMarker = L.marker([{{ $pickupRequest->driver->latitude }}, {{ $pickupRequest->driver->longitude }}], {icon: driverIcon})
                        .addTo(map)
                        .bindPopup("<b>{{ __('driver.driver_location') }}</b><br>{{ $pickupRequest->driver->first_name }}");
                    markers.push(driverMarker);
                    markerReferences['driver'] = driverMarker;
                @endif

                // إضافة مقياس الخريطة
                L.control.scale({metric: true, imperial: false}).addTo(map);

                // إضافة دليل الخريطة مع إمكانية النقر
                var legend = L.control({position: 'bottomright'});
                legend.onAdd = function (map) {
                    var div = L.DomUtil.create('div', 'legend');

                    // HTML للأسطوانات القابلة للنقر
                    var html = '<h6>مفتاح الخريطة</h6>' +
                        '<div class="legend-item" onclick="focusOnMarker(\'pickup\')">' +
                        '<div class="legend-color" style="background-color: #4e73df"></div> <span>موقع الاستلام</span></div>';

                    @if($pickupRequest->merchant && $pickupRequest->merchant->latitude && $pickupRequest->merchant->longitude)
                        html += '<div class="legend-item" onclick="focusOnMarker(\'merchant\')">' +
                        '<div class="legend-color" style="background-color: #1cc88a"></div> <span>التاجر</span></div>';
                    @endif

                    @if($pickupRequest->driver && $pickupRequest->driver->latitude && $pickupRequest->driver->longitude)
                        html += '<div class="legend-item" onclick="focusOnMarker(\'driver\')">' +
                        '<div class="legend-color" style="background-color: #36b9cc"></div> <span>السائق</span></div>';
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

                // دالة للتركيز على الماركر المحدد
                window.focusOnMarker = function(markerType) {
                    if (markerReferences[markerType]) {
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
                        map.setView(markerReferences[markerType].getLatLng(), 15);
                    }
                };
            });
        </script>
    @endif
@endsection
