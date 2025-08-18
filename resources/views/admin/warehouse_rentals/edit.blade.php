@extends('layouts.admin')

@section('content')

<!-- Page Title -->
<div class="row mb-3">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('rental.edit_rental') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">{{ __('rental.add_rental') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('rental.manage_rentals') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Rental Form -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-clipboard-text-outline me-1"></i> {{ __('rental.rental_info') }}
                </h4>

                <form action="{{ route('admin.warehouse_rentals.update', $warehouseRental->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Merchant Selection -->
                    <div class="row mb-4">
                        <label for="merchant_id" class="col-sm-2 col-form-label">{{ __('merchant.name') }}</label>
                        <div class="col-sm-10">
                            <select name="merchant_id" id="merchant_id" class="form-select select2">
                                <option disabled>{{ __('rental.select_merchant') }}</option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" {{ $warehouseRental->merchant_id == $merchant->id ? 'selected' : '' }}>
                                        {{ $merchant->name['en'] ?? $merchant->name }} - {{ $merchant->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('merchant_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Rental Start Date -->
                    <div class="row mb-4">
                        <label for="rental_start" class="col-sm-2 col-form-label">{{ __('rental.rental_start') }}</label>
                        <div class="col-sm-10">
                            <input type="date" name="rental_start" id="rental_start" class="form-control"
                                   {{-- value="{{ old('rental_start', $warehouseRental->rental_start->format('Y-m-d')) }}"> --}}
                                   value="{{ old('rental_start', $warehouseRental->rental_start ? \Carbon\Carbon::parse($warehouseRental->rental_start)->toDateString() : '') }}">

                            @error('rental_start')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Rental End Date -->
                    <div class="row mb-4">
                        <label for="rental_end" class="col-sm-2 col-form-label">{{ __('rental.rental_end') }}</label>
                        <div class="col-sm-10">
                            <input type="date" name="rental_end" id="rental_end" class="form-control"
                                   {{-- value="{{ old('rental_end', $warehouseRental->rental_end->format('Y-m-d')) }}"> --}}
                                   value="{{ old('rental_end', $warehouseRental->rental_end ? \Carbon\Carbon::parse($warehouseRental->rental_end)->toDateString() : '') }}">

                            @error('rental_end')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Accordion -->
                    <h5 class="text-muted ">
                        {{ __('rental.select_shelves') }}
                    </h5>
                    <p class="text-muted mb-3">
                        {{ __('shelf.shelf_note') }}
                    </p>


                    @php
                        $rentalShelves = $warehouseRental->shelves->keyBy('id');
                    @endphp

                    <div id="accordion" class="custom-accordion">
                        @forelse($warehouses as $index => $warehouse)
                            <div class="card mb-2 shadow-none border">
                                <a href="#collapseWarehouse{{ $warehouse->id }}" class="text-dark" data-bs-toggle="collapse"
                                   aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                   aria-controls="collapseWarehouse{{ $warehouse->id }}">
                                    <div class="card-header" id="headingWarehouse{{ $warehouse->id }}">
                                        <h6 class="m-0">
                                            {{ $warehouse->name['en'] ?? $warehouse->name }} ({{ $warehouse->code }})
                                            <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                        </h6>
                                    </div>
                                </a>

                                <div id="collapseWarehouse{{ $warehouse->id }}"
                                     class="collapse {{ $index === 0 ? 'show' : '' }}"
                                     aria-labelledby="headingWarehouse{{ $warehouse->id }}">
                                    <div class="card-body">
                                        @forelse($warehouse->shelves as $shelf)
                                            @php
                                                $existing = $rentalShelves->get($shelf->id);
                                            @endphp
                                            <div class="row align-items-end mb-3">
                                                <div class="col-md-1 text-center">
                                                    <input type="checkbox"
                                                           class="form-check-input"
                                                           name="shelves[{{ $shelf->id }}][selected]"
                                                           value="1"
                                                           {{ $existing ? 'checked' : '' }}>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label fw-bold">{{ $shelf->code }}</label>
                                                    <div class="text-muted small">
                                                        {{ __('shelf.size') }}: {{ $shelf->size }} |
                                                        {{ __('shelf.price') }}: {{ $shelf->price }}
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">{{ __('rental.price') }}</label>
                                                    <input type="number"
                                                           step="0.01"
                                                           name="shelves[{{ $shelf->id }}][custom_price]"
                                                           class="form-control"
                                                           value="{{ old("shelves.{$shelf->id}.custom_price", $existing?->pivot->custom_price) }}"
                                                           placeholder="0.00">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('rental.rental_start') }}</label>
                                                    <input type="date"
                                                           name="shelves[{{ $shelf->id }}][custom_start]"
                                                           class="form-control"
                                                           value="{{ old("shelves.{$shelf->id}.custom_start", $existing?->pivot->custom_start ? \Carbon\Carbon::parse($existing->pivot->custom_start)->toDateString() : '') }}">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">{{ __('rental.rental_end') }}</label>
                                                    <input type="date"
                                                           name="shelves[{{ $shelf->id }}][custom_end]"
                                                           class="form-control"
                                                           value="{{ old("shelves.{$shelf->id}.custom_end", $existing?->pivot->custom_end ? \Carbon\Carbon::parse($existing->pivot->custom_end)->toDateString() : '') }}">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-muted">{{ __('shelf.no_shelves_available') }}</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">{{ __('warehouse.no_warehouses_found') }}</div>
                        @endforelse
                    </div>

                    <!-- Submit -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save-outline me-1"></i> {{ __('rental.update_rental_data') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
