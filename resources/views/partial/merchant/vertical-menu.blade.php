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

                @if(isset($merchant_side_menu))
                    @foreach($merchant_side_menu as $item)
                        <li>
                            <a href="{{ $item->route ? route($item->route) : '#' }}">
                                @if($item->icon)<i class="{{ $item->icon }}"></i>@endif
                                {{ $item->display_name }}
                            </a>

                            @if($item->children->count())
                                <ul>
                                    @foreach($item->children as $child)
                                        <li>
                                            <a href="{{ $child->route ? route($child->route) : '#' }}">
                                                {{ $child->display_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
