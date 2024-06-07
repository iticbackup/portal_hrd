@extends('layouts.backend.master')

@section('title')
    Roles
@endsection

@section('css')
    <link href="{{ asset('assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/src/table/datatable/datatables.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/dark/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('plugins/src/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/light/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')
    @include('backend.roles.modalBuat')
    @include('backend.roles.modalEdit')
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">

            <!-- BREADCRUMB -->
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">User Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
            <!-- /BREADCRUMB -->

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        {{ $message }}
                    </div>
                    @endif
                    <button class="btn btn-primary mb-2 me-4" onclick="buat()">Create New Role</button>
                    <button class="btn btn-info mb-2 me-4" onclick="reload()">Reload</button>
                    <div class="widget-content widget-content-area br-8">
                        <table class="table dt-table-hover" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
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
    {{-- <script src="{{ asset('plugins/src/notification/snackbar/snackbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/components/notification/custom-snackbar.js') }}"></script> --}}
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
            ajax: "{{ route('roles.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                // {
                //     data: 'guard_name',
                //     name: 'guard_name'
                // },
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
            "pageLength": 10
        });

        function buat() {
            $('#buat').modal('show');
        }

        function reload() {
            table.ajax.reload();
        }

        // function edit(id) {
        //     $.ajax({
        //         type:'GET',
        //         url: "{{ url('roles/') }}"+'/'+id+'',
        //         contentType: "application/json;  charset=utf-8",
        //         cache: false,
        //         success: (result) => {
        //             if(result.success == true){
        //                 // $('#edit_id').val(result.data.id);
        //                 $('#edit_name').val(result.data.role.name);
        //                 // $('#edit_guard_name').val(result.data.guard_name);
        //                 var data_permission = result.data.permission;
        //                 var txt_data_permission = "";
        //                 data_permission.forEach(fungsi_permission);

        //                 function fungsi_permission(value, index)
        //                 {
        //                     txt_data_permission = txt_data_permission+""
        //                 }
        //                 $('#edit').modal('show');
        //             }else{

        //             }
        //         },
        //         error: function (request, status, error) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Error',
        //                 text: error
        //             });
        //         }
        //     });
        // }

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('roles.store') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (result) => {
                    if (result.success != false) {
                        // alert(result.message_title+" - "+result.message_content);
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content
                        });
                        table.ajax.reload();
                        $('#buat').modal('hide');
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
