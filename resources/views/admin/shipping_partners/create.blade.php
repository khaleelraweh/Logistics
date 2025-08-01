@extends('layouts.admin')

@section('content')

    <!-- start page title -->
    <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('shipping_partner.manage_shipping_partners') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('shipping_partner.add_shipping_partner') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('shipping_partner.manage_shipping_partners') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('shipping_partner.shipping_partner_info') }}</h4>

                            <form action="{{ route('admin.shipping_partners.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="name[{{ $key }}]">
                                            {{ __('shipping_partner.name') }}
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
                                        <label class="col-sm-2 col-form-label" for="description[{{ $key }}]">
                                            {{ __('shipping_partner.description') }}
                                            <span class="language-type">
                                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                                    title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                                {{ __('language.' . $key) }}
                                            </span>
                                        </label>
                                        <div class="col-sm-10">
                                            <input name="description[{{ $key }}]" class="form-control" id="description[{{ $key }}]" type="text" value="{{ old('description.' . $key) }}">
                                            @error('description.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="address[{{ $key }}]">
                                            {{ __('shipping_partner.address') }}
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
                                <h4 class="card-title">{{ __('shipping_partner.contact_data') }}</h4>

                                @foreach (config('locales.languages') as $key => $val)
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="contact_person[{{ $key }}]">
                                            {{ __('shipping_partner.contact_person') }}
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
                                    <label class="col-sm-2 col-form-label" for="contact_phone">{{ __('general.phone') }}</label>
                                    <div class="col-sm-10">
                                        <input name="contact_phone" class="form-control" id="contact_phone" type="text" value="{{ old('contact_phone') }}">
                                        @error('contact_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="input-email">{{ __('general.email') }}</label>
                                    <div class="col-sm-10">
                                        <input id="input-email" class="form-control input-mask" data-inputmask="'alias': 'email'" name="contact_email" value="{{ old('contact_email') }}">
                                        <span class="text-muted">_@_._</span>
                                        @error('contact_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <hr>
                                <h4 class="card-title">{{ __('shipping_partner.connection_data') }}</h4>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="api_url">{{ __('shipping_partner.api_url') }}</label>
                                    <div class="col-sm-10">
                                        <input name="api_url" class="form-control" id="api_url" type="text" value="{{ old('api_url') }}">
                                        @error('api_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="api_token">{{ __('shipping_partner.api_token') }}</label>
                                    <div class="col-sm-10">
                                        <input name="api_token" class="form-control" id="api_token" type="text" value="{{ old('api_token') }}">
                                        @error('api_token')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="auth_type">{{ __('shipping_partner.auth_type') }}</label>
                                    <div class="col-sm-10">
                                        <input name="auth_type" class="form-control" id="auth_type" type="text" value="{{ old('auth_type') }}">
                                        @error('auth_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="credentails">{{ __('shipping_partner.credentails') }}</label>
                                    <div class="col-sm-10">
                                        <input name="credentails" class="form-control" id="credentails" type="text" value="{{ old('credentails') }}">
                                        @error('credentails')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <hr>
                                <h4 class="card-title">{{ __('shipping_partner.logo') }}</h4>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="shipping_partner_logo">{{ __('shipping_partner.logo') }}</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="logo" id="shipping_partner_logo" class="file-input-overview ">
                                        @error('logo')
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
                                            <label class="form-check-label" for="customSwitch1">{{ __('shipping_partner.choose_shipping_partner_status') }}</label>
                                        </div>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                @ability('admin', 'create_shipping_partners')
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">{{ __('shipping_partner.save_shipping_partner_data') }}</button>
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
            $("#shipping_partner_logo").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });
        });
    </script>
@endsection
