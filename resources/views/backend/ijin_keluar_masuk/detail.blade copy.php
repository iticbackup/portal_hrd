@extends('layouts.backend.master')
@section('title')
    Ijin Keluar Masuk - {{ $ijin_keluar_masuk->nama }}
@endsection
@section('css')
    <style>
        .column {
            float: left;
            width: 25%;
            padding: 10px;
            height: 300px;
            /* Should be removed. Only for demonstration */
        }
    </style>
@endsection
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Ijin Keluar Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <button class="btn btn-secondary mb-2 me-2" style="text-transform: uppercase" onclick="window.location.href='{{ url()->previous() }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z" />
                        </svg>
                        Back
                    </button>
                    <button class="btn btn-info mb-2 me-2" style="text-transform: uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" fill-rule="evenodd" d="M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z" />
                        </svg>
                        Verifikasi
                    </button>
                    <div class="table-responsive">
                        <div style="text-align: right; color: black">IT/HRGA/FR/06</div>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="text-center" style="font-weight: bold">PT Indonesian Tobacco Tbk.</div>
                                    <div class="text-center">Jl. Letjen S. Parman 92 <br>Malang</div>
                                </td>
                                <td class="text-center" style="text-transform: uppercase; font-weight: bold; font-size: 14pt">Surat Ijin <br>Keluar - Masuk</td>
                                <td>
                                    <div>NO. &nbsp;: {{ $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') }}</div>
                                    <div>TGL.&nbsp;: {{ $ijin_keluar_masuk->created_at->isoFormat('DD MMMM YYYY') }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    {{-- <div class="mt-3 mb-3">NAMA <span style="margin-left: 15%">:</span></div>
                                    <div class="mt-3 mb-3">JABATAN <span style="margin-left: 11.5%">:</span></div>
                                    <div class="mt-3 mb-3">UNIT KERJA <span style="margin-left: 8.5%">:</span></div>
                                    <div class="mt-3 mb-3">KEPERLUAN <span style="margin-left: 7.9%">:</span></div>
                                    <div class="mt-3 mb-3">KENDARAAN <span style="margin-left: 15%">:</span></div>
                                    <div class="mt-3 mb-3">JAM KERJA <span style="margin-left: 15%">:</span></div> --}}
                                    <table style="border: 0px solid black;">
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Nama</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Jabatan</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jabatan }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Unit Kerja</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->unit_kerja }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Jenis Keperluan</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kategori_keperluan }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Keperluan</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->keperluan }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Kendaraan</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kendaraan }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Jam Kerja</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_kerja }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Jam Rencana Keluar</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_rencana_keluar }}</td>
                                        </tr>
                                        <tr style="border: 0px solid black;">
                                            <td style="border: 0px solid black; text-transform: uppercase">Jam Datang</td>
                                            <td style="border: 0px solid black;">:</td>
                                            <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_datang }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        @php
                            $detail = [
                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                'Signature: ' . $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' . "\n" . 
                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                            ];
                            $detail_manager_bagian = [
                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                // 'Signature: ' . $explode_validasi_manager_bagian[0].' ('.$explode_validasi_manager_bagian[1].') '.''.$ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_manager . "\n" . 
                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                            ];
                            $detail_personalia = [
                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                'Signature: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia.' '.$ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_personalia . "\n" . 
                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                            ];
                            $detail_kend_satpam = [
                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                'Signature: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam.' '.$ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_kend_satpam . "\n" . 
                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                            ];
                            // dd($ijin_keluar_masuk->ijin_keluar_masuk_ttd);
                        @endphp
                        <div class="row">
                            <div class="column text-center">
                                <div style="color: black">Pemohon</div>
                                <div style="margin-top: 2.5%; margin-bottom: 2.5%">{!! DNS2D::getBarcodeSVG($detail['identifier'], 'QRCODE', 2, 2) !!}</div>
                                <div style="color: black">{{ $ijin_keluar_masuk->nama }}</div>
                            </div>
                            <div class="column text-center">
                                <div style="color: black">Mengetahui</div>
                                @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager))
                                <div style="margin-top: 13%; margin-bottom: 13%;">-</div>
                                @else
                                    @if ($explode_validasi_manager_bagian[2] == 'Approved')
                                        <div style="margin-top: 2.5%; margin-bottom: 2.5%">{!! DNS2D::getBarcodeSVG($detail_manager_bagian['identifier'], 'QRCODE', 2, 2) !!}</div>
                                    @elseif ($explode_validasi_manager_bagian[2] == 'Rejected')
                                    <div style="margin-top: 13%; margin-bottom: 13%;">REJECTED</div>
                                    @endif
                                @endif
                                <div style="color: black">Manager Bagian</div>
                            </div>
                            <div class="column text-center">
                                <div style="color: black">Mengetahui</div>
                                {{-- <div style="margin-top: 2.5%; margin-bottom: 2.5%">{!! DNS2D::getBarcodeSVG($detail_personalia['identifier'], 'QRCODE', 2, 2) !!}</div> --}}
                                <div style="color: black">Personalia</div>
                            </div>
                            <div class="column text-center">
                                <div style="color: black">Mengetahui</div>
                                {{-- <div style="margin-top: 2.5%; margin-bottom: 2.5%">{!! DNS2D::getBarcodeSVG($detail_kend_satpam['identifier'], 'QRCODE', 2, 2) !!}</div> --}}
                                <div style="color: black">Ka. Kend / Satpam</div>
                            </div>
                        </div>
                        {{-- <table class="table table-bordered">
                            <tr>
                                <td class="text-center">Pemohon</td>
                                <td class="text-center">Mengetahui</td>
                                <td class="text-center">Mengetahui</td>
                                <td class="text-center">Mengetahui</td>
                            </tr>
                            <tr>
                                <td>
                                    {!! DNS2D::getBarcodeSVG($detail['identifier'], 'QRCODE', 2, 2) !!}
                                </td>
                                <td style="padding-bottom: 15%"></td>
                                <td style="padding-bottom: 5%"></td>
                                <td style="padding-bottom: 5%"></td>
                            </tr>
                            <tr>
                                <td class="text-center">{{ $ijin_keluar_masuk->nama }}</td>
                                <td class="text-center">Manager Bagian</td>
                                <td class="text-center">Personalia</td>
                                <td class="text-center">Ka. Kend / Satpam</td>
                            </tr>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection