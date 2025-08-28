@extends('layouts.admin')

@section('styles')
    <style>
        .section-block {
            border-left: 4px solid #3b7ddd;
            padding-left: 10px;
            margin: 20px 0;
        }
        .section-title {
            color: #3b7ddd;
            font-weight: 600;
        }
        .section-description {
            color: #6c757d;
            font-size: 0.875rem;
        }
        .language-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            color: white;
            font-size: 0.75rem;
            margin-left: 0.5rem;
        }
        .form-actions {
            border-top: 1px solid #e9ecef;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }
    </style>
@endsection

@section('content')

    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('warehouse.create_warehouse') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.warehouses.index') }}">{{ __('warehouse.warehouses') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('warehouse.create_warehouse') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('warehouse.add_new_warehouse') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.warehouses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Warehouse Information Section -->
                        <div class="section-block">
                            <h6 class="section-title">{{ __('warehouse.warehouse_info') }}</h6>
                            <p class="section-description">{{ __('warehouse.fill_basic_info') }}</p>
                        </div>

                        <!-- Multilingual Name Fields -->
                        @foreach (config('locales.languages') as $key => $val)
                            <div class="mb-3 row">
                                <label for="name[{{ $key }}]" class="col-md-3 col-form-label">
                                    {{ __('warehouse.name') }}
                                    <span class="language-badge bg-{{ $key == 'ar' ? 'primary' : 'info' }}">
                                        <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }}"></i>
                                        {{ __('language.' . $key) }}
                                    </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="name[{{ $key }}]"
                                           name="name[{{ $key }}]" value="{{ old('name.' . $key) }}"
                                           placeholder="{{ __('warehouse.enter_name') }}">
                                    @error('name.' . $key)
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach


                        <!-- Warehouse Code -->
                        <div class="mb-3 row">
                            <label for="code" class="col-md-3 col-form-label">{{ __('warehouse.code') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ old('code') }}" placeholder="WH-001">
                                    <span class="input-group-text bg-light">
                                        <small class="text-muted">{{ __('warehouse.unique_identifier') }}</small>
                                    </span>
                                </div>
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
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



                            <div class="row">
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

                            </div>


                        </div>



                        <!-- Warehouse Management Section -->
                        <div class="section-block mt-4">
                            <h6 class="section-title">{{ __('warehouse.warehouse_management') }}</h6>
                            <p class="section-description">{{ __('warehouse.fill_management_info') }}</p>
                        </div>

                        <!-- Multilingual Manager Fields -->
                        @foreach (config('locales.languages') as $key => $val)
                            <div class="mb-3 row">
                                <label for="manager[{{ $key }}]" class="col-md-3 col-form-label">
                                    {{ __('warehouse.manager') }}
                                    <span class="language-badge bg-{{ $key == 'ar' ? 'primary' : 'info' }}">
                                        <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }}"></i>
                                        {{ __('language.' . $key) }}
                                    </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="manager[{{ $key }}]"
                                           name="manager[{{ $key }}]" value="{{ old('manager.' . $key) }}"
                                           placeholder="{{ __('warehouse.enter_manager_name') }}">
                                    @error('manager.' . $key)
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endforeach

                        <!-- Contact Information -->
                        <div class="mb-3 row">
                            <label for="phone" class="col-md-3 col-form-label">{{ __('warehouse.phone') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{ old('phone') }}" placeholder="+966500000000">
                                </div>
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-md-3 col-form-label">{{ __('warehouse.email') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email') }}" placeholder="manager@example.com">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Toggle -->
                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label" for="status1">{{ __('general.status') }}</label>
                            <div class="col-md-9">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="status1"
                                           name="status" {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        {{ __('warehouse.active_warehouse') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="text-end pt-3">
                            @ability('admin', 'create_warehouses')
                                <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                    <i class="ri-save-3-line me-2"></i>
                                    <i class="bi bi-save me-2"></i>
                                    {{ __('warehouse.create_warehouse') }}
                                </button>
                            @endability

                            <a href="{{ route('admin.warehouses.index') }}" class="btn btn-outline-danger ms-2">
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
@endsection

