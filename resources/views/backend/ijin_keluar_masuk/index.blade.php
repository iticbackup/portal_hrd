@extends('layouts.backend.master')

@section('title')
    Ijin Keluar Masuk
@endsection

@section('css')
    <link href="{{ asset('assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @include('backend.ijin_keluar_masuk.input_jam_datang')
    @include('backend.ijin_keluar_masuk.modalDownloadRekap')
    @include('backend.ijin_keluar_masuk.modalDownloadRekapKaryawan')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ijin Keluar masuk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ijin Keluar Masuk</li>
                    </ol>
                </nav>
            </div>

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ...
                                </svg></button>
                            {{ $message }}
                        </div>
                    @endif
                    <button class="btn btn-primary mb-2 me-2" onclick="window.location.href='{{ route('f.form_ijin_keluar_masuk') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                        </svg> Buat Baru
                    </button>
                    <button class="btn btn-info mb-2 me-2" onclick="reload()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 11A8.1 8.1 0 0 0 4.5 9M4 5v4h4m-4 4a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg> Reload
                    </button>
                    @if (auth()->user()->getRoleNames()[0] == 'HRGA Admin' || auth()->user()->getRoleNames()[0] == 'Administrator')
                    <button class="btn btn-info mb-2 me-2" onclick="download_rekap()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                        </svg> Download Rekap
                    </button>
                    <button class="btn btn-secondary mb-2 me-2" onclick="download_rekap_karyawan()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                        </svg> Download Rekap Karyawan
                    </button>
                    @endif
                    <div class="widget-header mt-4">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h5>Ijin Keluar Masuk Pribadi</h5>
                            </div>                 
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-8">
                        <table class="table dt-table-hover" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Kategori Izin</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="widget-header mt-4">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h5>Ijin Keluar Masuk Karyawan Lain</h5>
                            </div>                 
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-8">
                        <table class="table dt-table-hover" id="datatable_karyawan_lain" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Kategori Izin</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- CONTENT AREA -->

        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('b_ijin_keluar_masuk') }}",
            columns: [
                {
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'unit_kerja',
                    name: 'unit_kerja'
                },
                {
                    data: 'kategori_izin',
                    name: 'kategori_izin'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10,
            order: [[1, 'desc']]
        });

        var table_karyawan_lain = $('#datatable_karyawan_lain').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('b_ijin_keluar_masuk.karyawan_lain') }}",
            columns: [
                {
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'unit_kerja',
                    name: 'unit_kerja'
                },
                {
                    data: 'kategori_izin',
                    name: 'kategori_izin'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10,
            order: [[1, 'desc']]
        });

        function reload()
        {
            table.ajax.reload(null,false);
            table_karyawan_lain.ajax.reload(null,false);
        }

        function download_rekap()
        {
            $('#download_rekap').modal('show');
        }

        function download_rekap_karyawan()
        {
            $('#download_rekap_karyawan').modal('show');
        }

        function input_jam_datang(id) {
            $.ajax({
                type:'GET',
                url: "{{ url('ijin_keluar_masuk/') }}"+'/'+id+'/input_jam_datang',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if(result.success == true){
                        $('#detail_jam_datang_id').val(result.data.id);
                        document.getElementById('detail_jam_datang_nik').innerHTML = result.data.nik;
                        document.getElementById('detail_jam_datang_name').innerHTML = result.data.nama;
                        document.getElementById('detail_jam_datang_jabatan').innerHTML = result.data.jabatan;
                        document.getElementById('detail_jam_datang_unit_kerja').innerHTML = result.data.unit_kerja;
                        document.getElementById('detail_jam_datang_jenis_keperluan').innerHTML = result.data.kategori_izin;
                        document.getElementById('detail_jam_datang_keperluan').innerHTML = result.data.keperluan;
                        document.getElementById('detail_jam_datang_jam_kerja').innerHTML = result.data.jam_kerja;
                        document.getElementById('detail_jam_datang_jam_rencana_keluar').innerHTML = result.data.jam_rencana_keluar;
                        if (result.data.jam_datang == null) {
                            document.getElementById('detail_jam_datang_jam_datang').innerHTML = "<input type='time' name='detail_jam_datang' class='form-control'>";
                        }else{
                            document.getElementById('detail_jam_datang_jam_datang').innerHTML = result.data.jam_rencana_keluar;
                        }
                        $('#jam_datang').modal('show');
                    }else{

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
        }

        function resend_mail(id) {
            $.ajax({
                type:'GET',
                url: "{{ url('ijin_keluar_masuk/') }}"+'/'+id+'/resend_mail',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                beforeSend: function(){
                    Swal.fire({
                        icon: 'info',
                        title: 'Waiting',
                        text: 'Sedang Proses',
                        showConfirmButton: false,
                    });
                },
                success: (result) => {
                    if(result.success == true){
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content
                        });
                        table.ajax.reload();
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
        }

        $('#form-update').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('b_ijin_keluar_masuk.b_input_jam_datang_update') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Waiting',
                        text: 'Sedang Proses'
                    });
                },
                success: (result) => {
                    if (result.success != false) {
                        // alert(result.message_title+" - "+result.message_content);
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content
                        });
                        table.ajax.reload();
                        $('#jam_datang').modal('hide');
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
