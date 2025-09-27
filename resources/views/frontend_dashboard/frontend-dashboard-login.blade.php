
@extends('layouts.admin-auth')
@section('content')

            {{-- <div class="text-center mt-4">
                <div class="mb-3">
                    <a href="index.html" class="auth-logo">
                        <img src="{{ asset('admin/assets/images/logo-dark.png')}}" style="height: 3em" class="logo-dark mx-auto animate-bounce" alt="">
                        <img src="{{ asset('admin/assets/images/logo-light.png')}}" style="height: 3em" class="logo-light mx-auto animate-bounce" alt="">
                    </a>
                </div>
            </div> --}}

            <h4 class="text-muted text-center font-size-18"><b>{{ __('auth.login') }}</b></h4>

            <div class="p-3">
                <form class="form-horizontal mt-3" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input class="form-control" type="text" required="" placeholder="{{ __('auth.username_or_email') }}" name="username" value="{{ old('username') }}">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input class="form-control" type="password" required="" placeholder="{{ __('auth.password') }}" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-label ms-1" for="customCheck1">{{ __('auth.remember_me') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 text-center row mt-3 pt-1">
                        <div class="col-12">
                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit">{{ __('auth.login') }}</button>
                        </div>
                    </div>

                    <div class="form-group mb-0 row mt-2">
                        <div class="col-sm-7 mt-3">
                            <a href="{{ route('admin.recover-password') }}" class="text-muted"><i class="mdi mdi-lock"></i> {{ __('auth.forgot_password') }}</a>
                        </div>
                        {{-- <div class="col-sm-5 mt-3">
                            <a href="auth-register.html" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>
                        </div> --}}
                    </div>
                </form>
            </div>
            <!-- end -->

@endsection

