@extends('layouts.admin')

@section('content')


     <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('stock-item.edit_stock_item') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.stock_items.index') }}">{{ __('stock-item.manage_stock_items') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('stock-item.edit_stock_item') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('stock-item.stock_item_info') }}</h4>

                    <form action="{{ route('admin.stock_items.update', $stockItem->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Merchant --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="merchant_id">{{ __('merchant.name') }}</label>
                            <div class="col-sm-10">
                                <select name="merchant_id" id="merchant_id" class="form-control select2" disabled>
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}" {{ $stockItem->merchant_id == $merchant->id ? 'selected' : '' }}>
                                            {{ $merchant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="merchant_id" value="{{ $stockItem->merchant_id }}">
                                @error('merchant_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Product --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_id">{{ __('product.name') }}</label>
                            <div class="col-sm-10">
                                <select name="product_id" id="product_id" class="form-control select2">
                                    <option value="">{{ __('product.select_product') }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ $stockItem->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Rental Shelf --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="rental_shelf_id">{{ __('rental.select_rental_shelf') }}</label>
                            <div class="col-sm-10">
                                <select name="rental_shelf_id" id="rental_shelf_id" class="form-control select2">
                                    <option value="">{{ __('rental.select_rental_shelf') }}</option>
                                    @foreach ($rentalShelves as $shelf)
                                        <option value="{{ $shelf->id }}" {{ $stockItem->rental_shelf_id == $shelf->id ? 'selected' : '' }}>
                                            {{ $shelf->shelf->code ?? '' }} - {{ $shelf->shelf->warehouse->name ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rental_shelf_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Quantity --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="quantity">{{ __('stock-item.quantity') }}</label>
                            <div class="col-sm-10">
                                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $stockItem->quantity) }}">
                                @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" id="customSwitch1" {{ $stockItem->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="customSwitch1">{{ __('stock-item.choose_stock_item_status') }}</label>
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="text-end pt-3">
                            @ability('admin', 'update_stock_items')
                                <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                    <i class="ri-save-3-line me-2"></i>
                                    <i class="bi bi-save me-2"></i>
                                    {{ __('stock-item.update_stock_item') }}
                                </button>
                            @endability

                            <a href="{{ route('admin.stock_items.index') }}" class="btn btn-outline-danger ms-2">
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
