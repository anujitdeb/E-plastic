@extends('../withoutLoginLayout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    @php

  /*      //check auth guard
if(auth('admin')->check()) {
 $currentUser = auth('admin')->user();
 $typeGuard = 'admin';
}
elseif(auth('web')->check()) {
 $currentUser = auth('web')->user();
 $typeGuard = 'web';
}
elseif(auth('organizer')->check()) {
 $currentUser = auth('organizer')->user();
 $typeGuard = 'organizer';
}
elseif(auth('stall')->check()) {
 $currentUser = auth('stall')->user();
 $typeGuard = 'stall';
}
elseif(auth('buyer')->check()){
 $currentUser = auth('buyer')->user();
 $typeGuard = 'buyer';
}*/


    @endphp
    @include('../withoutLoginLayout/components/mobile-menu')
    @include('../withoutLoginLayout/components/top-bar')
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <ul>

                    <a href="/eplastic">
                        <div class="flex">
                            <div class="side-menu__icon flex-none text-white mr-3">
                                <i data-feather="home"></i>
                            </div>
                            <div class="side-menu__title flex-auto text-white pt-1">
                                Dashboard
                            </div>
                        </div>
                    </a>

                   {{-- @foreach ($side_menu as $menuKey => $menu)
                        @if ($menu == 'devider')
                            <li class="side-nav__devider my-6"></li>
                            --}}{{-- @elseif(auth($menu['guard'])->user())--}}{{--
                        @elseif(in_array($typeGuard,$menu['guard']))
                            <li>
                                <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], $menu['params']) : 'javascript:;' }}"
                                   class="{{ $first_level_active_index == $menuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                    <div class="side-menu__icon">
                                        <i data-feather="{{ $menu['icon'] }}"></i>
                                    </div>
                                    <div class="side-menu__title">
                                        {{ $menu['title'] }}
                                        @if (isset($menu['sub_menu']))
                                            <div
                                                class="side-menu__sub-icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}">
                                                <i data-feather="chevron-down"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                @if (isset($menu['sub_menu']))
                                    <ul class="{{ $first_level_active_index == $menuKey ? 'side-menu__sub-open' : '' }}">
                                        @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                            <li>
                                                <a href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}"
                                                   class="{{ $second_level_active_index == $subMenuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                    <div class="side-menu__icon">
                                                        <i data-feather="activity"></i>
                                                    </div>
                                                    <div class="side-menu__title">
                                                        {{ $subMenu['title'] }}
                                                        @if (isset($subMenu['sub_menu']))
                                                            <div
                                                                class="side-menu__sub-icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}">
                                                                <i data-feather="chevron-down"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </a>
                                                @if (isset($subMenu['sub_menu']))
                                                    <ul class="{{ $second_level_active_index == $subMenuKey ? 'side-menu__sub-open' : '' }}">
                                                        @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                            <li>
                                                                <a href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}"
                                                                   class="{{ $third_level_active_index == $lastSubMenuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                                    <div class="side-menu__icon">
                                                                        <i data-feather="zap"></i>
                                                                    </div>
                                                                    <div
                                                                        class="side-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach--}}
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                @yield('subcontent')
            </div>
            <!-- END: Content -->
        </div>
    </div>
@endsection
