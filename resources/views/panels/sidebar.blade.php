<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">

        <h4 class="mt-2 mb-2">
            CEYC AIRPORT-CITY
        </h4>

    </div>
    <div class="main-menu-content mt-3">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item pb-1">
                <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : ''  }}">
                    <i></i>
                    <span class="menu-title" data-i18n="">Home</span>
                </a>
            </li>
            <li class="nav-item pb-1">
                <a href="{{ route('givings.dashboard') }}" class="{{ request()->is('givings/*') ? 'active' : ''  }}">
                    <i></i>
                    <span class="menu-title" data-i18n="">Givings</span>
                </a>
            </li>
            <li class="nav-item pb-1 mb-3">
                <a href="">
                    <i class=""></i>
                    <span class="menu-title" data-i18n="">
                        <i class="fa fa-user-circle"></i>
                        My Account
                    </span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <span class="menu-title">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
