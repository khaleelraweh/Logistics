@php
    $isRtl = Session::get('lang-rtl');
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl':'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Multipurpose Admin & Dashboard Template" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="all,follow">
    <meta name="author" content="khaleelRaweh" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Login | {{ config('app.name', 'Laravel') }} - Merchant & Dashboard  </title>

    @include('partial.merchant-auth.head')

</head>

<body class="merchant-auth-body-bg">

    <div class="bg-overlay"></div>
    <div id="app" class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    {{-- @include('partial.merchant-auth.switcher') --}}
                     @yield('content')
                </div>
            </div>
        </div>

    </div>

    @include('partial.merchant-auth.script')



</body>

</html>
