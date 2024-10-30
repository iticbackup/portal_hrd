{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.auth.master')

@section('title')
    Login Portal Antrian
@endsection

@section('content')
    <div class="auth-container d-flex">
        <div class="container mx-auto align-self-center">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                        <div class="card mt-3 mb-3">
                            <div class="card-body">
                                {{-- @if ($errors->any() && $retries > 0)
                                <div class="alert alert-arrow-right alert-icon-right alert-light-warning mb-4" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                            <path stroke-dasharray="64" stroke-dashoffset="64"
                                                d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s"
                                                    values="64;0" />
                                            </path>
                                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M12 7v6">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s"
                                                    dur="0.2s" values="8;0" />
                                            </path>
                                            <path stroke-dasharray="2" stroke-dashoffset="2" d="M12 17v0.01">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s"
                                                    dur="0.2s" values="2;0" />
                                            </path>
                                        </g>
                                    </svg>
                                    <strong>Warning!</strong> Remaining {{ $retries }} attempt.
                                </div>
                                @endif --}}
                                {{-- @if ($retries <= 0)
                                <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                            <path stroke-dasharray="64" stroke-dashoffset="64"
                                                d="M12 3c4.97 0 9 4.03 9 9c0 4.97 -4.03 9 -9 9c-4.97 0 -9 -4.03 -9 -9c0 -4.97 4.03 -9 9 -9Z">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s"
                                                    values="64;0" />
                                            </path>
                                            <path stroke-dasharray="8" stroke-dashoffset="8" d="M12 7v6">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s"
                                                    dur="0.2s" values="8;0" />
                                            </path>
                                            <path stroke-dasharray="2" stroke-dashoffset="2" d="M12 17v0.01">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.8s"
                                                    dur="0.2s" values="2;0" />
                                            </path>
                                        </g>
                                    </svg>
                                    <strong>Expired!</strong> Please try again after {{ $seconds }} seconds.
                                </div>
                                @endif --}}
                                <div class="row">
                                    <div class="col-md-12 mb-3 text-center">
                                        <h2>Login Portal HRD</h2>
                                        <p>Enter your NIK & Password to Login</p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">NIK</label>
                                            <input type="text" name="nik" class="form-control" placeholder="NIK"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check form-check-primary form-check-inline">
                                                <input class="form-check-input me-3" type="checkbox"
                                                    id="form-check-default">
                                                <label class="form-check-label" for="form-check-default">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-4">
                                            <button type="submit" class="btn btn-secondary w-100">
                                                SIGN IN
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
