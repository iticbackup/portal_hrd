@extends('layouts.backend.master')
@section('title')
    Validasi Ijin Keluar Masuk
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
                        <li class="breadcrumb-item"><a href="#">Ijin Keluar Masuk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Validasi</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="mb-3">Validasi Ijin Keluar Masuk</div>
                        <form id="form-simpan" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <table class="table">
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Nama
                                        </td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">
                                            {{ $ijin_keluar_masuk->nama . ' (' . $ijin_keluar_masuk->nik . ')' }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Jabatan</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jabatan }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Unit
                                            Kerja</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->unit_kerja }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jenis
                                            Keperluan</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kategori_keperluan }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Keperluan</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->keperluan }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Kendaraan</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->kendaraan }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam
                                            Kerja</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_kerja }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam
                                            Rencana Keluar</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_rencana_keluar }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">Jam
                                            Datang</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">{{ $ijin_keluar_masuk->jam_datang }}</td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Pemohon</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">
                                            @php
                                                $detail = [
                                                    'identifier' =>
                                                        'ID: ' .
                                                        $ijin_keluar_masuk->id .
                                                        "\n" .
                                                        'Kode Formulir: ' .
                                                        $ijin_keluar_masuk->no .
                                                        '-' .
                                                        $ijin_keluar_masuk->created_at->format('Ymd') .
                                                        "\n" .
                                                        'Signature: ' .
                                                        $ijin_keluar_masuk->nama .
                                                        ' (' .
                                                        $ijin_keluar_masuk->nik .
                                                        ')' .
                                                        "\n" .
                                                        'Tanggal Formulir: ' .
                                                        $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                ];
                                            @endphp
                                            {!! DNS2D::getBarcodeHTML($detail['identifier'], 'QRCODE', 2, 2) !!}
                                        </td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Mengetahui PIC/Manager Bagian</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">
                                            @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager))
                                                <div>-</div>
                                            @else
                                                @php
                                                    $explode_validasi_manager_bagian = explode(
                                                        '|',
                                                        $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager,
                                                    );
                                                    $detail_manager_bagian = [
                                                        'identifier' =>
                                                            'ID: ' .
                                                            $ijin_keluar_masuk->id .
                                                            "\n" .
                                                            'Kode Formulir: ' .
                                                            $ijin_keluar_masuk->no .
                                                            '-' .
                                                            $ijin_keluar_masuk->created_at->format('Ymd') .
                                                            "\n" .
                                                            'Signature: ' .
                                                            $explode_validasi_manager_bagian[0] .
                                                            ' (' .
                                                            $explode_validasi_manager_bagian[1] .
                                                            ') ' .
                                                            "\n" .
                                                            'Status Signature: ' .
                                                            $explode_validasi_manager_bagian[2] .
                                                            "\n" .
                                                            'Signature Date: ' .
                                                            $ijin_keluar_masuk->ijin_keluar_masuk_ttd
                                                                ->tgl_signature_manager .
                                                            "\n" .
                                                            'Tanggal Formulir: ' .
                                                            $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_validasi_manager_bagian[2] == 'Approved')
                                                    {!! DNS2D::getBarcodeHTML($detail_manager_bagian['identifier'], 'QRCODE', 2, 2) !!}
                                                @elseif ($explode_validasi_manager_bagian[2] == 'Rejected')
                                                    <div>REJECTED</div>
                                                @elseif ($explode_validasi_manager_bagian[2] == 'Waiting')
                                                    @if (auth()->user()->nik == $explode_validasi_manager_bagian[1] || auth()->user()->nik == '0000000')
                                                        <select name="status_validasi_manager" class="form-control"
                                                            id="">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Approved">Setuju</option>
                                                            <option value="Rejected">Tolak</option>
                                                        </select>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Mengetahui Personalia</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">
                                            @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia))
                                                {{-- <div>-</div> --}}
                                                {{-- @if (auth()->user()->departemen == 'HRD' || auth()->user()->departemen == 'Administrator') --}}
                                                @if (auth()->user()->getRoleNames()[0] == 'HRGA Admin' || auth()->user()->getRoleNames()[0] == 'Administrator')
                                                    <select name="status_validasi_personalia" class="form-control"
                                                        id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Approved">Setuju</option>
                                                        <option value="Rejected">Tolak</option>
                                                    </select>
                                                @else
                                                    <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                @endif
                                            @else
                                                @php
                                                    $explode_validasi_personalia = explode(
                                                        '|',
                                                        $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia,
                                                    );
                                                    $detail_personalia = [
                                                        'identifier' =>
                                                            'ID: ' .
                                                            $ijin_keluar_masuk->id .
                                                            "\n" .
                                                            'Kode Formulir: ' .
                                                            $ijin_keluar_masuk->no .
                                                            '-' .
                                                            $ijin_keluar_masuk->created_at->format('Ymd') .
                                                            "\n" .
                                                            'Signature: ' .
                                                            $explode_validasi_personalia[0] .
                                                            ' (' .
                                                            $explode_validasi_personalia[1] .
                                                            ') ' .
                                                            "\n" .
                                                            'Status Signature: ' .
                                                            $explode_validasi_personalia[2] .
                                                            "\n" .
                                                            'Signature Date: ' .
                                                            $ijin_keluar_masuk->ijin_keluar_masuk_ttd
                                                                ->tgl_signature_personalia .
                                                            "\n" .
                                                            'Tanggal Formulir: ' .
                                                            $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_validasi_personalia[2] == 'Approved')
                                                    {!! DNS2D::getBarcodeHTML($detail_personalia['identifier'], 'QRCODE', 2, 2) !!}
                                                @elseif ($explode_validasi_personalia[2] == 'Rejected')
                                                    <div>REJECTED</div>
                                                @elseif ($explode_validasi_personalia[2] == 'Waiting')
                                                    {{-- @if (auth()->user()->departemen == 'HRD' || auth()->user()->departemen == 'Administrator') --}}
                                                    @if (auth()->user()->getRoleNames()[0] == 'HRGA Admin' || auth()->user()->getRoleNames()[0] == 'Administrator')
                                                        <select name="status_validasi_personalia" class="form-control"
                                                            id="">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Approved">Setuju</option>
                                                            <option value="Rejected">Tolak</option>
                                                        </select>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr style="border: 0px solid black;">
                                        <td style="border: 0px solid black; text-transform: uppercase; font-weight: bold">
                                            Mengetahui Ka. Kend / Satpam</td>
                                        <td style="border: 0px solid black;">:</td>
                                        <td style="border: 0px solid black;">
                                            @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam))
                                                {{-- @if (auth()->user()->departemen == 'Satpam' || auth()->user()->departemen == 'Administrator') --}}
                                                @if (auth()->user()->getRoleNames()[0] == 'Satpam' || auth()->user()->getRoleNames()[0] == 'Administrator')
                                                    <select name="status_validasi_kend_satpam" class="form-control"
                                                        id="">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Approved">Setuju</option>
                                                        <option value="Rejected">Tolak</option>
                                                    </select>
                                                @else
                                                    <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                @endif
                                            @else
                                                @php
                                                    $explode_validasi_kend_satpam = explode(
                                                        '|',
                                                        $ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam,
                                                    );
                                                    $detail_kend_satpam = [
                                                        'identifier' =>
                                                            'ID: ' .
                                                            $ijin_keluar_masuk->id .
                                                            "\n" .
                                                            'Kode Formulir: ' .
                                                            $ijin_keluar_masuk->no .
                                                            '-' .
                                                            $ijin_keluar_masuk->created_at->format('Ymd') .
                                                            "\n" .
                                                            'Signature: ' .
                                                            $explode_validasi_kend_satpam[0] .
                                                            ' (' .
                                                            $explode_validasi_kend_satpam[1] .
                                                            ') ' .
                                                            "\n" .
                                                            'Status Signature: ' .
                                                            $explode_validasi_kend_satpam[2] .
                                                            "\n" .
                                                            'Signature Date: ' .
                                                            $ijin_keluar_masuk->ijin_keluar_masuk_ttd
                                                                ->tgl_signature_kend_satpam .
                                                            "\n" .
                                                            'Tanggal Formulir: ' .
                                                            $ijin_keluar_masuk->created_at->isoFormat('LL'),
                                                    ];
                                                @endphp
                                                @if ($explode_validasi_kend_satpam[2] == 'Approved')
                                                    {!! DNS2D::getBarcodeHTML($detail_kend_satpam['identifier'], 'QRCODE', 2, 2) !!}
                                                @elseif ($explode_validasi_kend_satpam[2] == 'Rejected')
                                                    <div>REJECTED</div>
                                                @elseif ($explode_validasi_kend_satpam[2] == 'Waiting')
                                                    @if (auth()->user()->getRoleNames()[0] == 'Satpam' || auth()->user()->getRoleNames()[0] == 'Administrator')
                                                        <select name="status_validasi_kend_satpam" class="form-control"
                                                            id="">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Approved">Setuju</option>
                                                            <option value="Rejected">Tolak</option>
                                                        </select>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu Persetujuan</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <button type="button" class="btn btn-secondary mb-2 me-2" style="text-transform: uppercase"
                                onclick="window.location.href='{{ route('b_ijin_keluar_masuk.detail',['id' => $ijin_keluar_masuk->id]) }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 28 28">
                                    <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z" />
                                </svg>
                                Back
                            </button>
                            {{-- @if (empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_manager)||empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_personalia)||empty($ijin_keluar_masuk->ijin_keluar_masuk_ttd->signature_kend_satpam))
                            @endif --}}
                            <button type="submit" class="btn btn-info mb-2 me-2" style="text-transform: uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    viewBox="0 0 28 28">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M13 5.828V17h-2V5.828L7.757 9.071L6.343 7.657L12 2l5.657 5.657l-1.414 1.414zM5 19h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2" />
                                </svg>
                                Submit
                            </button>
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
                url: "{{ route('b_ijin_keluar_masuk.b_validasi_simpan', ['id' => $ijin_keluar_masuk->id]) }}",
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
                            window.location.href="{{ route('b_ijin_keluar_masuk.b_validasi', ['id' => $ijin_keluar_masuk->id]) }}";
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
