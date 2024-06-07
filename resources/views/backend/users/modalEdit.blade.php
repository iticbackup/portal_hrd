<div class="modal fade" id="edit" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-update" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="edit_generate" id="edit_generate">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="edit_username" class="form-control" placeholder="Name" id="edit_username">
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="edit_name" class="form-control" placeholder="Name" id="edit_name">
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Roles</label>
                        {!! Form::select('edit_roles[]', $roles,[], array('class' => 'form-control','multiple', 'id' => 'edit_roles')) !!}
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