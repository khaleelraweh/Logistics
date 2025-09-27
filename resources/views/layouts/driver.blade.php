<!doctype html>
<html id="html-root" lang="{{ app()->getLocale() }}" dir="{{ (is_array(auth()->user()->layout_preferences) ? auth()->user()->layout_preferences['rtl'] ?? false : false) ? 'rtl' : 'ltr' }}">

<head>
    @include('partial.driver.head')
</head>

@php
    // Define default preferences
    $defaults = [
        'layout' => 'vertical',
        'topbar' => 'dark',
        'sidebar' => 'dark',
        'sidebar_size' => 'default',
        'layout_size' => 'fluid',
        'preloader' => false,
        'rtl' => false,
        'mode' => 'light',
        'locale' => config('app.locale'),
    ];

    // Get user preferences and ensure it's an array
    $userPrefs = is_array(auth()->user()->layout_preferences)
        ? auth()->user()->layout_preferences
        : json_decode(auth()->user()->layout_preferences, true) ?? [];

    // Merge defaults with user preferences
    $prefs = array_merge($defaults, $userPrefs);
@endphp

<body
    data-topbar="{{ $prefs['topbar'] }}"
    data-sidebar="{{ $prefs['sidebar'] }}"
    data-sidebar-size="{{ $prefs['sidebar_size'] }}"
    data-layout="{{ $prefs['layout'] }}"
    data-layout-size="{{ $prefs['layout_size'] }}"
    dir="{{ $prefs['rtl'] ? 'rtl' : 'ltr' }}"
    class="
        {{ $prefs['preloader'] ? 'preloader' : '' }}
        {{ $prefs['layout'] === 'vertical' && $prefs['sidebar_size'] === 'icon' ? 'vertical-collpsed' : '' }}"
>

<div id="app">

    <!-- Loader -->
    <div id="preloader" style="{{ !$prefs['preloader'] ? 'display: none;' : '' }}">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>

    <div id="layout-wrapper">
        <header id="page-topbar">
            @include('partial.driver.navbar-header')
        </header>

        <div id="vertical-menu" style="{{ $prefs['layout'] === 'horizontal' ? 'display:none;' : '' }}">
            @include('partial.driver.vertical-menu')
        </div>

        <div id="horizontal-menu" style="{{ $prefs['layout'] === 'horizontal' ? '' : 'display:none;' }}">
            @include('partial.driver.horizontal-menu')
        </div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @include('partial.driver.alert')
                    @yield('content')
                </div>
            </div>

            @include('partial.driver.footer')
        </div>
    </div>

    <!-- Pass layout preferences and useful data to JavaScript -->
    <script>
        window.currentLayoutPrefs = @json($prefs);
        window.csrfToken = "{{ csrf_token() }}";
        window.layoutPrefsSaveUrl = "{{ route('admin.profile.updateModeFromRightBar') }}";
    </script>

    @include('partial.driver.right-bar')
    @include('partial.driver.script')

</div>
</body>
</html>
