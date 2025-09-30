@extends('layouts.driver')

@section('style')

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
            height: 200px;
            border-radius: 8px;
            /* overflow: hidden; */
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
        .section-title {
            border-bottom: 2px solid #4a6fdc;
            padding-bottom: 10px;
            margin: 25px 0 15px;
            color: #4a6fdc;
        }
        .required-field::after {
            content: " *";
            color: red;
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
        .sender-info, .receiver-info {
        }
        .coordinates {
            font-family: monospace;
            background-color: #f8f9fa;
            padding: 5px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>

    <!-- مكتبة Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>

    <style>
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

        /* تأكد من أن الخريطة تأخذ الحجم الكامل */
        .map-container .leaflet-container {
            height: 100%;
            width: 100%;
        }
    </style>

@endsection




@section('content')



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ __('return_request.return_request_info') }}</h4>
                @livewire('driver.return-request.create-return-request-component')
            </div>
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
document.addEventListener('livewire:load', function () {
    // دالة لتهيئة الخرائط
    function initMaps() {
        // البحث عن جميع عناصر الخرائط
        const mapContainers = document.querySelectorAll('.map-container');

        mapContainers.forEach(container => {
            const lat = parseFloat(container.getAttribute('data-lat'));
            const lng = parseFloat(container.getAttribute('data-lng'));
            const mapId = container.id;

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
                L.marker([lat, lng]).addTo(map)
                    .bindPopup('{{ __("package.sender_location") }}')
                    .openPopup();
            } else {
                // إذا لم تكن هناك إحداثيات صحيحة
                container.innerHTML = `
                    <div class="map-placeholder">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ __("package.no_location_data") }}
                    </div>
                `;
            }
        });
    }

    // تهيئة الخرائط عند التحميل الأول
    initMaps();

    // إعادة تهيئة الخرائط عند تحديث Livewire
    Livewire.hook('message.processed', () => {
        setTimeout(initMaps, 100);
    });

    // إعادة تهيئة الخرائط عند تغيير حجم النافذة
    window.addEventListener('resize', function() {
        setTimeout(initMaps, 300);
    });
});
</script>
@endsection


