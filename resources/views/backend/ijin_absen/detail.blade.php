@extends('layouts.backend.master')
@section('title')
    Ijin Absen - {{ $ijin_absen->nama }}
@endsection
@section('css')
    <link href="{{ asset('assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/src/glightbox/glightbox.min.css') }}">
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
                                    <div style="color: #000">
                                        {{ \Carbon\Carbon::create($ijin_absen->tgl_mulai)->isoFormat('DD MMMM YYYY') . ' s/d ' . \Carbon\Carbon::create($ijin_absen->tgl_berakhir)->isoFormat('DD MMMM YYYY') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <div>Kategori Izin</div>
                                    <div style="color: #000">
                                        {{ (($ijin_absen->kategori_izin == 'IP' ? 'Ijin Pulang Awal' : $ijin_absen->kategori_izin == 'IS') ? 'Ijin Sakit' : $ijin_absen->kategori_izin == 'CT') ? 'Ijin Cuti' : '-' }}
                                    </div>
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
                                    <div style="color: #000">{{ $explode_saksi_1[0] . ' (' . $explode_saksi_1[1] . ')' }}
                                    </div>
                                    <div>Unit Kerja</div>
                                    <div style="color: #000">{{ $explode_saksi_1[2] }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div>2. Nama Terang</div>
                                    <div style="color: #000">{{ $explode_saksi_2[0] . ' (' . $explode_saksi_2[1] . ')' }}
                                    </div>
                                    <div>Unit Kerja</div>
                                    <div style="color: #000">{{ $explode_saksi_2[2] }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form id="form-attachment" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (!empty($ijin_absen->ijin_absen_attachment->attachment_written_letter))
                                <p>Lampiran Surat Tulis :</p>
                                <div class="row">
                                    @foreach (json_decode($ijin_absen->ijin_absen_attachment->attachment_written_letter) as $key => $attachment_written_letter)
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                                            <a href="{{ asset('ijin_absensi/' . $ijin_absen->nik . '_' . $ijin_absen->no . '-' . $ijin_absen->created_at->format('Ymd') . '/' . $attachment_written_letter) }}"
                                                class="defaultGlightbox glightbox-content">
                                                <img src="{{ asset('ijin_absensi/' . $ijin_absen->nik . '_' . $ijin_absen->no . '-' . $ijin_absen->created_at->format('Ymd') . '/' . $attachment_written_letter) }}"
                                                    class="img-fluid"
                                                    style="width: 300px; height: 300px; object-fit: cover;" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mb-3 badge bg-info">Lampiran Surat Tulis Belum Tersedia</div>
                                @if ($ijin_absen->nik == auth()->user()->nik)
                                    <div class="widget-content widget-content-area mb-3">
                                        <div>Format File Lampiran Surat Tulis (jpg/jpeg, png)</div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div id="formAttachment1">
                                                    <input type="file" name="attachment_written_letter[]"
                                                        class="form-control" multiple>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 mt-3">
                                                    <button type="button" class="btn btn-success add1"
                                                        onclick="add1()"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                d="M13 13v7a1 1 0 0 1-2 0v-7H4a1 1 0 0 1 0-2h7V4a1 1 0 0 1 2 0v7h7a1 1 0 0 1 0 2z" />
                                                        </svg></button>
                                                    <button type="button" class="btn btn-danger remove1"
                                                        onclick="remove1()"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z" />
                                                        </svg></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if (!empty($ijin_absen->ijin_absen_attachment->attachment))
                                <p>Lampiran Swab & Surat Pendukung :</p>
                                <div class="row">
                                    @foreach (json_decode($ijin_absen->ijin_absen_attachment->attachment) as $key => $attachment)
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-4">
                                            <a href="{{ asset('ijin_absensi/' . $ijin_absen->nik . '_' . $ijin_absen->no . '-' . $ijin_absen->created_at->format('Ymd') . '/' . $attachment) }}"
                                                class="defaultGlightbox glightbox-content">
                                                <img src="{{ asset('ijin_absensi/' . $ijin_absen->nik . '_' . $ijin_absen->no . '-' . $ijin_absen->created_at->format('Ymd') . '/' . $attachment) }}"
                                                    class="img-fluid"
                                                    style="width: 300px; height: 300px; object-fit: cover;" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="mb-3 badge bg-info">Lampiran Swab & Surat Pendukung Belum Tersedia</div>
                                @if ($ijin_absen->nik == auth()->user()->nik)
                                    <div class="widget-content widget-content-area mb-3">
                                        <div>Format File Lampiran Swab & Surat Pendukung (jpg/jpeg, png)</div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div id="formAttachment2">
                                                    <input type="file" name="attachment[]" class="form-control"
                                                        multiple>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 mt-3">
                                                    <button type="button" class="btn btn-success add2"
                                                        onclick="add2()"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" fill-rule="evenodd"
                                                                d="M13 13v7a1 1 0 0 1-2 0v-7H4a1 1 0 0 1 0-2h7V4a1 1 0 0 1 2 0v7h7a1 1 0 0 1 0 2z" />
                                                        </svg></button>
                                                    <button type="button" class="btn btn-danger remove2"
                                                        onclick="remove2()"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z" />
                                                        </svg></button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                @endif
                            @endif
                        </form>
                        <p>*Bersedia bersaksi dan dikenakan sangsi pemotongan bonus, apabila dalam kesaksian ini saya
                            berbohong.</p>
                        <div class="row mb-3">
                            <div class="col-md-2 mb-3">
                                <div style="color: #000">Mengetahui Mgr. Adm & Personalia</div>
                                <div>
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
                                            {!! DNS2D::getBarcodePNGPath($detail['signature_manager'], 'QRCODE', 2, 2) !!}
                                        @elseif($explode_signature_manager[2] == 'Rejected')
                                            <span class="badge badge-danger">REJECTED</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div style="color: #000">Disetujui PIC/Manager Bagian</div>
                                <div>
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
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div style="color: #000">Pemohon</div>
                                <div>
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
                            <div class="col-md-2 mb-3">
                                <div style="color: #000">Saksi 1</div>
                                <div>
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
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div style="color: #000">Saksi 2</div>
                                <div>
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
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary mb-2 me-2" style="text-transform: uppercase"
                            onclick="window.location.href='{{ route('b_ijin_absen') }}'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                                <path fill="currentColor" fill-rule="evenodd" d="m15 4l2 2l-6 6l6 6l-2 2l-8-8z" />
                            </svg>
                            Back
                        </button>
                        @can('ijinabsen-verifikasi')
                            @if (empty($ijin_absen->ijin_absen_ttd->tgl_signature_manager) ||
                                    empty($ijin_absen->ijin_absen_ttd->tgl_signature_bersangkutan) ||
                                    empty($ijin_absen->ijin_absen_ttd->tgl_signature_saksi_1) ||
                                    empty($ijin_absen->ijin_absen_ttd->tgl_signature_saksi_2))
                                <button class="btn btn-info mb-2 me-2" style="text-transform: uppercase"
                                    onclick="window.location.href='{{ route('b_ijin_absen.validasi', ['id' => $ijin_absen->id]) }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 28 28">
                                        <path fill="currentColor" fill-rule="evenodd"
                                            d="M5 20h14a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2m-1-5L14 5l3 3L7 18H4zM15 4l2-2l3 3l-2.001 2.001z" />
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
@section('script')
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('plugins/src/glightbox/glightbox.min.js') }}"></script>
    <script src="{{ asset('plugins/src/glightbox/custom-glightbox.min.js') }}"></script>
    <script>
        var formAttachment1 = document.getElementById('formAttachment1');
        var formAttachment2 = document.getElementById('formAttachment2');

        function add1() {
            var newField = document.createElement('input');
            newField.setAttribute('type', 'file');
            newField.setAttribute('name', 'attachment_written_letter[]');
            newField.setAttribute('class', 'form-control mt-2 mb-2');
            formAttachment1.appendChild(newField);
        }

        function remove1() {
            var input_tags = formAttachment1.getElementsByTagName('input');
            if (input_tags.length > 0) {
                formAttachment1.removeChild(input_tags[(input_tags.length) - 1]);
            }
        }

        function add2() {
            var newField = document.createElement('input');
            newField.setAttribute('type', 'file');
            newField.setAttribute('name', 'attachment[]');
            newField.setAttribute('class', 'form-control mt-2 mb-2');
            formAttachment2.appendChild(newField);
        }

        function remove2() {
            var input_tags = formAttachment2.getElementsByTagName('input');
            if (input_tags.length > 0) {
                formAttachment2.removeChild(input_tags[(input_tags.length) - 1]);
            }
        }

        $('#form-attachment').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            Swal.fire({
                title: "Apakah Sudah Sesuai?",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire({
                    // title: "Deleted!",
                    // text: "Your file has been deleted.",
                    // icon: "success"
                    // });
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('b_ijin_absen.attachment_simpan', ['id' => $ijin_absen->id]) }}",
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
                                Swal.fire({
                                    icon: 'success',
                                    title: result.message_title,
                                    text: result.message_content,
                                    showConfirmButton: false,
                                });
                                this.reset();
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: result.message_content
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
                }
            });

        });
    </script>
@endsection
