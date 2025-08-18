@extends('layouts.admin')

@section('content')

<!-- Page Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">{{ __('rental.add_rental') }}</h4>

            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.warehouse_rentals.index') }}">{{ __('rental.manage_rentals') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('rental.add_rental') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Rental Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">
                    <i class="mdi mdi-clipboard-text-outline align-middle me-2"></i>
                    {{ __('rental.rental_info') }}
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.warehouse_rentals.store') }}" method="POST" id="rentalForm">
                    @csrf

                    <!-- Merchant Selection -->
                    <div class="row mb-4">
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label for="merchant_id" class="form-label">{{ __('merchant.name') }} <span class="text-danger">*</span></label>
                                <select name="merchant_id" id="merchant_id" class="form-select select2" required>
                                    <option value="" disabled selected>{{ __('rental.select_merchant') }}</option>
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}" {{ old('merchant_id') == $merchant->id ? 'selected' : '' }}>
                                            {{ $merchant->name['en'] ?? $merchant->name }} - {{ $merchant->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('merchant_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Rental Period -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rental_start" class="form-label">{{ __('rental.rental_start') }} <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            <input type="date" name="rental_start" id="rental_start" class="form-control flatpickr-input"
                                                   value="{{ old('rental_start', now()->format('Y-m-d')) }}" required>
                                        </div>
                                        @error('rental_start')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rental_end" class="form-label">{{ __('rental.rental_end') }} <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            <input type="date" name="rental_end" id="rental_end" class="form-control flatpickr-input"
                                                   value="{{ old('rental_end', now()->addMonth()->format('Y-m-d')) }}" required>
                                        </div>
                                        @error('rental_end')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shelves Selection -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="mdi mdi-warehouse me-2"></i>
                                        {{ __('rental.select_shelves') }}
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted mb-4">
                                        <i class="mdi mdi-information-outline me-2"></i>
                                        {{ __('shelf.shelf_note1') }}<br>
                                        <i class="mdi mdi-information-outline me-2"></i>
                                        {{ __('shelf.shelf_note2') }}
                                    </p>

                                    @if($errors->has('shelves'))
                                        <div class="alert alert-danger mt-2">
                                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                                            {{ $errors->first('shelves') }}
                                        </div>
                                    @endif

                                    <div id="accordion" class="custom-accordion">
                                        @forelse($warehouses as $index => $warehouse)
                                            <div class="card mb-2 shadow-none border">
                                                <div class="card-header p-0" id="headingWarehouse{{ $warehouse->id }}">
                                                    <button type="button" class="btn btn-link w-100 text-start p-3 accordion-toggle"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapseWarehouse{{ $warehouse->id }}"
                                                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                                            aria-controls="collapseWarehouse{{ $warehouse->id }}">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="mb-0">
                                                                <i class="mdi mdi-warehouse me-2 text-primary"></i>
                                                                {{ $warehouse->name['en'] ?? $warehouse->name }}
                                                                <span class="badge bg-primary ms-2">{{ $warehouse->code }}</span>
                                                            </h6>
                                                            <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                        </div>
                                                    </button>
                                                </div>

                                                <div id="collapseWarehouse{{ $warehouse->id }}"
                                                     class="collapse {{ $index === 0 ? 'show' : '' }}"
                                                     aria-labelledby="headingWarehouse{{ $warehouse->id }}">
                                                    <div class="card-body">
                                                        @if($warehouse->shelves->count() > 0)
                                                            <div class="table-responsive">
                                                                <table class="table table-hover table-centered mb-0">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th width="5%">{{ __('general.select') }}</th>
                                                                            <th>{{ __('shelf.code') }}</th>
                                                                            <th>{{ __('shelf.size') }}</th>
                                                                            <th>{{ __('shelf.price') }}</th>
                                                                            <th>{{ __('rental.custom_price') }}</th>
                                                                            <th>{{ __('rental.custom_dates') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($warehouse->shelves as $shelf)
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="checkbox" class="form-check-input shelf-checkbox"
                                                                                           name="shelves[{{ $shelf->id }}][selected]" value="1">
                                                                                </td>
                                                                                <td>
                                                                                    <label class="form-check-label fw-bold">{{ $shelf->code }}</label>
                                                                                </td>
                                                                                <td>{{ __('general.'. $shelf->size) }}</td>
                                                                                <td>{{ number_format($shelf->price, 2) }}</td>
                                                                                <td width="20%">
                                                                                    <input type="number" step="0.01"
                                                                                           name="shelves[{{ $shelf->id }}][custom_price]"
                                                                                           class="form-control form-control-sm"
                                                                                           placeholder="{{ number_format($shelf->price, 2) }}">
                                                                                </td>
                                                                                <td width="30%">
                                                                                    <div class="input-group input-group-sm">
                                                                                        <input type="date" name="shelves[{{ $shelf->id }}][custom_start]"
                                                                                               class="form-control form-control-sm" placeholder="{{ __('rental.start_date') }}">
                                                                                        <span class="input-group-text">to</span>
                                                                                        <input type="date" name="shelves[{{ $shelf->id }}][custom_end]"
                                                                                               class="form-control form-control-sm" placeholder="{{ __('rental.end_date') }}">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <div class="alert alert-info mb-0">
                                                                <i class="mdi mdi-alert-circle-outline me-2"></i>
                                                                {{ __('shelf.no_shelves_available') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="alert alert-warning mb-0">
                                                <i class="mdi mdi-alert-outline me-2"></i>
                                                {{ __('warehouse.no_warehouses_found') }}
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="text-end mt-4">
                        <a href="{{ route('admin.warehouse_rentals.index') }}" class="btn btn-light me-2">
                            <i class="mdi mdi-arrow-left me-1"></i> {{ __('general.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save-outline me-1"></i> {{ __('rental.save_rental_data') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .custom-accordion .card-header button {
        text-decoration: none;
        box-shadow: none;
        cursor: pointer;
    }
    .custom-accordion .card-header .accordion-arrow {
        transition: transform 0.3s ease;
    }
    .custom-accordion .card-header button[aria-expanded="true"] .accordion-arrow {
        transform: rotate(180deg);
    }
    .shelf-checkbox:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    .flatpickr-input[readonly] {
        background-color: #fff;
    }
    .accordion-toggle {
        outline: none !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize select2
        $('.select2').select2({
            placeholder: "{{ __('rental.select_merchant') }}",
            width: '100%'
        });

        // Initialize datepickers
        $('#rental_start, #rental_end').flatpickr({
            dateFormat: "Y-m-d",
            minDate: "today"
        });

        // Validate end date is after start date
        $('#rentalForm').validate({
            rules: {
                rental_end: {
                    greaterThan: "#rental_start"
                }
            },
            messages: {
                rental_end: {
                    greaterThan: "{{ __('validation.after', ['attribute' => __('rental.rental_end'), 'date' => __('rental.rental_start')]) }}"
                }
            }
        });

        $.validator.addMethod("greaterThan", function(value, element, param) {
            var startDate = $(param).val();
            if (!startDate || !value) return true;
            return new Date(value) >= new Date(startDate);
        });


        // التحقق من اختيار رف واحد على الأقل قبل الإرسال
        $('#rentalForm').submit(function(e) {
            var atLeastOneChecked = false;
            $('.shelf-checkbox').each(function() {
                if ($(this).is(':checked')) {
                    atLeastOneChecked = true;
                    return false; // الخروج من الحلقة عند العثور على رف مختار
                }
            });

            if (!atLeastOneChecked) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("خطأ") }}',
                    text: '{{ __("يجب اختيار رف واحد على الأقل") }}',
                });
                return false;
            }
        });

    });
</script>
@endpush
