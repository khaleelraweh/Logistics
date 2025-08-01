@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('merchant.manage_merchants') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('merchant.add_merchant') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('merchant.manage_merchants') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('merchant.merchant_info') }}</h4>

                            <form action="{{ route('admin.merchants.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name[{{ $key }}]">
                                            {{ __('merchant.name') }}
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
                                        <label class="col-sm-2 col-form-label" for="address[{{ $key }}]">
                                            {{ __('general.address') }}
                                            <span class="language-type">
                                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                                    title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ __('language.' . $key) }}
                                            </span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="address[{{ $key }}]" class="form-control" id="address[{{ $key }}]" type="text" value="{{ old('address.' . $key) }}">
                                            @error('address.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                <hr>
                                <h4 class="card-title">{{ __('merchant.contact_data') }}</h4>

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="contact_person[{{ $key }}]">
                                            {{ __('merchant.contact_person') }}
                                            <span class="language-type">
                                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                                    title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ __('language.' . $key) }}
                                            </span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="contact_person[{{ $key }}]" class="form-control" id="contact_person[{{ $key }}]" type="text" value="{{ old('contact_person.' . $key) }}">
                                            @error('contact_person.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="phone">{{ __('general.phone') }}</label>
                                    <div class="col-sm-10">
                                        <input name="phone" class="form-control" id="phone" type="text" value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="input-email">{{ __('general.email') }}</label>
                                    <div class="col-sm-10">
                                        <input id="input-email" class="form-control input-mask" data-inputmask="'alias': 'email'" name="email" value="{{ old('email') }}">
                                        <span class="text-muted">_@_._</span>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="api_key">{{ __('merchant.api_key') }}</label>
                                    <div class="col-sm-10">
                                        <input name="api_key" class="form-control" id="api_key" type="text" value="{{ old('api_key') }}">
                                        @error('api_key')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <hr>
                                <h4 class="card-title">{{ __('merchant.logo') }}</h4>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="merchant_logo">{{ __('merchant.logo') }}</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="logo" id="merchant_logo" class="file-input-overview ">
                                        @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                <h4 class="card-title">{{ __('general.social_links') }}</h4>

                                @foreach (['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'] as $social)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="{{ $social }}">{{ ucfirst(__('social.'.$social)) }}</label>
                                        <div class="col-sm-10">
                                            <input name="{{ $social }}" class="form-control" id="{{ $social }}" type="url" value="{{ old($social) }}">
                                            @error('{{ $socail }}')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                <hr>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="status">{{ __('general.status') }}</label>
                                    <div class="col-sm-10">
                                        <div class="form-check form-switch" >
                                            <input type="checkbox" class="form-check-input" name="status"  id="customSwitch1"  {{ old('status', '1') == '1' ? 'checked' : '' }} >
                                            <label class="form-check-label" for="customSwitch1">{{ __('merchant.choose_merchant_status') }}</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                @ability('admin', 'create_merchants')
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">{{ __('merchant.save_merchant_data') }}</button>
                                    </div>
                                @endability

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
            $("#merchant_logo").fileinput({
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
