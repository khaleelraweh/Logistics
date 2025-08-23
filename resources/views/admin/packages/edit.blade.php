@extends('layouts.admin')

@section('style')

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --info: #4895ef;
            --warning: #f72585;
            --danger: #e63946;
            --light: #f8f9fa;
            --dark: #212529;
        }

        body {
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            background-color: #f5f7fb;
            color: #333;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
            border: none;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            padding: 15px 20px;
            font-weight: 600;
            color: var(--primary);
            border-radius: 10px 10px 0 0 !important;
        }

        .page-title-box {
            padding: 20px 0;
        }

        .breadcrumb {
            background: transparent;
            margin-bottom: 0;
            padding: 0;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.15);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .section-title {
            position: relative;
            padding-right: 15px;
            margin-bottom: 20px;
            font-weight: 600;
            color: var(--primary);
        }

        .section-title::before {
            content: '';
            position: absolute;
            right: 0;
            top: 3px;
            height: 20px;
            width: 5px;
            background-color: var(--primary);
            border-radius: 10px;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .attribute-checkbox {
            margin-bottom: 10px;
        }

        .is-invalid {
            border-color: var(--danger) !important;
        }

        .invalid-feedback {
            display: block;
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

    </style>

    <style>
        .review-section {
            border-left: 4px solid #4361ee;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .review-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .review-item:last-child {
            border-bottom: none;
        }

        .review-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
        }

        .review-value {
            color: #212529;
            text-align: left;
            flex: 1;
        }

        .review-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }

        .review-card .card-header {
            background: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }

        .review-badge {
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>

@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('package.manage_packages') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('package.edit_package') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('package.manage_packages') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- new style -->
    <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                <!-- رئس الويزرد  -->
                                <ul class="twitter-bs-wizard-nav">
                                    <li class="nav-item">
                                        <a href="#basic-informaion" class="nav-link" data-toggle="tab">
                                            <span class="step-number"><i class="fas fa-user"></i></span>
                                            <span class="step-title">{{ __('package.basic_informaion') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#trip-information" class="nav-link" data-toggle="tab">
                                            <span class="step-number"><i class=" fas fa-map-marked-alt"></i></span>
                                            <span class="step-title">{{ __('package.trip_information') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#package-details" class="nav-link" data-toggle="tab">
                                            <span class="step-number"><i class="fas fa-box"></i></span>
                                            <span class="step-title">{{ __('package.package_details') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#delivery-options" class="nav-link" data-toggle="tab">
                                            <span class="step-number"><i class="fas fa-shipping-fast"></i></span>
                                            <span class="step-title">{{ __('package.delivery_options') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#confirm-detail" class="nav-link" data-toggle="tab">
                                            <span class="step-number"><i class="fas fa-check-circle"></i></span>
                                            <span class="step-title">{{ __('package.review') }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <!-- محتويات الويزرد -->
                                <form action="{{ route('admin.packages.update' , $package->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <!-- المحتويات كخطوات -->
                                    <div class="tab-content twitter-bs-wizard-tab-content">

                                        <!-- الخطوة 1: المعلومات الأساسية -->
                                        <div class="tab-pane" id="basic-informaion">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>{{ __('package.sender_Information') }}</h5>
                                                            <span class="badge bg-primary">{{ __('general.required') }}</span>
                                                        </div>
                                                        <div class="card-body">
                                                            @livewire('admin.package.update-select-merchant-component', ['package' => $package])
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h5 class="mb-0"><i class="fas fa-user me-2"></i> {{ __('package.receiver_Information') }}</h5>
                                                            <span class="badge bg-primary">{{ __('general.required') }}</span>
                                                        </div>
                                                        <div class="card-body">
                                                            @livewire('admin.package.update-select-receiver-merchant-component', ['package' => $package])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         <!-- الخطوة 2: معلومات الرحلة -->
                                        <div class="tab-pane" id="trip-information">
                                            <div class="row">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                @livewire('admin.package.update-sender-location-component', ['package' => $package])
                                                            </div>
                                                            <div class="col-lg-6">
                                                                @livewire('admin.package.update-receiver-location-component', ['package' => $package])

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                         <!-- الخطوة 3: تفاصيل الطرد -->
                                        <div class="tab-pane" id="package-details">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-cube me-2"></i>{{__('package.package_specifications')}}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="package_type" class="form-label">{{ __('package.package_type') }}</label>
                                                                    <select class="form-select {{ $errors->has('package_type') ? 'is-invalid' : '' }}" id="package_type" name="package_type" required>
                                                                        <option value="box" {{ old('package_type' , $package->package_type) == 'box' ? 'selected' : '' }}>{{ __('package.type_box') }}</option>
                                                                        <option value="envelope" {{ old('package_type' , $package->package_type) == 'envelope' ? 'selected' : '' }}>{{ __('package.type_envelope') }}</option>
                                                                        <option value="pallet" {{ old('package_type' , $package->package_type) == 'pallet' ? 'selected' : '' }}>{{ __('package.type_pallet') }}</option>
                                                                        <option value="tube" {{ old('package_type' , $package->package_type) == 'tube' ? 'selected' : '' }}>{{ __('package.type_tube') }}</option>
                                                                        <option value="bag" {{ old('package_type' , $package->package_type) == 'bag' ? 'selected' : '' }}>{{ __('package.type_bag') }}</option>
                                                                    </select>
                                                                    @error('package_type')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="package_size" class="form-label">{{ __('package.package_size') }}</label>
                                                                    <select class="form-select {{ $errors->has('package_size') ? 'is-invalid' : '' }}" id="package_size" name="package_size" required>
                                                                        <option value="small" {{ old('package_size' , $package->package_size) == 'small' ? 'selected' : '' }}>{{ __('package.size_small') }}</option>
                                                                        <option value="medium" {{ old('package_size' , $package->package_size) == 'medium' ? 'selected' : '' }}>{{ __('package.size_medium') }}</option>
                                                                        <option value="large" {{ old('package_size' , $package->package_size) == 'large' ? 'selected' : '' }}>{{ __('package.size_large') }}</option>
                                                                        <option value="oversized" {{ old('package_size' , $package->package_size) == 'oversized' ? 'selected' : '' }}>{{ __('package.size_oversized') }}</option>
                                                                    </select>
                                                                    @error('package_size')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="weight" class="form-label">{{ __('package.weight') }} ({{ __('package.kgm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" id="weight" name="weight" value="{{ old('weight', $package->weight ?? 0) }}" required min="0">
                                                                    @error('weight')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="dimensions.length" class="form-label">{{ __('package.dimensions.length') }} ({{ __('package.cm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control {{ $errors->has('dimensions.length') ? 'is-invalid' : '' }}" id="dimensions.length" name="dimensions[length]" value="{{ old('dimensions.length', $package->dimensions['length'] ?? 0) }}" required min="0">
                                                                    @error('dimensions.length')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="dimensions.width" class="form-label">{{ __('package.dimensions.width') }} ({{ __('package.cm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control {{ $errors->has('dimensions.width') ? 'is-invalid' : '' }}" id="dimensions.width" name="dimensions[width]" value="{{ old('dimensions.width', $package->dimensions['width'] ?? 0) }}" required min="0">
                                                                    @error('dimensions.width')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="dimensions.height" class="form-label">{{ __('package.dimensions.height') }} ({{ __('package.cm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control {{ $errors->has('dimensions.height') ? 'is-invalid' : '' }}" id="dimensions.height" name="dimensions[height]" value="{{ old('dimensions.height', $package->dimensions['height'] ?? 0) }}" required min="0">
                                                                    @error('dimensions.height')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="package_content" class="form-label">{{ __('package.package_content') }}</label>
                                                                    <textarea class="form-control {{ $errors->has('package_content') ? 'is-invalid' : '' }}" id="package_content" name="package_content" rows="3">{{ old('package_content' , $package->package_content) }}</textarea>
                                                                    @error('package_content')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="package_note" class="form-label">{{ __('package.package_note') }}</label>
                                                                    <textarea class="form-control {{ $errors->has('package_note') ? 'is-invalid' : '' }}" id="package_note" name="package_note" rows="3">{{ old('package_note' , $package->package_note) }}</textarea>
                                                                    @error('package_note')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-cube me-2"></i>{{ __('package.package_specifications') }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            @livewire('admin.package.update-product-component', ['package_id' => $package->id])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- الخطوة 4: خيارات التوصيل -->
                                        <div class="tab-pane" id="delivery-options">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i> {{ __('package.delivery_options') }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="delivery_speed" class="form-label">{{ __('package.delivery_speed') }}</label>
                                                                    <select class="form-select {{ $errors->has('delivery_speed') ? 'is-invalid' : '' }}" id="delivery_speed" name="delivery_speed" required>
                                                                        <option value="standard" {{ old('delivery_speed', $package->delivery_speed) == 'standard' ? 'selected' : '' }}>{{ __('package.speed_standard') }}</option>
                                                                        <option value="express" {{ old('delivery_speed', $package->delivery_speed) == 'express' ? 'selected' : '' }}>{{ __('package.speed_express') }}</option>
                                                                        <option value="same_day" {{ old('delivery_speed', $package->delivery_speed) == 'same_day' ? 'selected' : '' }}>{{ __('package.speed_same_day') }}</option>
                                                                        <option value="next_day" {{ old('delivery_speed', $package->delivery_speed) == 'next_day' ? 'selected' : '' }}>{{ __('package.speed_next_day') }}</option>
                                                                    </select>
                                                                    @error('delivery_speed')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="delivery_date" class="form-label">{{ __('package.delivery_date') }}</label>
                                                                    <input type="date" class="form-control {{ $errors->has('delivery_date') ? 'is-invalid' : '' }}" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', $package->delivery_date ? \Carbon\Carbon::parse($package->delivery_date)->toDateString() : '') }}" required>
                                                                    @error('delivery_date')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="delivery_method" class="form-label">{{ __('package.delivery_method') }}</label>
                                                                    <select class="form-select {{ $errors->has('delivery_method') ? 'is-invalid' : '' }}" id="delivery_method" name="delivery_method" required>
                                                                        <option value="standard" {{ old('delivery_method', $package->delivery_method) == 'standard' ? 'selected' : '' }}>{{ __('package.method_standard') }}</option>
                                                                        <option value="express" {{ old('delivery_method', $package->delivery_method) == 'express' ? 'selected' : '' }}>{{ __('package.method_express') }}</option>
                                                                        <option value="pickup" {{ old('delivery_method', $package->delivery_method) == 'pickup' ? 'selected' : '' }}>{{ __('package.method_pickup') }}</option>
                                                                        <option value="courier" {{ old('delivery_method', $package->delivery_method) == 'courier' ? 'selected' : '' }}>{{ __('package.method_courier') }}</option>
                                                                    </select>
                                                                    @error('delivery_method')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="origin_type" class="form-label">{{ __('package.origin_type') }}</label>
                                                                    <select class="form-select {{ $errors->has('origin_type') ? 'is-invalid' : '' }}" id="origin_type" name="origin_type" required>
                                                                        <option value="warehouse" {{ old('origin_type', $package->origin_type) == 'warehouse' ? 'selected' : '' }}>{{ __('package.origin_warehouse') }}</option>
                                                                        <option value="store" {{ old('origin_type', $package->origin_type) == 'store' ? 'selected' : '' }}>{{ __('package.origin_store') }}</option>
                                                                        <option value="home" {{ old('origin_type', $package->origin_type) == 'home' ? 'selected' : '' }}>{{ __('package.origin_home') }}</option>
                                                                        <option value="other" {{ old('origin_type', $package->origin_type) == 'other' ? 'selected' : '' }}>{{ __('package.origin_other') }}</option>
                                                                    </select>
                                                                    @error('origin_type')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="status1" class="form-label">{{ __('package.status') }}</label>
                                                                    <select class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status1" name="status" required>
                                                                        @foreach (\App\Models\Package::statuses() as $key => $label)
                                                                            <option value="{{ $key }}" {{ old('status' , $package->status) == $key ? 'selected' : '' }}>
                                                                                {{ $label }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-12 mb-3">
                                                                    <label for="delivery_status_note" class="form-label">{{ __('package.delivery_status_note') }}</label>
                                                                    <textarea class="form-control {{ $errors->has('delivery_status_note') ? 'is-invalid' : '' }}" id="delivery_status_note" name="delivery_status_note" rows="3">{{ old('delivery_status_note' , $package->delivery_status_note) }}</textarea>
                                                                    @error('delivery_status_note')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    @livewire('admin.package.create-package-collection-component')
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>{{ __('package.additional_options') }}</h5>
                                                        </div>
                                                        @php
                                                            // القيم الافتراضية
                                                            $defaultAttributes = [
                                                                "is_fragile" => true,
                                                                "is_returnable" => false,
                                                                "is_confidential" => true,
                                                                "is_express" => false,
                                                                "is_cod" => true,
                                                                "is_gift" => false,
                                                                "is_oversized" => false,
                                                                "is_hazardous_material" => false,
                                                                "is_temperature_controlled" => false,
                                                                "is_perishable" => false,
                                                                "is_signature_required" => true,
                                                                "is_inspection_required" => false,
                                                                "is_special_handling_required" => true,
                                                            ];

                                                            // لو في بيانات قديمة (بعد فشل التحقق مثلًا) نستخدمها، وإلا نستخدم الافتراضية
                                                            $attrs = old('attributes', $package->attributes ?? $defaultAttributes);

                                                            // جميع المفاتيح مع الترجمة
                                                            $allKeys = [
                                                                "is_fragile" => __('package.is_fragile'),
                                                                "is_returnable" => __('package.is_returnable'),
                                                                "is_confidential" => __('package.is_confidential'),
                                                                "is_express" => __('package.is_express'),
                                                                "is_cod" => __('package.is_cod'),
                                                                "is_gift" => __('package.is_gift'),
                                                                "is_oversized" => __('package.is_oversized'),
                                                                "is_hazardous_material" => __('package.is_hazardous_material'),
                                                                "is_temperature_controlled" => __('package.is_temperature_controlled'),
                                                                "is_perishable" => __('package.is_perishable'),
                                                                "is_signature_required" => __('package.is_signature_required'),
                                                                "is_inspection_required" => __('package.is_inspection_required'),
                                                                "is_special_handling_required" => __('package.is_special_handling_required'),
                                                            ];
                                                        @endphp
                                                        <div class="card-body">
                                                            <div class="row mb-3">
                                                                @foreach($allKeys as $key => $label)
                                                                    <div class="col-6 col-md-4 mb-1">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox" id="{{ $key }}" name="attributes[{{ $key }}]" value="1" {{ !empty($attrs[$key]) ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                     <!-- ازرار التنقل -->
                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                        <li class="previous"><a href="javascript: void(0);">{{ __('general.previous') }}</a></li>
                                        <li class="next"><a href="javascript: void(0);">{{ __('general.next') }}</a></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.packages.update' , $package->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')


                <div class="row">
                    <div class="col-sm-12">
                        @livewire('admin.package.update-package-collection-component' , ['package_id' => $package->id])
                    </div>
                </div>

                <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('package.additional_information') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="delivery_speed">{{ __('package.delivery_speed') }}</label>
                                    <select name="delivery_speed" id="delivery_speed" class="form-select">
                                        <option value="standard" {{ old('delivery_speed', $package->delivery_speed) == 'standard' ? 'selected' : '' }}>{{ __('package.speed_standard') }}</option>
                                        <option value="express" {{ old('delivery_speed', $package->delivery_speed) == 'express' ? 'selected' : '' }}>{{ __('package.speed_express') }}</option>
                                        <option value="same_day" {{ old('delivery_speed', $package->delivery_speed) == 'same_day' ? 'selected' : '' }}>{{ __('package.speed_same_day') }}</option>
                                        <option value="next_day" {{ old('delivery_speed', $package->delivery_speed) == 'next_day' ? 'selected' : '' }}>{{ __('package.speed_next_day') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="delivery_date">{{ __('package.delivery_date') }}</label>
                                    <input name="delivery_date" class="form-control" id="delivery_date" type="date" value="{{ old('delivery_date', $package->delivery_date ? \Carbon\Carbon::parse($package->delivery_date)->toDateString() : '') }}">
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="status1">{{ __('package.status') }}</label>
                                    <select name="status" id="status1" class="form-select">
                                        @foreach(\App\Models\Package::statuses() as $key => $label)
                                            <option value="{{ $key }}" {{ old('status', $package->status) == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="delivery_method">{{ __('package.delivery_method') }}</label>
                                    <select name="delivery_method" id="delivery_method" class="form-select">
                                        <option value="standard" {{ old('delivery_method', $package->delivery_method) == 'standard' ? 'selected' : '' }}>{{ __('package.method_standard') }}</option>
                                        <option value="express" {{ old('delivery_method', $package->delivery_method) == 'express' ? 'selected' : '' }}>{{ __('package.method_express') }}</option>
                                        <option value="pickup" {{ old('delivery_method', $package->delivery_method) == 'pickup' ? 'selected' : '' }}>{{ __('package.method_pickup') }}</option>
                                        <option value="courier" {{ old('delivery_method', $package->delivery_method) == 'courier' ? 'selected' : '' }}>{{ __('package.method_courier') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="package_type">{{ __('package.package_type') }}</label>
                                    <select name="package_type" id="package_type" class="form-select">
                                        <option value="box" {{ old('package_type', $package->package_type) == 'box' ? 'selected' : '' }}>{{ __('package.type_box') }}</option>
                                        <option value="envelope" {{ old('package_type', $package->package_type) == 'envelope' ? 'selected' : '' }}>{{ __('package.type_envelope') }}</option>
                                        <option value="pallet" {{ old('package_type', $package->package_type) == 'pallet' ? 'selected' : '' }}>{{ __('package.type_pallet') }}</option>
                                        <option value="tube" {{ old('package_type', $package->package_type) == 'tube' ? 'selected' : '' }}>{{ __('package.type_tube') }}</option>
                                        <option value="bag" {{ old('package_type', $package->package_type) == 'bag' ? 'selected' : '' }}>{{ __('package.type_bag') }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-form-label" for="origin_type">{{ __('package.origin_type') }}</label>
                                    <select name="origin_type" id="origin_type" class="form-select">
                                        <option value="warehouse" {{ old('origin_type', $package->origin_type) == 'warehouse' ? 'selected' : '' }}>{{ __('package.origin_warehouse') }}</option>
                                        <option value="store" {{ old('origin_type', $package->origin_type) == 'store' ? 'selected' : '' }}>{{ __('package.origin_store') }}</option>
                                        <option value="home" {{ old('origin_type', $package->origin_type) == 'home' ? 'selected' : '' }}>{{ __('package.origin_home') }}</option>
                                        <option value="other" {{ old('origin_type', $package->origin_type) == 'other' ? 'selected' : '' }}>{{ __('package.origin_other') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="delivery_status_note">{{ __('package.delivery_status_note') }}</label>
                                <textarea name="delivery_status_note" class="form-control" id="delivery_status_note">{{ old('delivery_status_note', $package->delivery_status_note) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



                @php
                    // القيم الافتراضية
                    $defaultAttributes = [
                        "is_fragile" => true,
                        "is_returnable" => false,
                        "is_confidential" => true,
                        "is_express" => false,
                        "is_cod" => true,
                        "is_gift" => false,
                        "is_oversized" => false,
                        "is_hazardous_material" => false,
                        "is_temperature_controlled" => false,
                        "is_perishable" => false,
                        "is_signature_required" => true,
                        "is_inspection_required" => false,
                        "is_special_handling_required" => true,
                    ];

                    // لو في بيانات قديمة (بعد فشل التحقق مثلًا) نستخدمها، وإلا نستخدم الافتراضية
                    $attrs = old('attributes',  $package->attributes ?? $defaultAttributes);

                    // الملاحظة الخاصة بالحالة
                    $delivery_status_note = old('delivery_status_note', '');

                    // جميع المفاتيح مع الترجمة
                    $allKeys = [
                        "is_fragile" => __('package.is_fragile'),
                        "is_returnable" => __('package.is_returnable'),
                        "is_confidential" => __('package.is_confidential'),
                        "is_express" => __('package.is_express'),
                        "is_cod" => __('package.is_cod'),
                        "is_gift" => __('package.is_gift'),
                        "is_oversized" => __('package.is_oversized'),
                        "is_hazardous_material" => __('package.is_hazardous_material'),
                        "is_temperature_controlled" => __('package.is_temperature_controlled'),
                        "is_perishable" => __('package.is_perishable'),
                        "is_signature_required" => __('package.is_signature_required'),
                        "is_inspection_required" => __('package.is_inspection_required'),
                        "is_special_handling_required" => __('package.is_special_handling_required'),
                    ];
                @endphp



                <div class="mb-3">
                    <h5>{{ __('package.package_attributes') }}</h5>
                    @foreach($allKeys as $key => $label)
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="{{ $key }}"
                                name="attributes[{{ $key }}]"
                                value="1"
                                {{ !empty($attrs[$key]) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                </div>



                @ability('admin', 'create_packages')
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">{{ __('package.update_package_data') }}</button>
                    </div>
                @endability
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {

            // ===============================
            // دالة التحقق العامة للتاب الحالي
            // ===============================
            function validateCurrentStep() {
                var $currentTab = $('.tab-pane.active');

                // جميع الحقول المطلوبة
                var $requiredFields = $currentTab
                    .find('input[required], select[required], textarea[required]')
                    .filter(function () {
                        return $(this).is(':visible') && !$(this).prop('disabled');
                    });

                var isValid = true;
                var firstInvalid = null;

                // التحقق من الحقول المطلوبة
                $requiredFields.each(function () {
                    var val = $(this).val();
                    var empty = (val === null || val === '' || (Array.isArray(val) && val.length === 0));

                    if (empty) {
                        isValid = false;
                        if (!firstInvalid) firstInvalid = this;

                        $(this).addClass('is-invalid');
                        if (!$(this).next('.invalid-feedback').length) {
                            $(this).after('<div class="invalid-feedback">هذا الحقل مطلوب</div>');
                        }
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                    }
                });

                // تحقق من الحقول من نوع email
                $currentTab.find('input[type="email"]').each(function () {
                    var val = $(this).val();
                    if (val) { // تحقق فقط إذا تم إدخال قيمة
                        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(val)) {
                            isValid = false;
                            if (!firstInvalid) firstInvalid = this;

                            $(this).addClass('is-invalid');
                            if (!$(this).next('.invalid-feedback').length) {
                                $(this).after('<div class="invalid-feedback">يرجى إدخال بريد إلكتروني صالح</div>');
                            }
                        } else {
                            $(this).removeClass('is-invalid');
                            $(this).next('.invalid-feedback').remove();
                        }
                    }
                });

                // إذا كان هناك خطأ، إظهار تنبيه
                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'تنبيه',
                        text: 'يرجى ملء جميع الحقول المطلوبة بشكل صحيح قبل الانتقال إلى الخطوة التالية.',
                        confirmButtonText: 'موافق'
                    });

                    if (firstInvalid) {
                        $(firstInvalid).focus();
                    }
                }

                return isValid;
            }

            // ===============================
            // تهيئة الـ wizard الأساسي
            // ===============================
            $("#basic-pills-wizard").bootstrapWizard({
                tabClass: "nav nav-pills nav-justified",
                onNext: function (tab, navigation, index) {
                    if (!validateCurrentStep()) return false;
                },
                onTabClick: function (tab, navigation, index) {
                    var activeIndex = navigation.find('li').index(navigation.find('li.active'));
                    if (index > activeIndex && !validateCurrentStep()) return false;
                }
            });

            // ===============================
            // تهيئة الـ wizard ذو التقدّم
            // ===============================
            $("#progrss-wizard").bootstrapWizard({
                onTabShow: function (tab, navigation, index) {
                    var progress = (index + 1) / navigation.find("li").length * 100;
                    $("#progrss-wizard").find(".progress-bar").css({ width: progress + "%" });
                },
                onNext: function (tab, navigation, index) {
                    if (!validateCurrentStep()) return false;
                },
                onTabClick: function (tab, navigation, index) {
                    var activeIndex = navigation.find('li').index(navigation.find('li.active'));
                    if (index > activeIndex && !validateCurrentStep()) return false;
                }
            });

            // ===============================
            // منع الانتقال للأمام عبر تبويبات الـ Bootstrap
            // ===============================
            $(document).on('show.bs.tab', '.twitter-bs-wizard-nav .nav-link', function (e) {
                var $links = $('.twitter-bs-wizard-nav .nav-link');
                var currentIndex = $links.index($links.filter('.active'));
                var targetIndex = $links.index($(e.target));

                if (targetIndex > currentIndex && !validateCurrentStep()) {
                    e.preventDefault();
                }
            });

            // ===============================
            // منع أزرار "التالي" خارج الويزارد
            // ===============================
            $(document).on('click', '.next', function (e) {
                if (!validateCurrentStep()) {
                    e.preventDefault();
                    return false;
                }
            });

            // ===============================
            // تحديث صفحة المراجعة
            // ===============================
            function updateReviewPage() {
                        // معلومات المرسل
                        $('#review-sender-merchant').text($('#merchant_id option:selected').text());
                        $('#review-sender-name').text(
                            $('#sender_first_name').val() + ' ' +
                            $('#sender_middle_name').val() + ' ' +
                            $('#sender_last_name').val()
                        );
                        $('#review-sender-email').text($('#sender_email').val());
                        $('#review-sender-phone').text($('#sender_phone').val());
                        $('#review-sender-address').text($('#sender_address').val());
                        $('#review-sender-country').text($('#sender_country').val());
                        $('#review-sender-city').text($('#sender_city').val());
                        $('#review-sender-postal').text($('#sender_postal_code').val());

                        // معلومات المستلم
                        $('#review-receiver-merchant').text($('#receiver_merchant_id option:selected').text());
                        $('#review-receiver-name').text(
                            $('#receiver_first_name').val() + ' ' +
                            $('#receiver_middle_name').val() + ' ' +
                            $('#receiver_last_name').val()
                        );
                        $('#review-receiver-email').text($('#receiver_email').val());
                        $('#review-receiver-phone').text($('#receiver_phone').val());
                        $('#review-receiver-address').text($('#receiver_address').val());
                        $('#review-receiver-country').text($('#receiver_country').val());
                        $('#review-receiver-city').text($('#receiver_city').val());
                        $('#review-receiver-postal').text($('#receiver_postal_code').val());

                        // مواصفات الطرد
                        $('#review-package-type').text($('#package_type option:selected').text());
                        $('#review-package-size').text($('#package_size option:selected').text());
                        $('#review-weight').text($('#weight').val());
                        $('#review-dimensions').text(
                            $('#dimensions\\.length').val() + 'x' +
                            $('#dimensions\\.width').val() + 'x' +
                            $('#dimensions\\.height').val() + ' سم'
                        );
                        $('#review-package-content').text($('#package_content').val());
                        $('#review-package-note').text($('#package_note').val());

                        // خيارات التوصيل
                        $('#review-delivery-speed').text($('#delivery_speed option:selected').text());
                        $('#review-delivery-method').text($('#delivery_method option:selected').text());
                        $('#review-origin-type').text($('#origin_type option:selected').text());
                        $('#review-delivery-date').text($('#delivery_date').val());
                        $('#review-status').text($('#status1 option:selected').text());
                        $('#review-status-note').text($('#delivery_status_note').val());

                        // الخصائص
                        var attributesHtml = '';
                        $('input[name^="attributes"]:checked').each(function() {
                            var label = $('label[for="' + $(this).attr('id') + '"]').text();
                            attributesHtml += '<span class="badge bg-info me-1 mb-1">' + label + '</span>';
                        });
                        $('#review-attributes').html(attributesHtml);

                        // معلومات التحصيل (من Livewire components)
                        try {
                            $('#review-payment-responsibility').text($('select[name="payment_responsibility"] option:selected').text());
                            $('#review-payment-method').text($('select[name="payment_method"] option:selected').text());
                            $('#review-collection-method').text($('select[name="collection_method"] option:selected').text());
                            $('#review-delivery-fee').text($('input[name="delivery_fee"]').val() + ' ر.س');
                            $('#review-insurance-fee').text($('input[name="insurance_fee"]').val() + ' ر.س');
                            $('#review-service-fee').text($('input[name="service_fee"]').val() + ' ر.س');
                            $('#review-total-fee').text($('input[name="total_fee"]').val() + ' ر.س');
                            $('#review-paid-amount').text($('input[name="paid_amount"]').val() + ' ر.س');
                            $('#review-remaining-amount').text($('input[name="due_amount"]').val() + ' ر.س');
                            $('#review-cod-amount').text($('input[name="cod_amount"]').val() + ' ر.س');
                        } catch (e) {
                            console.log('Livewire components not loaded yet');
                        }






                        // المنتجات (من Livewire components)
                        try {
                            var productsHtml = '';
                            var hasProducts = false;

                            // استخرج كل الفهارس (indexes) للمنتجات
                            $('input[name^="products"][name$="[custom_name]"]').each(function () {
                                var index = $(this).attr('name').match(/\[(\d+)\]/)[1];

                                var type = $('select[name="products[' + index + '][type]"] option:selected').text() || '';
                                var name = $(this).val() || $('select[name="products[' + index + '][stock_item_id]"] option:selected').text() || '';
                                var weight = $('input[name="products[' + index + '][weight]"]').val() || '';
                                var quantity = $('input[name="products[' + index + '][quantity]"]').val() || '';
                                var price = $('input[name="products[' + index + '][price_per_unit]"]').val() || '';
                                var total = $('input[name="products[' + index + '][total_price]"]').val() || '';

                                // أظهر المنتج فقط إذا تم تعبئة جميع الحقول
                                if (type && name && weight && quantity && price && total) {
                                    if (!hasProducts) {
                                        // إنشاء رأس الجدول فقط عند وجود أول منتج
                                        productsHtml = `
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>النوع</th>
                                                        <th>المنتج</th>
                                                        <th>الوزن</th>
                                                        <th>الكمية</th>
                                                        <th>السعر</th>
                                                        <th>الإجمالي</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                        `;
                                        hasProducts = true;
                                    }

                                    productsHtml += `
                                        <tr>
                                            <td>${type}</td>
                                            <td>${name}</td>
                                            <td>${weight} كجم</td>
                                            <td>${quantity}</td>
                                            <td>${price} ر.س</td>
                                            <td>${total} ر.س</td>
                                        </tr>
                                    `;
                                }
                            });

                            if (hasProducts) {
                                productsHtml += '</tbody></table>';
                            } else {
                                // عرض صندوق فارغ ورسالة عند عدم وجود منتجات
                                productsHtml = `<div class="alert alert-warning text-center">لا توجد منتجات</div>`;
                            }

                            $('#review-products').html(productsHtml);

                        } catch (e) {
                            console.log('Error loading products:', e);
                        }


            }

            // تحديث صفحة المراجعة عند فتح تبويبها
            $(document).on('shown.bs.tab', 'a[href="#confirm-detail"]', function () {
                updateReviewPage();
            });

            // ===============================
            // تنظيف التنبيهات عند التركيز
            // ===============================
            $(document).on('focus', '.is-invalid', function () {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

        });
    </script>
@endsection
