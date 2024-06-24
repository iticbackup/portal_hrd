<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $asset = asset('assets/');
    $layout = asset('layouts/');
    $bootstrap = asset('bootstrap/');
    $plugin = asset('plugins/');
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ $layout }}/horizontal-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{ $layout }}/horizontal-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ $layout }}/horizontal-light-menu/loader.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ $bootstrap }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $layout }}/horizontal-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ $layout }}/horizontal-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />

    <link href="{{ $asset }}/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ $plugin }}/src/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="{{ $asset }}/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" /> --}}

    @yield('css')
</head>

<body class="layout-boxed enable-secondaryNav">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            {{-- <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a> --}}

            <ul class="navbar-item theme-brand flex-row  text-center">
                {{-- <li class="nav-item theme-logo">
                    <a href="index.html">
                        <img src="../src/assets/img/logo2.svg" class="navbar-logo" alt="logo">
                    </a>
                </li> --}}
                <li class="nav-item theme-text">
                    <a href="{{ route('frontend') }}" class="nav-link"> PORTAL HRD </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ms-lg-auto ms-0 action-area">

                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-moon dark-mode">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-sun light-mode">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </a>
                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    @guest
                    <a href="{{ route('login') }}" class="nav-link">
                        {{-- <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="../src/assets/img/profile-30.png" class="rounded-circle">
                            </div>
                        </div> --}}
                        <div style="font-weight: bold">LOGIN</div>
                    </a>
                    @else
                    <a href="{{ route('home') }}" class="nav-link"><div style="font-weight: bold">{{ auth()->user()->name }}</div></a>
                    @endguest
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            @yield('content')

            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2024</span>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Developer By IT</p>
                </div>
            </div>
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>

    <script src="{{ $plugin }}/src/global/vendors.min.js"></script>
    <script src="{{ $bootstrap }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $plugin }}/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ $plugin }}/src/mousetrap/mousetrap.min.js"></script>
    <script src="{{ $plugin }}/src/waves/waves.min.js"></script>
    <script src="{{ $layout }}/horizontal-light-menu/app.js"></script>
    <script src="{{ $asset }}/js/dashboard/dash_1.js"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('notification');
        channel.bind('App\\Events\\FrontendNotification', function(data) {
            // alert(JSON.stringify(data));
            // alert('OK');
            document.getElementById('no_antrian').innerHTML = data.antrian;
            document.getElementById('sisa_antrian_hari_ini').innerHTML = data.sisa_antrian_hari_ini;
            Swal.fire({
                position: "center-middle",
                icon: "info",
                title: data.message,
                showConfirmButton: false,
                timer: 10000
            });
        });
    </script>
    @yield('script')
</body>

</html>
