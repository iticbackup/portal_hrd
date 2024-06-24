@extends('layouts.frontend.master')
@section('title')
    Formulir Ijin Keluar Masuk
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
            <p><b>Note: </b>Formulir ini digunakan untuk keperluan Ijin Keluar Masuk yang bersangkutan.</p>
            <div class="row layout-top-spacing">
                <div class="col-xl-8">
                    <div class="widget-content widget-content-area">
                        <div style="font-weight: bold; text-transform: uppercase; text-align: center">Formulir Ijin Keluar
                            Masuk</div>
                        <hr>
                        <form method="post" id="form-simpan" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>NIK</label>
                                        <input type="text" name="nik" class="form-control" placeholder="NIK"
                                            id="nik">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama"
                                            readonly id="name">
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            id="email">
                                        <span>* Email ini untuk pemberitahuan notifikasi</span>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Departemen</label>
                                        <input type="text" name="departemen" class="form-control"
                                            placeholder="Departemen" readonly id="departemen">
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" placeholder="Bagian"
                                            readonly id="jabatan">
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Kategori Keperluan</label>
                                        <select name="kategori_keperluan" class="form-control" id="">
                                            <option value="">-- Pilih Kategori Keperluan --</option>
                                            <option value="Pribadi">Pribadi</option>
                                            <option value="Perusahaan">Perusahaan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Mengetahui Manager Bagian</label>
                                        <select name="mengetahui_manager_bagian" class="form-control select2" required id="">
                                            <option value="">-- Pilih Manager Bagian --</option>
                                            @foreach ($biodata_karyawans as $biodata_karyawan)
                                            <option value="{{ $biodata_karyawan->nama.'|'.$biodata_karyawan->nik }}">{{ $biodata_karyawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label>Keperluan</label>
                                        <textarea name="keperluan" class="form-control" id="" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Kendaraan</label>
                                        <input type="text" name="kendaraan" class="form-control" placeholder="Kendaraan"
                                            id="kendaraan">
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Kategori Ijin</label>
                                        <select name="kategori_izin" class="form-control" id="kategori_izin">
                                            <option value="">-- Pilih Kategori Ijin --</option>
                                            <option value="TL">Terlambat</option>
                                            <option value="KL">Keluar Masuk</option>
                                            <option value="PA">Pulang Awal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Jam Kerja</label>
                                        <input type="time" name="jam_kerja" class="form-control" placeholder="Jam Kerja"
                                            id="jam_kerja">
                                        <div>AM : Pukul 00.00 - 12.00</div>
                                        <div>PM : Pukul 12.00 - 23.59</div>
                                    </div>
                                </div>
                                <div class="col-xl-3" id="kategori_all_date"></div>
                                {{-- <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Jam Kerja</label>
                                        <input type="time" name="jam_kerja" class="form-control" placeholder="Jam Kerja"
                                            id="jam_kerja">
                                        <div>AM : Pukul 00.00 - 12.00</div>
                                        <div>PM : Pukul 12.00 - 23.59</div>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Jam Rencana Keluar</label>
                                        <input type="time" name="jam_rencana_keluar" class="form-control"
                                            placeholder="Jam Rencana Keluar" id="jam_rencana_keluar">
                                        <div>AM : Pukul 00.00 - 12.00</div>
                                        <div>PM : Pukul 12.00 - 23.59</div>
                                    </div>
                                </div> --}}
                            </div>
                            <button class="btn btn-primary mb-2 me-2">Submit</button>
                            <a href="{{ route('frontend') }}" class="btn btn-info mb-2 me-4">Cancel</a>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="widget-content widget-content-area">
                        <div style="font-weight: bold; text-transform: uppercase; text-align: center">Detail Ijin Keluar
                            Masuk</div>
                        <hr>
                        <div id="detail_ijin_keluar_masuk"></div>
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

                        document.getElementById('detail_ijin_keluar_masuk').innerHTML =
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

        $(document).ready(function(){
            new TomSelect(".select2",{
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        $('#kategori_izin').on('change', function(){
            if ($('#kategori_izin').val() == 'TL') {
                document.getElementById('kategori_all_date').innerHTML = "<div class='mb-3'>"+
                                                                            "<label>Jam Datang</label>"+
                                                                            "<input type='time' name='jam_datang' class='form-control' placeholder='Jam Datang' id='jam_datang'>"+
                                                                            "<div>AM : Pukul 00.00 - 12.00</div>"+
                                                                            "<div>PM : Pukul 12.00 - 23.59</div>"+
                                                                        "</div>";
            }else if($('#kategori_izin').val() == 'KL'){
                document.getElementById('kategori_all_date').innerHTML = "<div class='mb-3'>"+
                                                                            "<label>Jam Rencana Keluar</label>"+
                                                                            "<input type='time' name='jam_rencana_keluar' class='form-control' placeholder='Jam Rencana Keluar' id='jam_rencana_keluar'>"+
                                                                            "<div>AM : Pukul 00.00 - 12.00</div>"+
                                                                            "<div>PM : Pukul 12.00 - 23.59</div>"+
                                                                        "</div>";
            }else if($('#kategori_izin').val() == 'PA'){
                document.getElementById('kategori_all_date').innerHTML = "<div class='mb-3'>"+
                                                                            "<label>Jam Rencana Keluar</label>"+
                                                                            "<input type='time' name='jam_rencana_keluar' class='form-control' placeholder='Jam Rencana Keluar' id='jam_rencana_keluar'>"+
                                                                            "<div>AM : Pukul 00.00 - 12.00</div>"+
                                                                            "<div>PM : Pukul 12.00 - 23.59</div>"+
                                                                        "</div>";
            }else{
                document.getElementById('kategori_all_date').innerHTML = null;
            }
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
                        url: "{{ route('f.form_ijin_keluar_masuk.simpan') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function(){
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
                                    window.location.href="{{ route('b_ijin_keluar_masuk') }}";
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
