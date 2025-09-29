@extends('layouts.merchant')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ __('profile.preferences') }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('profile.profile') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('profile.preferences') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('merchant.profile.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ __('profile.user_info') }}</h4>

                    @foreach (config('locales.languages') as $key => $val)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="first_name[{{ $key }}]">
                                {{ __('general.first_name') }}
                                <span class="language-type">
                                    <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                        title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                    {{ __('language.' . $key) }}
                                </span>
                            </label>
                            <div class="col-sm-10">
                                <input name="first_name[{{ $key }}]" class="form-control" id="first_name[{{ $key }}]" type="text" value="{{ old('first_name.' . $key, auth()->user()->getTranslation('first_name',$key)) }}">
                                @error('first_name.' . $key)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach (config('locales.languages') as $key => $val)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="last_name[{{ $key }}]">
                                {{ __('general.last_name') }}
                                <span class="language-type">
                                    <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} mt-1 "
                                        title="{{ app()->getLocale() == 'ar' ? 'sa' : 'us' }}"></i>
                                    {{ __('language.' . $key) }}
                                </span>
                            </label>
                            <div class="col-sm-10">
                                <input name="last_name[{{ $key }}]" class="form-control" id="last_name[{{ $key }}]" type="text" value="{{ old('last_name', auth()->user()->getTranslation('last_name',$key)) }}">
                                @error('last_name.' . $key)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    <hr>
                    <h4 class="card-title">{{ __('profile.user_access_modifier') }}</h4>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="username">{{ __('general.username') }}</label>
                        <div class="col-sm-10">
                            <input name="username" class="form-control" id="username" type="text" value="{{ old('username', auth()->user()->username) }}">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="email">{{ __('general.email') }}</label>
                        <div class="col-sm-10">
                            <input name="email" class="form-control" id="email" type="email" value="{{ old('email', auth()->user()->email) }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="mobile">{{ __('general.mobile') }}</label>
                        <div class="col-sm-10">
                            <input name="mobile" class="form-control" id="mobile" type="text" value="{{ old('mobile', auth()->user()->mobile) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="password">{{ __('general.new_password') }}</label>
                        <div class="col-sm-10">
                            <input name="password" class="form-control" id="password" type="password" placeholder="****">
                        </div>
                    </div>

                    <hr>
                    <h4 class="card-title">{{ __('profile.user_image') }}</h4>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">{{ __('general.image') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="user_image" id="merchant_profile_image" class="file-input-overview ">
                            @error('user_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <h4 class="card-title">{{ __('profile.social_links') }}</h4>

                    @foreach (['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'website'] as $social)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="{{ $social }}">{{ ucfirst(__('social.'.$social)) }}</label>
                            <div class="col-sm-10">
                                <input name="{{ $social }}" class="form-control" id="{{ $social }}" type="url" value="{{ old($social, auth()->user()->$social) }}">
                                @error('{{ $socail }}')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @ability('merchant', 'update_account_settings')
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">{{ __('profile.save_preferences') }}</button>
                        </div>
                    @endability

                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')
    {{-- #user_image is the id in file input file above  --}}
    <script>
        $(function() {
            $("#merchant_profile_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if (auth()->user()->user_image != '')
                        "{{ asset('assets/users/' . auth()->user()->user_image) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if (auth()->user()->user_image != '')
                        {
                            caption: "{{ auth()->user()->user_image }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('merchant.profile.remove_image', ['merchant_id' => auth()->user()->id, '_token' => csrf_token()]) }}",
                            key: {{ auth()->user()->id }}
                        }
                    @endif
                ]
            });

        });
    </script>
@endsection
