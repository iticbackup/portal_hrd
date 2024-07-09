@extends('layouts.backend.master')

@section('title')
    Edit Role {{ $role->name }}
@endsection

@section('css')
    
@endsection

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">User Management</a></li>
                    <li class="breadcrumb-item" aria-current="page">Roles</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                {{-- <button class="btn btn-primary mb-2 me-4" onclick="buat()">Create New Role</button>
                <button class="btn btn-info mb-2 me-4" onclick="reload()">Reload</button>
                <div class="widget-content widget-content-area br-8">
                    <table class="table dt-table-hover" id="datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div> --}}
                <form action="{{ route('roles.update',['id' => $role->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="widget-content widget-content-area br-8">
                    <h5>Edit Role {{ $role->name }}</h5>
                    <hr>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $role->name }}">
                        </div> 
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Permission</label>
                            <div class="row">
                                @foreach($custom_permission as $key => $group)
                                <div class="mb-2" style="font-weight: bold">* {{ ucfirst($key) }}</div>
                                    @forelse($group as $permission)
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input {{ $role->permissions->contains('id',$permission->id) ? "checked" : "" }} name="permissions[]" class="rounded-md border" type="checkbox" value="{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </div>
                                    </div>
                                    @empty
                                        {{ __("No permission in this group !") }}
                                    @endforelse
                                @endforeach
                                {{-- @foreach ($permissions as $value)
                                    @php
                                        $explode_permission = explode('-',$value->name);
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'form-check-input']) }}
                                            {{ $value->name }}
                                        </div>
                                    </div>
                                @endforeach --}}
                            </div>
                        </div> 
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mb-2 me-2">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-2 me-4">Cancel</a>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection