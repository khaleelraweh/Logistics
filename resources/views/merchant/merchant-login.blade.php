@extends('layouts.merchant-auth')
@section('content')

    <div class="text-center mb-4">
        <div class="mb-4">
            <a href="{{ route('merchant.index') }}" class="auth-logo">
                <img src="{{ asset('admin/assets/images/logo-dark.png')}}" style="height: 4em" class="logo-dark mx-auto" alt="Logo">
                <img src="{{ asset('admin/assets/images/logo-light.png')}}" style="height: 4em" class="logo-light mx-auto" alt="Logo">
            </a>
        </div>

        <div class="welcome-section">
            <h3 class="text-dark mb-2">{{ __('auth.welcome_back') }}</h3>
            <p class="text-muted">{{ __('auth.Log_in_to_manage_your_store_and_track_your_sales') }}</p>
        </div>
    </div>

    <div class="p-2">
        <form class="form-horizontal mt-2" action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Username/Email Field -->
            <div class="form-group mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                    </span>
                    <input class="form-control border-start-0 ps-1" type="text" required
                        placeholder="{{ __('auth.username_or_email') }}" name="username"
                        value="{{ old('username') }}" autofocus>
                </div>
                @error('username')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                    </span>
                    <input class="form-control border-start-0 ps-1" type="password" required
                        placeholder="{{ __('auth.password') }}" name="password" id="password">
                    <span class="input-group-text bg-light border-start-0 toggle-password"
                        style="cursor: pointer;" data-target="password">
                        <i class="mdi mdi-eye-outline"></i>
                    </span>
                </div>
                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="form-group mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="customCheck1"
                        name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small" for="customCheck1">
                        {{ __('auth.remember_me') }}
                    </label>
                </div>
                <div>
                    <a href="{{ route('admin.recover-password') }}" class="text-decoration-none small text-primary">
                        {{ __('auth.forgot_password') }}
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group mb-3">
                <button class="btn btn-primary w-100 waves-effect waves-light py-2" type="submit">
                    <i class="mdi mdi-login me-1"></i>
                    {{ __('auth.login') }}
                </button>
            </div>

            <!-- Divider -->
            <div class="position-relative my-4">
                <div class="border-bottom"></div>
                <div class="position-absolute top-50 start-50 translate-middle bg-white px-2">
                    <small class="text-muted">أو</small>
                </div>
            </div>

            <!-- Additional Options -->
            <div class="text-center">
                <p class="text-muted mb-0">ليس لديك حساب؟
                    <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">
                        سجل الآن
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(target);
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('mdi-eye-outline');
                        icon.classList.add('mdi-eye-off-outline');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('mdi-eye-off-outline');
                        icon.classList.add('mdi-eye-outline');
                    }
                });
            });

            // Add focus effects
            document.querySelectorAll('.form-control').forEach(function(input) {
                input.addEventListener('focus', function() {
                    this.parentElement.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.parentElement.classList.remove('focused');
                });
            });
        });
    </script>

    <style>
        .input-group:focus-within {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            border-radius: 8px;
        }
        .input-group-text {
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .border-bottom {
            border-color: #e9ecef !important;
        }
    </style>

@endsection
