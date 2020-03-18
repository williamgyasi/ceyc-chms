<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">

        <h4 class="mt-2 mb-2">
            CEYC AIRPORT-CITY
        </h4>
        
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
            {{-- Routes For Managing Fellowships--}}
            <li class="nav-item">
                <a href="">
                    <i class=""></i>
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
            <li class="nav-item">
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
            <li class="nav-item">
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
            <li class="nav-item">
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

            {{-- Routes For Managing Services--}}
            <li class="nav-item">
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
            <li class="nav-item">
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

            <li class="nav-item">
                <a href="">
                    <i class=""></i>
                    <span class="menu-title" data-i18n="">Manage Users & Roles</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="{{ request()->is('admin/users/user-roles') ? 'active' : '' }}">
                            <i></i>
                            <span class="menu-title">All User Roles</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.create') }}"
                            class="{{ request()->is('admin/users/user-rolescreate') ? 'active' : '' }}">
                            <i></i>
                            <span class="menu-title">Add User Role</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->