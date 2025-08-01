@extends('layouts.admin-auth')

@section('content')

            {{-- <div class="text-center mt-4">
                <div class="mb-3">
                    <a href="index.html" class="auth-logo">
                        <img src="assets/images/logo-dark.png" style="height: 3em;" class="logo-dark mx-auto animate-bounce" alt="">
                        <img src="assets/images/logo-light.png" style="height: 3em;" class="logo-light mx-auto animate-bounce" alt="">
                    </a>
                </div>
            </div> --}}

            <h4 class="text-muted text-center font-size-18"><b>Reset Password</b></h4>

            <div class="p-3">
                <form class="form-horizontal mt-3" action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Enter Your <strong>E-mail</strong> and instructions will be sent to you!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}"  required="" placeholder="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group pb-2 text-center row mt-3">
                        <div class="col-12">
                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit" name="submit">Send Email</button>
                        </div>
                    </div>
                </form>
            </div>
@endsection

