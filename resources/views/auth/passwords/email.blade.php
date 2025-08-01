@extends('layouts.app')

@section('content')
    <!-- Start contact section  -->
    <div class="contact" id="contact">
        <div class="container">
            <div class="main-heading wow fadeIn" data-wow-duration="1s">
                <h2>{{ __('auth.reset_password') }}</h2>
                <p>{{ __('auth.enter_email_to_reset') }}</p>
            </div>
            <div class="content wow bounceIn" data-wow-duration="1s">

                 @if (session('status'))
                    <div class="alert alert-success wow fadeIn" data-wow-duration="1s" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div class="alert alert-info alert-dismissible fade show " role="alert">
                        {!! __('auth.reset_instructions') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <input class="main-input"  type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.placeholder_email') }}"  required autocomplete="email" autofocus/>
                    @error('email')
                        <span class="text-danger"> {{ $message }}</span>
                    @enderror


                    <input type="submit" value="{{ __('auth.send_reset_link') }}" />
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
