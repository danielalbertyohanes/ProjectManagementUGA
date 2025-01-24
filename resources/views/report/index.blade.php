@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class=" text-center mb-4 text-black" style="font-size: 3rem;">Workload Analysis</h1>

    @foreach ($courses as $course)
        <div class="card shadow-lg mb-4">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">{{ $course->name }}</h3>
                <p class="mb-1"><strong>Description:</strong> {{ $course->description }}</p>
                <p class="mb-1"><strong>Status:</strong> {{ ucfirst($course->status) }}</p>
                <p class="mb-0"><strong>PIC:</strong> {{ $course->user->name }}</p>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tugas</th>
                            <th>Assignee</th>
                            <th>Status</th>
                            <th>Durasi (hari kerja)</th>
                            <th>Peak Work Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($course->topics as $topic)
                            <tr class="table-info">
                                <td><strong>{{ $topic->name }}</strong></td>
                                <td>Topik PIC</td>
                                <td><span class="badge {{ $topic->status === 'Finished' ? 'badge-success' : 'badge-warning' }}">{{ $topic->status }}</span></td>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            @foreach ($topic->ppts as $ppt)
                                <tr>
                                    <td>{{ $ppt->name }}</td>
                                    <td>PPT PIC</td>
                                    <td><span class="badge {{ $ppt->status === 'Finished' ? 'badge-success' : 'badge-warning' }}">{{ $ppt->status }}</span></td>
                                    <td>
                                        @php
                                            $started_at = \Carbon\Carbon::parse($ppt->started_at);
                                            $finished_at = \Carbon\Carbon::parse($ppt->finished_at);
                                        @endphp
                                        {{ $finished_at->diffInDays($started_at) }} days
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($ppt->started_at)->format('d-M-Y') }} -
                                        {{ \Carbon\Carbon::parse($ppt->finished_at)->format('d-M-Y') }}</td>
                                </tr>
                                @foreach ($ppt->videos as $video)
                                    <tr>
                                        <td>{{ $video->name }}</td>
                                        <td>Video PIC</td>
                                        <td><span class="badge {{ $video->status === 'Finished' ? 'badge-success' : 'badge-warning' }}">{{ $video->status }}</span></td>
                                        <td>
                                            @php
                                                $started_at = \Carbon\Carbon::parse($video->started_at);
                                                $finished_at = \Carbon\Carbon::parse($video->finished_at);
                                            @endphp
                                            {{ $finished_at->diffInDays($started_at) }} days
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($video->started_at)->format('d-M-Y') }} -
                                            {{ \Carbon\Carbon::parse($video->finished_at)->format('d-M-Y') }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div



@endsection
