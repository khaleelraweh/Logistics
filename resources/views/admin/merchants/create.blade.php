@extends('layouts.admin')

@section('styles')
<style>
    /* Custom Form Styles */
    .card {
        border-radius: 12px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        border: none;
    }

    .form-control, .form-select, .input-group-text {
        border-radius: 8px;
    }

    .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }

    .form-switch.form-switch-lg .form-check-input {
        width: 4rem;
        height: 2rem;
    }

    .file-upload-container {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .file-upload-container:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }

    .file-input-overview {
        width: 100%;
    }

    .file-upload-preview img {
        border-radius: 8px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* Language Badge */
    .language-type .flag-icon {
        width: 16px;
        height: 16px;
    }

    /* Section Headers */
    .section-header {
        position: relative;
        padding-left: 40px;
        margin-bottom: 20px;
    }

    .section-header i {
        position: absolute;
        left: 0;
        top: 0;
        background-color: rgba(13, 110, 253, 0.1);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d6efd;
    }

    /* Social Icons */
    .input-group-text i {
        min-width: 16px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .col-form-label {
            text-align: left !important;
            margin-bottom: 5px;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Title -->


    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('merchant.add_merchant') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.merchants.index') }}">{{ __('merchant.merchants') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('merchant.add_merchant') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Merchant Form -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('admin.merchants.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <!-- Merchant Info Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-info-circle text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('merchant.merchant_info') }}</h5>
                            </div>

                            @foreach (config('locales.languages') as $key => $val)
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="name[{{ $key }}]">
                                        {{ __('merchant.name') }}
                                        <span class="badge bg-light text-dark ms-2">
                                            <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} me-1"></i>
                                            {{ __('language.' . $key) }}
                                        </span>
                                    </label>
                                    <div class="col-md-10">
                                        <input name="name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text"
                                               value="{{ old('name.' . $key) }}" required>
                                        @error('name.' . $key)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        <!-- Contact Data Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-person-lines-fill text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('merchant.contact_data') }}</h5>
                            </div>

                            @foreach (config('locales.languages') as $key => $val)
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="contact_person[{{ $key }}]">
                                        {{ __('merchant.contact_person') }}
                                        <span class="badge bg-light text-dark ms-2">
                                            <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} me-1"></i>
                                            {{ __('language.' . $key) }}
                                        </span>
                                    </label>
                                    <div class="col-md-10">
                                        <input name="contact_person[{{ $key }}]" class="form-control" id="contact_person[{{ $key }}]" type="text"
                                               value="{{ old('contact_person.' . $key) }}">
                                        @error('contact_person.' . $key)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="phone">{{ __('general.phone') }}</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input name="phone" class="form-control" id="phone" type="text"
                                               value="{{ old('phone') }}" required>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="email">{{ __('general.email') }}</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input id="email" class="form-control" name="email"
                                               type="email" value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="api_key">{{ __('merchant.api_key') }}</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                                        <input name="api_key" class="form-control" id="api_key" type="text"
                                               value="{{ old('api_key', Str::random(32)) }}" required>
                                        <button class="btn btn-outline-secondary" type="button" id="generateApiKey">
                                            <i class="bi bi-arrow-repeat"></i> {{ __('general.generate') }}
                                        </button>
                                    </div>
                                    @error('api_key')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Logo Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-image text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('merchant.logo') }}</h5>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="merchant_logo">{{ __('merchant.logo') }}</label>
                                <div class="col-md-10">
                                    <div class="file-upload-container">
                                        <input type="file" name="logo" id="merchant_logo" class="file-input-overview">
                                        <div class="file-upload-preview mt-2 d-none">
                                            <img id="logoPreview" src="#" alt="Logo Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>
                                    @error('logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('general.address_details') }}</h5>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="country">{{ __('general.country') }}</label>
                                <div class="col-md-10">
                                    <input name="country" class="form-control" id="country" type="text" value="{{ old('country') }}">
                                    @error('country')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="region">{{ __('general.region') }}</label>
                                <div class="col-md-10">
                                    <input name="region" class="form-control" id="region" type="text" value="{{ old('region') }}">
                                    @error('region')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="city">{{ __('general.city') }}</label>
                                <div class="col-md-10">
                                    <input name="city" class="form-control" id="city" type="text" value="{{ old('city') }}">
                                    @error('city')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="district">{{ __('general.district') }}</label>
                                <div class="col-md-10">
                                    <input name="district" class="form-control" id="district" type="text" value="{{ old('district') }}">
                                    @error('district')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="postal_code">{{ __('general.postal_code') }}</label>
                                <div class="col-md-10">
                                    <input name="postal_code" class="form-control" id="postal_code" type="text" value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">{{ __('general.location') }}</label>
                                <div class="col-md-10">
                                    <input type="text" id="latitude" name="latitude" class="form-control mb-2" placeholder="Latitude" value="{{ old('latitude', $merchant->latitude ?? '') }}">
                                    <input type="text" id="longitude" name="longitude" class="form-control mb-2" placeholder="Longitude" value="{{ old('longitude', $merchant->longitude ?? '') }}">
                                    <div id="map" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>


                            {{-- <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="latitude">{{ __('general.latitude') }}</label>
                                <div class="col-md-4">
                                    <input name="latitude" class="form-control" id="latitude" type="text" value="{{ old('latitude') }}">
                                    @error('latitude')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label class="col-md-2 col-form-label" for="longitude">{{ __('general.longitude') }}</label>
                                <div class="col-md-4">
                                    <input name="longitude" class="form-control" id="longitude" type="text" value="{{ old('longitude') }}">
                                    @error('longitude')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="others">{{ __('general.additional_notes') }}</label>
                                <div class="col-md-10">
                                    <input name="others" class="form-control" id="others" type="text" value="{{ old('others') }}">
                                    @error('others')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <!-- Social Links Section -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="bi bi-share text-primary"></i>
                                </div>
                                <h5 class="mb-0">{{ __('general.social_links') }}</h5>
                            </div>

                            @foreach (['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'] as $social)
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="{{ $social }}">
                                        <i class="bi bi-{{ $social == 'website' ? 'globe' : $social }} me-2"></i>
                                        {{ ucfirst(__('social.'.$social)) }}
                                    </label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-{{ $social == 'website' ? 'globe' : $social }}"></i>
                                            </span>
                                            <input name="{{ $social }}" class="form-control" id="{{ $social }}"
                                                   type="url" value="{{ old($social) }}" placeholder="https://">
                                        </div>
                                        @error($social)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Status Section -->
                        <div class="mb-4">
                            <div class="row">
                                <label class="col-md-2 col-form-label" for="status1">{{ __('general.status') }}</label>
                                <div class="col-md-10">
                                    <div class="form-check form-switch form-switch-lg">
                                        <input type="checkbox" class="form-check-input" name="status" id="status1"
                                               {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            {{ __('merchant.choose_merchant_status') }}
                                        </label>
                                    </div>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        @ability('admin', 'create_merchants')
                           <div class="text-end pt-3">
                                <button type="submit" class="btn btn-primary rounded-pill px-4 d-inline-flex align-items-center">
                                    <i class="ri-save-3-line me-2"></i>
                                    <i class="bi bi-save me-2"></i>
                                    {{ __('merchant.save_merchant_data') }}
                                </button>

                                <a href="{{ route('admin.merchants.index') }}" class="btn btn-outline-danger ms-2">
                                    <i class="ri-arrow-go-back-line me-1"></i>
                                    {{ __('panel.cancel') }}
                                </a>
                            </div>
                        @endability
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')
<script>
    $(document).ready(function() {
        // Initialize file input
        $("#merchant_logo").fileinput({
            theme: "fa5",
            maxFileCount: 1,
            allowedFileTypes: ['image'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false,
            browseClass: "btn btn-primary",
            browseIcon: '<i class="bi bi-folder2-open"></i> ',
            browseLabel: "{{ __('general.select_file') }}",
            msgPlaceholder: "{{ __('general.choose_file') }}",
            dropZoneEnabled: false
        }).on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#logoPreview').attr('src', e.target.result);
                    $('.file-upload-preview').removeClass('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Generate API Key
        $('#generateApiKey').click(function() {
            $('#api_key').val(generateApiKey(32));
        });

        function generateApiKey(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    });
</script>

 <!-- تضمين مكتبة Leaflet CSS و JS -->
 <!-- مكتبة خاصة بالخرائط -->
{{-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // إحداثيات البداية
        // صنعاء
        // var initialLat = parseFloat(document.getElementById('latitude').value) || 15.3694;
        // var initialLng = parseFloat(document.getElementById('longitude').value) || 44.1910;

        // وسط الرياض
        var initialLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
        var initialLng = parseFloat(document.getElementById('longitude').value) || 46.6753;

        // إنشاء الخريطة
        var map = L.map('map').setView([initialLat, initialLng], 13);

        // إضافة طبقة OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // إنشاء العلامة القابلة للسحب
        var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

        // تحديث الحقول عند تحريك العلامة
        marker.on('dragend', function(e) {
            var latlng = marker.getLatLng();
            document.getElementById('latitude').value = latlng.lat.toFixed(7);
            document.getElementById('longitude').value = latlng.lng.toFixed(7);
        });

        // تحديث العلامة عند النقر على الخريطة
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(7);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(7);
        });
    });
</script> --}}

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

        // إحداثيات البداية: إذا موجودة من الـ old أو من التاجر، وإلا وسط الرياض
        var initialLat = parseFloat(document.getElementById('latitude').value) || 24.7136;
        var initialLng = parseFloat(document.getElementById('longitude').value) || 46.6753;

        // إنشاء الخريطة
        var map = L.map('map').setView([initialLat, initialLng], 13);

        // إضافة طبقة OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // إنشاء العلامة القابلة للسحب
        var marker = L.marker([initialLat, initialLng], {draggable:true}).addTo(map);

        // تحديث الحقول عند تحريك العلامة
        marker.on('dragend', function(e) {
            var latlng = marker.getLatLng();
            document.getElementById('latitude').value = latlng.lat.toFixed(7);
            document.getElementById('longitude').value = latlng.lng.toFixed(7);
            updateFieldsFromLatLng(latlng.lat, latlng.lng);
        });

        // تحديث العلامة عند النقر على الخريطة
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(7);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(7);
            updateFieldsFromLatLng(e.latlng.lat, e.latlng.lng);
        });

        // تعبئة الحقول لأول مرة عند التحميل إذا كانت الإحداثيات موجودة
        if(initialLat && initialLng){
            updateFieldsFromLatLng(initialLat, initialLng);
        }

    });
</script>



{{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
<script>
    let map;
    let marker;

    function initMap() {
        const lat = parseFloat(document.getElementById('latitude').value) || 15.3694; // قيمة افتراضية
        const lng = parseFloat(document.getElementById('longitude').value) || 44.1910;

        const initialPosition = { lat: lat, lng: lng };

        map = new google.maps.Map(document.getElementById("map"), {
            center: initialPosition,
            zoom: 8,
        });

        marker = new google.maps.Marker({
            position: initialPosition,
            map: map,
            draggable: true
        });

        // عند تحريك المؤشر يتم تحديث الحقول
        marker.addListener('dragend', function(event) {
            document.getElementById('latitude').value = event.latLng.lat();
            document.getElementById('longitude').value = event.latLng.lng();
        });

        // يمكن النقر على الخريطة لتغيير الموقع
        map.addListener('click', function(event) {
            marker.setPosition(event.latLng);
            document.getElementById('latitude').value = event.latLng.lat();
            document.getElementById('longitude').value = event.latLng.lng();
        });
    }

    window.onload = initMap;
</script> --}}

@endsection
