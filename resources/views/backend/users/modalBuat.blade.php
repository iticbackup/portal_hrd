<div class="modal fade" id="buat" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-simpan" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Name">
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Departemen</label>
                        <select name="departemen" class="form-control" id="">
                            <option value="">-- Pilih Departemen --</option>
                            <option value="HRD">HRD</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Purchasing">Purchasing</option>
                            <option value="Finance">Finance</option>
                            <option value="Corsec">Corsec</option>
                            <option value="IT">IT</option>
                        </select>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Roles</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
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