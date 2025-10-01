@php
    $defaults = [
        'rtl' => false,
        'mode' => 'light',
    ];

    $userPrefs = is_array(auth()->user()->layout_preferences)
        ? auth()->user()->layout_preferences
        : json_decode(auth()->user()->layout_preferences, true) ?? [];

    $prefs = array_merge($defaults, $userPrefs);

    $isRtl = $prefs['rtl'];
    $isDark = $prefs['mode'] === 'dark';
@endphp

<!-- Meta tags -->
<meta charset="utf-8" />
<title>{{ __('panel.dashboard') }} | {{ config('app.name', 'Laravel') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta name="robots" content="all,follow">
<meta content="Themesdesign" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

<!-- Select2 -->
<link href="{{ asset('admin/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

<!-- Sweet Alert -->
<link href="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('admin/assets/libs/toastr/build/toastr.min.css') }}">

<!-- Icons & Flags -->
<link rel="stylesheet" href="{{ asset('admin/assets/fonts/feather-font/css/iconfont.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/libs/flag-icon-css/css/flag-icon.min.css') }}">

<!-- Vector Map -->
<link href="{{ asset('admin/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" />

<!-- DataTables -->
<link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admin/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />

@if ($isRtl)
    <link href="{{ asset($isDark ? 'admin/assets/css/bootstrap-dark-rtl.min.css' : 'admin/assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" />
    <link href="{{ asset($isDark ? 'admin/assets/css/app-dark-rtl.min.css' : 'admin/assets/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" />
@else
    <link href="{{ asset($isDark ? 'admin/assets/css/bootstrap-dark.min.css' : 'admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" />
    <link href="{{ asset($isDark ? 'admin/assets/css/app-dark.min.css' : 'admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" />
@endif

<!-- Icons -->
<link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" />

<!-- Animations -->
<link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}" />

<!-- File input -->
<link rel="stylesheet" href="{{ asset('admin/assets/libs/bootstrap-fileinput/css/fileinput.min.css') }}">

<!-- Custom General Styles -->
<link href="{{ asset('admin/assets/css/custom-general-style.css') }}" rel="stylesheet" />


@if ($isRtl)
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/flatpickr/flatpickr-rtl.min.css') }}">
@else
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.css') }}">
@endif

<!-- fontawesome icon  picker  -->
<link href="{{ asset('admin/assets/libs/fontawesomepicker/css/fontawesome-iconpicker.css') }}" rel="stylesheet">

@livewireStyles
@yield('style')
