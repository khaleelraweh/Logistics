<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة الطرود - إضافة طرد جديد</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --sidebar-width: 250px;
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

        .step-progress {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }

        .step-progress::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 4px;
            background-color: #eaeaea;
            z-index: 1;
        }

        .step {
            text-align: center;
            position: relative;
            z-index: 2;
            cursor: pointer;
        }

        .step-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #fff;
            border: 4px solid #eaeaea;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 18px;
            color: #999;
            transition: all 0.3s;
        }

        .step.active .step-icon {
            border-color: var(--primary);
            background-color: var(--primary);
            color: #fff;
        }

        .step.completed .step-icon {
            border-color: var(--success);
            background-color: var(--success);
            color: #fff;
        }

        .step-title {
            font-size: 14px;
            font-weight: 500;
            color: #999;
        }

        .step.active .step-title, .step.completed .step-title {
            color: #333;
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

        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #666;
            padding: 10px 15px;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary);
            border-bottom: 3px solid var(--primary);
            background: transparent;
        }

        @media (max-width: 768px) {
            .step-title {
                font-size: 12px;
            }

            .step-icon {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid py-3">
        <!-- رأس الصفحة -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">إدارة الطرود</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">إضافة طرد جديد</a></li>
                            <li class="breadcrumb-item active">إدارة الطرود</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- شريط التقدم -->
        <div class="row">
            <div class="col-12">
                <div class="step-progress mb-5">
                    <div class="step active" data-step="1">
                        <div class="step-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="step-title">المعلومات الأساسية</div>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="step-title">تفاصيل الطرد</div>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="step-title">خيارات التوصيل</div>
                    </div>
                    <div class="step" data-step="4">
                        <div class="step-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="step-title">مراجعة</div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" id="packageForm">
            @csrf

            <!-- الخطوة 1: المعلومات الأساسية -->
            <div class="step-content" id="step1">
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

                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-primary next-step" data-next="2">التالي <i class="fas fa-arrow-left ms-2"></i></button>
                    </div>
                </div>
            </div>

            <!-- الخطوة 2: تفاصيل الطرد -->
            <div class="step-content d-none" id="step2">
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

                <div class="row mt-4">
                    <div class="col-6 text-start">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-prev="1">
                            <i class="fas fa-arrow-right me-2"></i> السابق
                        </button>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-primary next-step" data-next="3">التالي <i class="fas fa-arrow-left ms-2"></i></button>
                    </div>
                </div>
            </div>

            <!-- الخطوة 3: خيارات التوصيل -->
            <div class="step-content d-none" id="step3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-cube me-2"></i>مواصفات الطرد</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="package_type" class="form-label">نوع الطرد</label>
                                        <select class="form-select" id="package_type" name="package_type">
                                            <option value="box" {{ old('package_type') == 'box' ? 'selected' : '' }}>صندوق</option>
                                            <option value="envelope" {{ old('package_type') == 'envelope' ? 'selected' : '' }}>مظروف</option>
                                            <option value="pallet" {{ old('package_type') == 'pallet' ? 'selected' : '' }}>بالت</option>
                                            <option value="tube" {{ old('package_type') == 'tube' ? 'selected' : '' }}>أنبوب</option>
                                            <option value="bag" {{ old('package_type') == 'bag' ? 'selected' : '' }}>حقيبة</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="package_size" class="form-label">الحجم</label>
                                        <select class="form-select" id="package_size" name="package_size">
                                            <option value="small" {{ old('package_size') == 'small' ? 'selected' : '' }}>صغير</option>
                                            <option value="medium" {{ old('package_size') == 'medium' ? 'selected' : '' }}>متوسط</option>
                                            <option value="large" {{ old('package_size') == 'large' ? 'selected' : '' }}>كبير</option>
                                            <option value="oversized" {{ old('package_size') == 'oversized' ? 'selected' : '' }}>كبير جداً</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
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
                </div>

                <div class="row mt-4">
                    <div class="col-6 text-start">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-prev="2">
                            <i class="fas fa-arrow-right me-2"></i> السابق
                        </button>
                    </div>
                    <div class="col-6 text-end">
                        <button type="button" class="btn btn-primary next-step" data-next="4">التالي <i class="fas fa-arrow-left ms-2"></i></button>
                    </div>
                </div>
            </div>

            <!-- الخطوة 4: المراجعة -->
            <div class="step-content d-none" id="step4">
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

                <div class="row mt-4">
                    <div class="col-6 text-start">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-prev="3">
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
        </form>
    </div>

    <!-- Bootstrap & jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // التنقل بين الخطوات
            $('.next-step').click(function() {
                var nextStep = $(this).data('next');
                $('.step-content').addClass('d-none');
                $('#step' + nextStep).removeClass('d-none');

                $('.step').removeClass('active');
                $('.step[data-step="' + nextStep + '"]').addClass('active');
            });

            $('.prev-step').click(function() {
                var prevStep = $(this).data('prev');
                $('.step-content').addClass('d-none');
                $('#step' + prevStep).removeClass('d-none');

                $('.step').removeClass('active');
                $('.step[data-step="' + prevStep + '"]').addClass('active');
            });

            // عند الانتقال إلى خطوة المراجعة، تعبئة بيانات المراجعة
            $('button[data-next="4"]').click(function() {
                // معلومات المرسل
                $('#review-sender-name').text(
                    $('#sender_first_name').val() + ' ' +
                    $('#sender_middle_name').val() + ' ' +
                    $('#sender_last_name').val()
                );
                $('#review-sender-email').text($('#sender_email').val());
                $('#review-sender-phone').text($('#sender_phone').val());
                $('#review-sender-address').text($('#sender_address').val());

                // معلومات المستلم
                $('#review-receiver-name').text(
                    $('#receiver_first_name').val() + ' ' +
                    $('#receiver_middle_name').val() + ' ' +
                    $('#receiver_last_name').val()
                );
                $('#review-receiver-email').text($('#receiver_email').val());
                $('#review-receiver-phone').text($('#receiver_phone').val());
                $('#review-receiver-address').text($('#receiver_address').val());

                // مواصفات الطرد
                $('#review-package-type').text($('#package_type option:selected').text());
                $('#review-package-size').text($('#package_size option:selected').text());
                $('#review-weight').text($('#weight').val());
                $('#review-dimensions').text(
                    $('#dimensions\\.length').val() + 'x' +
                    $('#dimensions\\.width').val() + 'x' +
                    $('#dimensions\\.height').val() + ' سم'
                );

                // خيارات التوصيل
                $('#review-delivery-speed').text($('#delivery_speed option:selected').text());
                $('#review-delivery-method').text($('#delivery_method option:selected').text());
                $('#review-delivery-date').text($('#delivery_date').val());
                $('#review-status').text($('#status1 option:selected').text());

                // الخصائص
                var attributesHtml = '';
                $('input[name^="attributes"]:checked').each(function() {
                    var label = $('label[for="' + $(this).attr('id') + '"]').text();
                    attributesHtml += '<span class="badge bg-info">' + label + '</span>';
                });
                $('#review-attributes').html(attributesHtml);
            });
        });
    </script>
</body>
</html>
