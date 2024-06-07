<div class="modal fade" id="buat" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-simpan" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Permission</label>
                        @foreach ($permissions as $permission)
                            <div class="mb-3">
                                {{ Form::checkbox('permission[]', $permission->id, false, ['class' => 'form-check-input']) }}
                                {{ $permission->name }}
                                {{-- <input type="checkbox" name="permission[]" class="form-check-input">
                                {{ $permission->name }} --}}
                            </div>
                        @endforeach
                        {{-- <select name="permission[]" class="form-control" id="">
                            <option value="">-- Select Guard Name --</option>
                            <option value="web">WEB</option>
                            <option value="api">API</option>
                        </select> --}}
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