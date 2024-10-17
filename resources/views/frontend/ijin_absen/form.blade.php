@extends('layouts.frontend.master')
@section('title')
    Formulir Ijin Absen
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/src/tomSelect/tom-select.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/iziToast.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/iziToast.min.css') }}">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .signature-pad {
            border: 1px solid black;
            border-radius: 5px;
            width: 100%;
            height: 200px;
        }

        .signature-pad-form{
            max-width: 200px;
            /* margin: 0 auto; */
        }

        /* .signature-pad-form{
                    max-width: 300px;
                    margin: 0 auto;
                }

                .signature-pad{
                    border: 2px solid black;
                    border-radius: 4px;
                }

                .clear-button{
                    color: black;
                }

                @media (pointer: coarse){
                    body{
                        overflow: hidden;
                    }
                } */
    </style>
@endsection
@section('content')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <p><b>Note: </b>Formulir ini digunakan untuk keperluan Ijin Absen yang bersangkutan.</p>
            <div class="row layout-top-spacing">
                <div class="col-xl-8">
                    <div class="widget-content widget-content-area">
                        <div style="font-weight: bold; text-transform: uppercase; text-align: center">Formulir Ijin Absen
                        </div>
                        <hr>
                        <form method="post" id="form-simpan" enctype="multipart/form-data">
                            @csrf
                            {{-- @include('backend.ijin_absen.modalSignature') --}}
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Yang bertanda tangan di bawah ini :</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>NIK</label>
                                            <input type="text" name="nik" class="form-control" placeholder="NIK"
                                                id="nik"
                                                value="{{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->nik }}"
                                                readonly style="color: black">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Nama Terang</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Nama Terang"
                                                value="{{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->nama }}"
                                                readonly id="name" style="color: black">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                    placeholder="Email" id="email">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Departemen</label>
                                            <input type="text" name="departemen" class="form-control"
                                                placeholder="Departemen"
                                                {{-- value="{{ auth()->user()->biodata_karyawan->departemen }}" --}}
                                                value="{{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->departemen->nama_departemen >= 2 ? auth()->user()->biodata_karyawan->departemen->nama_unit : auth()->user()->biodata_karyawan->departemen->nama_departemen }}"
                                                readonly id="departemen" style="color: black">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Jabatan</label>
                                            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan"
                                                value="{{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->posisi->nama_posisi }}"
                                                readonly id="jabatan" style="color: black">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td><input type="text" name="nik" class="form-control" placeholder="NIK"
                                                    id="nik"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Terang</td>
                                            <td>:</td>
                                            <td><input type="text" name="nama" class="form-control"
                                                    placeholder="Nama Terang" readonly id="name" style="color: black">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><input type="email" name="email" class="form-control"
                                                    placeholder="Email" id="email"></td>
                                        </tr>
                                        <tr>
                                            <td>Departemen</td>
                                            <td>:</td>
                                            <td><input type="text" name="departemen" class="form-control"
                                                    placeholder="Departemen" readonly id="departemen" style="color: black">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td><input type="text" name="jabatan" class="form-control"
                                                    placeholder="Jabatan" readonly id="jabatan" style="color: black"></td>
                                        </tr>
                                    </table>
                                </div> --}}
                                <hr>
                                <label>Memohon Ijin untuk tidak masuk kerja pada :</label>
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Hari</label>
                                            <select name="hari" class="form-control" id="">
                                                <option value="">-- Pilih Hari --</option>
                                                <option value="Senin">Senin</option>
                                                <option value="Selasa">Selasa</option>
                                                <option value="Rabu">Rabu</option>
                                                <option value="Kamis">Kamis</option>
                                                <option value="Jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                                <option value="Minggu">Minggu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Tanggal</label>
                                            <div class="input-group mb-3">
                                                <input type="date" name="tgl_mulai" class="form-control"
                                                    placeholder="Tgl Mulai">
                                                <span class="input-group-text">s/d</span>
                                                <input type="date" name="tgl_berakhir" class="form-control"
                                                    placeholder="Tgl Berakhir">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Selama</label>
                                            <div class="input-group mb-3">
                                                <input type="number" name="selama" class="form-control"
                                                    placeholder="Selama">
                                                <span class="input-group-text">Hari</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Untuk Keperluan</label>
                                            <textarea name="keperluan" class="form-control" id="" cols="30" rows="2"
                                                        placeholder="Untuk Keperluan"></textarea>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Hari</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name="hari" class="form-control"
                                                    placeholder="Hari">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal</td>
                                            <td>:</td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <input type="date" name="tgl_mulai" class="form-control"
                                                        placeholder="Tgl Mulai">
                                                    <span class="input-group-text">s/d</span>
                                                    <input type="date" name="tgl_berakhir" class="form-control"
                                                        placeholder="Tgl Berakhir">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Selama</td>
                                            <td>:</td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <input type="number" name="selama" class="form-control"
                                                        placeholder="Selama">
                                                    <span class="input-group-text">Hari</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Untuk Keperluan</td>
                                            <td>:</td>
                                            <td>
                                                <textarea name="keperluan" class="form-control" id="" cols="30" rows="2"
                                                    placeholder="Untuk Keperluan"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div> --}}
                                <hr>
                                <label>Kami yang bertanda tangan di bawah ini :</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>1. Nama Terang</label>
                                            <select name="saksi_1" class="form-control selectsaksi1" required
                                                id="saksi_1">
                                                <option value="">-- Pilih Saksi 1 --</option>
                                                @foreach ($saksis as $biodata_karyawan)
                                                    <option
                                                        value="{{ $biodata_karyawan->nama . '|' . $biodata_karyawan->nik }}">
                                                        {{ $biodata_karyawan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Unit Kerja Saksi 1</label>
                                            <input type="text" name="saksi1_unit_kerja" class="form-control"
                                                style="color: black" readonly placeholder="Unit Kerja"
                                                id="saksi1_unit_kerja">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>2. Nama Terang</label>
                                            <select name="saksi_2" class="form-control selectsaksi2" required
                                                id="saksi_2">
                                                <option value="">-- Pilih Saksi 2 --</option>
                                                @foreach ($saksis as $biodata_karyawan)
                                                    <option
                                                        value="{{ $biodata_karyawan->nama . '|' . $biodata_karyawan->nik }}">
                                                        {{ $biodata_karyawan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Unit Kerja Saksi 2</label>
                                            <input type="text" name="saksi2_unit_kerja" class="form-control"
                                                style="color: black" readonly placeholder="Unit Kerja"
                                                id="saksi2_unit_kerja">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>1. Nama Terang</td>
                                            <td>:</td>
                                            <td>
                                                <select name="saksi_1" class="form-control selectsaksi1" required
                                                    id="saksi_1">
                                                    <option value="">-- Pilih Saksi 1 --</option>
                                                    @foreach ($saksis as $biodata_karyawan)
                                                        <option
                                                            value="{{ $biodata_karyawan->nama . '|' . $biodata_karyawan->nik }}">
                                                            {{ $biodata_karyawan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                            <td>:</td>
                                            <td><input type="text" name="saksi1_unit_kerja" class="form-control"
                                                    style="color: black" readonly placeholder="Unit Kerja"
                                                    id="saksi1_unit_kerja"></td>
                                        </tr>
                                        <tr>
                                            <td>2. Nama Terang</td>
                                            <td>:</td>
                                            <td>
                                                <select name="saksi_2" class="form-control selectsaksi2" required
                                                    id="saksi_2">
                                                    <option value="">-- Pilih Saksi 2 --</option>
                                                    @foreach ($saksis as $biodata_karyawan)
                                                        <option
                                                            value="{{ $biodata_karyawan->nama . '|' . $biodata_karyawan->nik }}">
                                                            {{ $biodata_karyawan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp; Unit Kerja</td>
                                            <td>:</td>
                                            <td><input type="text" name="saksi2_unit_kerja" class="form-control"
                                                    style="color: black" readonly placeholder="Unit Kerja"
                                                    id="saksi2_unit_kerja"></td>
                                        </tr>
                                    </table>
                                </div> --}}
                                <p>*Bersedia bersaksi dan dikenakan sanksi apabila dalam kesaksian ini saya berbohong.</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Mengetahui Manager Bagian</label>
                                            <select name="mengetahui_manager_bagian" class="form-control select2" required
                                                id="">
                                                <option value="">-- Pilih Manager Bagian --</option>
                                                @foreach ($biodata_karyawans as $biodata_karyawan)
                                                    <option
                                                        value="{{ $biodata_karyawan->nama . '|' . $biodata_karyawan->nik }}">
                                                        {{ $biodata_karyawan->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Kategori Ijin</label>
                                            <select name="kategori_izin" class="form-control" id="kategori_izin">
                                                <option value="">-- Pilih Kategori Ijin --</option>
                                                <option value="CT">Cuti</option>
                                                <option value="IP">Ijin Pribadi</option>
                                                <option value="IS">Ijin Sakit</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                                <hr>
                                {{-- <div id="preview_ijin"></div> --}}
                                <p style="color: black">Malang, {!! \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') !!}</p>
                                <p style="color: black">Kepada Yth. <br> Dept. HRGA PT Indonesian Tobacco Tbk. <br>
                                    ditempat </p>
                                <p>Hal <select name='kategori_izin' style="color: black">
                                        <option>-- Pilih Izin --</option>
                                        <option value='CT'>Cuti</option>
                                        <option value='IP'>Izin Kepentingan Pribadi</option>
                                        <option value='IS'>Izin Sakit</option>
                                    </select>
                                </p>
                                <p style="color: black">Dengan Hormat, </p>
                                <p style="color: black">Saya yang bertanda tangan di bawah ini: </p>
                                <table style="color: black">
                                    <tr>
                                        <td style="color: black">NIK</td>
                                        <td style="color: black">:</td>
                                        <td style="color: black">
                                            {{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->nik }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: black">Nama</td>
                                        <td style="color: black">:</td>
                                        <td style="color: black">
                                            {{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->nama }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: black">Jabatan</td>
                                        <td style="color: black">:</td>
                                        <td style="color: black">
                                            {{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->posisi->nama_posisi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="color: black">Dept.</td>
                                        <td style="color: black">:</td>
                                        <td style="color: black">
                                            {{ !auth()->user()->biodata_karyawan ? null : auth()->user()->biodata_karyawan->departemen->nama_departemen }}
                                        </td>
                                    </tr>
                                </table>
                                <p>
                                    Dengan ini memohon izin untuk tidak masuk kerja pada hari
                                    <select name="hari">
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                    tanggal <input type='date' name='tgl_mulai'> sampai dengan <input type='date'
                                        name='tgl_berakhir'> dengan alasan <input type='text' name='keperluan'>
                                </p>
                                <p>Dengan surat permohonan izin ini saya sampaikan. Atas perhatian dan kerja sama yang
                                    diberikan saya ucapkan terimakasih.</p>
                                <p>Hormat Saya,</p>
                                <div class="signature-pad-form">
                                    <canvas height='100' width='300' id='signature-pad' class='signature-pad'></canvas>
                                </div>
                                <input type="hidden" name="signature_result" id="signature-result">
                                {{-- <button type="button" onclick="$('#modalSignature').modal('show')" class="btn btn-success">Signature</button> --}}
                                <p>
                                    <a href='javascript:void' class='btn btn-sm btn-danger' id='clear'>Clear</a> 
                                    <a href='javascript:void' class='btn btn-sm btn-info' id='undo'>Undo</a>
                                    <a href='javascript:void' class='btn btn-sm btn-success' id='apply'>Apply</a>
                                </p>
                                {{-- <div id="kategori_view_ijin" style="display: none">
                                    <label>*Upload Lampiran Surat Ijin Tertulis:</label>
                                    <span>Format file (jpg/jpeg, png)</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="formAttachmentWrittenLetter">
                                                <input type="file" name="attachment_written_letter[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-3">
                                                <button type="button" class="btn btn-success add" onclick="add()"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor" fill-rule="evenodd"
                                                            d="M13 13v7a1 1 0 0 1-2 0v-7H4a1 1 0 0 1 0-2h7V4a1 1 0 0 1 2 0v7h7a1 1 0 0 1 0 2z" />
                                                    </svg></button>
                                                <button type="button" class="btn btn-danger remove"
                                                    onclick="remove()"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z" />
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div id="kategori_view_ijin" style="display: block">
                                    <label>*Lampiran :</label>
                                    <span>Format file (jpg/jpeg, png)</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="formAttachment">
                                                <input type="file" name="attachment[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 mt-3">
                                                <button type="button" class="btn btn-success add" onclick="add()"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor" fill-rule="evenodd"
                                                            d="M13 13v7a1 1 0 0 1-2 0v-7H4a1 1 0 0 1 0-2h7V4a1 1 0 0 1 2 0v7h7a1 1 0 0 1 0 2z" />
                                                    </svg></button>
                                                <button type="button" class="btn btn-danger remove"
                                                    onclick="remove()"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M4 5h3V4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1h3a1 1 0 0 1 0 2h-1v13a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V7H4a1 1 0 1 1 0-2m3 2v13h10V7zm2-2h6V4H9zm0 4h2v9H9zm4 0h2v9h-2z" />
                                                    </svg></button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary mb-2 me-2">Submit</button>
                                <a href="{{ route('frontend') }}" class="btn btn-info mb-2 me-4">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="widget-content widget-content-area">
                        <div style="font-weight: bold; text-transform: uppercase; text-align: center">Detail Ijin Absen
                        </div>
                        <hr>
                        <div id="detail_ijin_absen"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/src/tomSelect/tom-select.base.js') }}"></script>
    <script src="{{ asset('plugins/src/tomSelect/custom-tom-select.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script src="{{ asset('assets/js/iziToast.js') }}"></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.4/signature_pad.min.js" integrity="sha512-Mtr2f9aMp/TVEdDWcRlcREy9NfgsvXvApdxrm3/gK8lAMWnXrFsYaoW01B5eJhrUpBT7hmIjLeaQe0hnL7Oh1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script>
        var formAttachmentWrittenLetter = document.getElementById('formAttachmentWrittenLetter');

        function add() {
            var newField = document.createElement('input');
            newField.setAttribute('type', 'file');
            newField.setAttribute('name', 'attachment_written_letter[]');
            newField.setAttribute('class', 'form-control');
            formAttachmentWrittenLetter.appendChild(newField);
        }

        function remove() {
            var input_tags = formAttachmentWrittenLetter.getElementsByTagName('input');
            if (input_tags.length > 0) {
                formAttachmentWrittenLetter.removeChild(input_tags[(input_tags.length) - 1]);
            }
        }
    </script>
    <script>
        $(document).ready(function() {

            var canvas = document.getElementById('signature-pad');

            function resizeCanvas() {
                // When zoomed out to less than 100%, for some very strange reason,
                // some browsers report devicePixelRatio as less than 1
                // and only part of the canvas is cleared then.
                // var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                var ratio = Math.max(window.devicePixelRatio);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                // canvas.width = 500;
                // canvas.height = 500;
                canvas.getContext("2d").scale(ratio, ratio);
            }

            window.onresize = resizeCanvas;
            resizeCanvas();

            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
            });

            document.getElementById('clear').addEventListener('click', function() {
                signaturePad.clear();
            });

            document.getElementById('undo').addEventListener('click', function() {
                var data = signaturePad.toData();
                if (data) {
                    data.pop(); // remove the last dot or line
                    signaturePad.fromData(data);
                }
            });

            document.getElementById('apply').addEventListener('click', function() {
                var imageData = signaturePad.toDataURL('image/png');
                $('#signature-result').val(imageData);
                iziToast.success({
                    title: 'Berhasil',
                    message: 'Tanda Tangan Berhasil Diinput',
                    position: 'topRight',
                });
                // $('#signature-img-result').attr('src',"data:"+imageData);
            });

            function getSignaturePad() {
                var imageData = signaturePad.toDataURL('image/png');
                // alert(imageData);
                $('#signature-result').val(imageData);
                // $('#signature-result').attr('src',"data:"+imageData);
                // $('#signature-img-result').attr('src',"data:"+imageData);
            }



            // $('#form-simpan').submit(function() {
            //     getSignaturePad();
            //     return false;
            // });

            // const canvas = document.querySelector('canvas');
            // const form = document.querySelector('.signature-pad-form');
            // const clearButton = document.querySelector('.clear-button');
            // const ctx = canvas.getContext('2d');
            // let writingMode = false;

            // const clearPad = () => {
            //     ctx.clearRect(0,0, canvas.width, canvas.height);
            // }

            // clearButton.addEventListener('click', (event) => {
            //     event.preventDefault();
            //     clearPad();
            // })

            // const getTargetPosition = (event) => {
            //     positionX = event.clientX - event.target.getBoundingClientRect().x;
            //     positionY = event.clientY - event.target.getBoundingClientRect().y;

            //     return [positionX, positionY];
            // }

            // const handlePointerMove = (event) => {
            //     if (!writingMode) return

            //     const [positionX, positionY] = getTargetPosition(event);
            //     ctx.lineTo(positionX,positionY);
            //     ctx.stroke();
            // }

            // const handlePointerUp = () => {
            //     writingMode = false;
            // }

            // const handlePointerDown = (event) => {
            //     writingMode = true;
            //     ctx.beginPath();

            //     const [positionX, positionY] = getTargetPosition(event);
            //     ctx.moveTo(positionX, positionY);
            // }

            // ctx.lineWidth = 3;
            // ctx.lineJoin = ctx.lineCap = 'round';
        });

        $('#nik').on('change', function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('formulir_antrian/search_nik/') }}" + "/" + $('#nik').val(),
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if (result.success == true) {
                        $('#name').val(result.data.nama);
                        $('#departemen').val(result.data.departemen);
                        $('#jabatan').val(result.data.bagian);

                        document.getElementById('detail_ijin_absen').innerHTML =
                            "<table class='table table-responsive table-striped'>" +
                            "<tr>" +
                            "<td>" + "NIK" + "</td>" +
                            "<td>" + ":" + "</td>" +
                            "<td>" + $('#nik').val() + "</td>" +
                            "</tr>" +
                            "<tr>" +
                            "<td>" + "Nama" + "</td>" +
                            "<td>" + ":" + "</td>" +
                            "<td>" + result.data.nama + "</td>" +
                            "</tr>" +
                            "<tr>" +
                            "<td>" + "Departemen" + "</td>" +
                            "<td>" + ":" + "</td>" +
                            "<td>" + result.data.departemen + "</td>" +
                            "</tr>" +
                            "<tr>" +
                            "<td>" + "Bagian" + "</td>" +
                            "<td>" + ":" + "</td>" +
                            "<td>" + result.data.bagian + "</td>" +
                            "</tr>" +
                            "</table>";

                        var txt = "<p>Malang, {!! \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') !!}</p>";
                        txt = txt +
                            "<p>Kepada Yth. <br> Dept. HRGA PT Indonesian Tobacco Tbk. <br> ditempat </p>";
                        // txt = txt+"<div class=input-group input-group-sm mb-3'>";
                        // txt = txt+  "<span class='input-group-text'>Hal</span>";
                        // txt = txt+  "<select><option>-- Pilih Kategori --</option><option value='CT'>Cuti</option><option value='IP'>Izin Kepentingan Pribadi</option><option value='IS'>Izin Sakit</option></select>";
                        // txt = txt+"</div>";
                        txt = txt +
                            "<p>Hal <select name='kategori_izin'><option>-- Pilih Izin --</option><option value='CT'>Cuti</option><option value='IP'>Izin Kepentingan Pribadi</option><option value='IS'>Izin Sakit</option></select></p>";
                        txt = txt + "<p>Dengan Hormat, </p>";
                        txt = txt + "<p>Saya yang bertanda tangan di bawah ini: </p>";
                        txt = txt + "<table>";
                        txt = txt + "<tr>";
                        txt = txt + "<td style='color: black'>NIK</td>";
                        txt = txt + "<td style='color: black'>:</td>";
                        txt = txt + "<td style='color: black'>" + result.data.nik + "</td>";
                        txt = txt + "</tr>";
                        txt = txt + "<tr>";
                        txt = txt + "<td style='color: black'>Nama</td>";
                        txt = txt + "<td style='color: black'>:</td>";
                        txt = txt + "<td style='color: black'>" + result.data.nama + "</td>";
                        txt = txt + "</tr>";
                        txt = txt + "<tr>";
                        txt = txt + "<td style='color: black'>Jabatan</td>";
                        txt = txt + "<td style='color: black'>:</td>";
                        txt = txt + "<td style='color: black'>" + result.data.bagian + "</td>";
                        txt = txt + "</tr>";
                        txt = txt + "<tr>";
                        txt = txt + "<td style='color: black'>Dept.</td>";
                        txt = txt + "<td style='color: black'>:</td>";
                        txt = txt + "<td style='color: black'>" + result.data.departemen + "</td>";
                        txt = txt + "</tr>";
                        txt = txt + "</table>";
                        txt = txt + "<p>";
                        txt = txt + "Dengan ini memohon izin untuk tidak masuk kerja pada hari ";
                        txt = txt + "<select name='hari'>";
                        txt = txt + "<option>-- Pilih Hari --</option>";
                        txt = txt + "<option>Senin</option>";
                        txt = txt + "<option>Selasa</option>";
                        txt = txt + "<option>Rabu</option>";
                        txt = txt + "<option>Kamis</option>";
                        txt = txt + "<option>Jumat</option>";
                        txt = txt + "<option>Sabtu</option>";
                        txt = txt + "<option>Minggu</option>";
                        txt = txt + "</select>";
                        txt = txt + " tanggal ";
                        txt = txt +
                            " <input type='date' name='tgl_mulai'> sampai dengan <input type='date' name='tgl_berakhir'>";
                        txt = txt + " dengan alasan <input type='text' name='keperluan'>";
                        txt = txt + "</p>";
                        txt = txt +
                            "<p>Dengan surat permohonan izin ini saya sampaikan. Atas perhatian dan kerja sama yang diberikan saya ucapkan terimakasih.</p>";
                        txt = txt + "<p>Hormat Saya,</p>";
                        txt = txt +
                            "<canvas height='100' width='300' id='signature-pad' class='signature-pad'></canvas>";
                        txt = txt +
                            "<p><a href='javascript:void' class='btn btn-sm btn-danger' id='clear'>Clear</a> <a href='javascript:void' class='btn btn-sm btn-info' id='undo'>Undo</a></p>";
                        txt = txt + "<p>" + result.data.nik + "</p>";
                        // txt = txt+"<div class=input-group input-group-sm mb-3'>";
                        // txt = txt+  "<span class='input-group-text'>NIK</span>";
                        // txt = txt+  "<input type='text' class='form-control' placeholder='NIK' value="+result.data.nik+" readonly style='color: black'>";
                        // txt = txt+"</div>";
                        // txt = txt+"<div class=input-group input-group-sm mb-3'>";
                        // txt = txt+  "<span class='input-group-text'>Nama</span>";
                        // txt = txt+  "<input type='text' class='form-control' placeholder='Nama' value="+result.data.nama+" readonly style='color: black'>";
                        // txt = txt+"</div>";
                        document.getElementById('preview_ijin').innerHTML = txt;

                        // const canvas = document.querySelector('canvas');
                        // const form = document.querySelector('.signature-pad-form');
                        // const clearButton = document.querySelector('.clear-button');
                        // const ctx = canvas.getContext('2d');
                        // let writingMode = false;

                        // const clearPad = () => {
                        //     ctx.clearRect(0,0, canvas.width, canvas.height);
                        // }

                        // clearButton.addEventListener('click', (event) => {
                        //     event.preventDefault();
                        //     clearPad();
                        // })

                        // const getTargetPosition = (event) => {
                        //     positionX = event.clientX - event.target.getBoundingClientRect().x;
                        //     positionY = event.clientY - event.target.getBoundingClientRect().y;

                        //     return [positionX, positionY];
                        // }

                        // const handlePointerMove = (event) => {
                        //     if (!writingMode) return

                        //     const [positionX, positionY] = getTargetPosition(event);
                        //     ctx.lineTo(positionX,positionY);
                        //     ctx.stroke();
                        // }

                        // const handlePointerUp = () => {
                        //     writingMode = false;
                        // }

                        // const handlePointerDown = (event) => {
                        //     writingMode = true;
                        //     ctx.beginPath();

                        //     const [positionX, positionY] = getTargetPosition(event);
                        //     ctx.moveTo(positionX, positionY);
                        // }

                        // ctx.lineWidth = 3;
                        // ctx.lineJoin = ctx.lineCap = 'round';

                        var canvas = document.getElementById('signature-pad');

                        function resizeCanvas() {
                            // When zoomed out to less than 100%, for some very strange reason,
                            // some browsers report devicePixelRatio as less than 1
                            // and only part of the canvas is cleared then.
                            // var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                            var ratio = Math.max(window.devicePixelRatio);
                            canvas.width = canvas.offsetWidth * ratio;
                            canvas.height = canvas.offsetHeight * ratio;
                            // canvas.width = 500;
                            // canvas.height = 500;
                            canvas.getContext("2d").scale(ratio, ratio);
                        }

                        window.onresize = resizeCanvas;
                        resizeCanvas();

                        var signaturePad = new SignaturePad(canvas, {
                            backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
                        });

                        document.getElementById('clear').addEventListener('click', function() {
                            signaturePad.clear();
                        });

                        document.getElementById('undo').addEventListener('click', function() {
                            var data = signaturePad.toData();
                            if (data) {
                                data.pop(); // remove the last dot or line
                                signaturePad.fromData(data);
                            }
                        });

                        function getSignaturePad() {
                            var imageData = signaturePad.toDataURL('image/png');
                            // alert(imageData);
                            $('#signature-result').val(imageData);
                            // $('#signature-result').attr('src',"data:"+imageData);
                            // $('#signature-img-result').attr('src',"data:"+imageData);
                        }

                        $('#form-simpan').submit(function() {
                            getSignaturePad();
                            return false;
                        });

                    } else {

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

        $('#saksi_1').on('change', function() {
            $.ajax({
                type: 'GET',
                // url: "{{ url('formulir_ijin_absen/search_nik/saksi_1/') }}" + "/" + $('#nik').val(),
                url: "{{ url('formulir_ijin_absen/search_nik/saksi/') }}" + "/" + this.value,
                // url: "{{ url('formulir_ijin_absen/search_nik/saksi_1/') }}",
                contentType: "application/json;  charset=utf-8",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#saksi1_unit_kerja').val('Loading....');
                },
                success: (result) => {
                    if (result.success == true) {
                        $('#saksi1_unit_kerja').val(result.data.bagian);
                    } else {

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

        $('#saksi_2').on('change', function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('formulir_ijin_absen/search_nik/saksi/') }}" + "/" + this.value,
                contentType: "application/json;  charset=utf-8",
                cache: false,
                beforeSend: function() {
                    $('#saksi2_unit_kerja').val('Loading....');
                },
                success: (result) => {
                    if (result.success == true) {
                        $('#saksi2_unit_kerja').val(result.data.bagian);
                    } else {

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

        $('#kategori_izin').on('change', function() {
            // if ($('#kategori_izin').val() == 'CT' || $('#kategori_izin').val() == 'IP') {
            //     document.getElementById('kategori_view_ijin').style.display = 'block';
            // }else{
            //     document.getElementById('kategori_view_ijin').style.display = 'none';
            // }
            var txt = "<p>Malang, {!! \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') !!}</p>";
            txt = txt + "<p>Kepada Yth. <br> Dept. HRGA PT Indonesian Tobacco Tbk. <br> ditempat </p>";
            txt = txt + "<div class=input-group input-group-sm mb-3'>";
            txt = txt + "<span class='input-group-text'>Hal</span>";
            txt = txt +
                "<select class='form-control' aria-describedby='inputGroup-sizing-sm'><option>-- Pilih Kategori --</option><option value='CT'>Cuti</option><option value='IP'>Izin Kepentingan Pribadi</option><option value='IS'>Izin Sakit</option></select>";
            txt = txt + "</div>";
            // txt = txt+"<p>Hal <select class='form-control'><option>-- Pilih Kategori --</option><option value='CT'>Cuti</option><option value='IP'>Izin Kepentingan Pribadi</option><option value='IS'>Izin Sakit</option></select></p>";
            txt = txt + "<p>Dengan Hormat, </p>";
            txt = txt + "<p>Saya yang bertanda tangan di bawah ini: </p>";
            txt = txt + "<div class=input-group input-group-sm mb-3'>";
            txt = txt + "<span class='input-group-text'>NIK</span>";
            txt = txt +
                "<input type='text' class='form-control' placeholder='NIK' value='{!! auth()->user()->nik !!}' readonly style='color: black'>";
            txt = txt + "</div>";
            txt = txt + "<div class=input-group input-group-sm mb-3'>";
            txt = txt + "<span class='input-group-text'>Nama</span>";
            txt = txt + "<input type='text' class='form-control' placeholder='Nama' readonly style='color: black'>";
            txt = txt + "</div>";
            document.getElementById('preview_ijin').innerHTML = txt;
        });

        $(document).ready(function() {
            new TomSelect(".select2", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect(".selectsaksi1", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect(".selectsaksi2", {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        $('#form-simpan').submit(function(e) {
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
                        url: "{{ route('f.form_ijin_absen.simpan') }}",
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
                                    window.location.href =
                                        "{{ route('b_ijin_absen') }}";
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
