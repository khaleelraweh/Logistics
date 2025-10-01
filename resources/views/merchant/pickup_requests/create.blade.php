@extends('layouts.merchant')

@section('content')


     <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pickup_request.add_pickup_request') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('merchant.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('merchant.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pickup_request.add_pickup_request') }}</li>
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


                    <form action="{{ route('merchant.pickup_requests.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Address Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('general.address_details') }}</h5>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">{{ __('general.address') }}</label>
                                <div class="col-md-10">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <input name="country" class="form-control" id="country" type="text" value="{{ old('country') }}" placeholder="{{ __('general.country') }}">
                                            @error('country')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="region" class="form-control" id="region" type="text" value="{{ old('region') }}" placeholder="{{ __('general.region') }}">
                                            @error('region')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="city" class="form-control" id="city" type="text" value="{{ old('city') }}" placeholder="{{ __('general.city') }}">
                                            @error('city')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="district" class="form-control" id="district" type="text" value="{{ old('district') }}" placeholder="{{ __('general.district') }}">
                                            @error('district')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>



                            {{-- <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('general.geographical_location') }}</label>
                                <div class="col-md-10">
                                    <div class="row">
                                            <div class="col-md-4">
                                            <input type="text" id="latitude" name="latitude" class="form-control mb-2" placeholder="{{ __('general.latitude') }}" value="{{ old('latitude', $merchant->latitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="longitude" name="longitude" class="form-control mb-2" placeholder="{{ __('general.longitude') }}" value="{{ old('longitude', $merchant->longitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="postal_code" class="form-control" id="postal_code" type="text" value="{{ old('postal_code') }}" placeholder="{{ __('general.postal_code') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="map" style="width: 100%; height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>

                            </div> --}}

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">{{ __('general.geographical_location') }}</label>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" id="latitude" name="latitude" class="form-control mb-2"
                                                placeholder="{{ __('general.latitude') }}"
                                                value="{{ old('latitude', auth()->user()->merchant->latitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="longitude" name="longitude" class="form-control mb-2"
                                                placeholder="{{ __('general.longitude') }}"
                                                value="{{ old('longitude', auth()->user()->merchant->longitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="postal_code" class="form-control" id="postal_code" type="text"
                                                value="{{ old('postal_code', auth()->user()->merchant->postal_code ?? '') }}"
                                                placeholder="{{ __('general.postal_code') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="map" style="width: 100%; height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                          <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('general.schedule_event') }}</h5>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="scheduled_at">{{ __('pickup_request.scheduled_at') }}</label>
                                <div class="col-sm-10">
                                    <input name="scheduled_at" class="form-control" id="scheduled_at" type="date" value="{{ old('scheduled_at', now()->format('Y-m-d')) }}">
                                    @error('scheduled_at')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Note --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="note">{{ __('general.note') }}</label>
                                <div class="col-sm-10">
                                    <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
                                    @error('note')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">{{ __('general.status') }}</label>
                                <div class="col-sm-10">
                                    <!-- الحقل مخفي ويُرسل مع الفورم -->
                                    <input type="hidden" name="status" value="pending">

                                    <!-- عرض النص للمشاهد -->
                                    <span class="form-control-plaintext">
                                        {{ __('pickup_request.status_pending') }}
                                    </span>
                                </div>
                            </div>

                          </div>


                        <!-- Submit Button -->
                        <div class="text-end pt-3">
                            @ability('merchant', 'create_pickup_requests')
                                <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                    <i class="ri-save-3-line me-2"></i>
                                    <i class="bi bi-save me-2"></i>
                                    {{ __('pickup_request.save_pickup_request') }}
                                </button>
                            @endability

                            <a href="{{ route('merchant.pickup_requests.index') }}" class="btn btn-outline-danger ms-2">
                                <i class="ri-arrow-go-back-line me-1"></i>
                                {{ __('panel.cancel') }}
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>

    <!-- تضمين مكتبة Leaflet CSS و JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // دالة لتحديث الحقول من خط الطول والعرض
        function updateFieldsFromLatLng(lat, lng){
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    if(data.address){
                        document.getElementById('country').value = data.address.country || '';
                        document.getElementById('region').value = data.address.state || '';
                        document.getElementById('city').value = data.address.city || data.address.town || data.address.village || '';
                        document.getElementById('district').value = data.address.suburb || '';
                        document.getElementById('postal_code').value = data.address.postcode || '';
                    }
                });
        }

        // دالة لتحويل العنوان لإحداثيات
        function getLatLngFromAddress(address, callback) {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        callback(parseFloat(data[0].lat), parseFloat(data[0].lon));
                    } else {
                        callback(null, null);
                    }
                });
        }

        // بيانات التاجر من auth()->user()->merchant
        var merchantCountry  = "{{ auth()->user()->merchant->country ?? '' }}";
        var merchantRegion   = "{{ auth()->user()->merchant->region ?? '' }}";
        var merchantCity     = "{{ auth()->user()->merchant->city ?? '' }}";
        var merchantDistrict = "{{ auth()->user()->merchant->district ?? '' }}";

        // قيم الإحداثيات (من old أو من التاجر)
        var initialLat = parseFloat(document.getElementById('latitude').value) || null;
        var initialLng = parseFloat(document.getElementById('longitude').value) || null;

        // إنشاء الخريطة (افتراضي وسط الرياض)
        var map = L.map('map').setView([24.7136, 46.6753], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = null;

        function setMarker(lat, lng) {
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], {draggable:true}).addTo(map);
                marker.on('dragend', function(e) {
                    var latlng = marker.getLatLng();
                    document.getElementById('latitude').value = latlng.lat.toFixed(7);
                    document.getElementById('longitude').value = latlng.lng.toFixed(7);
                    updateFieldsFromLatLng(latlng.lat, latlng.lng);
                });
            }
            map.setView([lat, lng], 13);
            document.getElementById('latitude').value = lat.toFixed(7);
            document.getElementById('longitude').value = lng.toFixed(7);
            updateFieldsFromLatLng(lat, lng);
        }

        // أولوية تحديد موقع البداية
        if (merchantCountry || merchantCity || merchantRegion || merchantDistrict) {
            let fullAddress = [merchantDistrict, merchantCity, merchantRegion, merchantCountry].filter(Boolean).join(", ");
            getLatLngFromAddress(fullAddress, function(lat, lng) {
                if (lat && lng) {
                    setMarker(lat, lng);
                } else if (initialLat && initialLng) {
                    setMarker(initialLat, initialLng);
                } else {
                    setMarker(24.7136, 46.6753); // الرياض
                }
            });
        } else if (initialLat && initialLng) {
            setMarker(initialLat, initialLng);
        } else {
            setMarker(24.7136, 46.6753); // الرياض
        }

        // تحديث العلامة عند النقر على الخريطة
        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });

    });
</script>
@endsection




