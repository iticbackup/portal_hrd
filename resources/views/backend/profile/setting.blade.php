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
                    @if (!$user->no_telp)
                    <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M85.57 446.25h340.86a32 32 0 0 0 28.17-47.17L284.18 82.58c-12.09-22.44-44.27-22.44-56.36 0L57.4 399.08a32 32 0 0 0 28.17 47.17" />
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="m250.26 195.39l5.74 122l5.73-121.95a5.74 5.74 0 0 0-5.79-6h0a5.74 5.74 0 0 0-5.68 5.95" />
                            <path fill="currentColor" d="M256 397.25a20 20 0 1 1 20-20a20 20 0 0 1-20 20" />
                        </svg>
                        <strong>Informasi!</strong> Silahkan melengkapi data terlebih dahulu.
                    </div>
                    @endif
                    <div class="user-profile">
                        <div class="widget-content widget-content-area">
                            <form id="form-update" method="post" enctype="multipart/form-data">
                                @csrf
                                <h4>Profile</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" class="form-control mb-3" placeholder="Nama"
                                                value="{{ $user->nik }}" readonly style="color: black">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fullName">Nama</label>
                                            <input type="text" class="form-control mb-3" placeholder="Nama"
                                                value="{{ $user->name }}" readonly style="color: black">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="profession">Departemen</label>
                                            <input type="text" class="form-control mb-3" placeholder="Departemen"
                                                value="{{ $user->departemen }}" readonly style="color: black">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        {{-- <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control mb-3" name="email" placeholder="Email" style="color: black" value="{{ $user->email }}" {{ empty($user->email) ? null : 'readonly' }}>
                                    <span>*Email ini untuk pemberitahuan notifikasi</span>
                                </div> --}}
                                        <div class="form-group">
                                            <label for="no_telp">No. Telepon</label>
                                            <input type="text" name="no_telp" id="no_telp" value="{{ $user->no_telp }}"
                                                {{ $user->no_telp ? 'readonly' : null }} class="form-control"
                                                style="color: black" placeholder="08xxxx">
                                            <span>*Nomor Telepon ini untuk pemberitahuan notifikasi</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control mb-3" name="email" placeholder="Email" style="color: black" value="{{ $user->email }}" {{ empty($user->email) ? null : 'readonly' }}>
                                            <span>*Email ini untuk pemberitahuan notifikasi</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div>Apakah ada perubahan password?</div>
                                            <select id="status_ubah_password" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="Y">Ya</option>
                                                <option value="T">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="row ubah_password" style="display: none">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password">New Password</label>
                                                    <input type="password" class="form-control mb-3" name="password"
                                                        placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cpassword">Konfirmasi Password</label>
                                                    <input type="password" class="form-control mb-3"
                                                        name="password_confirmation" placeholder="Konfirmasi Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-1">
                                        <div class="form-group text-end">
                                            <button class="btn btn-secondary" type="button"
                                                onclick="window.location.href='{{ route('profile') }}'">Back</button>
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
    {{-- <script src="{{ asset('plugins/src/input-mask/jquery.inputmask.bundle.min.js') }}"></script> --}}
    <script>
        // $('#no_telp').inputmask("99-9999-9999-999");

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
                beforeSend: function() {
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
                            window.location.href = "{{ route('profile') }}";
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

        $('#status_ubah_password').on('change', function() {
            if ($('#status_ubah_password').val() == 'Y') {
                document.querySelector('.ubah_password').style.display = 'block';
            } else {
                document.querySelector('.ubah_password').style.display = 'none';
            }
        });
    </script>
@endsection
