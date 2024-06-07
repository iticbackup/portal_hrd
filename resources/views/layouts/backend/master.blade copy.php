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
    <link href="{{ $layout }}/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{ $layout }}/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ $layout }}/vertical-light-menu/loader.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ $bootstrap }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ $layout }}/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ $layout }}/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ $asset }}/css/light/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="{{ $asset }}/css/dark/elements/alert.css">

    <link href="{{ $asset }}/css/light/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/scrollspyNav.css" rel="stylesheet" type="text/css" />

    @yield('css')
</head>

<body class="layout-boxed">
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    @include('layouts.backend.navbar')
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('layouts.backend.sidebar')
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            @yield('content')
            {{-- <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Layouts</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Empty Page</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->    
    
                    <!-- CONTENT AREA -->
                    <div class="row layout-top-spacing">

                        <div class="col-12">
                            <div class="alert alert-arrow-right alert-icon-right alert-light-success alert-dismissible fade show mb-4" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                <strong>Kick Start you new project with ease!</strong> Learn more about Starter Kit by refering to the <a target="_blank" href="https://designreset.com/equation/documentation/getting-started.html">Documentation</a>
                            </div>
                        </div>

                        <div class="col-md-12">
                        </div>
                        
                    </div>
                    <!-- CONTENT AREA -->

                </div>

            </div> --}}
            @include('layouts.backend.footer')
        </div>
        <!--  END CONTENT AREA  -->
    </div>

    <script src="{{ $plugin }}/src/global/vendors.min.js"></script>
    <script src="{{ $bootstrap }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ $plugin }}/src/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ $plugin }}/src/mousetrap/mousetrap.min.js"></script>
    <script src="{{ $plugin }}/src/waves/waves.min.js"></script>
    <script src="{{ $layout }}/vertical-light-menu/app.js"></script>
    <script src="{{ $asset }}/js/scrollspyNav.js"></script>
    @yield('script')
</body>

</html>
