


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OraxSoft">
<meta name="robots" content="all,follow">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'OraxSoft') }}</title>


<!-- google font  -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Montserrat:wght@100&family=Open+Sans:wght@400;700&family=Sacramento&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet"
/>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">

<!-- font awesome laberary  -->
<link rel="stylesheet" href="{{ asset('frontend/css/all.min.css')}}" />

<!-- normalize file -->
<link rel="stylesheet" href="{{ asset('frontend/css/normalize.css')}}" />

<!-- Bootstrap file -->
<link rel="stylesheet" href="{{ asset($isRtl ? 'frontend/css/bootstrap.rtl.min.css' : 'frontend/css/bootstrap.min.css') }}" />

<!-- Animate css -->
<link rel="stylesheet" href="{{ asset($isRtl ? 'frontend/css/animate-rtl.css' : 'frontend/css/animate.css')}}" />

<!-- bx slider css  -->
<link rel="stylesheet" href="{{ asset($isRtl ? 'frontend/css/jquery.bxslider-rtl.css' :'frontend/css/jquery.bxslider.css')}}" />

<!-- Flag icon  css  -->
<link rel="stylesheet" href="{{ asset('frontend/libs/flag-icon-css/css/flag-icon.min.css')}}" />


<!-- my style css -->
<link rel="stylesheet" href="{{ asset($isRtl ? 'frontend/css/main-rtl.css' : 'frontend/css/main.css')}}" />
<link rel="stylesheet" href="{{ asset('frontend/css/main-dark.css')}}" />

<!-- responsive css  -->
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}" />


<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
    .show_item{
        display: block;
    }
    .hide_item{
        display: none;
    }
</style>

@livewireStyles
@yield('style')

