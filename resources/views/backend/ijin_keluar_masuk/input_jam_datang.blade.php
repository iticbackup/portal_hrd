<div class="modal fade" id="jam_datang" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-update" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="detail_jam_datang_id" id="detail_jam_datang_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Jam Datang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label>NIK</label>
                        <div id="detail_jam_datang_nik"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Nama</label>
                        <div id="detail_jam_datang_name"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <div id="detail_jam_datang_jabatan"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Unit Kerja</label>
                        <div id="detail_jam_datang_unit_kerja"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Jenis Keperluan</label>
                        <div id="detail_jam_datang_jenis_keperluan"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Keperluan</label>
                        <p id="detail_jam_datang_keperluan"></p>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Jam Kerja</label>
                        <div id="detail_jam_datang_jam_kerja"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Jam Rencana Keluar</label>
                        <div id="detail_jam_datang_jam_rencana_keluar"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Jam Datang</label>
                        <div id="detail_jam_datang_jam_datang"></div>
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