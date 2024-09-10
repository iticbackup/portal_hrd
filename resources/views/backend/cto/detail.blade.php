@extends('layouts.backend.master')
@section('title')
    Detail Car Travel Order
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('b_cto') }}">Car Travel Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    {{-- <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Detail : {{ $cto->id }}</h4>
                            </div>
                        </div>
                    </div>
                </div> --}}
                    <div class="card">
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-3">
                                Detail : {{ $cto->id }}
                                @switch($cto->status)
                                    @case('Verifikasi')
                                        <span class="badge bg-warning">Menunggu Verifikasi</span>
                                    @break

                                    @case('On Going')
                                        <span class="badge bg-info">On Going</span>
                                    @break

                                    @case('Verified')
                                        <span class="badge bg-success">Verifikasi Berhasil</span>
                                    @break

                                    @case('Rejected')
                                        <span class="badge bg-danger">Gagal Verifikasi</span>
                                    @break

                                    @default
                                @endswitch
                            </h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>ID</div>
                                        <p>{{ $cto->id }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>No. Polisi</div>
                                        <p>{{ explode('-', $cto->no_polisi)[0] . explode('-', $cto->no_polisi)[1] . explode('-', $cto->no_polisi)[2] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Driver</div>
                                        <p>{{ $cto->biodata_karyawan->nama }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Jam Rencana Berangkat</div>
                                        <p>{!! !$cto->jam_berangkat_rencana
                                            ? '<span class="text-danger">Belum Diinput</span>'
                                            : \Carbon\Carbon::create($cto->jam_berangkat_rencana)->format('H:i') !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div>Jam Rencana Datang</div>
                                        <p>{!! !$cto->jam_datang_rencana
                                            ? '<span class="text-danger">Belum Diinput</span>'
                                            : \Carbon\Carbon::create($cto->jam_datang_rencana)->format('H:i') !!}</p>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="mb-3">
                                        <div>Jam Rencana Berangkat Aktual</div>
                                        <p>{!! !$cto->jam_berangkat_aktual ? '<span class="text-danger">Belum Diinput</span>' : $cto->jam_berangkat_aktual !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div>Jam Rencana Datang Aktual</div>
                                        <p>{!! !$cto->jam_datang_aktual ? '<span class="text-danger">Belum Diinput</span>' : $cto->jam_datang_aktual !!}</p>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="mb-3">
                                <div>Tujuan</div>
                                <div style="color: black">Rencana : {!! !$cto->tujuan_rencana ? '<span class="text-danger">Belum Diinput</span>' : $cto->tujuan_rencana !!}</div>
                                <div style="color: black">Aktual : {!! !$cto->tujuan_aktual ? '<span class="text-danger">Belum Diinput</span>' : $cto->tujuan_aktual !!}</div>
                            </div>
                            <div class="mb-3">
                                <div>Keperluan</div>
                                <div style="color: black">{!! !$cto->keperluan ? '<span class="text-danger">Belum Diinput</span>' : $cto->keperluan !!}</div>
                            </div>
                            <div class="mb-3">
                                <div>Penumpang</div>
                                <ul style="color: black">
                                    @foreach (json_decode($cto->penumpang) as $penumpang)
                                        <li>{{ $penumpang }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                            <h6>Tanda Tangan</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2" class="text-center">UMUM</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">TTD</td>
                                            <td class="text-center">DEPT</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                @if (empty($cto->ttd_umum))
                                                    {{-- <select name="verifikasi_hrd" class="form-control" id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Y">Setujui</option>
                                                        <option value="T">Tolak</option>
                                                    </select> --}}
                                                    <span class="text-danger">Belum Diinput</span>
                                                @else
                                                    @php
                                                        $detail = [
                                                            'signature_hrd' =>
                                                                'ID: ' .
                                                                explode('_', $cto->ttd_umum)[3] .
                                                                "\n" .
                                                                'Signature HRD: ' .
                                                                explode('_', $cto->ttd_umum)[0] .
                                                                ' ' .
                                                                explode('_', $cto->ttd_umum)[1] .
                                                                "\n" .
                                                                'Departemen: ' .
                                                                explode('_', $cto->ttd_umum)[2] .
                                                                "\n" .
                                                                'Tanggal Buat: ' .
                                                                \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                                                    'DD MMMM YYYY',
                                                                ),
                                                        ];
                                                    @endphp
                                                    {!! DNS2D::getBarcodeHTML($detail['signature_hrd'], 'QRCODE', 3, 3) !!}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (!empty($cto->ttd_umum))
                                                    {{ explode('_', $cto->ttd_umum)[2] }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2" class="text-center">PEMAKAI</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">TTD</td>
                                            <td class="text-center">DEPT</td>
                                        </tr>
                                        <tr>
                                            {{-- <td>{!! $cto->ttd_pemakai !!}</td> --}}
                                            <td class="text-center">
                                                @php
                                                    $detail = [
                                                        'signature_pemakai' =>
                                                            'ID: ' .
                                                            explode('_', $cto->ttd_pemakai)[3] .
                                                            "\n" .
                                                            'Signature Pemakai: ' .
                                                            explode('_', $cto->ttd_pemakai)[0] .
                                                            ' ' .
                                                            explode('_', $cto->ttd_pemakai)[1] .
                                                            "\n" .
                                                            'Departemen: ' .
                                                            explode('_', $cto->ttd_pemakai)[2] .
                                                            "\n" .
                                                            'Tanggal Buat: ' .
                                                            \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                                                'DD MMMM YYYY',
                                                            ),
                                                    ];
                                                @endphp
                                                {!! DNS2D::getBarcodeHTML($detail['signature_pemakai'], 'QRCODE', 3, 3) !!}
                                            </td>
                                            <td class="text-center">{!! explode('_', $cto->ttd_pemakai)[2] !!}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <h6>Security</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center">JAM</td>
                                        <td class="text-center">KM</td>
                                        <td class="text-center">TTD</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">KELUAR</td>
                                        <td class="text-center">
                                            {!! !$cto->security_jam_keluar
                                                ? '<span class="text-danger">Belum Diinput</span>'
                                                : \Carbon\Carbon::create($cto->security_jam_keluar)->format('H:i') !!}
                                        </td>
                                        <td class="text-center">{!! !$cto->security_km_keluar ? '<span class="text-danger">Belum Diinput</span>' : $cto->security_km_keluar !!}</td>
                                        <td class="text-center">
                                            @if (!empty($cto->security_ttd_keluar))
                                                @php
                                                    $detail = [
                                                        'signature_security_keluar' =>
                                                            'ID: ' .
                                                            explode('_', $cto->security_ttd_keluar)[3] .
                                                            "\n" .
                                                            'Signature Security Keluar: ' .
                                                            explode('_', $cto->security_ttd_keluar)[0] .
                                                            ' ' .
                                                            explode('_', $cto->security_ttd_keluar)[1] .
                                                            "\n" .
                                                            'Departemen: ' .
                                                            explode('_', $cto->security_ttd_keluar)[2] .
                                                            "\n" .
                                                            'Tanggal Buat: ' .
                                                            \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                                                'DD MMMM YYYY',
                                                            ),
                                                    ];
                                                @endphp
                                            @endif
                                            {!! !$cto->security_ttd_keluar
                                                ? '<span class="text-danger">Belum Diinput</span>'
                                                : DNS2D::getBarcodeHTML($detail['signature_security_keluar'], 'QRCODE', 3, 3) !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">MASUK</td>
                                        <td class="text-center">{!! !$cto->security_jam_masuk
                                            ? '<span class="text-danger">Belum Diinput</span>'
                                            : \Carbon\Carbon::create($cto->security_jam_masuk)->format('H:i') !!}</td>
                                        <td class="text-center">{!! !$cto->security_km_masuk ? '<span class="text-danger">Belum Diinput</span>' : $cto->security_km_masuk !!}</td>
                                        <td class="text-center">
                                            @if (!empty($cto->security_ttd_masuk))
                                                @php
                                                    $detail = [
                                                        'signature_security_masuk' =>
                                                            'ID: ' .
                                                            explode('_', $cto->security_ttd_masuk)[3] .
                                                            "\n" .
                                                            'Signature Security Masuk: ' .
                                                            explode('_', $cto->security_ttd_masuk)[0] .
                                                            ' ' .
                                                            explode('_', $cto->security_ttd_masuk)[1] .
                                                            "\n" .
                                                            'Departemen: ' .
                                                            explode('_', $cto->security_ttd_masuk)[2] .
                                                            "\n" .
                                                            'Tanggal Buat: ' .
                                                            \Carbon\Carbon::create($cto->tanggal_buat)->isoFormat(
                                                                'DD MMMM YYYY',
                                                            ),
                                                    ];
                                                @endphp
                                            @endif
                                            {!! !$cto->security_ttd_masuk
                                                ? '<span class="text-danger">Belum Diinput</span>'
                                                : DNS2D::getBarcodeHTML($detail['signature_security_masuk'], 'QRCODE', 3, 3) !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{ route('b_cto') }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                    <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z"></path>
                                </svg>Back</button>
                            @can('cto-verifikasi')
                                @if ($cto->status != 'Verified')
                                    <button type="button" class="btn btn-primary"
                                        onclick="window.location.href='{{ route('b_cto.validasi', ['id' => $cto->id]) }}'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                            viewBox="0 0 28 28">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z">
                                            </path>
                                        </svg>Verifikasi</button>
                                @endif
                            @endcan
                        </div>
                        <div class="card-footer px-4 pt-0 border-0">
                            <span>Tanggal Update : {{ $cto->updated_at->isoFormat('LLLL') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
