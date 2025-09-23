@extends('layouts.admin-auth')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="text-center mt-4">
                <div class="">
                    <a href="index.html" class="auth-logo">
                        {{-- <img src="{{ asset('admin/assets/images/logo-dark.png')}}" height="30" class="logo-dark mx-auto animate-bounce" alt=""> --}}
                        <img src="{{ asset('admin/assets/images/logo-dark.png')}}" style="height: 3em" class="logo-dark mx-auto animate-bounce" alt="">
                        <img src="{{ asset('admin/assets/images/logo-light.png')}}" style="height: 3em" class="logo-light mx-auto animate-bounce" alt="">
                    </a>
                </div>
            </div>

            <div class="p-3">
                <form class="form-horizontal mt-3" method="POST" action="{{ route('admin.unlock') }}">
                    @csrf

                    <div class="text-center mb-4">


                        <img src="{{ auth()->user()->user_image && file_exists(public_path('assets/users/' . auth()->user()->user_image))
                            ? asset('assets/users/' . auth()->user()->user_image)
                            : asset('images/not_found/small_avator__not_found.webp') }}"
                            alt="User Avatar"
                            class="avatar-md rounded-circle">

                        <h5 class="mt-3">{{ \Illuminate\Support\Str::limit(auth()->user()->full_name ?? 'Admin', 15) }}</h5>
                    </div>

                    @error('password')
                        <div class="alert alert-danger text-center">{{ $message }}</div>
                    @enderror

                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input class="form-control" type="password" name="password" required placeholder="{{ __('auth.enter_password') }}">
                        </div>
                    </div>

                    <div class="form-group text-center row mt-3">
                        <div class="col-12">
                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit">{{ __('auth.unlock') }}</button>
                        </div>
                    </div>

                    <div class="form-group mt-4 mb-0 row">
                        <div class="col-12 text-center">
                            <a href="{{ route('admin.login') }}" class="text-muted">{{ __('auth.not_yet') }}</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- end cardbody -->
    </div>
@endsection
