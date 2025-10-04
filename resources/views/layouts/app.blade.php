<?php $rtl = config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl' ? '-rtl' : ''; ?>
<?php $dark = Cookie::get('theme') !== null ? (Cookie::get('theme') == 'dark' ? 'dark' : '') : 'dark'; ?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partial.frontend.head')
</head>
{{-- <body class="defult-home"> --}}

<body class="home-style2" dir="{{ $rtl == '-rtl' ? 'rtl' : 'ltr' }}">

    <!--Preloader area start here-->
    <div id="loader" class="loader">
        <div class="loader-container">
            <div class='loader-icon'>
                <img src="{{ asset('frontend/images/pre-logo-ibb.png') }}" alt="">
            </div>
        </div>
    </div>
    <!--Preloader area End here-->

    {{-- <body class="theme-forth"> for the pages.blade.php --}}
    <div id="app">
        <div class="main-content">
            <!-- navbar-->
            @include('partial.frontend.header')

            @yield('content')
        </div>


    </div>

    <!-- Footer -->
    @include('partial.frontend.footer')

    <!-- start scrollUp  -->
    <div id="scrollUp" class="orange-color">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- End scrollUp  -->

    <!--  Modal -->
    @include('partial.frontend.modal')

    @include('partial.frontend.script')

</body>

</html>
