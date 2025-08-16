@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="bi bi-shop-window fs-3 me-2 text-primary"></i>
                    <div>
                        <h4 class="mb-0">{{ __('merchant.manage_merchants') }}</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.dashboard') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.merchants.index') }}">{{ __('merchant.merchants') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('merchant.edit_merchant') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <a href="{{ route('admin.merchants.index') }}" class="btn btn-outline-secondary rounded-pill px-3">
                    <i class="bi bi-arrow-left me-1"></i> {{ __('general.back') }}
                </a>
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

                            @foreach (config('locales.languages') as $key => $val)
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label" for="address[{{ $key }}]">
                                        {{ __('general.address') }}
                                        <span class="badge bg-light text-dark ms-2">
                                            <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} me-1"></i>
                                            {{ __('language.' . $key) }}
                                        </span>
                                    </label>
                                    <div class="col-md-10">
                                        <input name="address[{{ $key }}]" class="form-control" id="address[{{ $key }}]" type="text"
                                               value="{{ old('address.' . $key, $merchant->getTranslation('address', $key)) }}">
                                        @error('address.' . $key)
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
                    size: '{{ filesize(public_path("assets/merchants/" . $merchant->logo)) }}',
                    width: "120px",
                    url: "{{ route('admin.merchants.remove_image', ['merchant_id' => $merchant->id, '_token' => csrf_token()]) }}",
                    key: {{ $merchant->id }}
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
@endsection
