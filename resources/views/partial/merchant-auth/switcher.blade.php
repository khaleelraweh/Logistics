<nav class="navbar navbar-light bg-transparent px-4 py-3">
    <div class="d-flex justify-content-between align-items-center w-100">
        <!-- Logo -->
        <a href="{{ route('frontend.index') }}" class="navbar-brand m-0">
            <img src="{{ asset('admin/assets/images/logo-dark.png')}}"
                 style="height: 2em"
                 class="logo-dark animate-bounce"
                 alt="Logo">
            <img src="{{ asset('admin/assets/images/logo-light.png')}}"
                 style="height: 2em"
                 class="logo-light animate-bounce"
                 alt="Logo">
        </a>

        <!-- Controls -->
        <div class="d-flex align-items-center gap-2">
            <!-- Theme Toggle -->
            <button class="btn btn-sm btn-light rounded-circle p-2" onclick="toggleTheme()">
                <i class="fas fa-moon" id="dark_theme_icon"></i>
                <i class="fas fa-sun d-none" id="light_theme_icon"></i>
            </button>

            <!-- Language Switcher -->
            <div class="dropdown">
                <button class="btn btn-sm btn-light rounded-pill dropdown-toggle d-flex align-items-center"
                        data-bs-toggle="dropdown">
                    <i class="fas fa-globe me-1"></i>
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @foreach (config('locales.languages') as $key => $val)
                        <li>
                            <a class="dropdown-item {{ $key == app()->getLocale() ? 'active' : '' }}"
                               href="{{ route('change.language', $key) }}">
                                {{ $val['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
