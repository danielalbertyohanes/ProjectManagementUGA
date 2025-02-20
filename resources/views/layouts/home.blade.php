@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/home.css') }}">
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Welcome Card -->
            <div class="bg-primary text-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-2 flex items-center"><i class="fas fa-user mr-2"></i>Selamat Datang,
                    {{ Auth::user()->name }}</h2>
                <p>Anda dapat mengelola Course, Topics, dan informasi lainnya di sini.</p>
            </div>

            @if (Auth::user()->position_id == '1')
                <!-- Active Period Card -->
                <div class="bg-[#658DC6] text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-2 flex items-center"><i class="fas fa-calendar-alt mr-2"></i>Periode
                        Aktif</h2>
                    @if ($periodeAktif)
                        <p><strong>{{ $periodeAktif->name }}</strong></p>
                        <p>Dimulai: <strong>{{ \Carbon\Carbon::parse($periodeAktif->start_date)->format('d-m-Y') }}</strong>
                        </p>
                        <p>Berakhir: <strong>{{ \Carbon\Carbon::parse($periodeAktif->end_date)->format('d-m-Y') }}</strong>
                        </p>
                        <p>Kurasi: <strong>{{ \Carbon\Carbon::parse($periodeAktif->kurasi_date)->format('d-m-Y') }}</strong>
                        </p>
                    @else
                        <p>Tidak ada periode aktif saat ini.</p>
                    @endif
                </div>

                <!-- Total Users and Lecturers -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-[#B5C7D3] text-gray-800 p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i class="fas fa-users mr-2"></i>Total
                            Pengguna</h2>
                        <p class="text-4xl font-bold">{{ $totalPengguna }}</p>
                    </div>
                    <div class="bg-[#A58D7F] text-white p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold mb-2 flex items-center"><i
                                class="fas fa-chalkboard-teacher mr-2"></i>Total Dosen</h2>
                        <p class="text-4xl font-bold">{{ $totalDosen }}</p>
                    </div>
                </div>
            @endif

            <!-- Today's Date and Unfinished Courses -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#F3D5AD] text-gray-800 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-2 flex items-center"><i class="fas fa-calendar-day mr-2"></i>Hari
                        Ini</h2>
                    <p class="text-4xl font-bold">{{ $hariIni }}</p>
                </div>
                <div class="bg-[#F5B895] text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-2 flex items-center"><i class="fas fa-book mr-2"></i> Mata Pelajaran
                        Belum Selesai</h2>
                    @if ($courseBelumSelesai > 0)
                        <p class="text-4xl font-bold">{{ $courseBelumSelesai }}</p>
                    @else
                        <p class="text-lg">Tidak ada mata pelajaran yang belum selesai.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
