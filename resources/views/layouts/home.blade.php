@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Welcome Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-user"></i> Selamat Datang, {{ Auth::user()->name }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">Selamat datang di halaman ini. Anda dapat mengelola Course, Topics, dan
                            informasi lainnya di sini.</p>
                    </div>
                </div>
                @if (Auth::user()->position_id == '1')
                    <!-- Active Period Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-calendar-alt"></i> Periode Aktif
                        </div>
                        <div class="card-body">
                            @if ($periodeAktif)
                                <p class="card-text">Periode aktif saat ini adalah
                                    <strong>{{ $periodeAktif->name }}</strong>.
                                </p>
                                <p class="card-text">Dimulai pada
                                    <strong>{{ \Carbon\Carbon::parse($periodeAktif->start_date)->format('d-m-Y') }}</strong>.
                                </p>
                                <p class="card-text">Berakhir pada
                                    <strong>{{ \Carbon\Carbon::parse($periodeAktif->end_date)->format('d-m-Y') }}</strong>.
                                </p>
                                <p class="card-text">Kurasi pada
                                    <strong>{{ \Carbon\Carbon::parse($periodeAktif->kurasi_date)->format('d-m-Y') }}</strong>.
                                </p>
                            @else
                                <p class="card-text">Tidak ada Periode yang aktif saat ini.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Total Users and Lecturers Cards -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white">
                                    <i class="fas fa-users"></i> Total Pengguna
                                </div>
                                <div class="card-body">
                                    <p class="card-text display-4">{{ $totalPengguna }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-warning text-white">
                                    <i class="fas fa-chalkboard-teacher"></i> Total Dosen
                                </div>
                                <div class="card-body">
                                    <p class="card-text display-4">{{ $totalDosen }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Today's Date and Unfinished Courses Cards -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-secondary text-white">
                                <i class="fas fa-calendar-day"></i> Hari Ini
                            </div>
                            <div class="card-body">
                                <p class="card-text display-4">{{ $hariIni }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-danger text-white">
                                <i class="fas fa-book"></i> Mata Pelajaran Yang Belum Selesai
                            </div>
                            <div class="card-body">
                                @if ($courseBelumSelesai > 0)
                                    <p class="card-text display-4">{{ $courseBelumSelesai }}</p>
                                @else
                                    <p class="card-text">Saat ini tidak ada mata pelajaran yang belum selesai.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-yhF+o52vps0bIyQ/YNjyz8DbERanw11OvGQHp/JUsV2cv9VjaFCYJTPGa3Mva6ZR07gA/8N2UhuB1I1AGFyDVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
