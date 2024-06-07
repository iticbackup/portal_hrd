@extends('layouts.frontend.master')
@section('title')
    Portal Antrian
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/light/elements/alert.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dark/elements/alert.css') }}">
@endsection
@section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">
        <div class="alert alert-light-primary alert-dismissible fade show border-0 mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            <strong>Selamat Datang</strong> di Portal Antrian PT Indonesian Tobacco Tbk. Silahkan tekan tombol dibawah ini untuk mendapatkan nomor antrian.</button>
        </div> 
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
                {{-- <div class="widget widget-t-sales-widget widget-m-sales">
                    <a class="media" href="{{ route('antrian') }}">
                        <div class="icon ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M6 2h10l4 4v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m9.172 2H6v16h12V6.828h-2.828z" />
                            </svg>
                        </div>
                        <div class="media-body">
                            <p class="widget-text" style="text-transform: uppercase">Input Antrian</p>
                        </div>
                    </a>
                </div> --}}
                <a href="{{ route('antrian') }}" class="btn btn-primary btn-lg">
                    <div style="text-transform: uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" fill-rule="evenodd" d="M6 2h10l4 4v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m9.172 2H6v16h12V6.828h-2.828z" />
                        </svg>
                        Input Antrian
                    </div>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection