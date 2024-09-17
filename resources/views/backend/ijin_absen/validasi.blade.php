@extends('layouts.backend.master')
@section('title')
    Validasi Ijin Absen
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ijin Absen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Validasi</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="mb-3">Validasi Ijin Absen</div>
                        <form id="form-simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <hr>
                            <p>Yang bertanda tangan di bawah ini :</p>
                            {{-- <div class="col-md-3">
                                <div class="mb-3">
                                    <table class="table">
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $ijin_absen->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td>{{ $ijin_absen->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit Kerja</td>
                                            <td>:</td>
                                            <td>{{ $ijin_absen->unit_kerja }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Nama</div>
                                        <div style="color: #000">{{ $ijin_absen->nama }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Jabatan</div>
                                        <div style="color: #000">{{ $ijin_absen->jabatan }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Unit Kerja</div>
                                        <div style="color: #000">{{ $ijin_absen->unit_kerja }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p>Memohon Ijin untuk tidak masuk kerja pada :</p>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <div>Hari</div>
                                        <div style="color: #000">{{ $ijin_absen->hari }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Tanggal</div>
                                        <div style="color: #000">{{ \Carbon\Carbon::create($ijin_absen->tgl_mulai)->isoFormat('DD MMMM YYYY') . ' s/d ' . \Carbon\Carbon::create($ijin_absen->tgl_berakhir)->isoFormat('DD MMMM YYYY') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <div>Kategori Izin</div>
                                        <div style="color: #000">{{ $ijin_absen->kategori_izin == "IP" ? "Ijin Pulang Awal" : $ijin_absen->kategori_izin == "IS" ? "Ijin Sakit" : $ijin_absen->kategori_izin == "CT" ? "Ijin Cuti" : "-" }}</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <div>Selama</div>
                                        <div style="color: #000">{{ $ijin_absen->selama }} Hari</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <div>Keperluan</div>
                                        <div style="color: #000">{{ $ijin_absen->keperluan }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <p>Kami yang bertanda tangan di bawah ini :</p>
                            @php
                                $explode_saksi_1 = explode('|', $ijin_absen->saksi_1);
                                $explode_saksi_2 = explode('|', $ijin_absen->saksi_2);
                            @endphp
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div>1. Nama Terang</div>
                                        <div style="color: #000">{{ $explode_saksi_1[0] . ' (' . $explode_saksi_1[1] . ')' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <div>Unit Kerja 1</div>
                                        <div style="color: #000">{{ $explode_saksi_1[2] }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <div>Saksi 1</div>
                                        @if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_1))
                                            <select name="saksi_1" class="form-control" id="">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Approved">Disetujui</option>
                                                <option value="Rejected">Ditolak</option>
                                            </select>
                                        @else
                                            @php
                                                $explode_signature_saksi_1 = explode(
                                                    '|',
                                                    $ijin_absen->ijin_absen_ttd->signature_saksi_1,
                                                );
                                                $detail = [
                                                    'saksi_1' =>
                                                        'ID: ' .
                                                        $ijin_absen->id .
                                                        "\n" .
                                                        'Kode Formulir: ' .
                                                        $ijin_absen->no .
                                                        '-' .
                                                        $ijin_absen->created_at->format('Ymd') .
                                                        "\n" .
                                                        'Signature: ' .
                                                        $explode_signature_saksi_1[0] .
                                                        ' (' .
                                                        $explode_signature_saksi_1[1] .
                                                        ')' .
                                                        "\n" .
                                                        'Tanggal Formulir: ' .
                                                        $ijin_absen->created_at->isoFormat('LL'),
                                                ];
                                            @endphp

                                            @if ($explode_signature_saksi_1[2] == 'Approved')
                                                {!! DNS2D::getBarcodeHTML($detail['saksi_1'], 'QRCODE', 2, 2) !!}
                                            @elseif($explode_signature_saksi_1[2] == 'Rejected')
                                                <span class="badge badge-danger">REJECTED</span>
                                            @else
                                                @if ($explode_signature_saksi_1[1] == auth()->user()->nik || auth()->user()->nik == '0000000')
                                                    <select name="saksi_1" class="form-control" id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Approved">Disetujui</option>
                                                        <option value="Rejected">Ditolak</option>
                                                    </select>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div>2. Nama Terang</div>
                                        <div style="color: #000">{{ $explode_saksi_2[0] . ' (' . $explode_saksi_2[1] . ')' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <div>Unit Kerja 2</div>
                                        <div style="color: #000">{{ $explode_saksi_2[2] }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <div>Saksi 2</div>
                                        @if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_2))
                                            <select name="saksi_2" class="form-control" id="">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="Approved">Disetujui</option>
                                                <option value="Rejected">Ditolak</option>
                                            </select>
                                        @else
                                            @php
                                                $explode_signature_saksi_2 = explode(
                                                    '|',
                                                    $ijin_absen->ijin_absen_ttd->signature_saksi_2,
                                                );
                                                $detail = [
                                                    'saksi_2' =>
                                                        'ID: ' .
                                                        $ijin_absen->id .
                                                        "\n" .
                                                        'Kode Formulir: ' .
                                                        $ijin_absen->no .
                                                        '-' .
                                                        $ijin_absen->created_at->format('Ymd') .
                                                        "\n" .
                                                        'Signature: ' .
                                                        $explode_signature_saksi_2[0] .
                                                        ' (' .
                                                        $explode_signature_saksi_2[1] .
                                                        ')' .
                                                        "\n" .
                                                        'Tanggal Formulir: ' .
                                                        $ijin_absen->created_at->isoFormat('LL'),
                                                ];
                                            @endphp
                                            @if ($explode_signature_saksi_2[2] == 'Approved')
                                                {!! DNS2D::getBarcodeHTML($detail['saksi_2'], 'QRCODE', 2, 2) !!}
                                            @elseif($explode_signature_saksi_2[2] == 'Rejected')
                                                <span class="badge badge-danger">REJECTED</span>
                                            @else
                                                @if ($explode_signature_saksi_2[1] == auth()->user()->nik || auth()->user()->nik == '000000')
                                                    <select name="saksi_2" class="form-control" id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Approved">Disetujui</option>
                                                        <option value="Rejected">Ditolak</option>
                                                    </select>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-3">
                                <div class="mb-3">
                                    @php
                                        $explode_saksi_1 = explode('|', $ijin_absen->saksi_1);
                                        $explode_saksi_2 = explode('|', $ijin_absen->saksi_2);
                                    @endphp
                                    <table class="table">
                                        <tr>
                                            <td>1. Nama Terang</td>
                                            <td>:</td>
                                            <td>{{ $explode_saksi_1[0] . ' (' . $explode_saksi_1[1] . ')' }}</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                            <td>:</td>
                                            <td>{{ $explode_saksi_1[2] }}</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp; Saksi 1</td>
                                            <td>:</td>
                                            <td>
                                                @if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_1))
                                                    <select name="saksi_1" class="form-control" id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Approved">Disetujui</option>
                                                        <option value="Rejected">Ditolak</option>
                                                    </select>
                                                @else
                                                    @php
                                                        $explode_signature_saksi_1 = explode(
                                                            '|',
                                                            $ijin_absen->ijin_absen_ttd->signature_saksi_1,
                                                        );
                                                        $detail = [
                                                            'saksi_1' =>
                                                                'ID: ' .
                                                                $ijin_absen->id .
                                                                "\n" .
                                                                'Kode Formulir: ' .
                                                                $ijin_absen->no .
                                                                '-' .
                                                                $ijin_absen->created_at->format('Ymd') .
                                                                "\n" .
                                                                'Signature: ' .
                                                                $explode_signature_saksi_1[0] .
                                                                ' (' .
                                                                $explode_signature_saksi_1[1] .
                                                                ')' .
                                                                "\n" .
                                                                'Tanggal Formulir: ' .
                                                                $ijin_absen->created_at->isoFormat('LL'),
                                                        ];
                                                    @endphp

                                                    @if ($explode_signature_saksi_1[2] == 'Approved')
                                                        {!! DNS2D::getBarcodeHTML($detail['saksi_1'], 'QRCODE', 2, 2) !!}
                                                    @elseif($explode_signature_saksi_1[2] == 'Rejected')
                                                        <span class="badge badge-danger">REJECTED</span>
                                                    @else
                                                        @if ($explode_signature_saksi_1[1] == auth()->user()->nik || auth()->user()->nik == '0000000')
                                                            <select name="saksi_1" class="form-control" id="">
                                                                <option value="">-- Pilih Status --</option>
                                                                <option value="Approved">Disetujui</option>
                                                                <option value="Rejected">Ditolak</option>
                                                            </select>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2. Nama Terang</td>
                                            <td>:</td>
                                            <td>{{ $explode_saksi_2[0] . ' (' . $explode_saksi_2[1] . ')' }}</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                            <td>:</td>
                                            <td>{{ $explode_saksi_2[2] }}</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp; Saksi 2</td>
                                            <td>:</td>
                                            <td>
                                                @if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_2))
                                                    <select name="saksi_2" class="form-control" id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Approved">Disetujui</option>
                                                        <option value="Rejected">Ditolak</option>
                                                    </select>
                                                @else
                                                    @php
                                                        $explode_signature_saksi_2 = explode(
                                                            '|',
                                                            $ijin_absen->ijin_absen_ttd->signature_saksi_2,
                                                        );
                                                        $detail = [
                                                            'saksi_2' =>
                                                                'ID: ' .
                                                                $ijin_absen->id .
                                                                "\n" .
                                                                'Kode Formulir: ' .
                                                                $ijin_absen->no .
                                                                '-' .
                                                                $ijin_absen->created_at->format('Ymd') .
                                                                "\n" .
                                                                'Signature: ' .
                                                                $explode_signature_saksi_2[0] .
                                                                ' (' .
                                                                $explode_signature_saksi_2[1] .
                                                                ')' .
                                                                "\n" .
                                                                'Tanggal Formulir: ' .
                                                                $ijin_absen->created_at->isoFormat('LL'),
                                                        ];
                                                    @endphp
                                                    @if ($explode_signature_saksi_2[2] == 'Approved')
                                                        {!! DNS2D::getBarcodeHTML($detail['saksi_2'], 'QRCODE', 2, 2) !!}
                                                    @elseif($explode_signature_saksi_2[2] == 'Rejected')
                                                        <span class="badge badge-danger">REJECTED</span>
                                                    @else
                                                        @if ($explode_signature_saksi_2[1] == auth()->user()->nik || auth()->user()->nik == '000000')
                                                            <select name="saksi_2" class="form-control" id="">
                                                                <option value="">-- Pilih Status --</option>
                                                                <option value="Approved">Disetujui</option>
                                                                <option value="Rejected">Ditolak</option>
                                                            </select>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}
                            <hr>
                            <p>*Bersedia bersaksi dan dikenakan sangsi pemotongan bonus, apabila dalam kesaksian ini saya
                                berbohong.</p>
                            {{-- <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Mengetahui Mgr. Adm & Personalia</td>
                                            <td>:</td>
                                            <td>
                                                @if (empty($ijin_absen->ijin_absen_ttd->signature_manager))
                                                    @if (auth()->user()->departemen == 'HRD' || auth()->user()->departemen == 'Administrator')
                                                        <select name="signature_manager" class="form-control"
                                                            id="">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Approved">Disetujui</option>
                                                            <option value="Rejected">Ditolak</option>
                                                        </select>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                    @endif
                                                @else
                                                    @php
                                                        $explode_signature_manager = explode(
                                                            '|',
                                                            $ijin_absen->ijin_absen_ttd->signature_manager,
                                                        );
                                                        $detail = [
                                                            'signature_manager' =>
                                                                'ID: ' .
                                                                $ijin_absen->id .
                                                                "\n" .
                                                                'Kode Formulir: ' .
                                                                $ijin_absen->no .
                                                                '-' .
                                                                $ijin_absen->created_at->format('Ymd') .
                                                                "\n" .
                                                                'Signature: ' .
                                                                $explode_signature_manager[0] .
                                                                ' (' .
                                                                $explode_signature_manager[1] .
                                                                ')' .
                                                                "\n" .
                                                                'Tanggal Formulir: ' .
                                                                $ijin_absen->created_at->isoFormat('LL'),
                                                        ];
                                                    @endphp
                                                    @if ($explode_signature_manager[2] == 'Approved')
                                                        {!! DNS2D::getBarcodeHTML($detail['signature_manager'], 'QRCODE', 2, 2) !!}
                                                    @elseif($explode_signature_manager[2] == 'Rejected')
                                                        <span class="badge badge-danger">REJECTED</span>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Disetujui PIC/Manager Bagian</td>
                                            <td>:</td>
                                            <td>
                                                @php
                                                    $explode_signature_bersangkutan = explode(
                                                        '|',
                                                        $ijin_absen->ijin_absen_ttd->signature_bersangkutan,
                                                    );
                                                    $detail = [
                                                        'signature_bersangkutan' =>
                                                            'ID: ' .
                                                            $ijin_absen->id .
                                                            "\n" .
                                                            'Kode Formulir: ' .
                                                            $ijin_absen->no .
                                                            '-' .
                                                            $ijin_absen->created_at->format('Ymd') .
                                                            "\n" .
                                                            'Signature: ' .
                                                            $explode_signature_bersangkutan[0] .
                                                            ' (' .
                                                            $explode_signature_bersangkutan[1] .
                                                            ')' .
                                                            "\n" .
                                                            'Tanggal Formulir: ' .
                                                            $ijin_absen->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_signature_bersangkutan[2] == 'Approved')
                                                    {!! DNS2D::getBarcodeHTML($detail['signature_bersangkutan'], 'QRCODE', 2, 2) !!}
                                                @elseif($explode_signature_bersangkutan[2] == 'Rejected')
                                                    <span class="badge badge-danger">REJECTED</span>
                                                @else
                                                    @if ($explode_signature_bersangkutan[1] == auth()->user()->nik || auth()->user()->nik == '000000')
                                                        <select name="signature_bersangkutan" class="form-control"
                                                            id="">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Approved">Disetujui</option>
                                                            <option value="Rejected">Ditolak</option>
                                                        </select>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pemohon</td>
                                            <td>:</td>
                                            <td>
                                                @php
                                                    $detail = [
                                                        'pemohon' =>
                                                            'ID: ' .
                                                            $ijin_absen->id .
                                                            "\n" .
                                                            'Kode Formulir: ' .
                                                            $ijin_absen->no .
                                                            '-' .
                                                            $ijin_absen->created_at->format('Ymd') .
                                                            "\n" .
                                                            'Signature: ' .
                                                            $ijin_absen->nama .
                                                            ' (' .
                                                            $ijin_absen->nik .
                                                            ')' .
                                                            "\n" .
                                                            'Tanggal Formulir: ' .
                                                            $ijin_absen->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                {!! DNS2D::getBarcodeHTML($detail['pemohon'], 'QRCODE', 2, 2) !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div style="color: #000">Mengetahui Mgr. Adm & Personalia</div>
                                        @if (empty($ijin_absen->ijin_absen_ttd->signature_manager))
                                            @if (auth()->user()->departemen == 'HRD' || auth()->user()->departemen == 'Administrator')
                                                <select name="signature_manager" class="form-control"
                                                    id="">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Approved">Disetujui</option>
                                                    <option value="Rejected">Ditolak</option>
                                                </select>
                                            @else
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                                            @endif
                                        @else
                                            @php
                                                $explode_signature_manager = explode(
                                                    '|',
                                                    $ijin_absen->ijin_absen_ttd->signature_manager,
                                                );
                                                $detail = [
                                                    'signature_manager' =>
                                                        'ID: ' .
                                                        $ijin_absen->id .
                                                        "\n" .
                                                        'Kode Formulir: ' .
                                                        $ijin_absen->no .
                                                        '-' .
                                                        $ijin_absen->created_at->format('Ymd') .
                                                        "\n" .
                                                        'Signature: ' .
                                                        $explode_signature_manager[0] .
                                                        ' (' .
                                                        $explode_signature_manager[1] .
                                                        ')' .
                                                        "\n" .
                                                        'Tanggal Formulir: ' .
                                                        $ijin_absen->created_at->isoFormat('LL'),
                                                ];
                                            @endphp
                                            @if ($explode_signature_manager[2] == 'Approved')
                                                {!! DNS2D::getBarcodeHTML($detail['signature_manager'], 'QRCODE', 2, 2) !!}
                                            @elseif($explode_signature_manager[2] == 'Rejected')
                                                <span class="badge badge-danger">REJECTED</span>
                                            @else
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div style="color: #000">Disetujui PIC/Manager Bagian</div>
                                        @php
                                            $explode_signature_bersangkutan = explode(
                                                '|',
                                                $ijin_absen->ijin_absen_ttd->signature_bersangkutan,
                                            );
                                            $detail = [
                                                'signature_bersangkutan' =>
                                                    'ID: ' .
                                                    $ijin_absen->id .
                                                    "\n" .
                                                    'Kode Formulir: ' .
                                                    $ijin_absen->no .
                                                    '-' .
                                                    $ijin_absen->created_at->format('Ymd') .
                                                    "\n" .
                                                    'Signature: ' .
                                                    $explode_signature_bersangkutan[0] .
                                                    ' (' .
                                                    $explode_signature_bersangkutan[1] .
                                                    ')' .
                                                    "\n" .
                                                    'Tanggal Formulir: ' .
                                                    $ijin_absen->created_at->isoFormat('LL'),
                                            ];
                                        @endphp
                                        @if ($explode_signature_bersangkutan[2] == 'Approved')
                                            {!! DNS2D::getBarcodeHTML($detail['signature_bersangkutan'], 'QRCODE', 2, 2) !!}
                                        @elseif($explode_signature_bersangkutan[2] == 'Rejected')
                                            <span class="badge badge-danger">REJECTED</span>
                                        @else
                                            @if ($explode_signature_bersangkutan[1] == auth()->user()->nik || auth()->user()->nik == '000000')
                                                <select name="signature_bersangkutan" class="form-control"
                                                    id="">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Approved">Disetujui</option>
                                                    <option value="Rejected">Ditolak</option>
                                                </select>
                                            @else
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div style="color: #000">Pemohon</div>
                                        @php
                                            $detail = [
                                                'pemohon' =>
                                                    'ID: ' .
                                                    $ijin_absen->id .
                                                    "\n" .
                                                    'Kode Formulir: ' .
                                                    $ijin_absen->no .
                                                    '-' .
                                                    $ijin_absen->created_at->format('Ymd') .
                                                    "\n" .
                                                    'Signature: ' .
                                                    $ijin_absen->nama .
                                                    ' (' .
                                                    $ijin_absen->nik .
                                                    ')' .
                                                    "\n" .
                                                    'Tanggal Formulir: ' .
                                                    $ijin_absen->created_at->isoFormat('LL'),
                                            ];
                                        @endphp
                                        {!! DNS2D::getBarcodeHTML($detail['pemohon'], 'QRCODE', 2, 2) !!}
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary mb-2 me-2" style="text-transform: uppercase"
                                onclick="window.location.href='{{ route('b_ijin_absen') }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                    <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z" />
                                </svg>
                                Back
                            </button>
                            @if (empty($ijin_absen->ijin_absen_ttd->tgl_signature_manager)||
                                empty($ijin_absen->ijin_absen_ttd->tgl_signature_bersangkutan)||
                                empty($ijin_absen->ijin_absen_ttd->tgl_signature_saksi_1)||
                                empty($ijin_absen->ijin_absen_ttd->tgl_signature_saksi_2)
                            )
                                <button type="submit" class="btn btn-info mb-2 me-2" style="text-transform: uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 28 28">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M13 5.828V17h-2V5.828L7.757 9.071L6.343 7.657L12 2l5.657 5.657l-1.414 1.414zM5 19h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2" />
                                    </svg>
                                    Submit
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('b_ijin_absen.b_validasi_simpan', ['id' => $ijin_absen->id]) }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    Swal.fire({
                        icon: 'info',
                        showConfirmButton: false,
                        text: 'Sedang Proses harap tunggu'
                    });
                },
                success: (result) => {
                    if (result.success != false) {
                        // alert(result.message_title+" - "+result.message_content);
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content,
                            showConfirmButton: false,
                        });
                        setTimeout(() => {
                            window.location.href =
                                "{{ route('b_ijin_absen.validasi', ['id' => $ijin_absen->id]) }}";
                        }, 3000);
                    } else {
                        // alert(result.success+" - "+JSON.stringify(result.error));
                        Swal.fire({
                            icon: 'error',
                            title: result.success,
                            text: result.error
                        });
                    }
                },
                error: function(request, status, error) {
                    // alert("Error - "+error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error
                    });
                }
            });
        });
    </script>
@endsection
