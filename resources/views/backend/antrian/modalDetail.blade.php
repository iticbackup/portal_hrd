<div class="modal fade" id="detail" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-simpan" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="detail_id" id="detail_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detail_title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="form-group">
                        <label>NIK</label>
                        <div id="detail_nik"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Nama</label>
                        <div id="detail_name"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Departemen</label>
                        <div id="detail_departemen"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Bagian</label>
                        <div id="detail_bagian"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Dept. Tujuan</label>
                        <div id="detail_dept_tujuan"></div>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Keperluan</label>
                        <p id="detail_keperluan" style="word-break: break-all"></p>
                    </div> 
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="detail_status" class="form-control" id="">
                            <option value="">-- Pilih Status --</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Tolak">Tolak</option>
                            <option value="Cancel">Cancel</option>
                        </select>
                    </div> 
                </div>
                {{-- <div class="mb-3">
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
                            </div>
                        @endforeach
                    </div> 
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
    </div>
</div>