<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        {{-- <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                <h6 class="brand-text mb-0">CEYC AIRPORT-CITY</h6>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul> --}}
        <h3 class="mt-2 mb-2">
            CEYC AIRPORT-CITY
        </h3>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Foreach menu item starts --}}
            <li class="nav-item">
                    <a href="">
                        <i class=""></i>
                        <span class="menu-title" data-i18n="">Test</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a href="">
                                <i></i>
                                <span class="menu-title">Sub Menu Test</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @foreach($menuData->menu as $menu)
                <li class="nav-item {{ (request()->is($menu->url)) ? 'active' : '' }}">
                    <a href="{{ $menu->url }}">
                        <i class="{{ $menu->icon }}"></i>
                        <span class="menu-title" data-i18n="">{{ $menu->name }}</span>
                        @if (isset($menu->badge))
                            <?php $badgeClasses = "badge badge-pill badge-primary float-right" ?>
                            <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass.' test' : $badgeClasses.' notTest' }} ">{{$menu->badge}}</span>
                        @endif
                    </a>
                    @if(isset($menu->submenu))
                        @include('panels/submenu', ['menu' => $menu->submenu])
                    @endif
                </li>
            @endforeach
            {{-- Foreach menu item ends --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->