@extends('layouts.backend.master')
@section('title')
    Buat Car Travel Order
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/src/tomSelect/tom-select.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
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
                        <li class="breadcrumb-item"><a href="{{ route('b_cto') }}">Car Travel Order</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <form id="form-simpan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Buat Baru - Car Travel Order</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Tanggal Buat</label>
                                            <input type="date" name="tanggal_buat" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>No. Polisi</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="plat_nomor_1"
                                                    placeholder="N" maxlength="2" style="text-transform:uppercase">
                                                <input type="text" class="form-control" name="plat_nomor_2"
                                                    placeholder="1234" pattern="\d*" maxlength="4">
                                                <input type="text" class="form-control" name="plat_nomor_3"
                                                    placeholder="XX" maxlength="3" style="text-transform:uppercase">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Driver</label>
                                            <select name="driver" class="form-control" id="">
                                                <option value="">-- Pilih Driver --</option>
                                                @foreach ($biodata_karyawans as $biodata_karyawan)
                                                    @if ($biodata_karyawan->satuan_kerja == 21)
                                                        <option value="{{ $biodata_karyawan->id }}">
                                                            {{ $biodata_karyawan->nik . ' - ' . $biodata_karyawan->nama }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Jam Rencana Berangkat</label>
                                            <input type="time" name="jam_berangkat_rencana" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Jam Rencana Datang</label>
                                            <input type="time" name="jam_datang_rencana" class="form-control" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="mb-3">
                                            <div style="font-weight: bold; color: black; font-size: 14pt">Tujuan :</div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rencana</span>
                                            <textarea name="tujuan_rencana" class="form-control" id="" cols="30" rows="5"
                                                placeholder="Tujuan Rencana"></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Aktual</span>
                                            <textarea name="tujuan_aktual" class="form-control" id="" cols="30" rows="5"
                                                placeholder="Tujuan Aktual"></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Keperluan</span>
                                            <textarea name="keperluan" class="form-control" id="" cols="30" rows="5" placeholder="Keperluan"></textarea>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <div style="font-weight: bold; color: black; font-size: 14pt">Penumpang :</div>
                                            <select id="select-beast" name="penumpang[]" placeholder="Pilih Penumpang"
                                                multiple autocomplete="off">
                                                <option value="">-- Pilih Penumpang --</option>
                                                @foreach ($biodata_karyawans as $biodata_karyawan)
                                                    <option value="{{ $biodata_karyawan->nama }}">
                                                        {{ $biodata_karyawan->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="window.location.href='{{ url()->previous() }}'">Back</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('plugins/src/tomSelect/tom-select.base.js') }}"></script>
    <script src="{{ asset('plugins/src/tomSelect/custom-tom-select.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('plugins/src/sweetalerts2/custom-sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        new TomSelect("#select-beast", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        $('#form-simpan').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('b_cto.simpan') }}",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: () => {
                    let timerInterval
                    Swal.fire({
                        title: 'Silahkan Tunggu',
                        html: 'Sedang Dalam Proses.',
                        // timer: 2000,
                        // timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                },
                success: (result) => {
                    if (result.success != false) {
                        Swal.fire({
                            icon: 'success',
                            title: result.message_title,
                            text: result.message_content,
                            showConfirmButton: false,
                        });
                        setTimeout(() => {
                            window.location.href="{{ route('b_cto') }}";
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: result.message_title,
                            text: result.error
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
        });
    </script>
@endsection
