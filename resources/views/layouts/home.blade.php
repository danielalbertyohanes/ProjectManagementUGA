@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/home.css') }}">
    <div class="dashboard-container">
        <div class="dashboard-grid">
            <!-- Welcome Card -->
            <div class="dashboard-card welcome-card">
                <h2 class="card-title"><i class="fas fa-user"></i>Selamat Datang, {{ Auth::user()->name }}</h2>
                <p class="card-text">Anda dapat mengelola Course, Topics, dan informasi lainnya di sini.</p>
            </div>

            @if (Auth::user()->position_id == '1')
                <!-- Active Period Card -->
                <div class="dashboard-card period-card">
                    <h2 class="card-title"><i class="fas fa-calendar-alt"></i>Periode Aktif</h2>
                    @if ($periodeAktif)
                        <p class="period-name"><strong>{{ $periodeAktif->name }}</strong></p>
                        <p class="period-date">Dimulai:
                            <strong>{{ \Carbon\Carbon::parse($periodeAktif->start_date)->format('d-m-Y') }}</strong></p>
                        <p class="period-date">Berakhir:
                            <strong>{{ \Carbon\Carbon::parse($periodeAktif->end_date)->format('d-m-Y') }}</strong></p>
                        <p class="period-date">Kurasi:
                            <strong>{{ \Carbon\Carbon::parse($periodeAktif->kurasi_date)->format('d-m-Y') }}</strong></p>
                    @else
                        <p class="no-data">Tidak ada periode aktif saat ini.</p>
                    @endif
                </div>

                <!-- Stats Cards Container -->
                <div class="stats-grid">
                    <!-- Total Users Card -->
                    <div class="dashboard-card users-card">
                        <h2 class="card-title"><i class="fas fa-users"></i>Total Pengguna</h2>
                        <p class="stat-number">{{ $totalPengguna }}</p>
                    </div>

                    <!-- Total Lecturers Card -->
                    <div class="dashboard-card lecturers-card">
                        <h2 class="card-title"><i class="fas fa-chalkboard-teacher"></i>Total Dosen</h2>
                        <p class="stat-number">{{ $totalDosen }}</p>
                    </div>
                </div>
            @endif

            <!-- Bottom Stats Grid -->
            <div class="stats-grid">
                <!-- Today's Date Card -->
                <div class="dashboard-card date-card">
                    <h2 class="card-title"><i class="fas fa-calendar-day"></i>Hari Ini</h2>
                    <p class="stat-number">{{ $hariIni }}</p>
                </div>

                <!-- Unfinished Courses Card -->
                <div class="dashboard-card courses-card">
                    <h2 class="card-title"><i class="fas fa-book"></i>Mata Pelajaran Belum Selesai</h2>
                    @if ($courseBelumSelesai > 0)
                        <p class="stat-number">{{ $courseBelumSelesai }}</p>
                    @else
                        <p class="empty-state">Tidak ada mata pelajaran yang belum selesai.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
