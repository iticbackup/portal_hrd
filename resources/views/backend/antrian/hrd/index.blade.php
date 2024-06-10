@extends('layouts.backend.master')

@section('title')
    Antrian
@endsection

@section('css')
    <link href="{{ asset('assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/light/components/media_object.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dark/components/media_object.css') }}" rel="stylesheet" type="text/css">
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
                    <button class="btn btn-info mb-2 me-4" onclick="antrian_hrd()">Reload</button>
                </div>
            </div>
            <p>Tanggal Hari Ini : {{ \Carbon\Carbon::now()->isoFormat('LLLL') }}</p>
            <div class="row" id="detail_antrian"></div>
            <!-- CONTENT AREA -->
            
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function reload() {
        }

        function antrian_hrd() {
            $.ajax({
                type: 'GET',
                url: "{{ url('antrian/') }}",
                contentType: "application/json;  charset=utf-8",
                cache: false,
                beforeSend: function() {
                    // Swal.fire({
                    //     icon: 'info',
                    //     title: 'Waiting',
                    //     text: 'Sedang Proses Panggilan'
                    // });
                },
                success: (result) => {
                    // if (result.success == true) {
                    //     Swal.fire({
                    //         icon: 'success',
                    //         title: 'Success',
                    //         text: 'Panggilan Telah Terkirim'
                    //     });
                    // } else {

                    // }
                    var antrian = result.data;
                    var txt_antrian = "";

                    if (!antrian.length) {
                        txt_antrian = txt_antrian+'<div class="alert alert-light-primary alert-dismissible fade show border-0 mb-4" role="alert">'+
                                                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>'+
                                                        '<strong>Empty!</strong> Antrian Belum Tersedia.</button>'+
                                                    '</div>';
                    }else{
                        antrian.forEach(data_antrian);
    
                        function data_antrian(value, index)
                        {
                            txt_antrian = txt_antrian+"<div class='col-xl-4 col-lg-12 col-sm-4'>";
                            txt_antrian = txt_antrian+  "<div class='card style-4'>";
                            txt_antrian = txt_antrian+      "<div class='card-body pt-3'>";
                            txt_antrian = txt_antrian+          "<div class='media mt-0 mb-3'>";
                            txt_antrian = txt_antrian+              "<div class=''>";
                            txt_antrian = txt_antrian+                  "<div class='avatar avatar-md avatar-indicators avatar-online me-3'>";
                            txt_antrian = txt_antrian+                      "<img src='{{ asset('assets/img/group.png') }}' class='rounded-circle'>";
                            txt_antrian = txt_antrian+                  "</div>";
                            txt_antrian = txt_antrian+              "</div>";
                            txt_antrian = txt_antrian+              "<div class='media-body'>";
                            txt_antrian = txt_antrian+                  "<h4 class='media-heading mb-0'>"+value.nik+' - '+value.name+"</h4>";
                            txt_antrian = txt_antrian+                  "<p class='media-text'> Departemen : "+value.departemen+"</p>";
                            txt_antrian = txt_antrian+                  "<p class='media-text'> Status : "+value.status+"</p>";
                            txt_antrian = txt_antrian+              "</div>";
                            txt_antrian = txt_antrian+          "</div>";
                            txt_antrian = txt_antrian+          "<p class='card-text mt-0 mb-0'> Nomor Antrian : <span class='badge bg-primary'>"+value.no_urut+"</span></p>";
                            txt_antrian = txt_antrian+          "<p class='card-text mt-0 mb-0'> Keperluan : "+value.keperluan+"</p>";
                            txt_antrian = txt_antrian+      "</div>";
                            txt_antrian = txt_antrian+      "<div class='card-footer'>";
                            txt_antrian = txt_antrian+          "<div class='row'>";
                            txt_antrian = txt_antrian+              "<div class='col-md-4'>";
                            txt_antrian = txt_antrian+                  "<button type='button' class='btn btn-secondary mb-2 me-2 w-100' onclick='panggilan(`"+value.id+"`)'>"+
                                                                        "<svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>"+
                                                                            "<path fill='currentColor' d='M12 12V7.65c0-.11.025-.22.072-.316c.152-.314.5-.428.775-.253l6.86 4.349c.093.059.17.147.221.253c.153.314.054.71-.221.885l-6.86 4.35a.516.516 0 0 1-.277.081c-.315 0-.57-.291-.57-.651zc0 .23-.106.451-.293.57l-6.86 4.35a.516.516 0 0 1-.277.08c-.315 0-.57-.291-.57-.651V7.651c0-.11.025-.22.072-.316c.152-.314.5-.428.775-.253l6.86 4.349c.093.059.17.147.221.253c.049.1.072.209.072.315' />"+
                                                                        "</svg> Panggil"+
                                                                        "</button>";
                            txt_antrian = txt_antrian+              "</div>";
                            txt_antrian = txt_antrian+              "<div class='col-md-4'>";
                            txt_antrian = txt_antrian+                  "<button type='button' class='btn btn-info mb-2 me-2 w-100' onclick='resend_mail(`"+value.id+"`)'>"+
                                                                        "<svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>"+
                                                                            "<path fill='currentColor' d='m13.761 12.01l-10.76-1.084L3 4.074a1.074 1.074 0 0 1 1.554-.96l15.852 7.926a1.074 1.074 0 0 1 0 1.92l-15.85 7.926a1.074 1.074 0 0 1-1.554-.96v-6.852z' />"+
                                                                        "</svg> Resend Email"+
                                                                        "</button>";
                            txt_antrian = txt_antrian+              "</div>";
                            txt_antrian = txt_antrian+              "<div class='col-md-4'>";
                            txt_antrian = txt_antrian+                  "<button type='button' class='btn btn-primary mb-2 me-2 w-100' onclick='detail(`"+value.id+"`)'>"+
                                                                        "<svg xmlns='http://www.w3.org/2000/svg' width='1em' height='1em' viewBox='0 0 28 28'>"+
                                                                            "<path fill='currentColor' fill-rule='evenodd' d='M2 12c.945-4.564 5.063-8 10-8s9.055 3.436 10 8c-.945 4.564-5.063 8-10 8s-9.055-3.436-10-8m10 5a5 5 0 1 0 0-10a5 5 0 0 0 0 10m0-2a3 3 0 1 0 0-6a3 3 0 0 0 0 6' />"+
                                                                        "</svg>Detail"+
                                                                        "</button>";
                            txt_antrian = txt_antrian+              "</div>";
                            txt_antrian = txt_antrian+          "</div>";
                            txt_antrian = txt_antrian+      "</div>";
                            txt_antrian = txt_antrian+  "</div>";
                            txt_antrian = txt_antrian+"</div>";
                        }
                    }

                    document.getElementById('detail_antrian').innerHTML = txt_antrian;
                    console.table(result.data);
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

        antrian_hrd();
    </script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('notification');
        channel.bind('App\\Events\\BackendAntrianNotification', function(data) {
            // alert(JSON.stringify(data));
            // alert('OK');
            antrian_hrd();
            // document.getElementById('no_antrian').innerHTML = data.message;
            // document.getElementById('sisa_antrian_hari_ini').innerHTML = data.sisa_antrian_hari_ini;
            // Swal.fire({
            //     position: "center-middle",
            //     icon: "info",
            //     title: "Nomor Antrian "+data.message,
            //     showConfirmButton: false,
            //     timer: 10000
            // });
        });
    </script>
@endsection
