@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
     <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('rental.add_rental') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.merchants.index') }}">{{ __('merchant.merchants') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('merchant.edit_merchant') }}</li>
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
                    <form action="{{ route('admin.merchants.update', $merchant->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PATCH')

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
                                               value="{{ old('name.' . $key, $merchant->getTranslation('name', $key)) }}" required>
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
                                               value="{{ old('contact_person.' . $key, $merchant->getTranslation('contact_person', $key)) }}">
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
                                               value="{{ old('phone', $merchant->phone) }}" required>
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
                                               type="email" value="{{ old('email', $merchant->email) }}" required>
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
                                               value="{{ old('api_key', $merchant->api_key) }}" required>
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
                                        @if($merchant->logo)
                                        <div class="current-logo mt-3">
                                            <p class="text-muted mb-2">{{ __('general.current_logo') }}:</p>
                                            <img src="{{ asset('assets/merchants/' . $merchant->logo) }}" alt="Current Logo" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                        @endif
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
                                    <input type="text" name="country" id="country" class="form-control"
                                           value="{{ old('country', $merchant->country) }}">
                                    @error('country')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="region">{{ __('general.region') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="region" id="region" class="form-control"
                                           value="{{ old('region', $merchant->region) }}">
                                    @error('region')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="city">{{ __('general.city') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="city" id="city" class="form-control"
                                           value="{{ old('city', $merchant->city) }}">
                                    @error('city')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="district">{{ __('general.district') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="district" id="district" class="form-control"
                                           value="{{ old('district', $merchant->district) }}">
                                    @error('district')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="postal_code">{{ __('general.postal_code') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                                           value="{{ old('postal_code', $merchant->postal_code) }}">
                                    @error('postal_code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label">{{ __('general.location') }}</label>
                                <div class="col-md-10">
                                    <input type="text" id="latitude" name="latitude" class="form-control mb-2" placeholder="Latitude" value="{{ old('latitude', $merchant->latitude ?? '24.7136') }}">
                                    <input type="text" id="longitude" name="longitude" class="form-control mb-2" placeholder="Longitude" value="{{ old('longitude', $merchant->longitude ?? '46.6753') }}">
                                    <div id="map" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>




                            {{-- <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="latitude">{{ __('general.latitude') }}</label>
                                <div class="col-md-4">
                                    <input name="latitude" class="form-control" id="latitude" type="text" value="{{ old('latitude' , $merchant->latitude) }}">
                                    @error('latitude')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label class="col-md-2 col-form-label" for="longitude">{{ __('general.longitude') }}</label>
                                <div class="col-md-4">
                                    <input name="longitude" class="form-control" id="longitude" type="text" value="{{ old('longitude' , $merchant->longitude) }}">
                                    @error('longitude')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}


                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="others">{{ __('general.additional_notes') }}</label>
                                <div class="col-md-10">
                                    <input type="text" name="others" id="others" class="form-control"
                                           value="{{ old('others', $merchant->others) }}">
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
                                                   type="url" value="{{ old($social, $merchant->$social) }}" placeholder="https://">
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
                                               {{ old('status', $merchant->status) == '1' ? 'checked' : '' }}>
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
                        @ability('admin', 'update_merchants')
                            <div class="text-end pt-3">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-save me-1"></i> {{ __('merchant.update_merchant_data') }}
                                </button>
                            </div>
                        @endability
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

    .current-logo img {
        border-radius: 8px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid #dee2e6;
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

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize file input
            // $("#merchant_logo").fileinput({
            //     theme: "fa5",
            //     maxFileCount: 1,
            //     allowedFileTypes: ['image'],
            //     showCancel: true,
            //     showRemove: false,
            //     showUpload: false,
            //     overwriteInitial: false,
            //     browseClass: "btn btn-primary",
            //     browseIcon: '<i class="bi bi-folder2-open"></i> ',
            //     browseLabel: "{{ __('general.select_file') }}",
            //     msgPlaceholder: "{{ __('general.choose_file') }}",
            //     dropZoneEnabled: false,
            //     @if($merchant->logo)
            //     initialPreview: [
            //         "{{ asset('assets/merchants/' . $merchant->logo) }}"
            //     ],
            //     initialPreviewAsData: true,
            //     initialPreviewFileType: 'image',
            //    initialPreviewConfig: [
            //         @if(file_exists(public_path('assets/merchants/' . $merchant->logo)))
            //         {
            //             caption: "{{ $merchant->logo }}",
            //             size: {{ filesize(public_path('assets/merchants/' . $merchant->logo)) }},
            //             width: "120px",
            //             url: "{{ route('admin.merchants.remove_image', ['merchant_id' => $merchant->id, '_token' => csrf_token()]) }}",
            //             key: {{ $merchant->id }}
            //         }
            //         @endif
            //     ],
            //     @endif
            // });

            $("#merchant_logo").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: true, // استبدال مباشر
                browseClass: "btn btn-primary",
                browseIcon: '<i class="bi bi-folder2-open"></i> ',
                browseLabel: "{{ __('general.select_file') }}",
                msgPlaceholder: "{{ __('general.choose_file') }}",
                dropZoneEnabled: false,
                @if($merchant->logo)
                initialPreview: [
                    "{{ asset('assets/merchants/' . $merchant->logo) }}"
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    {
                        caption: "{{ $merchant->logo }}",
                        size: {{ file_exists(public_path('assets/merchants/' . $merchant->logo)) ? filesize(public_path('assets/merchants/' . $merchant->logo)) : 0 }},
                        width: "120px",
                        url: "{{ route('admin.merchants.remove_image') }}", // فقط الرابط
                        key: {{ $merchant->id }},
                        extra: {
                            _token: "{{ csrf_token() }}"
                        }
                    }
                ]
                @endif
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





