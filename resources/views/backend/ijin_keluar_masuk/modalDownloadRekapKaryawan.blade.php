<div class="modal fade" id="download_rekap_karyawan" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="get" action="{{ route('b_ijin_keluar_masuk.b_download_rekap_karyawan') }}" enctype="multipart/form-data" target="_blank">
        {{-- @csrf --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download Rekap Karyawan Ijin Keluar Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Mulai Tanggal</label>
                                <input type="date" name="rekap_karyawan_mulai_tanggal" class="form-control">
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="rekap_karyawan_sampai_tanggal" class="form-control">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>