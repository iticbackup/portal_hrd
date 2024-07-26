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
                            <div class="col-md-12">
                                <label>Yang bertanda tangan di bawah ini :</label>
                                <div class="table-responsive">
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
                                </div>
                                <hr>
                                <label>Memohon Ijin untuk tidak masuk kerja pada :</label>
                                <div class="table-responsive">
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
                                                    <input type="text" name="selama" class="form-control"
                                                        placeholder="Selama">
                                                    <span class="input-group-text">Hari</span>
                                                </div>
                                                {{-- <input type="text" name="selama" class="form-control" placeholder="Selama"> --}}
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
                                </div>
                                <hr>
                                <label>Kami yang bertanda tangan di bawah ini :</label>
                                <div class="table-responsive">
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
                                                        {{-- <option
                                                            value="{{ $biodata_karyawan->nik }}">
                                                            {{ $biodata_karyawan->nama }}</option> --}}
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
                                </div>
                                <p>*Bersedia bersaksi dan dikenakan sangsi pemotongan bonusm apabila dalam kesaksian ini
                                    saya berbohong.</p>
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
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Kategori Ijin</label>
                                            <select name="kategori_izin" class="form-control" id="kategori_izin">
                                                <option value="">-- Pilih Kategori Ijin --</option>
                                                <option value="CT">Cuti</option>
                                                <option value="IP">Ijin Pribadi</option>
                                                <option value="IS">Ijin Sakit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="kategori_view_ijin" style="display: none">
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
                                </div>
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
                            "<td>" + "Email" + "</td>" +
                            "<td>" + ":" + "</td>" +
                            "<td>" + $('#nik').val() + "</td>" +
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
                        $('#saksi1_unit_kerja').val(result.data.departemen);
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
                        $('#saksi2_unit_kerja').val(result.data.departemen);
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
            if ($('#kategori_izin').val() == 'CT' || $('#kategori_izin').val() == 'IP') {
                document.getElementById('kategori_view_ijin').style.display = 'block';
            }else{
                document.getElementById('kategori_view_ijin').style.display = 'none';
            }
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
