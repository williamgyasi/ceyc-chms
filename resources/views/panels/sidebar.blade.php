<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">

        <h4 class="mt-2 mb-2">
            CEYC AIRPORT-CITY
        </h4>

    </div>
    <div class="main-menu-content mt-3">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item pb-1">
                <a href="{{ route('home') }}">
                    <i></i>
                    <span class="menu-title" data-i18n="">Home</span>
                </a>
            </li>

            @foreach(Auth::user()->roles as $role)
                @if($role->name == 'Admin')
                    {{-- Routes For Managing Fellowships--}}
                    <li class="nav-item pb-1">
                        <a href="">
                            <i></i>
                            <span class="menu-title" data-i18n="">Manage Fellowships</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('fellowships.index') }}"
                                   class="{{ request()->is('admin/fellowships') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Fellowships</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('fellowships.create') }}"
                                   class="{{ request()->is('admin/fellowships/create') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Add Fellowship</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Routes For Managing Cells--}}
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Cells</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('cells.index') }}" class="{{ request()->is('admin/cells') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Cells</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cells.create') }}"
                                   class="{{ request()->is('admin/cells/create') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Add Cell</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Routes For Managing Members--}}
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Members</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('members.index') }}"
                                   class="{{ request()->is('admin/members') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Members</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('members.create') }}"
                                   class="{{ request()->is('admin/members/create') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Add Member</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Routes For Managing Departments--}}
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Departments</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('departments.index') }}"
                                   class="{{ request()->is('admin/departments') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Departments</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('departments.create') }}"
                                   class="{{ request()->is('admin/departments/create') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Add Department</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Services</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('services.index') }}"
                                   class="{{ request()->is('admin/services') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Services</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('services.create') }}"
                                   class="{{ request()->is('admin/services/create') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Add Service</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Routes For Managing Roles--}}
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Roles</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('roles.index') }}"
                                   class="{{ request()->is('admin/roles') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Roles</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('roles.create') }}"
                                   class="{{ request()->is('admin/roles/create') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Add Role</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Routes for managing user roles-->
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage User Roles</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('roles.index') }}"
                                   class="{{ request()->is('admin/users/user-roles') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.roles.assign.form') }}"
                                   class="{{ request()->is('admin/users/roles/assign') ? 'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">Manage Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endforeach
            <!-- Routes for managing a single fellowship-->
            @foreach(Auth::user()->roles as $role)
                @if($role->name == 'Fellowship Leader')
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Fellowship</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('fellowship.members', [ Auth::user()->fellowship->name ]) }}"
                                   class="{{ request()->is('fellowship/' . Auth::user()->fellowship->name .'/members') ?
                                    'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Members</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('fellowship.cells', [Auth::user()->fellowship->name ]) }}"
                                   class="{{ request()->is('fellowship/' . Auth::user()->fellowship->name .'/cells') ?
                                   'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Cells</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endforeach

        <!-- Routes for managing a single cell-->
            @foreach(Auth::user()->roles as $role)
                @if($role->name == 'Cell Leader')
                    <li class="nav-item pb-1">
                        <a href="">
                            <i class=""></i>
                            <span class="menu-title" data-i18n="">Manage Cell</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="{{ route('cell.members', [ Auth::user()->cell->name ]) }}"
                                   class="{{ request()->is('cell/' . Auth::user()->cell->name .'/members') ?
                                    'active' : '' }}">
                                    <i></i>
                                    <span class="menu-title">All Members</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endforeach

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
                        <a href="{{ route('roles.index') }}"
                           class="{{ request()->is('admin/users/user-roles') ? 'active' : '' }}">
                            <span class="menu-title">Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="{{ request()->is('admin/users/roles/assign') ? 'active' : '' }}">
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
