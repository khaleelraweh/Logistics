<div class="header">
      <div class="container">
        <a href="{{ route('frontend.index') }}" class="Logo">
          <img src="{{ asset('frontend/images/logo.png') }}" class="animate-bounce" alt="OraxSoft" />
        </a>

        <nav>
            <i class="fas fa-bars toogle-menu"></i>


            <ul class="navgition-container">
                @foreach ($frontend_menus->where('section', 1) as $menu)
                    <li class="{{ count($menu->appearedChildren) > 0 ? 'menu-item-has-children has-children' : '' }}">
                        <a href="{{ count($menu->appearedChildren) > 0 ? 'javascript:void(0)' : $menu->link }}">
                            {{ $menu->title }}
                        </a>

                        @if (count($menu->appearedChildren) > 0)
                            <ul class="sub-menu">
                                @foreach ($menu->appearedChildren as $sub_menu)
                                    <li class="{{ count($sub_menu->appearedChildren) > 0 ? 'menu-item-has-children has-children' : '' }}">
                                        <a href="{{ $sub_menu->link }}">{{ $sub_menu->title }}</a>

                                        @if (count($sub_menu->appearedChildren) > 0)
                                            <ul class="sub-menu">
                                                @foreach ($sub_menu->appearedChildren as $sub_sub_menu)
                                                    <li>
                                                        <a href="{{ $sub_sub_menu->link }}">{{ $sub_sub_menu->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            <div class="form">
                <i class="fas fa-search"></i>
            </div>

            <div class="theme-switcher">
                <div id="dark_theme_icon" onclick="toggleTheme()">
                    <i class="fa fa-moon"></i>
                </div>
                <div class="hide_item" id="light_theme_icon" onclick="toggleTheme()">
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
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="login-register" style="margin: 0 15px;">
                <i class="fa fa-sign-in text-white"></i>
                @if (auth()->check() && (auth()->user()->hasRole('admin')))
                    <a href="{{ route('admin.index') }}" style="color: #fff; text-decoration: none;">
                        {{ __('dashboard.dashboard') }}
                    </a>
                @else
                    <a href="{{ route('login') }}" style="color: #fff; text-decoration: none;">
                        {{ __('auth.login') }}
                    </a>
                @endif
            </div>
        </nav>
      </div>
</div>


