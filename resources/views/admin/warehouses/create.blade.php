@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">{{ __('warehouse.manage_warehouses') }}</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('warehouse.warehouses') }}</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.warehouses.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('general.back') }}
                </a>
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

                        <!-- Multilingual Location Fields -->
                        @foreach (config('locales.languages') as $key => $val)
                            <div class="mb-3 row">
                                <label for="location[{{ $key }}]" class="col-md-3 col-form-label">
                                    {{ __('warehouse.location') }}
                                    <span class="language-badge bg-{{ $key == 'ar' ? 'primary' : 'info' }}">
                                        <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }}"></i>
                                        {{ __('language.' . $key) }}
                                    </span>
                                </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="location[{{ $key }}]"
                                           name="location[{{ $key }}]" value="{{ old('location.' . $key) }}"
                                           placeholder="{{ __('warehouse.enter_location') }}">
                                    @error('location.' . $key)
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
                                </div>
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
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
                            <label class="col-md-3 col-form-label">{{ __('general.status') }}</label>
                            <div class="col-md-9">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="status"
                                           name="status" {{ old('status', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        {{ __('warehouse.active_warehouse') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions text-end">
                            <button type="reset" class="btn btn-light">{{ __('general.reset') }}</button>
                            @ability('admin', 'create_warehouses')
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>{{ __('warehouse.save_warehouse') }}
                                </button>
                            @endability
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- File Input Script -->
    <script>
        $(document).ready(function() {
            $("#warehouse_logo").fileinput({
                theme: "fas",
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-primary",
                removeClass: "btn btn-danger",
                mainClass: "input-group-lg",
                allowedFileExtensions: ['jpg', 'png', 'jpeg'],
                maxFileSize: 2048, // 2MB
                overwriteInitial: false,
                initialPreviewAsData: true,
                showClose: false
            });
        });
    </script>
@endsection

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
