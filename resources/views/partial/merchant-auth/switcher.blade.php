<style>

    .navbar-controls .btn {
        border-radius: 10px;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }

    .navbar-controls .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .theme-toggle-container .btn {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .language-switcher .dropdown-toggle::after {
        margin-right: 0.5em;
        margin-left: 0;
    }

    .flag-icon {
        width: 20px;
        height: 15px;
        border-radius: 2px;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 8px;
    }

    .dropdown-item {
        border-radius: 8px;
        padding: 10px 15px;
        margin: 2px 0;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover, .dropdown-item:focus {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
    }

    .dropdown-item.active {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .navbar-brand span {
            display: none;
        }

        .navbar-controls {
            flex-direction: row;
        }

        .theme-toggle-container {
            margin-right: 10px !important;
        }
    }

    /* Dark theme support */
    [data-theme="dark"] .navbar-brand span {
        color: white;
    }

    [data-theme="dark"] .navbar-controls .btn {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: rgba(255, 255, 255, 0.2);
    }
</style>
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
