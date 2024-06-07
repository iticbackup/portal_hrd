<div class="modal fade" id="edit" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-update" method="post">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="edit_name" class="form-control" placeholder="Access Name" id="edit_name">
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Guard Name</label>
                        <select name="edit_guard_name" class="form-control" id="edit_guard_name">
                            <option value="">-- Select Guard Name --</option>
                            <option value="web">WEB</option>
                            <option value="api">API</option>
                        </select>
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