<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    @foreach ($driver_side_menu as $menu)
                        @if (count($menu->appearedChildren) == 0)
                            <!-- عنصر بدون أبناء -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('driver.'.$menu->as) }}">
                                    <i class="{{ $menu->icon }} me-2"></i>
                                    {{ \Illuminate\Support\Str::limit($menu->display_name, 25) }}
                                </a>
                            </li>
                        @else
                            <!-- عنصر له أبناء -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-{{ $menu->id }}"
                                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="{{ $menu->icon }} me-2"></i>
                                    {{ \Illuminate\Support\Str::limit($menu->display_name, 25) }}
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-{{ $menu->id }}">
                                    @foreach ($menu->appearedChildren as $sub_menu)
                                        <a href="{{ route('driver.' . $sub_menu->as) }}" class="dropdown-item">
                                            {{ \Illuminate\Support\Str::limit($sub_menu->display_name, 25) }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>
        </nav>
    </div>
</div>
