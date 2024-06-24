@extends('layouts.backend.master')

@section('title')
    Antrian
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
    @include('backend.antrian.modalDetail')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Antrian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Antrian</li>
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
                    <button class="btn btn-info mb-2 me-2" onclick="window.location.href='{{ route('antrian') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 28 28">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 11A8.1 8.1 0 0 0 4.5 9M4 5v4h4m-4 4a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg> Buat Baru
                    </button>
                    <button class="btn btn-info mb-2 me-4" onclick="reload()">Reload</button>
                    <div class="widget-content widget-content-area br-8">
                        <table class="table dt-table-hover" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No. Antrian</th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Bagian</th>
                                    <th>Dept. Tujuan</th>
                                    <th>Status</th>
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
            ajax: "{{ route('b_antrian') }}",
            columns: [{
                    data: 'no_urut',
                    name: 'no_urut'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'departemen',
                    name: 'departemen'
                },
                {
                    data: 'bagian',
                    name: 'bagian'
                },
                {
                    data: 'dept_tujuan',
                    name: 'dept_tujuan'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // },
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
            "pageLength": 10
        });

        function reload() {
            table.ajax.reload();
        }

        function detail(id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('antrian/') }}" + '/' + id + '',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                success: (result) => {
                    if (result.success == true) {
                        $('#detail_id').val(result.data.id);
                        document.getElementById('detail_title').innerHTML = 'Antrian '+result.data.no_urut;
                        document.getElementById('detail_nik').innerHTML = result.data.nik;
                        document.getElementById('detail_name').innerHTML = result.data.name;
                        document.getElementById('detail_departemen').innerHTML = result.data.departemen;
                        document.getElementById('detail_bagian').innerHTML = result.data.bagian;
                        document.getElementById('detail_dept_tujuan').innerHTML = result.data.dept_tujuan;
                        document.getElementById('detail_keperluan').innerHTML = result.data.keperluan;
                        $('#detail').modal('show');
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

        function resend_mail(id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('antrian/') }}" + '/' + id + '/' + 'resend_mail',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                beforeSend: function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Waiting',
                        text: 'Sedang Proses Pengiriman'
                    });
                },
                success: (result) => {
                    if (result.success == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email Telah Terkirim'
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
        }
        function panggilan(id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('antrian/') }}" + '/' + id + '/' + 'panggilan',
                contentType: "application/json;  charset=utf-8",
                cache: false,
                beforeSend: function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Waiting',
                        text: 'Sedang Proses Panggilan'
                    });
                },
                success: (result) => {
                    if (result.success == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Panggilan Telah Terkirim'
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
        }

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('b_antrian.detail_update') }}",
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
                        // alert(result.message_title+" - "+result.message_content);
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content
                        });
                        table.ajax.reload();
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
