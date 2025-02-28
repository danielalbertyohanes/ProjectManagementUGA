@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">

    <div class="container">
        <div class="login-wrapper">
            <div class="card">
                <h1 class="title">UGA PROJECT MANAGEMENT</h1>

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" autocomplete="email" autofocus class="form-control">
                        @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group">
                        <label for="password" placeholder="masukkan email">{{ __('Password') }}</label>
                        <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    </div>

                    {{-- Sign In Button --}}
                    <div class="button-wrapper">
                        <button type="submit" class="btn-submit">Sign In</button>
                    </div>

                    {{-- Footer Logos --}}
                    <div class="logo-container">
                        <img src="{{ asset('admin/img/ubaya_logos.svg') }}" class="logo-ubaya" alt="Ubaya Logo">
                        <img src="{{ asset('admin/img/uga_logos.svg') }}" alt="UGA Logo">
                        <img src="{{ asset('admin/img/ppkp_logos.svg') }}" alt="PPKP Logo">
                        <img src="{{ asset('admin/img/ifubaya_logos.svg') }}" alt="IF Ubaya Logo">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
