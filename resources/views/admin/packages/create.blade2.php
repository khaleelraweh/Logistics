@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('package.manage_packages') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('package.add_new_package') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('package.manage_packages') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.warehouses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Sender Information -->
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('package.sender_Information') }}</h4>
                                </div>

                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-12">

                                            <label for="merchant_id" class="col-form-label">{{ __('merchant.sender_merchant') }} ({{ __('general.optional') }})</label>
                                            <select name="merchant_id" id="merchant_id" class="form-select">
                                                <option value="">{{ __('merchant.without_merchant') }}</option>
                                                @foreach($merchants as $merchant)
                                                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('merchant_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="sender_first_name">{{ __('package.sender_first_name') }}</label>
                                            <input name="sender_first_name" class="form-control" id="sender_first_name" type="text" value="{{ old('sender_first_name') }}">
                                            @error('sender_first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="sender_middle_name">{{ __('package.sender_middle_name') }}</label>
                                            <input name="sender_middle_name" class="form-control" id="sender_middle_name" type="text" value="{{ old('sender_middle_name') }}">
                                            @error('sender_middle_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="sender_last_name">{{ __('package.sender_last_name') }}</label>
                                            <input name="sender_last_name" class="form-control" id="sender_last_name" type="text" value="{{ old('sender_last_name') }}">
                                            @error('sender_last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="sender_email">{{ __('package.sender_email') }}</label>
                                            <input name="sender_email" class="form-control" id="sender_email" type="text" value="{{ old('sender_email') }}">
                                            @error('sender_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="sender_phone">{{ __('package.sender_phone') }}</label>
                                            <input name="sender_phone" class="form-control" id="sender_phone" type="text" value="{{ old('sender_phone') }}">
                                            @error('sender_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('package.trip_information') }}</h4>
                                </div>

                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-12">

                                            <label for="sender_address" class="col-form-label">{{ __('package.sender_address') }}</label>
                                            <input name="sender_address" class="form-control" id="sender_address" type="text" value="{{ old('sender_address') }}">
                                            @error('sender_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_country">{{ __('package.sender_country') }}</label>
                                            <input name="sender_country" class="form-control" id="sender_country" type="text" value="{{ old('sender_country') }}">
                                            @error('sender_country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="sender_regin">{{ __('package.sender_regin') }}</label>
                                            <input name="sender_regin" class="form-control" id="sender_regin" type="text" value="{{ old('sender_regin') }}">
                                            @error('sender_regin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="sender_city">{{ __('package.sender_city') }}</label>
                                            <input name="sender_city" class="form-control" id="sender_city" type="text" value="{{ old('sender_city') }}">
                                            @error('sender_city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="sender_district">{{ __('package.sender_district') }}</label>
                                            <input name="sender_district" class="form-control" id="sender_district" type="text" value="{{ old('sender_district') }}">
                                            @error('sender_district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="sender_postal_code">{{ __('package.sender_postal_code') }}</label>
                                            <input name="sender_postal_code" class="form-control" id="sender_postal_code" type="text" value="{{ old('sender_postal_code') }}">
                                            @error('sender_postal_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="sender_location">{{ __('package.sender_location') }}</label>
                                            <input name="sender_location" class="form-control" id="sender_location" type="text" value="{{ old('sender_location') }}">
                                            @error('sender_location')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="sender_others">{{ __('package.sender_others') }}</label>
                                            <input name="sender_others" class="form-control" id="sender_others" type="text" value="{{ old('sender_others') }}">
                                            @error('sender_others')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('package.receiver_Information') }}</h4>
                                </div>

                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-12">

                                            <label for="merchant_id" class="col-form-label">{{ __('merchant.receiver_merchant') }} (اختياري)</label>
                                            <select name="merchant_id" id="merchant_id" class="form-select">
                                                <option value=""> {{ __('merchant.without_merchant') }}</option>
                                                @foreach($merchants as $merchant)
                                                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('merchant_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_first_name">{{ __('package.receiver_first_name') }}</label>
                                            <input name="receiver_first_name" class="form-control" id="receiver_first_name" type="text" value="{{ old('receiver_first_name') }}">
                                            @error('receiver_first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_middle_name">{{ __('package.receiver_middle_name') }}</label>
                                            <input name="receiver_middle_name" class="form-control" id="receiver_middle_name" type="text" value="{{ old('receiver_middle_name') }}">
                                            @error('receiver_middle_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_last_name">{{ __('package.receiver_last_name') }}</label>
                                            <input name="receiver_last_name" class="form-control" id="receiver_last_name" type="text" value="{{ old('receiver_last_name') }}">
                                            @error('receiver_last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="receiver_email">{{ __('package.receiver_email') }}</label>
                                            <input name="receiver_email" class="form-control" id="receiver_email" type="text" value="{{ old('receiver_email') }}">
                                            @error('receiver_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="receiver_phone">{{ __('package.receiver_phone') }}</label>
                                            <input name="receiver_phone" class="form-control" id="receiver_phone" type="text" value="{{ old('receiver_phone') }}">
                                            @error('receiver_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ __('package.trip_information') }}</h4>
                                </div>

                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-sm-12">

                                            <label for="receiver_address" class="col-form-label">{{ __('package.receiver_address') }}</label>
                                            <input name="receiver_address" class="form-control" id="receiver_address" type="text" value="{{ old('receiver_address') }}">
                                            @error('receiver_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_country">{{ __('package.receiver_country') }}</label>
                                            <input name="receiver_country" class="form-control" id="receiver_country" type="text" value="{{ old('receiver_country') }}">
                                            @error('receiver_country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_regin">{{ __('package.receiver_regin') }}</label>
                                            <input name="receiver_regin" class="form-control" id="receiver_regin" type="text" value="{{ old('receiver_regin') }}">
                                            @error('receiver_regin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="receiver_city">{{ __('package.receiver_city') }}</label>
                                            <input name="receiver_city" class="form-control" id="receiver_city" type="text" value="{{ old('receiver_city') }}">
                                            @error('receiver_city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="receiver_district">{{ __('package.receiver_district') }}</label>
                                            <input name="receiver_district" class="form-control" id="receiver_district" type="text" value="{{ old('receiver_district') }}">
                                            @error('receiver_district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="receiver_postal_code">{{ __('package.receiver_postal_code') }}</label>
                                            <input name="receiver_postal_code" class="form-control" id="receiver_postal_code" type="text" value="{{ old('receiver_postal_code') }}">
                                            @error('receiver_postal_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="receiver_location">{{ __('package.receiver_location') }}</label>
                                            <input name="receiver_location" class="form-control" id="receiver_location" type="text" value="{{ old('receiver_location') }}">
                                            @error('receiver_location')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="col-form-label" for="receiver_others">{{ __('package.receiver_others') }}</label>
                                            <input name="receiver_others" class="form-control" id="receiver_others" type="text" value="{{ old('receiver_others') }}">
                                            @error('receiver_others')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('package.package_information') }}</h4>
                                </div>
                                <div class="card-body">
                                    @livewire('admin.package.add-product-component')

                                </div>
                            </div>
                        </div>
                    </div>

                    @ability('admin', 'create_warehouses')
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('warehouse.save_warehouse_data') }}</button>
                        </div>
                    @endability
                </form>


            </div>
        </div>

@endsection


@section('script')
    {{-- Call select2 plugin --}}

    <script>
        $(function() {
            $("#warehouse_logo").fileinput({
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
