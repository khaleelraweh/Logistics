
@php
    $isRtl = Session::get('lang-rtl');
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $isRtl ? 'rtl':'ltr' }}">

<head>
    @include('partial.frontend.head')
</head>

<body >
    <div id="app">
        <div class="main-content">
            @include('partial.frontend.header')

            @yield('content')

            @include('partial.frontend.footer')
        </div>
    </div>

    @include('partial.frontend.script')

</body>

</html>
