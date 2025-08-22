<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>{{ __('package.sender_address') }}</h5>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label" for="sender_country">{{ __('package.sender_country') }}</label>
                    <input type="text" class="form-control" name="sender_country" id="sender_country" wire:model="sender_country">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="sender_region">{{ __('package.sender_region') }}</label>
                    <input type="text" class="form-control" name="sender_region" id="sender_region" wire:model="sender_region">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="sender_city">{{ __('package.sender_city') }}</label>
                    <input type="text" class="form-control" name="sender_city" id="sender_city" wire:model="sender_city">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label" for="sender_district">{{ __('package.sender_district') }}</label>
                    <input type="text" class="form-control" name="sender_district" id="sender_district" wire:model="sender_district">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="sender_postal_code">{{ __('package.sender_postal_code') }}</label>
                    <input type="text" class="form-control" name="sender_postal_code" id="sender_postal_code" wire:model="sender_postal_code">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label">{{ __('package.sender_location') }}</label>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label" for="sender_latitude"> {{ __('package.sender_latitude') }}</label>
                            <input type="text" class="form-control" name="sender_latitude" id="sender_latitude" wire:model="latitude">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="sender_longitude"> {{ __('package.sender_longitude') }}</label>
                            <input type="text" class="form-control" name="sender_longitude" id="sender_longitude" wire:model="longitude">
                        </div>
                    </div>
                    <div id="map" wire:ignore style="width: 100%; height: 300px;"></div>

                </div>
            </div>
        </div>
    </div>



    <!-- مكتبة Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>



    <script>
        document.addEventListener('livewire:load', function () {

            function updateFieldsFromLatLng(lat, lng){
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        if(data.address){
                            @this.set('sender_country', data.address.country || '');
                            @this.set('sender_city', data.address.city || data.address.town || data.address.village || '');
                            @this.set('sender_region', data.address.state || '');
                            @this.set('sender_district', data.address.suburb || '');
                            @this.set('sender_postal_code', data.address.postcode || '');
                        }
                    });
            }

            var mapDiv = document.getElementById('map');
            if(!mapDiv) return;

            // ⚡ اجلب القيم من Livewire مباشرة
            var initialLat = parseFloat(@this.latitude) || 24.7136;
            var initialLng = parseFloat(@this.longitude) || 46.6753;

            var map = L.map('map', {
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

            Livewire.on('refreshMap', () => {
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
    </script>


</div>
