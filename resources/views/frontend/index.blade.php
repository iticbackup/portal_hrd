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
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            <strong>Selamat Datang</strong> di Portal Antrian PT Indonesian Tobacco Tbk. Silahkan tekan tombol dibawah ini untuk mendapatkan nomor antrian.</button>
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
            <strong>Surat Ijin Keluar Masuk |</strong> Lorem Ipsum is simply dummy text of the printing.
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
                <button onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('antrian') }}'" class="card bg-primary w-100">
                    <div class="card-body w-100">
                        <h5 class="card-title text-center">INPUT ANTRIAN</h5>
                        {{-- <p class="mb-0">-</p> --}}
                    </div>
                </button>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <button onclick="window.location.href='{{ !\Auth::check() ? route('login') : route('f.form_ijin_keluar_masuk') }}'" class="card bg-secondary w-100">
                    <div class="card-body w-100">
                        <h5 class="card-title text-center">SURAT IJIN KELUAR MASUK</h5>
                        {{-- <p class="mb-0">-</p> --}}
                    </div>
                </button>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                <button class="card bg-danger w-100" onclick="alert('Surat Ijin Absen Segera Hadir')">
                    <div class="card-body w-100">
                        <h5 class="card-title text-center">SURAT IJIN ABSEN</h5>
                        {{-- <p class="mb-0">-</p> --}}
                    </div>
                </button>
            </div>
        </div>

    </div>

</div>
@endsection