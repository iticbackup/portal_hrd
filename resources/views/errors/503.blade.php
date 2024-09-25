{{-- @extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable')) --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Unavailable</title>
    <link href="{{ url('/') }}/layouts/horizontal-light-menu/css/light/loader.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/layouts/horizontal-light-menu/css/dark/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{ url('/') }}/layouts/horizontal-light-menu/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ url('/') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/layouts/horizontal-light-menu/css/light/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/css/light/pages/error/style-maintanence.css" rel="stylesheet" type="text/css" />

    <link href="{{ url('/') }}/layouts/horizontal-light-menu/css/dark/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/css/dark/pages/error/style-maintanence.css" rel="stylesheet" type="text/css" />

    <style>
        body.dark .theme-logo.dark-element {
            display: inline-block;
        }

        .theme-logo.dark-element {
            display: none;
        }

        body.dark .theme-logo.light-element {
            display: none;
        }

        .theme-logo.light-element {
            display: inline-block;
        }
    </style>
</head>

<body class="maintanence text-center">
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid maintanence-content">
        <div class="">
            <div class="maintanence-hero-img">
                <a href="{{ route('frontend') }}">
                    <h1>PORTAL HRD</h1>
                    {{-- <img alt="logo" src="../src/assets/img/logo.svg" class="dark-element theme-logo">
                    <img alt="logo" src="../src/assets/img/logo2.svg" class="light-element theme-logo"> --}}
                </a>
            </div>
            <h1 class="error-title">Website Sedang Dalam Perbaikan</h1>
            {{-- <h1 class="error-title">Under Maintenance</h1> --}}
            <p class="error-text">Terima kasih telah mengunjungi kami.</p>
            <p class="text">Saat ini kami sedang berupaya melakukan beberapa perbaikan
                untuk memberi Anda pengalaman pengguna yang lebih baik.</p>
            <p class="text">Silakan kunjungi kami lagi segera.</p>
            <a href="{{ route('frontend') }}" class="btn btn-dark mt-4">Beranda</a>
            <p class="text">Team IT.</p>
        </div>
    </div>

    <script src="{{ url('/') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
