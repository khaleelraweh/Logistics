@extends('layouts.admin')

@section('content')


    <!-- Page Header -->
    <div class="row ">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ __('product.add_product') }}</h4>

                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">{{ __('general.main') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('product.products') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('product.add_product') }}</li>
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

                    <h4 class="card-title">{{ __('product.product_info') }}</h4>

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">{{ __('product.name') }}</label>
                            <div class="col-sm-10">
                                <input name="name" class="form-control" id="name" type="text" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="merchant_id">{{ __('merchant.name') }}</label>
                            <div class="col-sm-10">
                                <select name="merchant_id" class="form-control select2">
                                    <option>{{ __('product.select_merchant') }}</option>
                                    @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}" {{ old('merchant_id') ? 'selected' : null }}>{{ $merchant->name }} - {{ $merchant->email }}</option>
                                    @endforeach
                                </select>

                                @error('merchant_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="description">{{ __('product.description') }}</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="tinymceExample" rows="10" class="form-control">{!! old('description') !!}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="sku">{{ __('product.sku_code') }}</label>
                            <div class="col-sm-10">
                                <input name="sku" class="form-control" id="sku" type="text" value="{{ old('sku') }}">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="price">{{ __('product.price_per_item') }}</label>
                            <div class="col-sm-10">
                                <input name="price" class="form-control" id="price" type="number" value="{{ old('price') }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <hr>
                        <h4 class="card-title">{{ __('product.images') }}</h4>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product_images">{{ __('product.images') }}</label>
                            <div class="col-sm-10">
                                <input type="file" name="images[]" id="product_images" class="file-input-overview" multiple>
                                @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch" >
                                    <input type="checkbox" class="form-check-input" name="status"  id="customSwitch1"  {{ old('status', '1') == '1' ? 'checked' : '' }} >
                                    <label class="form-check-label" for="customSwitch1">{{ __('product.choose_product_status') }}</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <!-- submit button -->

                            <div class="text-end pt-3">
                                @ability('admin', 'create_products')
                                    <button type="submit" class="btn btn-primary px-3 d-inline-flex align-items-center">
                                        <i class="ri-save-3-line me-2"></i>
                                        <i class="bi bi-save me-2"></i>
                                        {{ __('product.save_product_data') }}
                                    </button>
                                @endability

                                <a href="{{ route('admin.merchants.index') }}" class="btn btn-outline-danger ms-2">
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


@section('script')
    {{-- Call select2 plugin --}}

    <script>
        $(function() {
            $("#product_images").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });
        });
    </script>
@endsection
