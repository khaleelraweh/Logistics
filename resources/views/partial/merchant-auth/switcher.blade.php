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
<nav class="navbar navbar-expand-lg navbar-light bg-transparent px-4 py-3">
    <div class="container-fluid">
        <!-- Logo Section -->
        <div class="navbar-brand">
            <a href="{{ route('frontend.index') }}" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('admin/assets/images/logo-dark.png')}}"
                     style="height: 2em"
                     class="logo-dark me-2"
                     alt="{{ config('app.name') }}">
                <img src="{{ asset('admin/assets/images/logo-light.png')}}"
                     style="height: 2em"
                     class="logo-light me-2"
                     alt="{{ config('app.name') }}">
                <span class="fw-bold text-dark fs-5">{{ config('app.name') }}</span>
            </a>
        </div>

        <!-- Controls Section -->
        <div class="navbar-controls d-flex align-items-center">
            <!-- Theme Toggle -->
            <div class="theme-toggle-container me-3">
                <button class="btn btn-sm btn-outline-secondary border-0 theme-toggle"
                        onclick="toggleTheme()"
                        title="تبديل السمة">
                    <i class="fas fa-moon" id="dark_theme_icon"></i>
                    <i class="fas fa-sun d-none" id="light_theme_icon"></i>
                </button>
            </div>

            <!-- Language Switcher -->
            <div class="language-switcher dropdown">
                <button class="btn btn-sm btn-outline-primary border-0 dropdown-toggle"
                        type="button"
                        id="languageDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        title="تغيير اللغة">
                    <i class="fas fa-globe me-1"></i>
                    <span class="text-uppercase">{{ app()->getLocale() }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    @foreach (config('locales.languages') as $key => $val)
                        <li>
                            <a class="dropdown-item d-flex align-items-center {{ $key == app()->getLocale() ? 'active' : '' }}"
                               href="{{ route('change.language', $key) }}">
                                <i class="flag-icon flag-icon-{{ $key == 'ar' ? 'sa' : 'us' }} me-2"></i>
                                <span>{{ $val['name'] }}</span>
                                @if($key == app()->getLocale())
                                    <i class="fas fa-check ms-auto text-success"></i>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    // Theme Toggle Function
    function toggleTheme() {
        const html = document.documentElement;
        const darkIcon = document.getElementById('dark_theme_icon');
        const lightIcon = document.getElementById('light_theme_icon');

        if (html.getAttribute('data-theme') === 'dark') {
            html.setAttribute('data-theme', 'light');
            darkIcon.classList.remove('d-none');
            lightIcon.classList.add('d-none');
            localStorage.setItem('theme', 'light');
        } else {
            html.setAttribute('data-theme', 'dark');
            darkIcon.classList.add('d-none');
            lightIcon.classList.remove('d-none');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Initialize theme on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        const html = document.documentElement;
        const darkIcon = document.getElementById('dark_theme_icon');
        const lightIcon = document.getElementById('light_theme_icon');

        html.setAttribute('data-theme', savedTheme);

        if (savedTheme === 'dark') {
            darkIcon.classList.add('d-none');
            lightIcon.classList.remove('d-none');
        } else {
            darkIcon.classList.remove('d-none');
            lightIcon.classList.add('d-none');
        }

        // Initialize dropdowns
        const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        const dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });
    });
</script>
