@extends('layouts.admin')

@section('content')
      <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('warehouse.edit_warehouse') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.warehouses.index') }}">{{ __('warehouse.warehouses') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('warehouse.edit_warehouse') }}</li>
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
                    <h5 class="card-title">{{ __('warehouse.editing_warehouse') }}: {{ $warehouse->code }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.warehouses.update', $warehouse->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Warehouse Information Section -->
                        <div class="section-block">
                            <h6 class="section-title">{{ __('warehouse.warehouse_info') }}</h6>
                            <p class="section-description">{{ __('warehouse.update_basic_info') }}</p>
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
                                           name="name[{{ $key }}]"
                                           value="{{ old('name.' . $key, $warehouse->getTranslation('name', $key)) }}"
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
                                           name="location[{{ $key }}]"
                                           value="{{ old('location.' . $key, $warehouse->getTranslation('location', $key)) }}"
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
                                           value="{{ old('code', $warehouse->code) }}"
                                           placeholder="WH-001" readonly>
                                    <span class="input-group-text bg-light">
                                        <small class="text-muted">{{ __('warehouse.unique_identifier') }}</small>
                                    </span>
                                </div>
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Warehouse Management Section -->
                        <div class="section-block mt-4">
                            <h6 class="section-title">{{ __('warehouse.warehouse_management') }}</h6>
                            <p class="section-description">{{ __('warehouse.update_management_info') }}</p>
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
                                           name="manager[{{ $key }}]"
                                           value="{{ old('manager.' . $key, $warehouse->getTranslation('manager', $key)) }}"
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
                                           value="{{ old('phone', $warehouse->phone) }}"
                                           placeholder="+966500000000">
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
                                           value="{{ old('email', $warehouse->email) }}"
                                           placeholder="manager@example.com">
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
                                    <input type="checkbox" class="form-check-input" id="status1"
                                           name="status" {{ old('status', $warehouse->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status1">
                                        {{ __('warehouse.active_warehouse') }}
                                    </label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        {{-- <div class="form-actions text-end">
                            <button type="reset" class="btn btn-light">{{ __('general.reset_changes') }}</button>
                            @ability('admin', 'update_warehouses')
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>{{ __('warehouse.update_warehouse') }}
                                </button>
                            @endability
                        </div> --}}


                            <div class="text-end pt-3">
                                @ability('admin', 'update_warehouses')
                                    <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                        <i class="ri-save-3-line me-2"></i>
                                        <i class="bi bi-save me-2"></i>
                                        {{ __('warehouse.update_warehouse') }}
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
                maxFileSize: 2048,
                overwriteInitial: true,
                initialPreview: [
                    @if($warehouse->logo)
                        "{{ asset('storage/' . $warehouse->logo) }}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewConfig: [
                    @if($warehouse->logo)
                        {caption: "{{ basename($warehouse->logo) }}", size: "{{ Storage::size('public/' . $warehouse->logo) }}", url: "{{ route('admin.warehouses.deleteLogo', $warehouse->id) }}", key: 1}
                    @endif
                ],
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
        .input-group-text.bg-light {
            background-color: #f8f9fa!important;
        }
    </style>
@endsection
