<?php $rtl = config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl' ? '-rtl' : ''; ?>
<?php $dark = Cookie::get('theme') !== null ? (Cookie::get('theme') == 'dark' ? 'dark' : '') : 'dark'; ?>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OraxSoft">
<meta name="robots" content="all,follow">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'OraxSoft') }}</title>

<!-- Google fonts-->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">

<!-- favicon -->
<link rel="apple-touch-icon" href="apple-touch-icon.html">
{{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/fav-orange.png') }}"> --}}
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/pre-logo-ibb.png') }}">
<!-- Bootstrap v4.4.1 css -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/ar/bootstrap' . $rtl . '.min.css') }}">
<!-- font-awesome css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/fontawesome/fontawesome.css') }}"> --}}
<!-- animate css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
<!-- owl.carousel css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/ar/owl.carousel.css') }}">
<!-- slick css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css') }}">
<!-- off canvas css -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/off-canvas.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/off-canvas' . $rtl . '.css') }}">
<!-- linea-font css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/linea-fonts.css') }}">
<!-- flaticon css  -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/fonts/flaticon.css') }}">
<!-- magnific popup css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/magnific-popup.css') }}">
<!-- Main Menu css -->
{{-- <link rel="stylesheet" href="{{ asset('frontend/css/rsmenu-main.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('frontend/css/rsmenu-main' . $rtl . '.css') }}">
<!-- spacing css -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/rs-spacing.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/rs-spacing' . $rtl . '.css') }}">
<!-- style css -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style' . $rtl . '.css') }}">
<!-- This stylesheet dynamically changed from style.less -->
<!-- responsive css -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive' . $rtl . '.css') }}">
<link rel="stylesheet" href="{{ asset('backend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom' . $rtl . '.css') }}">

<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

@livewireStyles
@yield('style')
