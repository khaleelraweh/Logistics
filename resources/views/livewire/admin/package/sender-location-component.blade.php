<div>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>{{ __('package.sender_address') }}</h5>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">الدولة</label>
                    <input type="text" class="form-control" wire:model="sender_country">
                </div>
                <div class="col-md-4">
                    <label class="form-label">المنطقة</label>
                    <input type="text" class="form-control" wire:model="sender_region">
                </div>
                <div class="col-md-4">
                    <label class="form-label">المدينة</label>
                    <input type="text" class="form-control" wire:model="sender_city">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">الحي</label>
                    <input type="text" class="form-control" wire:model="sender_district">
                </div>
                <div class="col-md-6">
                    <label class="form-label">الرمز البريدي</label>
                    <input type="text" class="form-control" wire:model="sender_postal_code">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label">الموقع</label>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">خط العرض (Latitude)</label>
                            <input type="text" class="form-control" wire:model="latitude">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">خط الطول (Longitude)</label>
                            <input type="text" class="form-control" wire:model="longitude">
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

{{--
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

            var senderLocation = @this.sender_location || '24.7136,46.6753';
            var loc = senderLocation.split(',');
            var initialLat = parseFloat(loc[0]) || 24.7136;
            var initialLng = parseFloat(loc[1]) || 46.6753;

            var map = L.map('map').setView([initialLat, initialLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

            marker.on('dragend', function(e){
                var latlng = marker.getLatLng();
                @this.set('sender_location', latlng.lat + ',' + latlng.lng);
                updateFieldsFromLatLng(latlng.lat, latlng.lng);
            });

            map.on('click', function(e){
                marker.setLatLng(e.latlng);
                @this.set('sender_location', e.latlng.lat + ',' + e.latlng.lng);
                updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
            });

            Livewire.on('refreshMap', () => {
                var loc = @this.sender_location.split(',');
                if(loc.length === 2){
                    marker.setLatLng([parseFloat(loc[0]), parseFloat(loc[1])]);
                    map.setView([parseFloat(loc[0]), parseFloat(loc[1])], 13);
                    map.invalidateSize(); // 👈 هذه السطر مهم جدًا
                }
            });

            // إذا كانت الخريطة مخفية عند التحميل (مثلاً داخل tab)، أضف هذا:
            setTimeout(() => map.invalidateSize(), 500);

        });
    </script> --}}


    {{-- <script>
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

            // ⚡ إذا لم يحدد المستخدم، اجعل نقطة البداية "وسط الرياض"
            var senderLocation = @this.sender_location || '24.7136,46.6753';
            var loc = senderLocation.split(',');
            var initialLat = parseFloat(loc[0]) || 24.7136;
            var initialLng = parseFloat(loc[1]) || 46.6753;

            // ⚡ تقليل مستوى التكبير الافتراضي (يخفف الضغط على الخريطة)
            var map = L.map('map', {
                minZoom: 8,   // أصغر زوم ممكن (تجنب عرض كل السعودية)
                maxZoom: 18,  // أكبر زوم
                zoomControl: true,
            }).setView([initialLat, initialLng], 11); // 👈 زوم أقل (أسرع)

            // ⚡ استخدام بلاطات خفيفة (Carto أو OSM)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                subdomains: ['a','b','c'], // تحميل متوازي أسرع
                tileSize: 256,
            }).addTo(map);

            var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

            marker.on('dragend', function(e){
                var latlng = marker.getLatLng();
                @this.set('sender_location', latlng.lat + ',' + latlng.lng);
                updateFieldsFromLatLng(latlng.lat, latlng.lng);
            });

            map.on('click', function(e){
                marker.setLatLng(e.latlng);
                @this.set('sender_location', e.latlng.lat + ',' + e.latlng.lng);
                updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
            });

            Livewire.on('refreshMap', () => {
                var loc = @this.sender_location.split(',');
                if(loc.length === 2){
                    marker.setLatLng([parseFloat(loc[0]), parseFloat(loc[1])]);
                    map.setView([parseFloat(loc[0]), parseFloat(loc[1])], 11);
                    map.invalidateSize();
                }
            });

            // ⚡ إصلاح مشكلة العرض في التابات أو النماذج
            setTimeout(() => map.invalidateSize(), 300);
        });
    </script> --}}


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
