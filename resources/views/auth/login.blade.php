@extends('layouts.app')

@section('content')
    <!-- Start contact section  -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="main-heading wow fadeIn" data-wow-duration="1s">
                <h2>{{ __('auth.login') }}</h2>
                <p>{{ __('auth.login_message') }}</p>
            </div>
            <div class="content wow bounceIn" data-wow-duration="1s">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <input class="main-input"  type="text" name="username" value="{{ old('username') }}" placeholder="{{ __('auth.username_or_email') }}" />
                    @error('username')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror

                    <input  class="main-input"  type="password"  name="password" value="{{ old('password') }}"  placeholder="{{ __('auth.email') }}"/>

                    <div class="remember-section">
                        <div class="remember-me wow fadeInLeft" data-wow-duration="1.5s">
                            <input type="checkbox"  id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-label ms-1" for="customCheck1">{{ __('auth.remember_me') }}</label>
                        </div>
                        <div class="forgot-password wow fadeInRight" data-wow-duration="1.5s">
                            @if (Route::has('password.request'))
                                <p class="condition">
                                    <a href="{{ route('password.request') }}"> <i class="fa fa-lock"></i> {{ __('auth.forgot_password') }}</a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <input type="submit" value="{{ __('auth.login') }}" />
                </form>
                <div class="info">
                    <div class="info-content">
                        <img class="" src="{{asset('frontend/images/logo.png')}}" alt="OraxSoft" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End contact section  -->
@endsection
