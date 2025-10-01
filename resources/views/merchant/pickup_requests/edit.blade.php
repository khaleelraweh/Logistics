@extends('layouts.merchant')

@section('content')

      <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('pickup_request.edit_pickup_request') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('merchant.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('merchant.pickup_requests.index') }}">{{ __('pickup_request.manage_pickup_requests') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('pickup_request.edit_pickup_request') }}</li>
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


                    <form action="{{ route('merchant.pickup_requests.update', $pickupRequest->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


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
                                            <input name="country" class="form-control" id="country" type="text" value="{{ old('country', $pickupRequest->country) }}" placeholder="{{ __('general.country') }}">
                                            @error('country')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="region" class="form-control" id="region" type="text" value="{{ old('region' , $pickupRequest->region) }}" placeholder="{{ __('general.region') }}">
                                            @error('region')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="city" class="form-control" id="city" type="text" value="{{ old('city' , $pickupRequest->city) }}" placeholder="{{ __('general.city') }}">
                                            @error('city')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input name="district" class="form-control" id="district" type="text" value="{{ old('district' , $pickupRequest->district) }}" placeholder="{{ __('general.district') }}">
                                            @error('district')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="row">
                                <label class="col-md-2 col-form-label">{{ __('general.geographical_location') }}</label>
                                <div class="col-md-10">
                                    <div class="row">
                                            <div class="col-md-4">
                                            <input type="text" id="latitude" name="latitude" class="form-control mb-2" placeholder="{{ __('general.latitude') }}" value="{{ old('latitude', $pickupRequest->latitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" id="longitude" name="longitude" class="form-control mb-2" placeholder="{{ __('general.longitude') }}" value="{{ old('longitude', $pickupRequest->longitude ?? '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input name="postal_code" class="form-control" id="postal_code" type="text" value="{{ old('postal_code' , $pickupRequest->postal_code) }}" placeholder="{{ __('general.postal_code') }}">
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
                                    <input name="scheduled_at" class="form-control" id="scheduled_at" type="date"
                                    value="{{ old('scheduled_at', $pickupRequest->scheduled_at ? \Carbon\Carbon::parse($pickupRequest->scheduled_at)->toDateString() : '') }}">

                                    @error('scheduled_at')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Note -->
                            <div class="row mb-4">
                                <label for="note" class="col-sm-2 col-form-label">{{ __('delivery.note') }}</label>
                                <div class="col-sm-10">
                                    <textarea name="note" id="note" class="form-control">{{ old('note', $pickupRequest->note) }}</textarea>
                                    @error('note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="status1">{{ __('general.status') }}</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="status1">
                                        <option value="pending" {{ old('status', $pickupRequest->status) == 'pending' ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_pending') }}
                                        </option>
                                        <option value="accepted" {{ old('status', $pickupRequest->status) == 'accepted' ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_accepted') }}
                                        </option>
                                        <option value="completed" {{ old('status', $pickupRequest->status) == 'completed' ? 'selected' : '' }}>
                                            {{ __('pickup_request.status_completed') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end pt-3">
                            @ability('merchant', 'update_pickup_requests')
                                <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                    <i class="ri-save-3-line me-2"></i>
                                    <i class="bi bi-save me-2"></i>
                                    {{ __('pickup_request.update_pickup_request') }}
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

    <!-- Leaflet CSS & JS -->
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

            // إحداثيات البداية: من قاعدة البيانات إذا موجودة، وإلا وسط الرياض
            var initialLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
            var initialLng = parseFloat(document.getElementById('longitude').value) || 46.6753;

            // إنشاء الخريطة
            var map = L.map('map').setView([initialLat, initialLng], 13);

            // إضافة طبقة OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // إنشاء Marker قابل للسحب
            var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

            // عند سحب Marker، يتم تحديث الحقول تلقائيًا
            marker.on('dragend', function(e) {
                var latlng = marker.getLatLng();
                document.getElementById('latitude').value = latlng.lat.toFixed(7);
                document.getElementById('longitude').value = latlng.lng.toFixed(7);
                updateFieldsFromLatLng(latlng.lat, latlng.lng);
            });

            // عند النقر على الخريطة، نقل Marker وتحديث الحقول
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat.toFixed(7);
                document.getElementById('longitude').value = e.latlng.lng.toFixed(7);
                updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
            });

            // تحديث الحقول لأول مرة عند التحميل إذا كانت الإحداثيات موجودة من DB
            if(initialLat && initialLng){
                updateFieldsFromLatLng(initialLat, initialLng);
            }

        });
    </script>
@endsection
