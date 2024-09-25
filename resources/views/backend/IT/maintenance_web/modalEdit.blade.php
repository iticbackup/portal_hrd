<div class="modal fade" id="modalEdit" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-update" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="edit_name" class="form-control" id="edit_name" placeholder="Name">
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Mode</label>
                                <select name="edit_mode" class="form-control" id="edit_mode">
                                    <option value="">-- Pilih Mode --</option>
                                    <option value="up">Selesai Maintenance</option>
                                    <option value="down">Maintenance</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="edit_status" class="form-control" id="edit_status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </form>
    </div>
</div>