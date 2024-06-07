{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.backend.master')
@section('title')
    Beranda
@endsection
@section('css')
    @php
        $asset = asset('assets/');
    @endphp
    <link href="{{ $asset }}/css/light/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->
            <div class="row layout-top-spacing">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                    <div class="widget widget-t-sales-widget widget-m-sales">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Nomor Antrian</p>
                                <p class="widget-numeric-value">{{ $no_antrian }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                    <div class="widget widget-t-sales-widget widget-m-orders">
                        <div class="media">
                            <div class="icon ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Sisa Antrian Hari Ini</p>
                                <p class="widget-numeric-value">{{ $sisa_antrian_hari_ini }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row layout-top-spacing">

                <div class="col-12">
                    <div class="alert alert-arrow-right alert-icon-right alert-light-success alert-dismissible fade show mb-4"
                        role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-alert-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12" y2="16"></line>
                        </svg>
                        <strong>Kick Start you new project with ease!</strong> Learn more about Starter Kit by refering to
                        the <a target="_blank"
                            href="https://designreset.com/equation/documentation/getting-started.html">Documentation</a>
                    </div>
                </div>

                <div class="col-md-12">
                </div>

            </div> --}}
            <!-- CONTENT AREA -->

        </div>

    </div>
@endsection
@section('script')
    <script src="{{ $asset }}/js/dashboard/dash_1.js"></script>
@endsection