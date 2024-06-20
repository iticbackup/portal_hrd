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
    {{-- <link href="{{ $asset }}/css/light/apps/notes.css" rel="stylesheet" type="text/css" />
    <link href="{{ $asset }}/css/dark/apps/notes.css" rel="stylesheet" type="text/css" /> --}}
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-globe">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>
                            </div>
                            <div class="media-body">
                                <p class="widget-text">Sisa Antrian Hari Ini</p>
                                <p class="widget-numeric-value">{{ $sisa_antrian_hari_ini }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$ijin_keluar_masuks->isEmpty())
                    <h5><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor"
                                d="M6 20h5v2H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6.3c-.22.12-.43.26-.61.44L18 12.13V4h-5v8l-2.5-2.25L8 12V4H6zm16.85-6.53l-1.32-1.32c-.2-.2-.53-.2-.72 0l-.98.98l2.04 2.04l.98-.98c.2-.19.2-.52 0-.72M13 19.96V22h2.04l6.13-6.12l-2.04-2.05z" />
                        </svg> Ijin Keluar Masuk</h5>
                    <div class="row">
                        @foreach ($ijin_keluar_masuks as $ijin_keluar_masuk)
                            @switch($ijin_keluar_masuk->status)
                                @case('Waiting')
                                    @php
                                        $color = 'badge-warning';
                                    @endphp
                                @break

                                @case('Approved')
                                    @php
                                        $color = 'badge-success';
                                    @endphp
                                @break

                                @case('Rejected')
                                    @php
                                        $color = 'badge-danger';
                                    @endphp
                                @break

                                @default
                                    @php
                                        $color = null;
                                    @endphp
                            @endswitch
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <a href="javascript:void()" class="card"
                                        onclick="window.location.href='{{ route('b_ijin_keluar_masuk.detail', ['id' => $ijin_keluar_masuk->id]) }}'">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $ijin_keluar_masuk->no . '-' . $ijin_keluar_masuk->created_at->format('Ymd') }}
                                                <span
                                                    class="badge {{ $color }}">{{ $ijin_keluar_masuk->status }}</span>
                                            </h5>
                                            <p class="mb-0">Nama :
                                                {{ $ijin_keluar_masuk->nik . ' - ' . $ijin_keluar_masuk->nama }}</p>
                                            <p class="mb-0">Jabatan : {{ $ijin_keluar_masuk->jabatan }}</p>
                                            <p class="mb-0">Unit Kerja : {{ $ijin_keluar_masuk->unit_kerja }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
                @if (!$ijin_absens->isEmpty())
                <h5><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                        <path fill="currentColor"
                            d="M6 20h5v2H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6.3c-.22.12-.43.26-.61.44L18 12.13V4h-5v8l-2.5-2.25L8 12V4H6zm16.85-6.53l-1.32-1.32c-.2-.2-.53-.2-.72 0l-.98.98l2.04 2.04l.98-.98c.2-.19.2-.52 0-.72M13 19.96V22h2.04l6.13-6.12l-2.04-2.05z" />
                    </svg> Ijin Absen</h5>
                @foreach ($ijin_absens as $ijin_absen)
                    @switch($ijin_absen->status)
                        @case('Waiting')
                            @php
                                $color = 'badge-warning';
                            @endphp
                        @break

                        @case('Approved')
                            @php
                                $color = 'badge-success';
                            @endphp
                        @break

                        @case('Rejected')
                            @php
                                $color = 'badge-danger';
                            @endphp
                        @break

                        @default
                            @php
                                $color = null;
                            @endphp
                    @endswitch
                    <div class="col-md-4">
                        <div class="mb-3">
                            <a href="javascript:void()" class="card"
                                onclick="window.location.href='{{ route('b_ijin_absen.detail', ['id' => $ijin_absen->id]) }}'">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $ijin_absen->no . '-' . $ijin_absen->created_at->format('Ymd') }}
                                        <span class="badge {{ $color }}">{{ $ijin_absen->status }}</span>
                                    </h5>
                                    <p class="mb-0">Nama : {{ $ijin_absen->nik . ' - ' . $ijin_absen->nama }}
                                    </p>
                                    <p class="mb-0">Jabatan : {{ $ijin_absen->jabatan }}</p>
                                    <p class="mb-0">Unit Kerja : {{ $ijin_absen->unit_kerja }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                @endif
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
    {{-- <script src="{{ $asset }}/js/apps/notes.js"></script> --}}
@endsection
