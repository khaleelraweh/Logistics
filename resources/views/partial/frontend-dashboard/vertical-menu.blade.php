<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ auth()->user()->user_image && file_exists(public_path('assets/users/' . auth()->user()->user_image))
                        ? asset('assets/users/' . auth()->user()->user_image)
                        : asset('images/not_found/small_avator__not_found.webp') }}"
                        alt="User Avatar"
                        class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ \Illuminate\Support\Str::limit(auth()->user()->full_name ?? '', 15) }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                @if(isset($frontend_dashboard_side_menu))
                    @foreach ($frontend_dashboard_side_menu as $menu)

                        <!-- عندما لا يكون ابناء في عنصر القائمة -->
                        @if (count($menu->appearedChildren) == 0)
                            <li>
                                <a href="{{ route('driver.'.$menu->as) }}" class="waves-effect">
                                    <i class="{{ $menu->icon }}"></i>
                                    {{-- <span class="badge rounded-pill bg-success float-end">3</span> --}}
                                    <span>
                                        {{ \Illuminate\Support\Str::limit($menu->display_name, 25) }}
                                    </span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="{{ $menu->icon }}"></i>
                                    <span>
                                        {{ \Illuminate\Support\Str::limit($menu->display_name, 25) }}
                                    </span>
                                </a>
                                @if ($menu->appearedChildren !== null && count($menu->appearedChildren) > 0)
                                    <ul class="sub-menu" aria-expanded="false">
                                        @foreach ($menu->appearedChildren as $sub_menu)
                                            <li>
                                                <a href="{{ route('driver.' . $sub_menu->as) }}">
                                                    {{ \Illuminate\Support\Str::limit($sub_menu->display_name, 25) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif

                    @endforeach
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
