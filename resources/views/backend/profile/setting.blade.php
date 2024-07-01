@extends('layouts.backend.master')
@section('title')
    Setting Profile
@endsection
@section('css')
<link href="{{ asset('assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/light/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/dark/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="row layout-spacing ">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                <div class="user-profile">
                    <div class="widget-content widget-content-area">
                        <form id="form-update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullName">Nama</label>
                                    <input type="text" class="form-control mb-3" placeholder="Nama" value="{{ $user->name }}" readonly style="color: black">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profession">Departemen</label>
                                    <input type="text" class="form-control mb-3" placeholder="Departemen" value="{{ $user->departemen }}" readonly style="color: black">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control mb-3" name="email" placeholder="Email" style="color: black" value="{{ $user->email }}" {{ empty($user->email) ? null : 'readonly' }}>
                                    <span>*Email ini untuk pemberitahuan notifikasi</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control mb-3" name="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cpassword">Konfirmasi Password</label>
                                    <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="Konfirmasi Password">
                                </div>
                            </div>

                            <div class="col-md-12 mt-1">
                                <div class="form-group text-end">
                                    <button class="btn btn-secondary" onclick="window.location.href='{{ route('profile') }}'">Back</button>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script>
        $('#form-update').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('profile.update') }}",
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
                            text: result.message_content,
                            showConfirmButton: false,
                        });
                        setTimeout(() => {
                            window.location.href="{{ route('profile') }}";
                        }, 3000);
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