@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <img src="admin/img/uga_logos.svg" alt="UGA Logo">
        <img src="admin/img/ppkp_logos.svg" alt="PPKP Logo">
        <h1 class="display-4">Oops! Halaman Tidak Ditemukan.</h1>
        <p class="lead">Halaman yang Anda cari tidak tersedia.</p>

        @if (Auth::check())
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Kembali</a>
        @endif

    </div>
@endsection
