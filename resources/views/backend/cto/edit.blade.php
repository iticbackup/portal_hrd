@extends('layouts.backend.master')
@section('title')
    Edit Car Travel Order
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
                        <li class="breadcrumb-item active" aria-current="page">Edit - {{ $cto->id }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <form id="form-update" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Edit - Car Travel Order</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Tanggal Buat</label>
                                            <input type="date" name="tanggal_buat" class="form-control" value="{{ $cto->tanggal_buat }}" id="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>No. Polisi</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="plat_nomor_1"
                                                    placeholder="N" maxlength="2" style="text-transform:uppercase" value="{{ explode('-',$cto->no_polisi)[0] }}">
                                                <input type="text" class="form-control" name="plat_nomor_2"
                                                    placeholder="1234" pattern="\d*" maxlength="4" value="{{ explode('-',$cto->no_polisi)[1] }}">
                                                <input type="text" class="form-control" name="plat_nomor_3"
                                                    placeholder="XX" maxlength="3" style="text-transform:uppercase" value="{{ explode('-',$cto->no_polisi)[2] }}">
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
                                                        <option value="{{ $biodata_karyawan->id }}" {{ $cto->driver_id == $biodata_karyawan->id ? 'selected' : null }}>
                                                            {{ $biodata_karyawan->nik . ' - ' . $biodata_karyawan->nama }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
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
                                                placeholder="Tujuan Rencana">{{ $cto->tujuan_rencana }}</textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Aktual</span>
                                            <textarea name="tujuan_aktual" class="form-control" id="" cols="30" rows="5"
                                                placeholder="Tujuan Aktual">{{ $cto->tujuan_aktual }}</textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Keperluan</span>
                                            <textarea name="keperluan" class="form-control" id="" cols="30" rows="5" placeholder="Keperluan">{{ $cto->keperluan }}</textarea>
                                        </div>
                                        <hr>
                                        <div class="mb-3">
                                            <div style="font-weight: bold; color: black; font-size: 14pt">Penumpang :</div>
                                            <p>Apakah ada perubahan untuk penumpang ?</p>
                                            <select name="perubahan_penumpang" class="form-control mb-3" id="kategori_penumpang">
                                                <option value="">-- Pilih Opsi --</option>
                                                <option value="Y">Ya</option>
                                                <option value="T">Tidak</option>
                                            </select>
                                            <div style="display: none" id="display_penumpang">
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
                                        </div>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="window.location.href='{{ url()->previous() }}'">Back</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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

        $('#kategori_penumpang').on('change', function(){
            if ($('#kategori_penumpang').val() == 'Y') {
                document.getElementById('display_penumpang').style.display = 'block';
            }else{
                document.getElementById('display_penumpang').style.display = 'none';
            }
        });

        $('#form-update').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $('#image-input-error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ route('b_cto.update',['id' => $cto->id]) }}",
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
                            window.location.href="{{ route('b_cto.detail',['id' => $cto->id]) }}";
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: result.success,
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
