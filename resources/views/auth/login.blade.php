@extends('layouts.app')

@section('content')
<<<<<<< Updated upstream
<div class="container">
=======
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">

    <div class="container">
        <div class="login-wrapper">
            <div class="card">
                <h1 class="title">UGA PROJECT MANAGEMENT</h1>
>>>>>>> Stashed changes

    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card text-white" style="border-radius: 1rem; background-color: blue;">

<<<<<<< Updated upstream
                <div class="card-body">
                <div class="card-header center custom-bg-color" style="text-align: center; margin-bottom: 20px;">
                        {{ __('Login') }}
=======
                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" autocomplete="email" autofocus class="form-control">
                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
>>>>>>> Stashed changes
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

<<<<<<< Updated upstream
                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

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

                        <div class="center" style="text-align: center;">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <button type="register" class="btn btn-primary">
                                    
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                                </button>
                            </div>
                        </div>
                </div>
=======
                    {{-- Password --}}
                    <div class="form-group">
                        <label for="password" placeholder="masukkan email">{{ __('Password') }}</label>
                        <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Sign In Button --}}
                    <div class="button-wrapper">
                        <button type="submit" class="btn-submit">Sign In</button>
                    </div>

                    {{-- Footer Logos --}}
                    <div class="logo-container">
                        <img src="{{ asset('admin/img/ubaya_logos.svg') }}" alt="Ubaya Logo">
                        <img src="{{ asset('admin/img/uga_logos.svg') }}" alt="UGA Logo">
                        <img src="{{ asset('admin/img/ppkp_logos.svg') }}" alt="PPKP Logo">
                        <img src="{{ asset('admin/img/ifubaya_logos.svg') }}" alt="IF Ubaya Logo">
                    </div>
                </form>
>>>>>>> Stashed changes
            </div>
        </div>
    </div>
    <!-- <div class="row justify-content-center">
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

                    {{-- Footer Logos --}}
                    <div class="mt-6 flex justify-center space-x-4">
                        <img src="admin/img/uga_logos.svg" alt="UGA Logo">
                        <img src="admin/img/ppkp_logos.svg" alt="PPKP Logo">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
