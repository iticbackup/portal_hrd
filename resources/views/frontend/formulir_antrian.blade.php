@extends('layouts.frontend.master')
@section('title')
    Formulir Antrian
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">
            <p><b>Note: </b>Formulir ini digunakan untuk keperluan ke <b>Departemen</b> yang bersangkutan.</p>
            <div class="row layout-top-spacing">
                <div class="col-xl-8">
                    <div class="widget-content widget-content-area">
                        <div style="font-weight: bold; text-transform: uppercase; text-align: center">Formulir Antrian</div>
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
                                        <input type="text" name="name" class="form-control" placeholder="Nama"
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
                                        <input type="text" name="bagian" class="form-control" placeholder="Bagian"
                                            readonly id="bagian">
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="mb-3">
                                        <label>Dept. Tujuan</label>
                                        <select name="dept_tujuan" class="form-control" id="">
                                            <option value="">-- Pilih Dept. Tujuan --</option>
                                            <option value="HRD">HRD</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Purchasing">Purchasing</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Corsec">Corsec</option>
                                            <option value="IT">IT</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="mb-3">
                                        <label>Keperluan</label>
                                        <textarea name="keperluan" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mb-2 me-2">Submit</button>
                            <a href="{{ route('frontend') }}" class="btn btn-info mb-2 me-4">Cancel</a>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="widget-content widget-content-area">
                        <div style="font-weight: bold; text-transform: uppercase; text-align: center">Detail Antrian</div>
                        <hr>
                        <div id="detail_antrian"></div>
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
    <script>
        $('#nik').on('change', function() {
            $.ajax({
                type: 'GET',
                url: "{{ url('formulir_antrian/search_nik/') }}" + "/" + $('#nik').val(),
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if (result.success == true) {
                        // $('#edit_id').val(result.data.id);
                        // $('#edit_name').val(result.data.role.name);
                        // // $('#edit_guard_name').val(result.data.guard_name);
                        // var data_permission = result.data.permission;
                        // var txt_data_permission = "";
                        // data_permission.forEach(fungsi_permission);

                        // function fungsi_permission(value, index)
                        // {
                        //     txt_data_permission = txt_data_permission+""
                        // }
                        // $('#edit').modal('show');
                        // alert('nik ok');
                        $('#name').val(result.data.nama);
                        $('#departemen').val(result.data.departemen);
                        $('#bagian').val(result.data.bagian);

                        document.getElementById('detail_antrian').innerHTML =
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

        function edit(id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('roles/') }}" + '/' + id + '',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if (result.success == true) {
                        // $('#edit_id').val(result.data.id);
                        $('#edit_name').val(result.data.role.name);
                        // $('#edit_guard_name').val(result.data.guard_name);
                        var data_permission = result.data.permission;
                        var txt_data_permission = "";
                        data_permission.forEach(fungsi_permission);

                        function fungsi_permission(value, index) {
                            txt_data_permission = txt_data_permission + ""
                        }
                        $('#edit').modal('show');
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
        }

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
                        url: "{{ route('antrian.simpan') }}",
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
                                    text: result.message_content
                                });
                                this.reset();
                                window.location.href="{{ route('frontend') }}";
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
