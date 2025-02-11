@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4 text-black" style="font-size: 3rem;">Laporan Kerja Karyawan</h1>

        @foreach ($employeeReports as $key => $report)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white toggle-header" data-target="#report-{{ $key }}">
                    <h3 class="mb-0">{{ $report['user']->name }}</h3>
                    <p class="mb-0">
                        Total Courses (PIC): {{ $report['courses_count'] }} |
                        Total Tugas: {{ $report['total_tasks'] }}
                    </p>
                </div>

                <div class="card-body" id="report-{{ $key }}" style="display: none;">

                    <!-- Courses Section -->
                    @if ($report['courses_count'] > 0)
                        <h4 class="mb-3">Courses (PIC)</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Course</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($report['courses'] as $course)
                                        <tr>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->description }}</td>
                                            <td><span
                                                    class="badge bg-{{ $course->status === 'active' ? 'success' : 'warning' }}">
                                                    {{ $course->status }}
                                                </span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada Mata pelajaran</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <!-- PPT Logs Section -->
                    @if ($report['ppt_logs']->count() > 0)
                        <h4 class="mb-3">Aktivitas PPT</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama PPT</th>
                                        <th>Aksi</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($report['ppt_logs'] as $log)
                                        <tr>
                                            <td>{{ $log->ppt->name }}</td>
                                            <td>{{ $log->status }}</td>
                                            <td>{{ ucwords(str_replace('-', ' ', $log->description)) }}</td>
                                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                            <td><span
                                                    class="badge bg-{{ $log->ppt->status === 'Finished' ? 'success' : 'warning' }}">
                                                    {{ $log->ppt->status }}
                                                </span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada Aktivitas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Video Logs Section -->
                    @if ($report['video_logs']->count() > 0)
                        <h4 class="mb-3">Aktivitas Video</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Video</th>
                                        <th>Aksi</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($report['video_logs'] as $log)
                                        <tr>
                                            <td>{{ $log->video->name }}</td>
                                            <td>{{ $log->status }}</td>
                                            <td>{{ ucwords(str_replace('-', ' ', $log->description)) }}</td>
                                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                                            <td><span
                                                    class="badge bg-{{ $log->video->status === 'Edited' ? 'success' : 'warning' }}">
                                                    {{ $log->video->status }}
                                                </span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada Aktivitas</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function() {
            $(".toggle-header").click(function() {
                var target = $(this).data("target");
                $(target).slideToggle(); 
            });
        });
    </script>
@endsection
