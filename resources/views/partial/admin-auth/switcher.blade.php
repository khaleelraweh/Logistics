<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 mb-3 d-flex justify-content-between">

    <div class="">
        <a href="{{ route('frontend.index') }}" class="auth-logo">
            <img src="{{ asset('admin/assets/images/logo-dark.png')}}" style="height: 1.5em" class="logo-dark mx-auto animate-bounce" alt="">
            <img src="{{ asset('admin/assets/images/logo-light.png')}}" style="height: 1.5em" class="logo-light mx-auto animate-bounce" alt="">
        </a>
    </div>




    <div class="language-switcher d-flex" >
        <div class=" ms-auto" id="dark_theme_icon" onclick="toggleTheme()">
            <i class="fa fa-moon"></i>
        </div>
        <div class=" ms-auto hide_item" id="light_theme_icon" onclick="toggleTheme()">
            <i class="fa fa-sun"></i>
        </div>
        @foreach (config('locales.languages') as $key => $val)
            @if ($key != app()->getLocale())
                    <a href="{{ route('change.language', $key) }}" class="switcher_item">
                        <span>
                            <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }}"
                                title="{{ $key == 'ar' ? 'sa' : 'us' }}"
                                id="{{ $key == 'ar' ? 'sa' : 'us' }}"></i>
                        </span>
                    </a>

            @endif
        @endforeach
    </div>
</nav>
