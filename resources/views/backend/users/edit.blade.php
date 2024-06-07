@extends('layouts.backend.master')
@section('title')
    Users
@endsection
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">User Management</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ...
                            </svg></button>
                        {{ $message }}
                    </div>
                @elseif($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ...
                            </svg></button>
                        {{ $message }}
                    </div>
                @endif
                <div class="widget-content widget-content-area br-8">
                    <form action="{{ route('user.update',['generate' => $user->id_generate]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $user->username }}" id="edit_username">
                        </div> 
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}" id="edit_name">
                        </div> 
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Roles</label>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        </div> 
                    </div>
                    <button type="submit" class="btn btn-success mb-2 me-2">Update</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-2 me-2">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
