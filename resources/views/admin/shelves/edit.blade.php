@extends('layouts.admin')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-title">{{ __('shelf.edit_shelf') }}</h1>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.shelves.index') }}">{{ __('shelf.shelves') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('shelf.editing') }}: {{ $shelf->code }}</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.shelves.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>{{ __('general.back') }}
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('shelf.editing_shelf') }}: <strong>{{ $shelf->code }}</strong></h5>
                    <p class="text-muted mb-0">{{ __('shelf.update_shelf_details') }}</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.shelves.update', $shelf->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Shelf Code -->
                        <div class="mb-3 row">
                            <label for="code" class="col-md-3 col-form-label">{{ __('shelf.code') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    <input type="text" class="form-control" id="code" name="code"
                                           value="{{ old('code', $shelf->code) }}" placeholder="SH-001">
                                    <span class="input-group-text bg-light">
                                        <small class="text-muted">{{ __('shelf.unique_identifier') }}</small>
                                    </span>
                                </div>
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Warehouse Selection -->
                        <div class="mb-3 row">
                            <label for="warehouse_id" class="col-md-3 col-form-label">{{ __('warehouse.name') }}</label>
                            <div class="col-md-9">
                                <select name="warehouse_id" class="form-select select2" data-placeholder="{{ __('shelf.select_warehouse') }}">
                                    <option></option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $shelf->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }} ({{ $warehouse->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Size Selection -->
                        <div class="mb-3 row">
                            <label for="size" class="col-md-3 col-form-label">{{ __('shelf.size') }}</label>
                            <div class="col-md-9">
                                <select name="size" class="form-select select2">
                                    <option value="">{{ __('shelf.select_size') }}</option>
                                    <option value="small" {{ old('size', $shelf->size) == 'small' ? 'selected' : '' }}>
                                        {{ __('general.small') }}
                                    </option>
                                    <option value="medium" {{ old('size', $shelf->size) == 'medium' ? 'selected' : '' }}>
                                        {{ __('general.medium') }}
                                    </option>
                                    <option value="large" {{ old('size', $shelf->size) == 'large' ? 'selected' : '' }}>
                                        {{ __('general.large') }}
                                    </option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="mb-3 row">
                            <label for="price" class="col-md-3 col-form-label">{{ __('shelf.price') }}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-text">{{ config('settings.currency_symbol') }}</span>
                                    <input type="number" step="1" class="form-control" id="price"
                                           name="price" value="{{ old('price', $shelf->price) }}" placeholder="0.00">
                                    <span class="input-group-text bg-light">
                                        <small class="text-muted">{{ __('shelf.initial_price_per_day') }}</small>
                                    </span>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3 row">
                            <label for="description" class="col-md-3 col-form-label">{{ __('shelf.description') }}</label>
                            <div class="col-md-9">
                                <textarea name="description" id="tinymceExample" rows="5"
                                          class="form-control" placeholder="{{ __('shelf.enter_description') }}">{!! old('description', $shelf->description) !!}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Toggle -->
                        <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">{{ __('general.status') }}</label>
                            <div class="col-md-9">
                                <div class="form-check form-switch form-switch-lg">
                                    <input type="checkbox" class="form-check-input" id="status1"
                                           name="status" {{ old('status', $shelf->status) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status1">
                                        {{ $shelf->status ? __('general.active') : __('general.inactive') }}
                                    </label>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions border-top pt-4 mt-4">
                            <div class="text-end">
                                @ability('admin', 'update_shelves')
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>{{ __('shelf.update_shelf') }}
                                    </button>
                                @endability
                                 <a href="{{ route('admin.merchants.index') }}" class="btn btn-outline-danger ms-2">
                                    <i class="ri-arrow-go-back-line me-1"></i>
                                    {{ __('panel.cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- TinyMCE Editor -->
    <script src="{{ asset('admin/assets/libs/tinymce/tinymce.min.js') }}"></script>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#tinymceExample',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });

        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            dropdownParent: $('.card-body')
        });

        // Price input formatting
        $('#price').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
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
        .form-actions {
            border-top: 1px solid #e9ecef;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }
        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 5px 10px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .form-switch-lg .form-check-input {
            width: 3rem;
            height: 1.5rem;
        }
        .card-header h5 strong {
            color: #3b7ddd;
        }
    </style>
@endsection
