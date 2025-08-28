<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>{{ __('package.receiver_address') }}</h5>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="receiver_country">{{ __('package.receiver_country') }}</label>
                    <input type="text" class="form-control" name="receiver_country" id="receiver_country" wire:model="receiver_country">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="receiver_region">{{ __('package.receiver_region') }}</label>
                    <input type="text" class="form-control" name="receiver_region" id="receiver_region" wire:model="receiver_region">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="receiver_city">{{ __('package.receiver_city') }}</label>
                    <input type="text" class="form-control" name="receiver_city" id="receiver_city" wire:model="receiver_city">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="receiver_district">{{ __('package.receiver_district') }}</label>
                    <input type="text" class="form-control" name="receiver_district" id="receiver_district" wire:model="receiver_district">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="receiver_postal_code">{{ __('package.receiver_postal_code') }}</label>
                    <input type="text" class="form-control" name="receiver_postal_code" id="receiver_postal_code" wire:model="receiver_postal_code">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label class="form-label">{{ __('package.receiver_location') }}</label>
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="receiver_latitude">{{ __('package.receiver_latitude') }}</label>
                            <input type="text" class="form-control" name="receiver_latitude" id="receiver_latitude" wire:model="latitude" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="receiver_longitude">{{ __('package.receiver_longitude') }}</label>
                            <input type="text" class="form-control" name="receiver_longitude" id="receiver_longitude" wire:model="longitude" >
                        </div>
                    </div>
                    <div id="receiver-map" wire:ignore style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('livewire:load', function () {

            function updateFieldsFromLatLng(lat, lng){
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        if(data.address){
                            @this.set('receiver_country', data.address.country || '');
                            @this.set('receiver_city', data.address.city || data.address.town || data.address.village || '');
                            @this.set('receiver_region', data.address.state || '');
                            @this.set('receiver_district', data.address.suburb || '');
                            @this.set('receiver_postal_code', data.address.postcode || '');
                        }
                    });
            }

            var mapDiv = document.getElementById('receiver-map');
            if(!mapDiv) return;

            var initialLat = parseFloat(@this.latitude) || @this.defaultLatitude;
            var initialLng = parseFloat(@this.longitude) || @this.defaultLongitude;

            var map = L.map('receiver-map', {
                minZoom: 8,
                maxZoom: 18,
                zoomControl: true,
            }).setView([initialLat, initialLng], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                subdomains: ['a','b','c'],
                tileSize: 256,
            }).addTo(map);

            var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

            marker.on('dragend', function(e){
                var latlng = marker.getLatLng();
                @this.set('latitude', latlng.lat);
                @this.set('longitude', latlng.lng);
                updateFieldsFromLatLng(latlng.lat, latlng.lng);
            });

            map.on('click', function(e){
                marker.setLatLng(e.latlng);
                @this.set('latitude', e.latlng.lat);
                @this.set('longitude', e.latlng.lng);
                updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
            });

            Livewire.on('refreshReceiverMap', () => {
                var lat = parseFloat(@this.latitude);
                var lng = parseFloat(@this.longitude);
                if(!isNaN(lat) && !isNaN(lng)){
                    marker.setLatLng([lat, lng]);
                    map.setView([lat, lng], 11);
                    map.invalidateSize();
                }
            });

            setTimeout(() => map.invalidateSize(), 300);
        });
    </script> --}}

    <script>
    document.addEventListener('livewire:load', function () {
        let receiverMap, receiverMarker;

        function initReceiverMap() {
            var mapDiv = document.getElementById('receiver-map');
            if(!mapDiv) return;

            var initialLat = parseFloat(@this.latitude) || parseFloat(@this.defaultLatitude) || 24.7136;
            var initialLng = parseFloat(@this.longitude) || parseFloat(@this.defaultLongitude) || 46.6753;

            // إنشاء الخريطة
            receiverMap = L.map('receiver-map', {
                minZoom: 8,
                maxZoom: 18,
                zoomControl: true,
            }).setView([initialLat, initialLng], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                subdomains: ['a','b','c'],
                tileSize: 256,
            }).addTo(receiverMap);

            receiverMarker = L.marker([initialLat, initialLng], {draggable:true}).addTo(receiverMap);

            receiverMarker.on('dragend', function(e){
                var latlng = receiverMarker.getLatLng();
                @this.set('latitude', latlng.lat);
                @this.set('longitude', latlng.lng);
                updateFieldsFromLatLng(latlng.lat, latlng.lng);
            });

            receiverMap.on('click', function(e){
                receiverMarker.setLatLng(e.latlng);
                @this.set('latitude', e.latlng.lat);
                @this.set('longitude', e.latlng.lng);
                updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
            });

            // إعادة رسم الخريطة بعد التحميل
            setTimeout(() => {
                if (receiverMap) {
                    receiverMap.invalidateSize();
                }
            }, 500);
        }

        function updateFieldsFromLatLng(lat, lng){
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    if(data.address){
                        @this.set('receiver_country', data.address.country || '');
                        @this.set('receiver_city', data.address.city || data.address.town || data.address.village || '');
                        @this.set('receiver_region', data.address.state || '');
                        @this.set('receiver_district', data.address.suburb || '');
                        @this.set('receiver_postal_code', data.address.postcode || '');
                    }
                });
        }

        // تهيئة الخريطة لأول مرة
        initReceiverMap();

        // إعادة رسم الخريطة عند تحديث Livewire
        Livewire.hook('message.processed', (message, component) => {
            setTimeout(() => {
                if (receiverMap) {
                    receiverMap.invalidateSize();
                }
            }, 300);
        });

        // إعادة رسم الخريطة عند تغيير حجم النافذة
        window.addEventListener('resize', function() {
            if (receiverMap) {
                setTimeout(() => {
                    receiverMap.invalidateSize();
                }, 300);
            }
        });

        // حدث خاص لتحديث الخريطة
        Livewire.on('refreshReceiverMap', () => {
            var lat = parseFloat(@this.latitude);
            var lng = parseFloat(@this.longitude);
            if(!isNaN(lat) && !isNaN(lng) && receiverMap && receiverMarker){
                receiverMarker.setLatLng([lat, lng]);
                receiverMap.setView([lat, lng], 11);
                setTimeout(() => {
                    receiverMap.invalidateSize();
                }, 300);
            }
        });

        // حدث لإعادة رسم الخريطة من Blade
        window.addEventListener('mapInvalidateSize', () => {
            if (receiverMap) {
                setTimeout(() => {
                    receiverMap.invalidateSize();
                }, 300);
            }
        });
    });
</script>
</div>
