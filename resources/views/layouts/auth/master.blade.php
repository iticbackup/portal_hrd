<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $asset = asset('assets/');
        $layout = asset('layouts/');
        $bootstrap = asset('bootstrap/');
    @endphp
    <link href="{{ $layout }}/vertical-light-menu/css/light/loader.css" rel="stylesheet" type="text/css">
    <link href="{{ $layout }}/vertical-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css">
    <script src="{{ $layout }}/vertical-light-menu/loader.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ $bootstrap }}/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="{{ $layout }}/vertical-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css">
    <link href="{{ $asset }}/css/light/authentication/auth-boxed.css" rel="stylesheet" type="text/css">
    
    <link href="{{ $layout }}/vertical-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css">
    <link href="{{ $asset }}/css/dark/authentication/auth-boxed.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ $asset }}/css/light/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="{{ $asset }}/css/dark/elements/alert.css">
    <title>@yield('title')</title>
</head>
<body class="form">
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    @yield('content')
    <script src="{{ $bootstrap }}/js/bootstrap.bundle.min.js"></script>
</body>
</html>