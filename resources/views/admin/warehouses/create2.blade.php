@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('warehouse.manage_warehouses') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('warehouse.add_warehouse') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('warehouse.manage_warehouses') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('warehouse.warehouse_info') }}</h4>

                            <form action="{{ route('admin.warehouses.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name[{{ $key }}]">
                                            {{ __('warehouse.name') }}
                                            <span class="language-type">
                                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                                    title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ __('language.' . $key) }}
                                            </span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="name[{{ $key }}]" class="form-control" id="name[{{ $key }}]" type="text" value="{{ old('name.' . $key) }}">
                                            @error('name.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="location[{{ $key }}]">
                                            {{ __('warehouse.location') }}
                                            <span class="language-type">
                                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                                    title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ __('language.' . $key) }}
                                            </span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="location[{{ $key }}]" class="form-control" id="location[{{ $key }}]" type="text" value="{{ old('location.' . $key) }}">
                                            @error('location.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="code">{{ __('warehouse.code') }}</label>
                                    <div class="col-sm-10">
                                        <input name="code" class="form-control" id="code" type="text" value="{{ old('code') }}">
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                <h4 class="card-title">{{ __('warehouse.warehouse_management') }}</h4>

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="manager[{{ $key }}]">
                                            {{ __('warehouse.manager') }}
                                            <span class="language-type">
                                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                                    title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ __('language.' . $key) }}
                                            </span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="manager[{{ $key }}]" class="form-control" id="manager[{{ $key }}]" type="text" value="{{ old('manager.' . $key) }}">
                                            @error('manager.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="phone">{{ __('warehouse.phone') }}</label>
                                    <div class="col-sm-10">
                                        <input name="phone" class="form-control" id="phone" type="text" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="input-email">{{ __('warehouse.email') }}</label>
                                    <div class="col-sm-10">
                                        <input id="input-email" class="form-control input-mask" data-inputmask="'alias': 'email'" name="email" value="{{ old('email') }}">
                                        <span class="text-muted">_@_._</span>
                                        @error('email')
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
                                            <label class="form-check-label" for="customSwitch1">{{ __('warehouse.choose_warehouse_status') }}</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                </div>
            </div>

@endsection



