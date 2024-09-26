@extends('layouts.frontend.master')
@section('title')
    Portal HRD
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dark/elements/alert.css') }}">

<style>
    #content{
        margin-top: 100px
    }
</style>
@endsection
@section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">
        <div class="alert alert-light-primary alert-dismissible fade show border-0 mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 36 36">
                    <path fill="currentColor" d="m19.41 18l8.29-8.29a1 1 0 0 0-1.41-1.41L18 16.59l-8.29-8.3a1 1 0 0 0-1.42 1.42l8.3 8.29l-8.3 8.29A1 1 0 1 0 9.7 27.7l8.3-8.29l8.29 8.29a1 1 0 0 0 1.41-1.41Z" class="clr-i-outline clr-i-outline-path-1" />
                    <path fill="none" d="M0 0h36v36H0z" />
                </svg>
            </button>
            {{-- <strong>Selamat Datang</strong> di Portal Antrian PT Indonesian Tobacco Tbk. Silahkan tekan tombol dibawah ini untuk keperluan Anda.</button> --}}
            <strong>Selamat Datang</strong> di Portal Antrian PT Indonesian Tobacco Tbk.</button>
        </div>
        @auth
        @foreach ($ijin_keluar_masuks as $ijin_keluar_masuk)
        @php
            if ($ijin_keluar_masuk->status == 'Waiting') {
                $status = 'warning';
            }elseif ($ijin_keluar_masuk->status == 'Approved') {
                $status = 'success';    
            }elseif ($ijin_keluar_masuk->status == 'Rejected') {
                $status = 'danger';    
            }
        @endphp
        <div class="alert alert-{{ $status }} alert-dismissible fade show mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            <strong>Surat Ijin Keluar Masuk - {{ $ijin_keluar_masuk->status }} |</strong> {{ $ijin_keluar_masuk->keperluan }}
            <strong>Tgl Dibuat: {{ $ijin_keluar_masuk->created_at->isoFormat('LLL') }}</strong>
        </div>
        @endforeach
        @endauth
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <div class="widget widget-t-sales-widget widget-m-sales">
                    <div class="media">
                        <p class="widget-text" style="text-transform: uppercase">No Antrian</p>
                        <div class="media-body">
                            <p class="widget-text" style="font-size: 56pt" id="no_antrian">{{ $no_antrian }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <div class="widget widget-t-sales-widget widget-m-sales">
                    <div class="media">
                        <p class="widget-text" style="text-transform: uppercase">Sisa Antrian Hari Ini</p>
                        <div class="media-body">
                            <p class="widget-text" style="font-size: 56pt" id="sisa_antrian_hari_ini">{{ $sisa_antrian_hari_ini }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a class="card" style="background: radial-gradient(circle, #19cf32 0%, #466ac4 100%); color: white" onclick="window.location.href='{{ route('frontend.database_karyawan.create') }}'">
                    <div class="card-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="8em" height="8em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7.5 5C9.43 5 11 6.57 11 8.5S9.43 12 7.5 12S4 10.43 4 8.5S5.57 5 7.5 5M1 19v-2.5C1 14.57 4.46 13 7.5 13c1.18 0 2.42.24 3.5.64V19zm21 0h-8c-.55 0-1-.45-1-1V6c0-.55.45-1 1-1h5l4 4v9c0 .55-.45 1-1 1m-4-9h3v-.17L18.17 7H18zm-3 2v1.5h6V12zm0 3v1.5h6V15z" />
                        </svg>
                        <h5 class="card-title text-center" style="font-weight: bold; color: white">UPDATE DATA KARYAWAN</h5>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a class="card bg-secondary" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_keluar_masuk') }}'">
                    <div class="card-body text-center">
                        <div></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8em" height="8em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                        </svg>
                        <h5 class="card-title text-center" style="font-weight: bold">SURAT IJIN KELUAR MASUK</h5>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a class="card bg-danger" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_absen') }}'">
                    <div class="card-body text-center">
                        <div></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8em" height="8em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                        </svg>
                        <h5 class="card-title text-center" style="font-weight: bold">SURAT IJIN ABSEN</h5>
                    </div>
                </a>
            </div>
            {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a class="card bg-primary" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('antrian') }}'">
                    <div class="card-body text-center">
                        <div></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8em" height="8em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                        </svg>
                        <h5 class="card-title mb-3 text-center" style="font-weight: bold">INPUT ANTRIAN</h5>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a class="card bg-secondary" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_keluar_masuk') }}'">
                    <div class="card-body text-center">
                        <div></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8em" height="8em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                        </svg>
                        <h5 class="card-title mb-3 text-center" style="font-weight: bold">SURAT IJIN KELUAR MASUK</h5>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <a class="card bg-danger" onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_absen') }}'">
                    <div class="card-body text-center">
                        <div></div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8em" height="8em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M7 2a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h4.174A6.5 6.5 0 0 1 11 17.5H7a.5.5 0 0 1-.5-.5V4a.5.5 0 0 1 .5-.5h5.5v3.25c0 .966.784 1.75 1.75 1.75h3.25V11q.776.002 1.5.174V7.768a2 2 0 0 0-.586-1.414l-3.768-3.768A2 2 0 0 0 13.232 2zm7 4.75V4.06L16.94 7h-2.69a.25.25 0 0 1-.25-.25M6.5 20.5h5.232A6.5 6.5 0 0 0 12.81 22H6.5A4.5 4.5 0 0 1 2 17.5v-1.75a.75.75 0 0 1 1.5 0v1.75a3 3 0 0 0 3 3M8 5.75A.75.75 0 0 1 8.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 1 8 5.75M8.75 8a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zm0 3a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5zM23 17.5a5.5 5.5 0 1 0-11 0a5.5 5.5 0 0 0 11 0m-5 .5l.001 2.503a.5.5 0 1 1-1 0V18h-2.505a.5.5 0 0 1 0-1H17v-2.5a.5.5 0 1 1 1 0V17h2.497a.5.5 0 0 1 0 1z" />
                        </svg>
                        <h5 class="card-title mb-3 text-center" style="font-weight: bold">SURAT IJIN ABSEN</h5>
                    </div>
                </a>
            </div> --}}

        </div>

    </div>

</div>
@endsection