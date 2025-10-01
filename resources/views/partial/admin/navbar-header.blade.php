<div class="navbar-header">
    <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="{{ route('admin.index') }}" class="logo logo-dark">
                <span class="logo-sm">
                    {{-- <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="logo-sm" height="22"> --}}
                    <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="logo-sm" class="animate-bounce" style="height: 3.5em" >
                </span>
                <span class="logo-lg">
                    {{-- <img src="{{asset('admin/assets/images/logo-dark.png')}}" alt="logo-dark" height="20"> --}}
                    <img src="{{asset('admin/assets/images/logo-dark.png')}}" alt="logo-dark" class="animate-bounce" style="height: 4.5em" >
                </span>
            </a>

            <a href="{{ route('admin.index') }}" class="logo logo-light">
                <span class="logo-sm">
                    {{-- <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="logo-sm-light" height="22"> --}}
                    <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="logo-sm-light" class="animate-bounce" style="height: 3.5em;">
                </span>
                <span class="logo-lg">
                    {{-- <img src="{{asset('admin/assets/images/logo-light.png')}}" alt="logo-light" height="20"> --}}
                    <img src="{{asset('admin/assets/images/logo-light.png')}}" alt="logo-light" class="animate-bounce" style="height: 4.5em">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
            <i class="ri-menu-2-line align-middle"></i>
        </button>

        <!-- App Search-->
        <form class="app-search d-none d-lg-block">
            <div class="position-relative">
                <input type="text" class="form-control" placeholder="{{ __('layout.search_placeholder') }}">
                <span class="ri-search-line"></span>
            </div>
        </form>

        <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                Mega Menu
                <i class="mdi mdi-chevron-down"></i>
            </button>
            <div class="dropdown-menu dropdown-megamenu">
                <div class="row">
                    <div class="col-sm-8">

                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="font-size-14">UI Components</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Lightbox</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Rating</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Forms</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Tables</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Charts</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <h5 class="font-size-14">Applications</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Ecommerce</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Calendar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Email</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Projects</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Tasks</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Contacts</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-4">
                                <h5 class="font-size-14">Extra Pages</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Light Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Compact Sidebar</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Horizontal layout</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Maintenance</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Coming Soon</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Timeline</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">FAQs</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="font-size-14">UI Components</h5>
                                <ul class="list-unstyled megamenu-list">
                                    <li>
                                        <a href="javascript:void(0);">Lightbox</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Rating</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Forms</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Tables</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Charts</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-sm-5">
                                <div>
                                    <img src="{{asset('admin/assets/images/megamenu-img.png')}}" alt="megamenu-img" class="img-fluid mx-auto d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="d-flex">

        <div class="dropdown d-inline-block d-lg-none ms-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-search-line"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-search-dropdown">

                <form class="p-3">
                    <div class="mb-3 m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @livewire('admin.profile.language-switcher-component')

            {{-- <a class="nav-link" href="{{route('admin.supervisors.index')}}">{{ __('navbar.supervisors') }}</a> --}}

        {{-- رابط المشرفين بجوار القائمة --}}
        <div class="d-none d-lg-inline-block ms-1">
            <a class="btn header-item noti-icon waves-effect d-flex align-items-center" href="{{ route('admin.supervisors.index') }}">
                <i class="ri-team-line"></i>
                <span class="d-none d-xl-inline">{{ __('navbar.supervisors') }}</span>
            </a>
        </div>

        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ri-apps-2-line"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <div class="px-lg-2">
                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('admin/assets/images/brands/github.png')}}" alt="Github">
                                <span>GitHub</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('admin/assets/images/brands/bitbucket.png')}}" alt="bitbucket">
                                <span>Bitbucket</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('admin/assets/images/brands/dribbble.png')}}" alt="dribbble">
                                <span>Dribbble</span>
                            </a>
                        </div>
                    </div>

                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('admin/assets/images/brands/dropbox.png')}}" alt="dropbox">
                                <span>Dropbox</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('admin/assets/images/brands/mail_chimp.png')}}" alt="mail_chimp">
                                <span>Mail Chimp</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('admin/assets/images/brands/slack.png')}}" alt="slack">
                                <span>Slack</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown d-none d-lg-inline-block ms-1">
            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                <i class="ri-fullscreen-line"></i>
            </button>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-notification-3-line"></i>
                <span class="noti-dot"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0"> Notifications </h6>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="small"> View All</a>
                        </div>
                    </div>
                </div>
                <div data-simplebar style="max-height: 230px;">
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                    <i class="ri-shopping-cart-line"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <h6 class="mb-1">Your order is placed</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}"
                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mb-1">James Lemire</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">It will seem like simplified English.</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                    <i class="ri-checkbox-circle-line"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <h6 class="mb-1">Your item is shipped</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="" class="text-reset notification-item">
                        <div class="d-flex">
                            <img src="{{asset('admin/assets/images/users/avatar-4.jpg')}}"
                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                            <div class="flex-1">
                                <h6 class="mb-1">Salena Layfield</h6>
                                <div class="font-size-12 text-muted">
                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="p-2 border-top">
                    <div class="d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown d-inline-block user-dropdown">
            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ auth()->user()->user_image && file_exists(public_path('assets/users/' . auth()->user()->user_image))
                        ? asset('assets/users/' . auth()->user()->user_image)
                        : asset('images/not_found/small_avator__not_found.webp') }}"
                        alt="User Avatar"
                        class="rounded-circle header-profile-user">
                <span class="d-none d-xl-inline-block ms-1">{{ \Illuminate\Support\Str::limit(auth()->user()->first_name ?? '', 8) }}</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="ri-user-line align-middle me-1"></i> {{ __('layout.profile') }}</a>
                <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> {{ __('layout.wallet') }}</a>
                <a class="dropdown-item d-block" href="{{ route('admin.profile.layout-customizer') }}"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> {{ __('layout.settings') }}</a>
                <a class="dropdown-item" href="{{ route('admin.lock-screen') }}"><i class="ri-lock-unlock-line align-middle me-1"></i> {{ __("layout.lock_screen") }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger"
                    href="javascript:void(0)"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    >
                    <i class="ri-shut-down-line align-middle me-1 text-danger"></i> {{ __('layout.logout') }}
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                        @csrf
                </form>
            </div>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                <i class="ri-settings-2-line"></i>
            </button>
        </div>

    </div>
</div>
