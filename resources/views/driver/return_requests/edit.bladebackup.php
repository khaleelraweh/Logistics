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




<!-- return_request Form -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-truck-return_request-outline me-1"></i> {{ __('return_request.return_request_info') }}
                </h4>

                @livewire('driver.return-request.edit-return-request-component', ['id' => $return_request->id])

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
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                {{ __("package.no_location_data") }}
                            </div>
                        `;
                        container.setAttribute('data-initialized', 'true');
                    }
                });
            }

            // تهيئة الخرائط عند التحميل الأول
            setTimeout(initMaps, 500);

            // إعادة تهيئة الخرائط عند تحديث Livewire
            Livewire.hook('message.processed', () => {
                setTimeout(initMaps, 300);
            });

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

            // دالة عالمية يمكن استدعاؤها من أي مكان
            window.refreshMaps = function() {
                initMaps();
            };

            // في الـ script
            Livewire.on('refreshMaps', () => {
                setTimeout(initMaps, 200);
            });
        });
    </script>
@endsection
