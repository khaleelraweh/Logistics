@extends('layouts.admin')

@section('style')
<style>
    #driversMap {
        width: 100%;
        height: 500px;
        border-radius: 10px;
    }
    .custom-car-icon i{
        background: transparent;
        border: none;
        color: red !important;
    }
</style>
@endsection

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('dashboard.dashboard') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('dashboard.logestics') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('dashboard.dashboard') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- الإحصائيات فوق الخريطة -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5>إجمالي السائقين</h5>
                <h2>{{ $stats['drivers_total'] }}</h2>
                <small>🟢 {{ $stats['drivers_available'] }} متاح | 🔴 {{ $stats['drivers_busy'] }} مشغول</small>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5>إجمالي الطرود</h5>
                <h2>{{ $stats['packages_total'] }}</h2>
                <small>📦 {{ $stats['packages_pending'] }} قيد الانتظار | ✅ {{ $stats['packages_delivered'] }} تم التوصيل</small>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5>عدد التجار</h5>
                <h2>{{ $stats['merchants_total'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5>عدد المستودعات</h5>
                <h2>{{ $stats['warehouses_total'] }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- الخريطة -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">{{ __('drivers.available_on_map') }}</h4>
                <div id="driversMap"></div>
            </div>
        </div>
    </div>
</div>

<!-- الرسوم البيانية أسفل الخريطة -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>توزيع الطرود</h5>
                <canvas id="packagesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>حالة السائقين</h5>
                <canvas id="driversChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // إنشاء الخريطة
    var map = L.map('driversMap').setView([24.7136, 46.6753], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var carIcon = L.divIcon({
        html: '<i class="fas fa-car" style="font-size:24px; color:#007bff;"></i>',
        className: 'custom-car-icon',
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -15]
    });

    var drivers = @json($drivers);
    var locale = "{{ app()->getLocale() }}";

    drivers.forEach(function(driver) {
        if(driver.latitude && driver.longitude) {
            var marker = L.marker([driver.latitude, driver.longitude], { icon: carIcon }).addTo(map);
            marker.bindPopup(`
                <strong>${driver.first_name[locale] ?? ''} ${driver.last_name[locale] ?? ''}</strong><br>
                📞 ${driver.phone ?? '---'}
            `);
        }
    });

    if(drivers.length > 0){
        var bounds = L.latLngBounds(drivers.map(d => [d.latitude, d.longitude]));
        map.fitBounds(bounds, { padding: [50, 50] });
    }

    // Charts
    new Chart(document.getElementById("packagesChart"), {
        type: 'doughnut',
        data: {
            labels: ["قيد الانتظار", "تم التوصيل"],
            datasets: [{
                data: [{{ $stats['packages_pending'] }}, {{ $stats['packages_delivered'] }}],
                backgroundColor: ["#ffc107", "#28a745"]
            }]
        }
    });

    new Chart(document.getElementById("driversChart"), {
        type: 'pie',
        data: {
            labels: ["متاح", "مشغول"],
            datasets: [{
                data: [{{ $stats['drivers_available'] }}, {{ $stats['drivers_busy'] }}],
                backgroundColor: ["#007bff", "#dc3545"]
            }]
        }
    });
});
</script>
@endsection
