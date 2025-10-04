<div class="header">
      <div class="container">
        <a href="{{ route('frontend.index') }}" class="Logo">
          <img src="{{ asset('frontend/images/logo.png') }}" class="animate-bounce" alt="OraxSoft" />
        </a>
        <nav>
            <i class="fas fa-bars toogle-menu"></i>
            <ul class="navgition-container">
                <li><a href="{{ route('frontend.index') }}">{{ __('menus.home') }}</a></li>
                <li><a href="{{ route('frontend.index') }}#services">{{ __('menus.services') }}</a></li>
                <li><a href="{{ route('frontend.index') }}#portfolio">{{ __('menus.portfolio') }}</a></li>
                <li><a href="{{ route('frontend.index') }}#about">{{ __('menus.about') }}</a></li>
                <li><a href="{{ route('frontend.index') }}#project">{{ __('menus.project') }}</a></li>
                <li><a href="{{ route('frontend.index') }}#contact">{{ __('menus.contact') }}</a></li>
            </ul>
            <div class="form">
                <i class="fas fa-search"></i>
            </div>
            <div class="theme-switcher">
                <div class="" id="dark_theme_icon" onclick="toggleTheme()">
                    <i class="fa fa-moon"></i>
                </div>
                <div class="hide_item " id="light_theme_icon" onclick="toggleTheme()">
                    <i class="fa fa-sun"></i>
                </div>
            </div>

            <div class="language-switcher">
                @foreach (config('locales.languages') as $key => $val)
                    @if ($key != app()->getLocale())
                            <a href="{{ route('change.language', $key) }}" class="switcher_item">
                                <span>
                                    <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }}"
                                        title="{{ $key == 'ar' ? 'sa' : 'us' }}"
                                        id="{{ $key == 'ar' ? 'sa' : 'us' }}"></i>
                                </span>
                                {{-- {{ __('transf.lang_' . $val['lang']) }} --}}
                            </a>

                    @endif
                @endforeach
            </div>

            <div class="login-register" style="margin: 0 15px;">

                <i class="fa fa-sign-in text-white"></i>
                @if (auth()->check() && (auth()->user()->hasRole('admin')))
                    <a href="{{ route('admin.index') }}" style="color: #fff; text-decoration: none;">{{ __('dashboard.dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" style="color: #fff; text-decoration: none;">{{ __('auth.login') }}</a>
                @endif

            </div>

        </nav>
      </div>
</div>

