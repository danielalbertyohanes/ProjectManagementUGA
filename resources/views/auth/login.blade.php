@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #3b5998; /* Blue background */
        }
    </style>
    <div class="container">
        <div class="flex justify-center items-center min-h-screen">
            <div class="bg-blue-200 rounded-lg shadow-lg p-8 w-96">
                <h1 class="text-xl font-bold text-center mb-4">UGA PROJECT MANAGEMENT</h1>

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" autocomplete="email" autofocus class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                        <input type="password" type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- Sign In Button --}}
                    <div class="flex justify-center">
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 p-4 rounded hover:bg-blue-600">Sign In</button>
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
