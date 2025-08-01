@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('stock-item.add_stock_item') }}</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.stock_items.index') }}">{{ __('stock-item.manage_stock_items') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('stock-item.add_stock_item') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('stock-item.stock_item_info') }}</h4>

                    <form action="{{ route('admin.stock_items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Merchant --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="merchant_id">{{ __('merchant.name') }}</label>
                            <div class="col-sm-10">
                                <select name="merchant_id" class="form-control select2">
                                    <option value="">{{ __('merchant.select_merchant') }}</option>
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}" {{ old('merchant_id') == $merchant->id ? 'selected' : '' }}>
                                            {{ $merchant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('merchant_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Product --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_id">{{ __('product.name') }}</label>
                            <div class="col-sm-10">
                                <select name="product_id" class="form-control select2">
                                    <option value="">{{ __('product.select_product') }}</option>
                                </select>
                                @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>




                        {{-- Rental Shelf --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="rental_shelf_id">{{ __('rental.select_rental_shelf') }}</label>
                            <div class="col-sm-10">
                                <select name="rental_shelf_id" class="form-control select2">
                                    <option value="">{{ __('rental.select_rental_shelf') }}</option>
                                </select>

                                @error('rental_shelf_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Quantity --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="quantity">{{ __('stock-item.quantity') }}</label>
                            <div class="col-sm-10">
                                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity', 0) }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="status" id="customSwitch1" {{ old('status', 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="customSwitch1">{{ __('stock-item.choose_stock_item_status') }}</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        @ability('admin', 'create_stock_items')
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">{{ __('stock-item.save_stock_item') }}</button>
                            </div>
                        @endability

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            console.log("Script is running");
            // عند اختيار التاجر
            $('select[name="merchant_id"]').on('change', function () {
                let merchantId = $(this).val();

                if (merchantId) {
                    // جلب المنتجات الخاصة بالتاجر
                    $.ajax({
                        url: "{{ route('admin.stock_items.fetch_merchant_data') }}",
                        type: "GET",
                        data: { merchant_id: merchantId },
                        success: function (response) {
                            // المنتجات
                            $('select[name="product_id"]').html('<option value="">{{ __("product.select_product") }}</option>');
                            $.each(response.products, function (key, product) {
                                $('select[name="product_id"]').append('<option value="' + product.id + '">' + product.name + '</option>');
                            });

                            // الرفوف
                            $('select[name="rental_shelf_id"]').html('<option value="">{{ __("rental.select_rental_shelf") }}</option>');
                            $.each(response.rental_shelves, function (key, shelf) {
                                $('select[name="rental_shelf_id"]').append('<option value="' + shelf.id + '">' + shelf.code + ' - ' + shelf.warehouse + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="product_id"]').html('');
                    $('select[name="rental_shelf_id"]').html('');
                }
            });
        });
    </script>
@endsection

