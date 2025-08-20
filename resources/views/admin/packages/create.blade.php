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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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


</style>

@endsection
@section('content')
    <div class="container-fluid py-3">
        <!-- رأس الصفحة -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('package.manage_packages') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('package.add_new_package') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('package.manage_packages') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="basic-pills-wizard" class="twitter-bs-wizard">
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

                                <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" id="packageForm">
                                    @csrf
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
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    @livewire('admin.package.create-select-merchant-component')
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="sender_first_name" class="form-label">{{ __('package.sender_first_name') }}</label>
                                                                    <input type="text" class="form-control" id="sender_first_name" name="sender_first_name" value="{{ old('sender_first_name') }}">
                                                                    @error('sender_first_name')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="sender_middle_name" class="form-label">{{ __('package.sender_middle_name') }}</label>
                                                                    <input type="text" class="form-control" id="sender_middle_name" name="sender_middle_name" value="{{ old('sender_middle_name') }}">
                                                                    @error('sender_middle_name')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="sender_last_name" class="form-label">{{ __('package.sender_last_name') }}</label>
                                                                    <input type="text" class="form-control" id="sender_last_name" name="sender_last_name" value="{{ old('sender_last_name') }}">
                                                                    @error('sender_last_name')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="sender_email" class="form-label">{{ __('package.sender_email') }}</label>
                                                                    <input type="email" class="form-control" id="sender_email" name="sender_email" value="{{ old('sender_email') }}">
                                                                    @error('sender_email')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="sender_phone" class="form-label">{{ __('package.sender_phone') }}</label>
                                                                    <input type="text" class="form-control" id="sender_phone" name="sender_phone" value="{{ old('sender_phone') }}">
                                                                    @error('sender_phone')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
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
                                                            <div class="row mb-3">
                                                                <div class="com-md-12">
                                                                    <div class="mb-3">
                                                                        <label for="merchant_recever_id" class="form-label">التاجر ({{ __('general.optional') }})</label>
                                                                        <select class="form-select" id="merchant_recever_id" name="merchant_recever_id">
                                                                            <option value="">بدون تاجر</option>
                                                                            @foreach($merchants as $merchant)
                                                                                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="receiver_first_name" class="form-label">{{ __('package.receiver_first_name') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_first_name" name="receiver_first_name" value="{{ old('receiver_first_name') }}">
                                                                    @error('receiver_first_name')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="receiver_middle_name" class="form-label">{{ __('package.receiver_middle_name') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_middle_name" name="receiver_middle_name" value="{{ old('receiver_middle_name') }}">
                                                                    @error('receiver_middle_name')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="receiver_last_name" class="form-label">{{ __('package.receiver_last_name') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_last_name" name="receiver_last_name" value="{{ old('receiver_last_name') }}">
                                                                    @error('receiver_last_name')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="receiver_email" class="form-label">{{ __('package.receiver_email') }}</label>
                                                                    <input type="email" class="form-control" id="receiver_email" name="receiver_email" value="{{ old('receiver_email') }}">
                                                                    @error('receiver_email')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="receiver_phone" class="form-label">{{ __('package.receiver_phone') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" value="{{ old('receiver_phone') }}">
                                                                    @error('receiver_phone')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- الخطوة 2: معلومات الرحلة -->
                                        <div class="tab-pane" id="trip-information">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>{{ __('package.sender_address') }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="sender_address" class="form-label">{{ __('package.address') }}</label>
                                                                    <input type="text" class="form-control" id="sender_address" name="sender_address" value="{{ old('sender_address') }}">
                                                                    @error('sender_address')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="sender_country" class="form-label">{{ __('package.sender_country') }}</label>
                                                                    <input type="text" class="form-control" id="sender_country" name="sender_country" value="{{ old('sender_country') }}">
                                                                    @error('sender_country')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="sender_region" class="form-label">{{ __('package.sender_region') }}</label>
                                                                    <input type="text" class="form-control" id="sender_region" name="sender_region" value="{{ old('sender_region') }}">
                                                                    @error('sender_region')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="sender_city" class="form-label">{{ __('package.sender_city') }}</label>
                                                                    <input type="text" class="form-control" id="sender_city" name="sender_city" value="{{ old('sender_city') }}">
                                                                    @error('sender_city')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="sender_district" class="form-label">{{ __('package.sender_district') }}</label>
                                                                    <input type="text" class="form-control" id="sender_district" name="sender_district" value="{{ old('sender_district') }}">
                                                                    @error('sender_district')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="sender_postal_code" class="form-label">{{ __('package.sender_postal_code') }}</label>
                                                                    <input type="text" class="form-control" id="sender_postal_code" name="sender_postal_code" value="{{ old('sender_postal_code') }}">
                                                                    @error('sender_postal_code')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="sender_location" class="form-label">{{ __('package.sender_location') }}</label>
                                                                    <input type="text" class="form-control" id="sender_location" name="sender_location" value="{{ old('sender_location') }}">
                                                                    @error('sender_location')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="sender_others" class="form-label">{{ __('package.sender_others') }}</label>
                                                                    <input type="text" class="form-control" id="sender_others" name="sender_others" value="{{ old('sender_others') }}">
                                                                    @error('sender_others')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>{{ __('package.receiver_address') }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="receiver_address" class="form-label">{{ __('package.address') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_address" name="receiver_address" value="{{ old('receiver_address') }}">
                                                                    @error('receiver_address')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="receiver_country" class="form-label">{{ __('package.receiver_country') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_country" name="receiver_country" value="{{ old('receiver_country') }}">
                                                                    @error('receiver_country')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="receiver_region" class="form-label">{{ __('package.receiver_region') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_region" name="receiver_region" value="{{ old('receiver_region') }}">
                                                                    @error('receiver_region')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="receiver_city" class="form-label">{{ __('package.receiver_city') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_city" name="receiver_city" value="{{ old('receiver_city') }}">
                                                                    @error('receiver_city')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="receiver_district" class="form-label">{{ __('package.receiver_district') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_district" name="receiver_district" value="{{ old('receiver_district') }}">
                                                                    @error('receiver_district')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="receiver_postal_code" class="form-label">{{ __('package.receiver_postal_code') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_postal_code" name="receiver_postal_code" value="{{ old('receiver_postal_code') }}">
                                                                    @error('receiver_postal_code')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="receiver_location" class="form-label">{{ __('package.receiver_location') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_location" name="receiver_location" value="{{ old('receiver_location') }}">
                                                                    @error('receiver_location')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="receiver_others" class="form-label">{{ __('package.receiver_others') }}</label>
                                                                    <input type="text" class="form-control" id="receiver_others" name="receiver_others" value="{{ old('receiver_others') }}">
                                                                    @error('receiver_others')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
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
                                                                    <select class="form-select" id="package_type" name="package_type">
                                                                        <option value="box" {{ old('package_type') == 'box' ? 'selected' : '' }}>{{ __('package.type_box') }}</option>
                                                                        <option value="envelope" {{ old('package_type') == 'envelope' ? 'selected' : '' }}>{{ __('package.type_envelope') }}</option>
                                                                        <option value="pallet" {{ old('package_type') == 'pallet' ? 'selected' : '' }}>{{ __('package.type_pallet') }}</option>
                                                                        <option value="tube" {{ old('package_type') == 'tube' ? 'selected' : '' }}>{{ __('package.type_tube') }}</option>
                                                                        <option value="bag" {{ old('package_type') == 'bag' ? 'selected' : '' }}>{{ __('package.type_bag') }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="package_size" class="form-label">{{ __('package.package_size') }}</label>
                                                                    <select class="form-select" id="package_size" name="package_size">
                                                                        <option value="small" {{ old('package_size') == 'small' ? 'selected' : '' }}>{{ __('package.size_small') }}</option>
                                                                        <option value="medium" {{ old('package_size') == 'medium' ? 'selected' : '' }}>{{ __('package.size_medium') }}</option>
                                                                        <option value="large" {{ old('package_size') == 'large' ? 'selected' : '' }}>{{ __('package.size_large') }}</option>
                                                                        <option value="oversized" {{ old('package_size') == 'oversized' ? 'selected' : '' }}>{{ __('package.size_oversized') }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="weight" class="form-label">{{ __('package.weight') }} ({{ __('package.kgm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ old('weight', 0) }}">
                                                                    @error('weight')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-4">
                                                                    <label for="dimensions.length" class="form-label">{{ __('package.dimensions.length') }} ({{ __('package.cm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control" id="dimensions.length" name="dimensions[length]" value="{{ old('dimensions.length', 0) }}">
                                                                    @error('dimensions.length')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="dimensions.width" class="form-label">{{ __('package.dimensions.width') }} ({{ __('package.cm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control" id="dimensions.width" name="dimensions[width]" value="{{ old('dimensions.width', 0) }}">
                                                                    @error('dimensions.width')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="dimensions.height" class="form-label">{{ __('package.dimensions.height') }} ({{ __('package.cm') }})</label>
                                                                    <input type="number" step="0.01" class="form-control" id="dimensions.height" name="dimensions[height]" value="{{ old('dimensions.height', 0) }}">
                                                                    @error('dimensions.height')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="package_content" class="form-label">{{ __('package.package_content') }}</label>
                                                                    <textarea class="form-control" id="package_content" name="package_content" rows="3">{{ old('package_content') }}</textarea>
                                                                    @error('package_content')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="package_note" class="form-label">{{ __('package.package_note') }}</label>
                                                                    <textarea class="form-control" id="package_note" name="package_note" rows="3">{{ old('package_note') }}</textarea>
                                                                    @error('package_note')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
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
                                                            @livewire('admin.package.create-product-component')
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
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="delivery_speed" class="form-label">{{ __('package.delivery_speed') }}</label>
                                                                    <select class="form-select" id="delivery_speed" name="delivery_speed">
                                                                        <option value="standard" {{ old('delivery_speed') == 'standard' ? 'selected' : '' }}>{{ __('package.speed_standard') }}</option>
                                                                        <option value="express" {{ old('delivery_speed') == 'express' ? 'selected' : '' }}>{{ __('package.speed_express') }}</option>
                                                                        <option value="same_day" {{ old('delivery_speed') == 'same_day' ? 'selected' : '' }}>{{ __('package.speed_same_day') }}</option>
                                                                        <option value="next_day" {{ old('delivery_speed') == 'next_day' ? 'selected' : '' }}>{{ __('package.speed_next_day') }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="delivery_date" class="form-label">{{ __('package.delivery_date') }}</label>
                                                                    <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="delivery_method" class="form-label">{{ __('package.delivery_method') }}</label>
                                                                    <select class="form-select" id="delivery_method" name="delivery_method">
                                                                        <option value="standard" {{ old('delivery_method') == 'standard' ? 'selected' : '' }}>{{ __('package.method_standard') }}</option>
                                                                        <option value="express" {{ old('delivery_method') == 'express' ? 'selected' : '' }}>{{ __('package.method_express') }}</option>
                                                                        <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>{{ __('package.method_pickup') }}</option>
                                                                        <option value="courier" {{ old('delivery_method') == 'courier' ? 'selected' : '' }}>{{ __('package.method_courier') }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="origin_type" class="form-label">{{ __('package.origin_type') }}</label>
                                                                    <select class="form-select" id="origin_type" name="origin_type">
                                                                        <option value="warehouse" {{ old('origin_type') == 'warehouse' ? 'selected' : '' }}>{{ __('package.origin_warehouse') }}</option>
                                                                        <option value="store" {{ old('origin_type') == 'store' ? 'selected' : '' }}>{{ __('package.origin_store') }}</option>
                                                                        <option value="home" {{ old('origin_type') == 'home' ? 'selected' : '' }}>{{ __('package.origin_home') }}</option>
                                                                        <option value="other" {{ old('origin_type') == 'other' ? 'selected' : '' }}>{{ __('package.origin_other') }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label for="status1" class="form-label">{{ __('package.status') }}</label>
                                                                    <select class="form-select" id="status1" name="status">
                                                                        @foreach (\App\Models\Package::statuses() as $key => $label)
                                                                            <option value="{{ $key }}" {{ old('status', $package->status ?? '') == $key ? 'selected' : '' }}>
                                                                                {{ $label }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-12">
                                                                    <label for="delivery_status_note" class="form-label">{{ __('package.delivery_status_note') }}</label>
                                                                    <textarea class="form-control" id="delivery_status_note" name="delivery_status_note" rows="3">{{ old('delivery_status_note') }}</textarea>
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
                                                            $attrs = old('attributes', $defaultAttributes);

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

                                        <!-- الخطوة 5: المراجعة النهائية -->
                                        <div class="tab-pane" id="confirm-detail">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>مراجعة المعلومات</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h6 class="section-title">معلومات المرسل</h6>
                                                                    <p><strong>التاجر:</strong> <span id="review-sender-merchant"></span></p>
                                                                    <p><strong>الاسم:</strong> <span id="review-sender-name"></span></p>
                                                                    <p><strong>البريد الإلكتروني:</strong> <span id="review-sender-email"></span></p>
                                                                    <p><strong>الهاتف:</strong> <span id="review-sender-phone"></span></p>
                                                                    <p><strong>العنوان:</strong> <span id="review-sender-address"></span></p>
                                                                    <p><strong>البلد:</strong> <span id="review-sender-country"></span></p>
                                                                    <p><strong>المدينة:</strong> <span id="review-sender-city"></span></p>
                                                                    <p><strong>الرمز البريدي:</strong> <span id="review-sender-postal"></span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6 class="section-title">معلومات المستلم</h6>
                                                                    <p><strong>التاجر:</strong> <span id="review-receiver-merchant"></span></p>
                                                                    <p><strong>الاسم:</strong> <span id="review-receiver-name"></span></p>
                                                                    <p><strong>البريد الإلكتروني:</strong> <span id="review-receiver-email"></span></p>
                                                                    <p><strong>الهاتف:</strong> <span id="review-receiver-phone"></span></p>
                                                                    <p><strong>العنوان:</strong> <span id="review-receiver-address"></span></p>
                                                                    <p><strong>البلد:</strong> <span id="review-receiver-country"></span></p>
                                                                    <p><strong>المدينة:</strong> <span id="review-receiver-city"></span></p>
                                                                    <p><strong>الرمز البريدي:</strong> <span id="review-receiver-postal"></span></p>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="row mt-4">
                                                                <div class="col-md-6">
                                                                    <h6 class="section-title">مواصفات الطرد</h6>
                                                                    <p><strong>النوع:</strong> <span id="review-package-type"></span></p>
                                                                    <p><strong>الحجم:</strong> <span id="review-package-size"></span></p>
                                                                    <p><strong>الوزن:</strong> <span id="review-weight"></span> كجم</p>
                                                                    <p><strong>الأبعاد:</strong> <span id="review-dimensions"></span></p>
                                                                    <p><strong>المحتويات:</strong> <span id="review-package-content"></span></p>
                                                                    <p><strong>ملاحظات:</strong> <span id="review-package-note"></span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6 class="section-title">خيارات التوصيل</h6>
                                                                    <p><strong>سرعة التوصيل:</strong> <span id="review-delivery-speed"></span></p>
                                                                    <p><strong>طريقة التوصيل:</strong> <span id="review-delivery-method"></span></p>
                                                                    <p><strong>نوع المصدر:</strong> <span id="review-origin-type"></span></p>
                                                                    <p><strong>تاريخ التوصيل:</strong> <span id="review-delivery-date"></span></p>
                                                                    <p><strong>الحالة:</strong> <span id="review-status"></span></p>
                                                                    <p><strong>ملاحظات الحالة:</strong> <span id="review-status-note"></span></p>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col-12">
                                                                    <h6 class="section-title">المنتجات</h6>
                                                                    <div id="review-products"></div>
                                                                </div>
                                                            </div>

                                                            <div class="row mt-4">
                                                                <div class="col-md-6">
                                                                    <h6 class="section-title">معلومات التحصيل</h6>
                                                                    <p><strong>مسؤولية الدفع:</strong> <span id="review-payment-responsibility"></span></p>
                                                                    <p><strong>طريقة الدفع:</strong> <span id="review-payment-method"></span></p>
                                                                    <p><strong>طريقة التحصيل:</strong> <span id="review-collection-method"></span></p>
                                                                    <p><strong>رسوم التوصيل:</strong> <span id="review-delivery-fee"></span></p>
                                                                    <p><strong>رسوم التأمين:</strong> <span id="review-insurance-fee"></span></p>
                                                                    <p><strong>رسوم الخدمة:</strong> <span id="review-service-fee"></span></p>
                                                                    <p><strong>المبلغ الإجمالي:</strong> <span id="review-total-fee"></span></p>
                                                                    <p><strong>المبلغ المدفوع:</strong> <span id="review-paid-amount"></span></p>
                                                                    <p><strong>المبلغ المتبقي:</strong> <span id="review-remaining-amount"></span></p>
                                                                    <p><strong>مبلغ الدفع عند الاستلام:</strong> <span id="review-cod-amount"></span></p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h6 class="section-title">الخصائص الإضافية</h6>
                                                                    <div id="review-attributes" class="d-flex flex-wrap gap-2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-6 text-start">
                                                    <button type="button" class="btn btn-outline-secondary" id="prev-to-options">
                                                        <i class="fas fa-arrow-right me-2"></i> السابق
                                                    </button>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-save me-2"></i> حفظ الطرد
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
    </div>
@endsection


@section('script')
<!-- Bootstrap & jQuery JS -->
<script>
    $(document).ready(function() {
        // دالة لتحديث صفحة المراجعة
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
            $('#review-receiver-merchant').text($('#merchant_recever_id option:selected').text());
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
                $('#review-delivery-fee').text(($('input[name="delivery_fee"]').val() || '0') + ' ر.س');
                $('#review-insurance-fee').text(($('input[name="insurance_fee"]').val() || '0') + ' ر.س');
                $('#review-service-fee').text(($('input[name="service_fee"]').val() || '0') + ' ر.س');
                $('#review-total-fee').text(($('input[name="total_fee"]').val() || '0') + ' ر.س');
                $('#review-paid-amount').text(($('input[name="paid_amount"]').val() || '0') + ' ر.س');
                $('#review-remaining-amount').text(($('input[name="due_amount"]').val() || '0') + ' ر.س');
                $('#review-cod-amount').text(($('input[name="cod_amount"]').val() || '0') + ' ر.س');
            } catch (e) {
                console.log('Livewire components not loaded yet');
            }

            // المنتجات (من Livewire component) - التصحيح هنا
            try {
                var productsHtml = '<table class="table table-bordered"><thead><tr><th>النوع</th><th>المنتج</th><th>الوزن (كجم)</th><th>الكمية</th><th>السعر (ر.س)</th><th>الإجمالي (ر.س)</th></tr></thead><tbody>';

                var hasProducts = false;

                // البحث عن جميع الصفوف في جدول المنتجات
                $('.table-bordered tbody tr').each(function() {
                    var type = $(this).find('select[name*="[type]"] option:selected').text() ||
                              $(this).find('input[readonly]').val() || 'مخصص';

                    var name = $(this).find('select[name*="[stock_item_id]"] option:selected').text() ||
                              $(this).find('input[name*="[custom_name]"]').val() || 'غير محدد';

                    // إزالة نص "اختر من المخزون" إذا كان موجودًا
                    if (name.includes('-- اختر من المخزون --')) {
                        name = 'غير محدد';
                    }

                    var weight = $(this).find('input[name*="[weight]"]').val() || '0';
                    var quantity = $(this).find('input[name*="[quantity]"]').val() || '0';
                    var price = $(this).find('input[name*="[price_per_unit]"]').val() || '0';
                    var total = $(this).find('input[name*="[total_price]"]').val() || '0';

                    // فقط أضف المنتج إذا كان له اسم أو وزن أو كمية
                    if (name !== 'غير محدد' || weight !== '0' || quantity !== '0') {
                        productsHtml += '<tr>' +
                            '<td>' + type + '</td>' +
                            '<td>' + name + '</td>' +
                            '<td>' + weight + '</td>' +
                            '<td>' + quantity + '</td>' +
                            '<td>' + price + '</td>' +
                            '<td>' + total + '</td>' +
                        '</tr>';
                        hasProducts = true;
                    }
                });

                productsHtml += '</tbody></table>';

                // إذا لم يكن هناك منتجات، عرض رسالة
                if (!hasProducts) {
                    productsHtml = '<div class="alert alert-info">لم يتم إضافة أي منتجات</div>';
                }

                $('#review-products').html(productsHtml);
            } catch (e) {
                console.log('Error loading products:', e);
                $('#review-products').html('<div class="alert alert-danger">حدث خطأ في تحميل بيانات المنتجات</div>');
            }
        }

        // تحديث صفحة المراجعة عند النقر على تبويب المراجعة
        $('a[href="#confirm-detail"]').on('click', function() {
            updateReviewPage();
        });

        // الانتقال إلى الخطوة السابقة من صفحة المراجعة
        $('#prev-to-options').on('click', function() {
            $('a[href="#delivery-options"]').tab('show');
        });

        // تهيئة نظام التبويب
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            // تحديث حالة الخطوات
            var target = $(e.target).attr("href");
            var currentStep = parseInt(target.substring(1));

            $('.twitter-bs-wizard-nav .nav-item').removeClass('active completed');

            $('.twitter-bs-wizard-nav .nav-item').each(function(index) {
                if (index < currentStep) {
                    $(this).addClass('completed');
                } else if (index === currentStep) {
                    $(this).addClass('active');
                }
            });
        });

        // معالجة أزرار التالي والسابق
        $('.twitter-bs-wizard-pager-link .next').on('click', function() {
            var $activeTab = $('.twitter-bs-wizard-tab-content .tab-pane.active');
            var nextTab = $activeTab.next('.tab-pane');

            if (nextTab.length) {
                $('a[href="#' + nextTab.attr('id') + '"]').tab('show');
            }
        });

        $('.twitter-bs-wizard-pager-link .previous').on('click', function() {
            var $activeTab = $('.twitter-bs-wizard-tab-content .tab-pane.active');
            var prevTab = $activeTab.prev('.tab-pane');

            if (prevTab.length) {
                $('a[href="#' + prevTab.attr('id') + '"]').tab('show');
            }
        });
    });
</script>
@endsection
