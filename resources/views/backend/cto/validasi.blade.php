@extends('layouts.backend.master')
@section('title')
    Validasi Car Travel Order
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/src/tomSelect/tom-select.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
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
                        <li class="breadcrumb-item"><a href="{{ route('b_cto') }}">Car Travel Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Validasi {{ $cto->id }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <form id="form-validasi" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body pt-3">
                                <h5 class="card-title mb-3">Validasi : {{ $cto->id }}</h5>
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
                                                ? '<input type="time" name="jam_berangkat_rencana" class="form-control">'
                                                : $cto->jam_berangkat_rencana !!}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <div>Jam Rencana Datang</div>
                                            <p>{!! !$cto->jam_datang_rencana
                                                ? '<input type="time" name="jam_datang_rencana" class="form-control">'
                                                : $cto->jam_datang_rencana !!}</p>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                    <div class="mb-3">
                                        <div>Jam Rencana Berangkat Aktual</div>
                                        <p>{!! !$cto->jam_berangkat_aktual ? '<input type="time" name="jam_berangkat_aktual" class="form-control">' : $cto->jam_berangkat_aktual !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div>Jam Rencana Datang Aktual</div>
                                        <p>{!! !$cto->jam_datang_aktual ? '<input type="time" name="jam_datang_aktual" class="form-control">' : $cto->jam_datang_aktual !!}</p>
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
                                                        @if (auth()->user()->getRoleNames()[0] == 'Administrator' || auth()->user()->getRoleNames()[0] == 'HRGA Admin')
                                                        <select name="verifikasi_hrd" class="form-control" id="">
                                                            <option value="">-- Pilih Status --</option>
                                                            <option value="Y">Setujui</option>
                                                            <option value="T">Tolak</option>
                                                        </select>
                                                        @else
                                                        <span class="text-danger">Belum Diinput</span>
                                                        @endif
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
                                                                    \Carbon\Carbon::create(
                                                                        $cto->tanggal_buat,
                                                                    )->isoFormat('DD MMMM YYYY'),
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
                                @if (auth()->user()->getRoleNames()[0] == 'Administrator' || auth()->user()->getRoleNames()[0] == 'Satpam')
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
                                            <td class="text-center">{!! !$cto->security_jam_keluar
                                                ? '<input type="time" name="security_jam_keluar" class="form-control">'
                                                : $cto->security_jam_keluar !!}</td>
                                            <td class="text-center">{!! !$cto->security_km_keluar
                                                ? '<input type="text" name="security_km_keluar" class="form-control text-center" placeholder="KM">'
                                                : $cto->security_km_keluar !!}</td>
                                            <td class="text-center">{!! !$cto->security_ttd_keluar ? '<span>Tanda Tangan Otomatis</span>' : $cto->security_ttd_keluar !!}</td>
                                        </tr>
                                        @if (!empty($cto->security_ttd_keluar))
                                            <tr>
                                                <td class="text-center">MASUK</td>
                                                <td class="text-center">{!! !$cto->security_jam_masuk
                                                    ? '<input type="time" name="security_jam_masuk" class="form-control">'
                                                    : $cto->security_jam_masuk !!}</td>
                                                <td class="text-center">{!! !$cto->security_km_masuk
                                                    ? '<input type="text" name="security_km_masuk" class="form-control text-center" placeholder="KM">'
                                                    : $cto->security_km_masuk !!}</td>
                                                <td class="text-center">{!! !$cto->security_ttd_masuk ? '<span>Tanda Tangan Otomatis</span>' : $cto->security_ttd_masuk !!}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td class="text-center">MASUK</td>
                                                <td class="text-center">{!! !$cto->security_jam_masuk
                                                    ? '<span class="text-danger">Menunggu Input Keluar</span>'
                                                    : $cto->security_jam_masuk !!}</td>
                                                <td class="text-center">{!! !$cto->security_km_masuk
                                                    ? '<span class="text-danger">Menunggu Input Keluar</span>'
                                                    : $cto->security_km_masuk !!}</td>
                                                <td class="text-center">{!! !$cto->security_ttd_masuk ? '<span>Tanda Tangan Otomatis</span>' : $cto->security_ttd_masuk !!}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                @endif
                                <button type="button" class="btn btn-secondary"
                                    onclick="window.location.href='{{ url()->previous() }}'">Back</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('plugins/src/tomSelect/tom-select.base.js') }}"></script>
    <script src="{{ asset('plugins/src/tomSelect/custom-tom-select.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $('#form-validasi').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('b_cto.validasi_simpan',['id' => $cto->id]) }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    let timerInterval
                    Swal.fire({
                        title: 'Silahkan Tunggu',
                        html: 'Sedang Dalam Proses.',
                        // timer: 2000,
                        // timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                },
                success: (result) => {
                    if (result.success != false) {
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content,
                            showConfirmButton: false,
                        });
                        setTimeout(() => {
                            window.location.href="{{ route('b_cto.detail',['id' => $cto->id]) }}";
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: result.success,
                            text: result.error
                        });
                    }
                },
                error: function(request, status, error) {
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
