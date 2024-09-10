<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="./index.html">
                        <div style="font-weight: bold; text-align: center; font-size: 18pt">H</div>
                        {{-- <img src="../src/assets/img/logo.svg" class="navbar-logo" alt="logo"> --}}
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ route('home') }}" class="nav-link"> PORTAL HRD </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="profile-info">
            <div class="user-info">
                <div class="profile-img">
                    <img src="{{ url('') }}/assets/img/profile-30.png" alt="avatar">
                </div>
                <div class="profile-content">
                    <h6 class="">{{ auth()->user()->name }}</h6>
                    <p class="">{{ auth()->user()->departemen }}</p>
                </div>
            </div>
        </div>

        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ request()->is('home*') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            @can('antrian-list')
                <li class="menu {{ request()->is('antrian*') ? 'active' : '' }}">
                    <a href="{{ route('b_antrian') }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m8-10a8 8 0 1 0-16 0a8 8 0 0 0 16 0m-4-1a1 1 0 0 1 0 2h-3c-1.1 0-2-.9-2-2V7a1 1 0 0 1 2 0v4z" />
                            </svg>
                            <span>Antrian</span>
                        </div>
                    </a>
                </li>
            @endcan
            <li class="menu menu-heading">
                <div class="heading">
                    <span>IJIN</span>
                </div>
            </li>
            @can('ijinkeluarmasuk-list')
                <li class="menu {{ request()->is('ijin_keluar_masuk*') ? 'active' : '' }}">
                    <a href="{{ route('b_ijin_keluar_masuk') }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m8-10a8 8 0 1 0-16 0a8 8 0 0 0 16 0m-4-1a1 1 0 0 1 0 2h-3c-1.1 0-2-.9-2-2V7a1 1 0 0 1 2 0v4z" />
                            </svg>
                            <span>Ijin Keluar Masuk</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('ijinabsen-list')
                <li class="menu {{ request()->is('ijin_absen*') ? 'active' : '' }}">
                    <a href="{{ route('b_ijin_absen') }}" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m8-10a8 8 0 1 0-16 0a8 8 0 0 0 16 0m-4-1a1 1 0 0 1 0 2h-3c-1.1 0-2-.9-2-2V7a1 1 0 0 1 2 0v4z" />
                            </svg>
                            <span>Ijin Absen</span>
                        </div>
                    </a>
                </li>
            @endcan
            @can('cto-list')
            <li class="menu menu-heading">
                <div class="heading">
                    <span>DRIVER</span>
                </div>
            </li>
            <li class="menu {{ request()->is('cto*') ? 'active' : '' }}">
                <a href="{{ route('b_cto') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32"
                                d="m80 224l37.78-88.15C123.93 121.5 139.6 112 157.11 112h197.78c17.51 0 33.18 9.5 39.33 23.85L432 224m-352 0h352v144H80zm32 144v32H80v-32m352 0v32h-32v-32" />
                            <circle cx="144" cy="288" r="16" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                            <circle cx="368" cy="288" r="16" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                        </svg>
                        <span>Car Travel Order</span>
                    </div>
                </a>
            </li>
            @endcan
            {{-- <li class="menu {{ request()->is('antrian*') ? 'active' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Ijin Absen</span>
                    </div>
                </a>
            </li> --}}
            @can('usermanagement-list')
                <li class="menu menu-heading">
                    <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg><span style="text-transform: uppercase">User Management</span></div>
                </li>
                @can('user-list')
                    <li class="menu {{ request()->is('users*') ? 'active' : '' }}">
                        <a href="{{ route('user') }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user">
                                    <path fill="currentColor"
                                        d="M12 12a4 4 0 1 1 0-8a4 4 0 0 1 0 8m0 3c3.186 0 6.045.571 8 3.063V20H4v-1.937C5.955 15.57 8.814 15 12 15" />
                                </svg>
                                <span>User</span>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('role-list')
                    <li class="menu {{ request()->is('roles*') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 30 30"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-calendar">
                                    <path fill="currentColor"
                                        d="M28.07 21L22 15l6.07-6l1.43 1.41L24.86 15l4.64 4.59zM22 30h-2v-5a5 5 0 0 0-5-5H9a5 5 0 0 0-5 5v5H2v-5a7 7 0 0 1 7-7h6a7 7 0 0 1 7 7zM12 4a5 5 0 1 1-5 5a5 5 0 0 1 5-5m0-2a7 7 0 1 0 7 7a7 7 0 0 0-7-7" />
                                </svg>
                                <span>Roles</span>
                            </div>
                        </a>
                    </li>
                @endcan
                @can('permission-list')
                    <li class="menu {{ request()->is('permission*') ? 'active' : '' }}">
                        <a href="{{ route('permission') }}" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 28 28"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-calendar">
                                    <path fill="currentColor"
                                        d="M11.9 11H22v4.004c0 .546-.45.996-1 .996s-1-.45-1-.996V13h-2v2c0 .55-.45 1-1 1s-1-.45-1-1v-2h-4.1A5.002 5.002 0 0 1 2 12a5 5 0 0 1 9.9-1M7 15a3 3 0 1 0 0-6a3 3 0 0 0 0 6" />
                                </svg>
                                <span>Permissions</span>
                            </div>
                        </a>
                    </li>
                @endcan
            @endcan
            <li class="menu menu-heading">
                <div class="heading">
                    <span>PROFILE</span>
                </div>
            </li>
            <li class="menu {{ request()->is('profiles*') ? 'active' : '' }}">
                <a href="{{ route('profile') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Profile</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>
