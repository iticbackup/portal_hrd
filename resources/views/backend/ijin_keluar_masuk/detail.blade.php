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
                    <div class="mb-3" style="font-weight: bold; font-size: 14pt">Detail Ijin Keluar Masuk</div>
                    {{-- <div class="table-responsive">
                        <table class="table">
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Nama</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' }}</td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jabatan</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jabatan }}</td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Unit Kerja</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->unit_kerja }}</td>
                            </tr>
                            @switch($ijin_keluar_masuk->kategori_izin)
                                @case('TL')
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam Datang</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{!! $ijin_keluar_masuk->jam_datang !!}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jenis Izin</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">Terlambat</td>
                                    </tr>
                                    @break
                                @case('KL')
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam Rencana Keluar</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_rencana_keluar }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam Datang</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{!! $ijin_keluar_masuk->jam_datang !!}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jenis Izin</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">Keluar Masuk</td>
                                    </tr>
                                    @break
                                @case('PA')
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam Rencana Keluar</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_rencana_keluar }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jenis Izin</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">Pulang Awal</td>
                                    </tr>
                                    @break
                                @default
                                    
                            @endswitch
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jenis Keperluan</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kategori_keperluan }}</td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Keperluan</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->keperluan }}</td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Kendaraan</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kendaraan }}</td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam Kerja</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_kerja }}</td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Pemohon</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">
                                    @php
                                        $detail = [
                                            'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                            'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                            'Signature: ' . $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' . "\n" . 
                                                            'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                        ];
                                    @endphp
                                    {!! DNS2D::getBarcodeHTML($detail['identifier'], 'QRCODE', 2, 2) !!}
                                </td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Mengetahui PIC/Manager Bagian</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">
                                    @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager))
                                    <div>-</div>
                                    @else
                                        @php
                                            $explode_validasi_manager_bagian = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager);
                                            $detail_manager_bagian = [
                                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                'Signature: ' . $explode_validasi_manager_bagian[0].' ('.$explode_validasi_manager_bagian[1].') '. "\n" . 
                                                                'Status Signature: ' . $explode_validasi_manager_bagian[2] . "\n" . 
                                                                'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_manager . "\n" . 
                                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                            ];
                                        @endphp
                                        @if ($explode_validasi_manager_bagian[2] == 'Approved')
                                        {!! DNS2D::getBarcodeHTML($detail_manager_bagian['identifier'], 'QRCODE', 2, 2) !!}
                                        @elseif ($explode_validasi_manager_bagian[2] == 'Rejected')
                                        <div class="badge bg-danger">REJECTED</div>
                                        @else
                                        <div>-</div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Mengetahui Personalia</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">
                                    @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia))
                                    <div>-</div>
                                    @else
                                        @php
                                            $explode_validasi_personalia = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia);
                                            $detail_personalia = [
                                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                'Signature: ' . $explode_validasi_personalia[0].' ('.$explode_validasi_personalia[1].') '. "\n" . 
                                                                'Status Signature: ' . $explode_validasi_personalia[2] . "\n" . 
                                                                'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_personalia . "\n" . 
                                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                            ];
                                        @endphp
                                        @if ($explode_validasi_personalia[2] == 'Approved')
                                        {!! DNS2D::getBarcodeHTML($detail_personalia['identifier'], 'QRCODE', 2, 2) !!}
                                        @elseif ($explode_validasi_personalia[2] == 'Rejected')
                                        <div class="badge bg-danger">REJECTED</div>
                                        @else
                                        <div>-</div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr style="border: 0px solid black;">
                                <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Mengetahui Ka. Kend / Satpam</td>
                                <td style="border: 0px solid black;">:</td>
                                <td style="border: 0px solid black;">
                                    @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam))
                                    <div>-</div>
                                    @else
                                        @php
                                            $explode_validasi_kend_satpam = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam);
                                            $detail_kend_satpam = [
                                                'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                'Signature: ' . $explode_validasi_kend_satpam[0].' ('.$explode_validasi_kend_satpam[1].') '. "\n" . 
                                                                'Status Signature: ' . $explode_validasi_kend_satpam[2] . "\n" . 
                                                                'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_kend_satpam . "\n" . 
                                                                'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                            ];
                                        @endphp
                                        @if ($explode_validasi_kend_satpam[2] == 'Approved')
                                        {!! DNS2D::getBarcodeHTML($detail_kend_satpam['identifier'], 'QRCODE', 2, 2) !!}
                                        @elseif ($explode_validasi_kend_satpam[2] == 'Rejected')
                                        <div class="badge bg-danger">REJECTED</div>
                                        @else
                                        <div>-</div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->jabatan }}</td>
                            </tr>
                            <tr>
                                <td>Unit Kerja</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->unit_kerja }}</td>
                            </tr>
                            <tr>
                                <td>Keperluan</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->keperluan }}</td>
                            </tr>
                            <tr>
                                <td>Kendaraan</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->kendaraan }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Keperluan</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->kategori_keperluan }}</td>
                            </tr>
                            @switch($ijin_keluar_masuk->kategori_izin)
                                @case('TL')
                                    <tr>
                                        <td>Jam Datang</td>
                                        <td>:</td>
                                        <td>{!! !$ijin_keluar_masuk->jam_datang ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_datang !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Izin</td>
                                        <td>:</td>
                                        <td>Terlambat</td>
                                    </tr>
                                    @break
                                @case('KL')
                                    <tr>
                                        <td>Jam Rencana Keluar</td>
                                        <td>:</td>
                                        <td>{!! !$ijin_keluar_masuk->jam_rencana_keluar ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_rencana_keluar !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Jam Datang</td>
                                        <td>:</td>
                                        <td>{!! !$ijin_keluar_masuk->jam_datang ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_datang !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Izin</td>
                                        <td>:</td>
                                        <td>Keluar Masuk</td>
                                    </tr>
                                    @break
                                @case('PA')
                                    <tr>
                                        <td>Jam Rencana Keluar</td>
                                        <td>:</td>
                                        <td>{!! !$ijin_keluar_masuk->jam_rencana_keluar ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_rencana_keluar !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Izin</td>
                                        <td>:</td>
                                        <td>Pulang Awal</td>
                                    </tr>
                                    @break
                                @default
                            @endswitch
                            <tr>
                                <td>Jam Masuk Kerja</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->jam_kerja }}</td>
                            </tr>
                            <tr>
                                <td>Apakah Ijin Keluar Masuk <br> Sudah Termasuk Jam Istirahat ?</td>
                                <td>:</td>
                                <td>{{ $ijin_keluar_masuk->status_jam_istirahat }}</td>
                            </tr>
                            @if ($ijin_keluar_masuk->status_jam_istirahat == 'Ya')
                                <tr>
                                    <td>Jam Istirahat Mulai</td>
                                    <td>:</td>
                                    <td>{{ $ijin_keluar_masuk->jam_istirahat_awal }}</td>
                                </tr>
                                <tr>
                                    <td>Jam Istirahat Selesai</td>
                                    <td>:</td>
                                    <td>{{ $ijin_keluar_masuk->jam_istirahat_selesai }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-2">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Nama</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' }}</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Jabatan</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->jabatan }}</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Unit Kerja</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->unit_kerja }}</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Keperluan</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->keperluan }}</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Kendaraan</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->kendaraan }}</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Jenis Keperluan</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->kategori_keperluan }}</div>
                            </div>
                        </div>
                        @switch($ijin_keluar_masuk->kategori_izin)
                            @case('TL')
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jam Datang</div>
                                        <div style="color: #000">{!! !$ijin_keluar_masuk->jam_datang ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_datang !!}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jenis Izin</div>
                                        <div style="color: #000">Terlambat</div>
                                    </div>
                                </div>
                                @break
                            @case('KL')
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jam Rencana Keluar</div>
                                        <div style="color: #000">{!! !$ijin_keluar_masuk->jam_rencana_keluar ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_rencana_keluar !!}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jam Datang</div>
                                        <div style="color: #000">{!! !$ijin_keluar_masuk->jam_datang ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_datang !!}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jenis Izin</div>
                                        <div style="color: #000">Keluar Masuk</div>
                                    </div>
                                </div>
                                @break
                            @case('PA')
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jam Rencana Keluar</div>
                                        <div style="color: #000">{!! !$ijin_keluar_masuk->jam_rencana_keluar ? '<span class="text-danger">Belum Diinput</span>' : $ijin_keluar_masuk->jam_rencana_keluar !!}</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div style="color: #000; font-weight: bold">Jenis Izin</div>
                                        <div style="color: #000">Pulang Awal</div>
                                    </div>
                                </div>
                                @break
                            @default
                        @endswitch
                        <div class="col-md-3">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Jam Masuk Kerja</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->jam_kerja }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <div style="color: #000; font-weight: bold">Apakah Ijin Keluar Masuk Sudah Termasuk Jam Istirahat?</div>
                                <div style="color: #000">{{ $ijin_keluar_masuk->status_jam_istirahat }}</div>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="mb-3">
                                        <div class="text-center" style="color: #000; font-weight: bold">Pemohon</div>
                                        <div style="display: flex; justify-content: center">
                                            @php
                                                $detail = [
                                                    'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                    'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                    'Signature: ' . $ijin_keluar_masuk->nama.' ('.$ijin_keluar_masuk->nik.')' . "\n" . 
                                                                    'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                ];
                                            @endphp
                                            {!! DNS2D::getBarcodeHTML($detail['identifier'], 'QRCODE', 2.5, 2.5) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="mb-3">
                                        <div class="text-center" style="color: #000; font-weight: bold">Mengetahui PIC/Manager Bagian</div>
                                        @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager))
                                        <div>-</div>
                                        @else
                                            <div style="display: flex; justify-content: center">
                                                @php
                                                    $explode_validasi_manager_bagian = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager);
                                                    $detail_manager_bagian = [
                                                        'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                        'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                        'Signature: ' . $explode_validasi_manager_bagian[0].' ('.$explode_validasi_manager_bagian[1].') '. "\n" . 
                                                                        'Status Signature: ' . $explode_validasi_manager_bagian[2] . "\n" . 
                                                                        'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_manager . "\n" . 
                                                                        'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_validasi_manager_bagian[2] == 'Approved')
                                                {!! DNS2D::getBarcodeHTML($detail_manager_bagian['identifier'], 'QRCODE', 2, 2) !!}
                                                @elseif ($explode_validasi_manager_bagian[2] == 'Rejected')
                                                <div class="badge bg-danger">REJECTED</div>
                                                @else
                                                <div>-</div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="mb-3">
                                        <div class="text-center" style="color: #000; font-weight: bold">Mengetahui Personalia</div>
                                        @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia))
                                        <div>-</div>
                                        @else
                                            <div style="display: flex; justify-content: center">
                                                @php
                                                    $explode_validasi_personalia = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia);
                                                    $detail_personalia = [
                                                        'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                        'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                        'Signature: ' . $explode_validasi_personalia[0].' ('.$explode_validasi_personalia[1].') '. "\n" . 
                                                                        'Status Signature: ' . $explode_validasi_personalia[2] . "\n" . 
                                                                        'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_personalia . "\n" . 
                                                                        'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_validasi_personalia[2] == 'Approved')
                                                {!! DNS2D::getBarcodeHTML($detail_personalia['identifier'], 'QRCODE', 2, 2) !!}
                                                @elseif ($explode_validasi_personalia[2] == 'Rejected')
                                                <div class="badge bg-danger">REJECTED</div>
                                                @else
                                                <div>-</div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="mb-3">
                                        <div class="text-center" style="color: #000; font-weight: bold">Mengetahui Satpam</div>
                                        @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam))
                                        <div>-</div>
                                        @else
                                            <div style="display: flex; justify-content: center">
                                                @php
                                                    $explode_validasi_kend_satpam = explode('|',$ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam);
                                                    $detail_kend_satpam = [
                                                        'identifier' => 'ID: ' . $ijin_keluar_masuk->id . "\n" . 
                                                                        'Kode Formulir: ' . $ijin_keluar_masuk->no.'-'.$ijin_keluar_masuk->created_at->format('Ymd') . "\n" . 
                                                                        'Signature: ' . $explode_validasi_kend_satpam[0].' ('.$explode_validasi_kend_satpam[1].') '. "\n" . 
                                                                        'Status Signature: ' . $explode_validasi_kend_satpam[2] . "\n" . 
                                                                        'Signature Date: ' . $ijin_keluar_masuk->ijin_keluar_masuk_ttd->tgl_signature_personalia . "\n" . 
                                                                        'Tanggal Formulir: ' . $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_validasi_kend_satpam[2] == 'Approved')
                                                {!! DNS2D::getBarcodeHTML($detail_kend_satpam['identifier'], 'QRCODE', 2, 2) !!}
                                                {{-- <img src="data:image/png;base64,' . {!! DNS2D::getBarcodePNG('12345678', 'QRCODE', 2, 2) !!} . '"/> --}}
                                                @elseif ($explode_validasi_kend_satpam[2] == 'Rejected')
                                                <div class="badge bg-danger">REJECTED</div>
                                                @else
                                                <div>-</div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-secondary mb-2 me-2" style="text-transform: uppercase" onclick="window.location.href='{{ route('b_ijin_keluar_masuk') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z" />
                        </svg>
                        Back
                    </button>
                    @can('ijinkeluarmasuk-verifikasi')
                        {{-- @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager)||empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia)||empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam))
                        <button class="btn btn-info mb-2 me-2" style="text-transform: uppercase" onclick="window.location.href='{{ route('b_ijin_keluar_masuk.b_validasi',['id' => $ijin_keluar_masuk->id]) }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                <path fill="currentColor" fill-rule="evenodd" d="M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z" />
                            </svg>
                            Verifikasi
                        </button>
                        @endif --}}
                        @if ($ijin_keluar_masuk->status == 'Waiting')
                        <button class="btn btn-info mb-2 me-2" style="text-transform: uppercase" onclick="window.location.href='{{ route('b_ijin_keluar_masuk.b_validasi',['id' => $ijin_keluar_masuk->id]) }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                <path fill="currentColor" fill-rule="evenodd" d="M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z" />
                            </svg>
                            Verifikasi
                        </button>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection