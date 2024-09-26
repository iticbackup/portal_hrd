@extends('layouts.frontend.master')
@section('title')
    Update Data Karyawan - Portal HRD
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
                        <li class="breadcrumb-item"><a href="#">Portal HRD</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Data Karyawan</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <h5>Data Karyawan</h5>
                        <hr>
                        <form id="form-simpan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">NIK Karyawan</label>
                            <div class="input-group mb-3">
                                <input type="text" name="nik" class="form-control" style="color: black" id="nik_karyawan"
                                    placeholder="NIK Karyawan">
                                <button type="button" class="btn btn-primary" id="cari_data">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M9.5 3A6.5 6.5 0 0 1 16 9.5c0 1.61-.59 3.09-1.56 4.23l.27.27h.79l5 5l-1.5 1.5l-5-5v-.79l-.27-.27A6.52 6.52 0 0 1 9.5 16A6.5 6.5 0 0 1 3 9.5A6.5 6.5 0 0 1 9.5 3m0 2C7 5 5 7 5 9.5S7 14 9.5 14S14 12 14 9.5S12 5 9.5 5" />
                                    </svg>
                                    Cari Data
                                </button>
                                {{-- <span class="input-group-text" id="basic-addon3">https://example.com/users/</span> --}}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" class="form-control" style="color: black" placeholder="Nama Karyawan" readonly
                                id="nama_karyawan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departemen</label>
                            <input type="text" class="form-control" style="color: black" placeholder="Departemen" readonly id="departemen">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bagian</label>
                            <input type="text" class="form-control" style="color: black" placeholder="Bagian" readonly id="bagian">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" style="color: black" placeholder="Email" id="email">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" onclick="window.location.href='{{ route('frontend') }}'"
                                class="btn btn-secondary">Cancel</button>
                        </div>
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
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.getElementById('cari_data').addEventListener('click', function() {
            // alert($('#nik_karyawan').val());
            $.ajax({
                type:'GET',
                url: "{{ url('update_data_karyawan/search_nik/') }}"+"/"+$('#nik_karyawan').val(),
                contentType: "application/json;  charset=utf-8",
                cache: false,
                beforeSend: function(){
                    Swal.fire({
                        icon: 'info',
                        title: 'Waiting',
                        text: 'Sedang Pencarian Data',
                        showConfirmButton: false,
                    });
                },
                success: (result) => {
                    // console.table(result.data);
                    if(result.success == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'NIK Karyawan '+result.data.nik+' Berhasil Ditemukan',
                        });
                        
                        document.getElementById('nik_karyawan').readOnly = true;
                        
                        if (result.data.email != null) {
                            document.getElementById('email').readOnly = true;
                        }

                        $('#nama_karyawan').val(result.data.name);
                        $('#departemen').val(result.data.departemen);
                        $('#bagian').val(result.data.bagian);
                        $('#email').val(result.data.email);
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: result.success,
                            text: result.error
                        });
                    }
                },
                error: function (request, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error
                    });
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
                confirmButtonText: "Ya"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('frontend.database_karyawan.update') }}",
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
                                        "{{ route('frontend') }}";
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
