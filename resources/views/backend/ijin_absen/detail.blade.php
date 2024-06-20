@extends('layouts.backend.master')
@section('title')
    Ijin Absen - {{ $ijin_absen->nama }}
@endsection
@section('css')
    <link href="{{ asset('assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ijin Absen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="mb-3" style="font-weight: bold; font-size: 14pt">Detail Ijin Absen</div>
                        <hr>
                        <p>Yang bertanda tangan di bawah ini :</p>
                        <div class="col-md-3">
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
                        </div>
                        <p>Memohon Ijin untuk tidak masuk kerja pada :</p>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <table class="table">
                                    <tr>
                                        <td>Hari</td>
                                        <td>:</td>
                                        <td>{{ $ijin_absen->hari }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td>{{ \Carbon\Carbon::create($ijin_absen->tgl_mulai)->isoFormat('DD MMMM YYYY') . ' s/d ' . \Carbon\Carbon::create($ijin_absen->tgl_berakhir)->isoFormat('DD MMMM YYYY') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Selama</td>
                                        <td>:</td>
                                        <td>{{ $ijin_absen->selama }} Hari</td>
                                    </tr>
                                    <tr>
                                        <td>Selama</td>
                                        <td>:</td>
                                        <td>{{ $ijin_absen->keperluan }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <p>Kami yang bertanda tangan di bawah ini :</p>
                        <div class="col-md-3">
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
                                        <td>2. Nama Terang</td>
                                        <td>:</td>
                                        <td>{{ $explode_saksi_2[0] . ' (' . $explode_saksi_2[1] . ')' }}</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                        <td>:</td>
                                        <td>{{ $explode_saksi_2[2] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <p>Lampiran :</p>
                        {{-- <p>{{ $ijin_absen->ijin_absen_attachment->attachment }}</p> --}}
                        {{-- <div class="row">
                            @foreach (json_decode($ijin_absen->ijin_absen_attachment->attachment) as $attachment)
                                <div class="col-md-3">
                                    <img src="{{ asset('ijin_absensi/'.$attachment) }}" width="120">
                                </div>
                            @endforeach
                        </div> --}}
                        <ol>
                            @foreach (json_decode($ijin_absen->ijin_absen_attachment->attachment) as $key => $attachment)
                                <li class="mb-3">
                                    <div>
                                        {{ $attachment }}
                                        <div class="modal fade" id="key{{ $key + 1 }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $attachment }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24">
                                                                <path fill="currentColor"
                                                                    d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <img src="{{ asset('ijin_absensi/'.$attachment) }}" width="120">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#key{{ $key + 1 }}" class="btn btn-primary"
                                            data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                height="1em" viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M2 12c.945-4.564 5.063-8 10-8s9.055 3.436 10 8c-.945 4.564-5.063 8-10 8s-9.055-3.436-10-8m10 5a5 5 0 1 0 0-10a5 5 0 0 0 0 10m0-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6" />
                                            </svg> View
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                        <p>*Bersedia bersaksi dan dikenakan sangsi pemotongan bonus, apabila dalam kesaksian ini saya
                            berbohong.</p>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Mengetahui Mgr. Adm & Personalia</td>
                                        <td>:</td>
                                        <td>
                                            @if (empty($ijin_absen->ijin_absen_ttd->signature_manager))
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
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
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Disetujui</td>
                                        <td>:</td>
                                        <td>
                                            @if (empty($ijin_absen->ijin_absen_ttd->signature_bersangkutan))
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
                                            @else
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
                                                @elseif($explode_signature_bersangkutan[2] == 'Waiting')
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
                                    <tr>
                                        <td>Saksi 1</td>
                                        <td>:</td>
                                        <td>
                                            @if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_1))
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
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
                                                @elseif($explode_signature_saksi_1[2] == 'Waiting')
                                                    <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Saksi 2</td>
                                        <td>:</td>
                                        <td>
                                            @if (empty($ijin_absen->ijin_absen_ttd->signature_saksi_2))
                                                <span class="badge badge-warning">Menunggu Persetujuan</span>
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
                                                @elseif($explode_signature_saksi_2[2] == 'Waiting')
                                                    <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <button class="btn btn-secondary mb-2 me-2" style="text-transform: uppercase"
                            onclick="window.location.href='{{ route('b_ijin_absen') }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z" />
                            </svg>
                            Back
                        </button>
                        @if (empty($ijin_absen->ijin_absen_ttd->tgl_signature_manager) ||
                                empty($ijin_absen->ijin_absen_ttd->tgl_signature_bersangkutan) ||
                                empty($ijin_absen->ijin_absen_ttd->tgl_signature_saksi_1) ||
                                empty($ijin_absen->ijin_absen_ttd->tgl_signature_saksi_2))
                            <button class="btn btn-info mb-2 me-2" style="text-transform: uppercase"
                                onclick="window.location.href='{{ route('b_ijin_absen.validasi', ['id' => $ijin_absen->id]) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z" />
                                </svg>
                                Verifikasi
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
