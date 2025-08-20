@extends('layouts.admin')

@section('content')

    <!-- start page title -->
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
                                        <span class="step-title">المعلومات الأساسية</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#trip-information" class="nav-link" data-toggle="tab">
                                        <span class="step-number"><i class=" fas fa-map-marked-alt"></i></span>
                                        <span class="step-title">معلومات الرحلة</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#package-details" class="nav-link" data-toggle="tab">
                                        <span class="step-number"><i class="fas fa-box"></i></span>
                                        <span class="step-title">تفاصيل الطرد</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#delivery-options" class="nav-link" data-toggle="tab">
                                        <span class="step-number"><i class="fas fa-shipping-fast"></i></span>
                                        <span class="step-title">خيارات التوصيل</span>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="#confirm-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number"><i class="fas fa-check-circle"></i></span>
                                        <span class="step-title">مراجعة المعلومات</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content twitter-bs-wizard-tab-content">

                                <div class="tab-pane" id="basic-informaion">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>معلومات المرسل</h5>
                                                    <span class="badge bg-primary">مطلوب</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            @livewire('admin.package.create-select-merchant-component')
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <label for="sender_first_name" class="form-label">الاسم الأول</label>
                                                            <input type="text" class="form-control" id="sender_first_name" name="sender_first_name" value="{{ old('sender_first_name') }}">
                                                            @error('sender_first_name')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="sender_middle_name" class="form-label">الاسم الأوسط</label>
                                                            <input type="text" class="form-control" id="sender_middle_name" name="sender_middle_name" value="{{ old('sender_middle_name') }}">
                                                            @error('sender_middle_name')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="sender_last_name" class="form-label">الاسم الأخير</label>
                                                            <input type="text" class="form-control" id="sender_last_name" name="sender_last_name" value="{{ old('sender_last_name') }}">
                                                            @error('sender_last_name')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="sender_email" class="form-label">البريد الإلكتروني</label>
                                                            <input type="email" class="form-control" id="sender_email" name="sender_email" value="{{ old('sender_email') }}">
                                                            @error('sender_email')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="sender_phone" class="form-label">رقم الهاتف</label>
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
                                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>معلومات المستلم</h5>
                                                    <span class="badge bg-primary">مطلوب</span>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row mb-3">
                                                        <div class="com-md-12">
                                                            <div class="mb-3">
                                                                <label for="merchant_id" class="form-label">التاجر (اختياري)</label>
                                                                <select class="form-select"  id="merchant_recever_id" name="merchant_recever_id">
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
                                                            <label for="receiver_first_name" class="form-label">الاسم الأول</label>
                                                            <input type="text" class="form-control" id="receiver_first_name" name="receiver_first_name" value="{{ old('receiver_first_name') }}">
                                                            @error('receiver_first_name')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="receiver_middle_name" class="form-label">الاسم الأوسط</label>
                                                            <input type="text" class="form-control" id="receiver_middle_name" name="receiver_middle_name" value="{{ old('receiver_middle_name') }}">
                                                            @error('receiver_middle_name')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="receiver_last_name" class="form-label">الاسم الأخير</label>
                                                            <input type="text" class="form-control" id="receiver_last_name" name="receiver_last_name" value="{{ old('receiver_last_name') }}">
                                                            @error('receiver_last_name')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label for="receiver_email" class="form-label">البريد الإلكتروني</label>
                                                            <input type="email" class="form-control" id="receiver_email" name="receiver_email" value="{{ old('receiver_email') }}">
                                                            @error('receiver_email')
                                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="receiver_phone" class="form-label">رقم الهاتف</label>
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
                                <div class="tab-pane" id="trip-information">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>عنوان المرسل</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <label for="sender_address" class="form-label">العنوان</label>
                                                                <input type="text" class="form-control" id="sender_address" name="sender_address" value="{{ old('sender_address') }}">
                                                                @error('sender_address')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label for="sender_country" class="form-label">الدولة</label>
                                                                <input type="text" class="form-control" id="sender_country" name="sender_country" value="{{ old('sender_country') }}">
                                                                @error('sender_country')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="sender_region" class="form-label">المنطقة</label>
                                                                <input type="text" class="form-control" id="sender_region" name="sender_region" value="{{ old('sender_region') }}">
                                                                @error('sender_region')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="sender_city" class="form-label">المدينة</label>
                                                                <input type="text" class="form-control" id="sender_city" name="sender_city" value="{{ old('sender_city') }}">
                                                                @error('sender_city')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="sender_district" class="form-label">الحي</label>
                                                                <input type="text" class="form-control" id="sender_district" name="sender_district" value="{{ old('sender_district') }}">
                                                                @error('sender_district')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="sender_postal_code" class="form-label">الرمز البريدي</label>
                                                                <input type="text" class="form-control" id="sender_postal_code" name="sender_postal_code" value="{{ old('sender_postal_code') }}">
                                                                @error('sender_postal_code')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="sender_location" class="form-label">الموقع</label>
                                                                <input type="text" class="form-control" id="sender_location" name="sender_location" value="{{ old('sender_location') }}">
                                                                @error('sender_location')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="sender_others" class="form-label">معلومات إضافية</label>
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
                                                        <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>عنوان المستلم</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <label for="receiver_address" class="form-label">العنوان</label>
                                                                <input type="text" class="form-control" id="receiver_address" name="receiver_address" value="{{ old('receiver_address') }}">
                                                                @error('receiver_address')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label for="receiver_country" class="form-label">الدولة</label>
                                                                <input type="text" class="form-control" id="receiver_country" name="receiver_country" value="{{ old('receiver_country') }}">
                                                                @error('receiver_country')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="receiver_region" class="form-label">المنطقة</label>
                                                                <input type="text" class="form-control" id="receiver_region" name="receiver_region" value="{{ old('receiver_region') }}">
                                                                @error('receiver_region')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="receiver_city" class="form-label">المدينة</label>
                                                                <input type="text" class="form-control" id="receiver_city" name="receiver_city" value="{{ old('receiver_city') }}">
                                                                @error('receiver_city')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="receiver_district" class="form-label">الحي</label>
                                                                <input type="text" class="form-control" id="receiver_district" name="receiver_district" value="{{ old('receiver_district') }}">
                                                                @error('receiver_district')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="receiver_postal_code" class="form-label">الرمز البريدي</label>
                                                                <input type="text" class="form-control" id="receiver_postal_code" name="receiver_postal_code" value="{{ old('receiver_postal_code') }}">
                                                                @error('receiver_postal_code')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="receiver_location" class="form-label">الموقع</label>
                                                                <input type="text" class="form-control" id="receiver_location" name="receiver_location" value="{{ old('receiver_location') }}">
                                                                @error('receiver_location')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="receiver_others" class="form-label">معلومات إضافية</label>
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
                                </div>
                                <div class="tab-pane" id="package-details">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="fas fa-cube me-2"></i>مواصفات الطرد</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label for="package_type" class="form-label">نوع الطرد</label>
                                                                <select class="form-select" id="package_type" name="package_type">
                                                                    <option value="box" {{ old('package_type') == 'box' ? 'selected' : '' }}>صندوق</option>
                                                                    <option value="envelope" {{ old('package_type') == 'envelope' ? 'selected' : '' }}>مظروف</option>
                                                                    <option value="pallet" {{ old('package_type') == 'pallet' ? 'selected' : '' }}>بالت</option>
                                                                    <option value="tube" {{ old('package_type') == 'tube' ? 'selected' : '' }}>أنبوب</option>
                                                                    <option value="bag" {{ old('package_type') == 'bag' ? 'selected' : '' }}>حقيبة</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="package_size" class="form-label">الحجم</label>
                                                                <select class="form-select" id="package_size" name="package_size">
                                                                    <option value="small" {{ old('package_size') == 'small' ? 'selected' : '' }}>صغير</option>
                                                                    <option value="medium" {{ old('package_size') == 'medium' ? 'selected' : '' }}>متوسط</option>
                                                                    <option value="large" {{ old('package_size') == 'large' ? 'selected' : '' }}>كبير</option>
                                                                    <option value="oversized" {{ old('package_size') == 'oversized' ? 'selected' : '' }}>كبير جداً</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="weight" class="form-label">الوزن (كجم)</label>
                                                                <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ old('weight', 0) }}">
                                                                @error('weight')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label for="dimensions.length" class="form-label">الطول (سم)</label>
                                                                <input type="number" step="0.01" class="form-control" id="dimensions.length" name="dimensions[length]" value="{{ old('dimensions.length', 0) }}">
                                                                @error('dimensions.length')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="dimensions.width" class="form-label">العرض (سم)</label>
                                                                <input type="number" step="0.01" class="form-control" id="dimensions.width" name="dimensions[width]" value="{{ old('dimensions.width', 0) }}">
                                                                @error('dimensions.width')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="dimensions.height" class="form-label">الارتفاع (سم)</label>
                                                                <input type="number" step="0.01" class="form-control" id="dimensions.height" name="dimensions[height]" value="{{ old('dimensions.height', 0) }}">
                                                                @error('dimensions.height')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <label for="package_content" class="form-label">محتويات الطرد</label>
                                                                <textarea class="form-control" id="package_content" name="package_content" rows="3">{{ old('package_content') }}</textarea>
                                                                @error('package_content')
                                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-12">
                                                                <label for="package_note" class="form-label">ملاحظات</label>
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
                                                        <h5 class="mb-0"><i class="fas fa-cube me-2"></i>مواصفات الطرد</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        @livewire('admin.package.create-product-component')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="delivery-options">
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>خيارات التوصيل</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="delivery_speed" class="form-label">سرعة التوصيل</label>
                                                                <select class="form-select" id="delivery_speed" name="delivery_speed">
                                                                    <option value="standard" {{ old('delivery_speed') == 'standard' ? 'selected' : '' }}>عادي</option>
                                                                    <option value="express" {{ old('delivery_speed') == 'express' ? 'selected' : '' }}>سريع</option>
                                                                    <option value="same_day" {{ old('delivery_speed') == 'same_day' ? 'selected' : '' }}>نفس اليوم</option>
                                                                    <option value="next_day" {{ old('delivery_speed') == 'next_day' ? 'selected' : '' }}>اليوم التالي</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="delivery_date" class="form-label">تاريخ التوصيل</label>
                                                                <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="delivery_method" class="form-label">طريقة التوصيل</label>
                                                                <select class="form-select" id="delivery_method" name="delivery_method">
                                                                    <option value="standard" {{ old('delivery_method') == 'standard' ? 'selected' : '' }}>عادي</option>
                                                                    <option value="express" {{ old('delivery_method') == 'express' ? 'selected' : '' }}>سريع</option>
                                                                    <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>استلام من الفرع</option>
                                                                    <option value="courier" {{ old('delivery_method') == 'courier' ? 'selected' : '' }}>مستعجل</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="origin_type" class="form-label">نوع المصدر</label>
                                                                <select class="form-select" id="origin_type" name="origin_type">
                                                                    <option value="warehouse" {{ old('origin_type') == 'warehouse' ? 'selected' : '' }}>مستودع</option>
                                                                    <option value="store" {{ old('origin_type') == 'store' ? 'selected' : '' }}>متجر</option>
                                                                    <option value="home" {{ old('origin_type') == 'home' ? 'selected' : '' }}>منزل</option>
                                                                    <option value="other" {{ old('origin_type') == 'other' ? 'selected' : '' }}>أخرى</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <label for="status1" class="form-label">الحالة</label>
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
                                                                <label for="delivery_status_note" class="form-label">ملاحظات الحالة</label>
                                                                <textarea class="form-control" id="delivery_status_note" name="delivery_status_note" rows="3">{{ old('delivery_status_note') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>التحصيل</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                @livewire('admin.package.create-package-collection-component')
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
                                                        <h5 class="mb-0"><i class="fas fa-shipping-fast me-2"></i>خيارات اضافية</h5>
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
                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            @foreach($allKeys as $key => $label)
                                                                <div class="col-md-4">
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
                                                            <p><strong>الاسم:</strong> <span id="review-sender-name"></span></p>
                                                            <p><strong>البريد الإلكتروني:</strong> <span id="review-sender-email"></span></p>
                                                            <p><strong>الهاتف:</strong> <span id="review-sender-phone"></span></p>
                                                            <p><strong>العنوان:</strong> <span id="review-sender-address"></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="section-title">معلومات المستلم</h6>
                                                            <p><strong>الاسم:</strong> <span id="review-receiver-name"></span></p>
                                                            <p><strong>البريد الإلكتروني:</strong> <span id="review-receiver-email"></span></p>
                                                            <p><strong>الهاتف:</strong> <span id="review-receiver-phone"></span></p>
                                                            <p><strong>العنوان:</strong> <span id="review-receiver-address"></span></p>
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
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="section-title">خيارات التوصيل</h6>
                                                            <p><strong>سرعة التوصيل:</strong> <span id="review-delivery-speed"></span></p>
                                                            <p><strong>طريقة التوصيل:</strong> <span id="review-delivery-method"></span></p>
                                                            <p><strong>تاريخ التوصيل:</strong> <span id="review-delivery-date"></span></p>
                                                            <p><strong>الحالة:</strong> <span id="review-status"></span></p>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-4">
                                                        <div class="col-12">
                                                            <h6 class="section-title">الخصائص الإضافية</h6>
                                                            <div id="review-attributes" class="d-flex flex-wrap gap-2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                                <li class="next"><a href="javascript: void(0);">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Sender Information -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('package.sender_Information') }}</h4>
                            </div>

                            <div class="card-body">

                                {{-- <div class="row mb-3">
                                    <div class="col-sm-12">

                                        <label for="merchant_id" class="col-form-label">{{ __('merchant.sender_merchant') }} ({{ __('general.optional') }})</label>
                                        <select name="merchant_id" id="merchant_id" class="form-select">
                                            <option value="">{{ __('merchant.without_merchant') }}</option>
                                            @foreach($merchants as $merchant)
                                                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('merchant_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        @livewire('admin.package.create-select-merchant-component')
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="sender_first_name">{{ __('package.sender_first_name') }}</label>
                                        <input name="sender_first_name" class="form-control" id="sender_first_name" type="text" value="{{ old('sender_first_name') }}">
                                        @error('sender_first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="sender_middle_name">{{ __('package.sender_middle_name') }}</label>
                                        <input name="sender_middle_name" class="form-control" id="sender_middle_name" type="text" value="{{ old('sender_middle_name') }}">
                                        @error('sender_middle_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="sender_last_name">{{ __('package.sender_last_name') }}</label>
                                        <input name="sender_last_name" class="form-control" id="sender_last_name" type="text" value="{{ old('sender_last_name') }}">
                                        @error('sender_last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="sender_email">{{ __('package.sender_email') }}</label>
                                        <input name="sender_email" class="form-control" id="sender_email" type="text" value="{{ old('sender_email') }}">
                                        @error('sender_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="sender_phone">{{ __('package.sender_phone') }}</label>
                                        <input name="sender_phone" class="form-control" id="sender_phone" type="text" value="{{ old('sender_phone') }}">
                                        @error('sender_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('package.trip_information') }}</h4>
                            </div>

                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-sm-12">

                                        <label for="sender_address" class="col-form-label">{{ __('package.sender_address') }}</label>
                                        <input name="sender_address" class="form-control" id="sender_address" type="text" value="{{ old('sender_address') }}">
                                        @error('sender_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_country">{{ __('package.sender_country') }}</label>
                                        <input name="sender_country" class="form-control" id="sender_country" type="text" value="{{ old('sender_country') }}">
                                        @error('sender_country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="sender_region">{{ __('package.sender_region') }}</label>
                                        <input name="sender_region" class="form-control" id="sender_region" type="text" value="{{ old('sender_region') }}">
                                        @error('sender_regin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="sender_city">{{ __('package.sender_city') }}</label>
                                        <input name="sender_city" class="form-control" id="sender_city" type="text" value="{{ old('sender_city') }}">
                                        @error('sender_city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="sender_district">{{ __('package.sender_district') }}</label>
                                        <input name="sender_district" class="form-control" id="sender_district" type="text" value="{{ old('sender_district') }}">
                                        @error('sender_district')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="sender_postal_code">{{ __('package.sender_postal_code') }}</label>
                                        <input name="sender_postal_code" class="form-control" id="sender_postal_code" type="text" value="{{ old('sender_postal_code') }}">
                                        @error('sender_postal_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="sender_location">{{ __('package.sender_location') }}</label>
                                        <input name="sender_location" class="form-control" id="sender_location" type="text" value="{{ old('sender_location') }}">
                                        @error('sender_location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="sender_others">{{ __('package.sender_others') }}</label>
                                        <input name="sender_others" class="form-control" id="sender_others" type="text" value="{{ old('sender_others') }}">
                                        @error('sender_others')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('package.receiver_Information') }}</h4>
                            </div>

                            <div class="card-body">

                                {{-- <div class="row mb-3">
                                    <div class="col-sm-12">

                                        <label for="merchant_id" class="col-form-label">{{ __('merchant.receiver_merchant') }} ({{ __('general.optional') }})</label>
                                        <select name="merchant_id" id="merchant_id" class="form-select">
                                            <option value=""> {{ __('merchant.without_merchant') }}</option>
                                            @foreach($merchants as $merchant)
                                                <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('merchant_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div> --}}

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_first_name">{{ __('package.receiver_first_name') }}</label>
                                        <input name="receiver_first_name" class="form-control" id="receiver_first_name" type="text" value="{{ old('receiver_first_name') }}">
                                        @error('receiver_first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_middle_name">{{ __('package.receiver_middle_name') }}</label>
                                        <input name="receiver_middle_name" class="form-control" id="receiver_middle_name" type="text" value="{{ old('receiver_middle_name') }}">
                                        @error('receiver_middle_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_last_name">{{ __('package.receiver_last_name') }}</label>
                                        <input name="receiver_last_name" class="form-control" id="receiver_last_name" type="text" value="{{ old('receiver_last_name') }}">
                                        @error('receiver_last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="receiver_email">{{ __('package.receiver_email') }}</label>
                                        <input name="receiver_email" class="form-control" id="receiver_email" type="text" value="{{ old('receiver_email') }}">
                                        @error('receiver_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="receiver_phone">{{ __('package.receiver_phone') }}</label>
                                        <input name="receiver_phone" class="form-control" id="receiver_phone" type="text" value="{{ old('receiver_phone') }}">
                                        @error('receiver_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('package.trip_information') }}</h4>
                            </div>

                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-sm-12">

                                        <label for="receiver_address" class="col-form-label">{{ __('package.receiver_address') }}</label>
                                        <input name="receiver_address" class="form-control" id="receiver_address" type="text" value="{{ old('receiver_address') }}">
                                        @error('receiver_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_country">{{ __('package.receiver_country') }}</label>
                                        <input name="receiver_country" class="form-control" id="receiver_country" type="text" value="{{ old('receiver_country') }}">
                                        @error('receiver_country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_region">{{ __('package.receiver_region') }}</label>
                                        <input name="receiver_region" class="form-control" id="receiver_region" type="text" value="{{ old('receiver_region') }}">
                                        @error('receiver_region')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="receiver_city">{{ __('package.receiver_city') }}</label>
                                        <input name="receiver_city" class="form-control" id="receiver_city" type="text" value="{{ old('receiver_city') }}">
                                        @error('receiver_city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="receiver_district">{{ __('package.receiver_district') }}</label>
                                        <input name="receiver_district" class="form-control" id="receiver_district" type="text" value="{{ old('receiver_district') }}">
                                        @error('receiver_district')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="receiver_postal_code">{{ __('package.receiver_postal_code') }}</label>
                                        <input name="receiver_postal_code" class="form-control" id="receiver_postal_code" type="text" value="{{ old('receiver_postal_code') }}">
                                        @error('receiver_postal_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="receiver_location">{{ __('package.receiver_location') }}</label>
                                        <input name="receiver_location" class="form-control" id="receiver_location" type="text" value="{{ old('receiver_location') }}">
                                        @error('receiver_location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="receiver_others">{{ __('package.receiver_others') }}</label>
                                        <input name="receiver_others" class="form-control" id="receiver_others" type="text" value="{{ old('receiver_others') }}">
                                        @error('receiver_others')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('package.package_information') }}</h4>
                            </div>
                            <div class="card-body">
                                @livewire('admin.package.create-product-component')
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12"></div>
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('package.package_details') }}</h4>
                            </div>
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="package_type">{{ __('package.package_type') }}</label>
                                        <select name="package_type" id="package_type" class="form-select">
                                            <option value="box" {{ old('package_type') == 'box' ? 'selected' : '' }}>{{ __('package.type_box') }}</option>
                                            <option value="envelope" {{ old('package_type') == 'envelope' ? 'selected' : '' }}>{{ __('package.type_envelope') }}</option>
                                            <option value="pallet" {{ old('package_type') == 'pallet' ? 'selected' : '' }}>{{ __('package.type_pallet') }}</option>
                                            <option value="tube" {{ old('package_type') == 'tube' ? 'selected' : '' }}>{{ __('package.type_tube') }}</option>
                                            <option value="bag" {{ old('package_type') == 'bag' ? 'selected' : '' }}>{{ __('package.type_bag') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="package_size">{{ __('package.package_size') }}</label>
                                        <select name="package_size" id="package_size" class="form-select">
                                            <option value="small" {{ old('package_size') == 'small' ? 'selected' : '' }}>{{ __('package.size_small') }}</option>
                                            <option value="medium" {{ old('package_size') == 'medium' ? 'selected' : '' }}>{{ __('package.size_medium') }}</option>
                                            <option value="large" {{ old('package_size') == 'large' ? 'selected' : '' }}>{{ __('package.size_large') }}</option>
                                            <option value="oversized" {{ old('package_size') == 'oversized' ? 'selected' : '' }}>{{ __('package.size_oversized') }}</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="weight">{{ __('package.weight') }}</label>
                                        <input name="weight" class="form-control" id="weight" type="number" step="0.01" value="{{ old('weight', 0) }}" >
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="dimensions.length">{{ __('package.dimensions.length') }}</label>
                                        <input name="dimensions[length]" class="form-control" id="dimensions.length" type="number" step="0.01" value="{{ old('dimensions.length', 0) }}">
                                        @error('dimensions.length')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="dimensions.width">{{ __('package.dimensions.width') }}</label>
                                        <input name="dimensions[width]" class="form-control" id="dimensions.width" type="number" step="0.01" value="{{ old('dimensions.width', 0) }}">
                                        @error('dimensions.width')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="dimensions.height">{{ __('package.dimensions.height') }}</label>
                                        <input name="dimensions[height]" class="form-control" id="dimensions.height" type="number" step="0.01" value="{{ old('dimensions.height', 0) }}">
                                        @error('dimensions.height')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="package_content">{{ __('package.package_content') }}</label>
                                        <textarea name="package_content" class="form-control" id="package_content">{{ old('package_content') }}</textarea>
                                        @error('package_content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label" for="package_note">{{ __('package.package_note') }}</label>
                                        <textarea name="package_note" class="form-control" id="package_note">{{ old('package_note') }}</textarea>
                                        @error('package_note')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @livewire('admin.package.create-package-collection-component')
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
                                            <option value="standard" {{ old('delivery_speed') == 'standard' ? 'selected' : '' }}>{{ __('package.speed_standard') }}</option>
                                            <option value="express" {{ old('delivery_speed') == 'express' ? 'selected' : '' }}>{{ __('package.speed_express') }}</option>
                                            <option value="same_day" {{ old('delivery_speed') == 'same_day' ? 'selected' : '' }}>{{ __('package.speed_same_day') }}</option>
                                            <option value="next_day" {{ old('delivery_speed') == 'next_day' ? 'selected' : '' }}>{{ __('package.speed_next_day') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="delivery_date">{{ __('package.delivery_date') }}</label>
                                        <input name="delivery_date" class="form-control" id="delivery_date" type="date" value="{{ old('delivery_date') }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="status1">{{ __('package.status') }}</label>

                                        <select name="status" id="status1" class="form-select">
                                            @foreach (\App\Models\Package::statuses() as $key => $label)
                                                <option value="{{ $key }}" {{ old('status', $package->status ?? '') == $key ? 'selected' : '' }}>
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
                                            <option value="standard" {{ old('delivery_method') == 'standard' ? 'selected' : '' }}>{{ __('package.method_standard') }}</option>
                                            <option value="express" {{ old('delivery_method') == 'express' ? 'selected' : '' }}>{{ __('package.method_express') }}</option>
                                            <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>{{ __('package.method_pickup') }}</option>
                                            <option value="courier" {{ old('delivery_method') == 'courier' ? 'selected' : '' }}>{{ __('package.method_courier') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="package_type">{{ __('package.package_type') }}</label>
                                        <select name="package_type" id="package_type" class="form-select">
                                            <option value="box" {{ old('package_type') == 'box' ? 'selected' : '' }}>{{ __('package.type_box') }}</option>
                                            <option value="envelope" {{ old('package_type') == 'envelope' ? 'selected' : '' }}>{{ __('package.type_envelope') }}</option>
                                            <option value="pallet" {{ old('package_type') == 'pallet' ? 'selected' : '' }}>{{ __('package.type_pallet') }}</option>
                                            <option value="tube" {{ old('package_type') == 'tube' ? 'selected' : '' }}>{{ __('package.type_tube') }}</option>
                                            <option value="bag" {{ old('package_type') == 'bag' ? 'selected' : '' }}>{{ __('package.type_bag') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="col-form-label" for="origin_type">{{ __('package.origin_type') }}</label>
                                        <select name="origin_type" id="origin_type" class="form-select">
                                            <option value="warehouse" {{ old('origin_type') == 'warehouse' ? 'selected' : '' }}>{{ __('package.origin_warehouse') }}</option>
                                            <option value="store" {{ old('origin_type') == 'store' ? 'selected' : '' }}>{{ __('package.origin_store') }}</option>
                                            <option value="home" {{ old('origin_type') == 'home' ? 'selected' : '' }}>{{ __('package.origin_home') }}</option>
                                            <option value="other" {{ old('origin_type') == 'other' ? 'selected' : '' }}>{{ __('package.origin_other') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label" for="delivery_status_note">{{ __('package.delivery_status_note') }}</label>
                                    <textarea name="delivery_status_note" class="form-control" id="delivery_status_note">{{ old('delivery_status_note') }}</textarea>
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
                    $attrs = old('attributes', $defaultAttributes);

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
                    <div class="row">
                        @foreach($allKeys as $key => $label)
                            <div class="col-sm-3 mb-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $key }}" name="attributes[{{ $key }}]" value="1" {{ !empty($attrs[$key]) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @ability('admin', 'create_packages')
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">{{ __('package.save_package_data') }}</button>
                    </div>
                @endability
            </form>
        </div>
    </div>
@endsection
