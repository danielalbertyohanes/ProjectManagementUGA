@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">

    {{-- Header dengan Logo Dikelompokkan di Tengah --}}
    <div class="header bg-blue-900 flex justify-center items-center fixed w-full h-20 top-0">
        <div class="logo-container flex items-center justify-center gap-8">
            <img src="{{ asset('admin/img/ubaya_logos.svg') }}" alt="Ubaya Logo" class="h-12">
            <img src="{{ asset('admin/img/uga_logos.svg') }}" alt="UGA Logo" class="h-12">
            <img src="{{ asset('admin/img/ppkp_logos.svg') }}" alt="PPKP Logo" class="h-12">
            <img src="{{ asset('admin/img/ifubaya_logos.svg') }}" alt="IF Ubaya Logo" class="h-12">
        </div>
    </div>

    {{-- Container Login (Agar Tidak Tertutup Header) --}}
    <div class="container flex justify-center items-center min-h-screen flex-col pt-24">
        <div class="bg-blue-200 rounded-lg shadow-lg p-8 w-96">
            <h1 class="text-xl font-bold text-center mb-4">UGA PROJECT MANAGEMENT</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}"
                        autocomplete="email" autofocus
                        class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 form-control">
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Sign In Button --}}
                <div class="flex justify-center">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 p-4 rounded hover:bg-blue-600">
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
