@extends('layouts.app')

@section('style')

<style>
    /* Start contact section  */
.contact {
  padding-top: var(--section-padding);
  padding-bottom: var(--section-padding);
}
.contact .container {
}
.contact .content {
  display: flex;
  justify-content: space-between;
}
@media (max-width: 767px) {
  .contact .content {
    flex-direction: column;
  }
}
.contact .content form {
  flex-basis: 70%;
}
.contact .content form .main-input ,
.contact .content form .remember-section {
  width: 100%;
  max-width: 100%;
  padding: 20px;
  margin-bottom: 40px;
  border: 1px solid #ccc;
}

.contact .content form .remember-section{
    border: none;
    padding: 0;
    display: flex;
    justify-content: space-between;
}

.contact .content form .remember-section .remember-me,
.contact .content form .remember-section .forgot-password a{
    color :#777;
    text-decoration: none;
}

@media (max-width: 767px){
    .contact .content form .remember-section{
        flex-direction: column;
        text-align: center;
    }
    .contact .content form .remember-section .remember-me,
    .contact .content form .remember-section .forgot-password{
        padding: 20px;
    }
}
.contact .content form .main-input:focus {
  outline: none;
}
.contact .content form textarea.main-input {
  height: 200px;
}
.contact .content form input[type="submit"] {
  background-color: var(--main-color);
  color: white;
  border: none;
  padding: 15px 25px;
  cursor: pointer;
  /* الفلكس مع المارجن يحرك العنصر نفس الفلوت  */
  display: flex;
  margin-right: auto;
}
@media (max-width: 767px) {
  .contact .content form input[type="submit"] {
    margin: auto;
  }
}
.contact .content .info {
  flex-basis: 25%;
  color: #777;
}
@media (max-width: 767px) {
  .contact .content .info {
    order: -1;
    text-align: center;
  }
}
.contact .content .info h4 {
  color: #777;
  text-transform: uppercase;
  margin-bottom: 25px;
}
.contact .content .info span {
  line-height: 2;
  color: #777;
  display: block;
}
.contact .content .info h4:nth-of-type(2) {
  margin-top: 90px;
}
@media (max-width: 767px) {
  .contact .content .info h4:nth-of-type(2) {
    margin-top: 40px;
  }
}
.contact .content .info address {
  line-height: 2;
}
@media (max-width: 767px) {
  .contact .content .info address {
    margin-bottom: 45px;
  }
}
/* End contact section  */

</style>

@endsection

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
