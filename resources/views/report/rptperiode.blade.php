@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <h1 class="text-center mb-4 text-black" style="font-size: 3rem;">Laporan Periode</h1>

        @foreach ($periodes as $key => $periode)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white toggle-header" data-target="#report-{{ $key }}">
                    <h3 class="mb-0">{{ $periode['name'] }}</h3>
                    <p class="mb-0">
                        Periode: {{ \Carbon\Carbon::parse($periode['start_date'])->format('d-m-Y') }} -
                        {{ \Carbon\Carbon::parse($periode['end_date'])->format('d-m-Y') }} |
                        Kurasi: {{ \Carbon\Carbon::parse($periode['kurasi_date'])->format('d-m-Y') }} |
                        Status:
                        <span class="badge {{ $periode['status'] == 'Active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($periode['status']) }}
                        </span>
                    </p>
                </div>
                <div class="card-body" id="report-{{ $key }}" style="display: none;">
                    @if ($periode['open_courses_count'] == 0)
                        <p class="text-center"><b>Belum ada Course yang tercatat pada Periode ini</b></p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Jumlah Course</th>
                                    <th>Total Topik</th>
                                    <th>Total Subtopik</th>
                                    <th>Total PPT</th>
                                    <th>Total Video</th>
                                    <th>Course Publish</th>
                                    <th>Course Belum Publish</th>
                                    <th>Progres (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $periode['open_courses_count'] }}</td>
                                    <td>{{ $periode['total_topics'] }}</td>
                                    <td>{{ $periode['total_subtopics'] }}</td>
                                    <td>{{ $periode['total_ppts'] }}</td>
                                    <td>{{ $periode['total_videos'] }}</td>
                                    <td>{{ $periode['completed_courses'] }}</td>
                                    <td>{{ $periode['not_completed_courses'] }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $periode['progress_percentage'] }}%;"
                                                aria-valuenow="{{ $periode['progress_percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ $periode['progress_percentage'] }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
