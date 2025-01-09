@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Workload Analysis</h1>

        @foreach ($courses as $course)
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Course: {{ $course->name }}</h3>
                    <p>{{ $course->description }}</p>
                    <p>{{ $course->status }}</p>
                    <p><strong>PIC:</strong> {{ $course->user->name }}</p>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tugas</th>
                                <th>Assignee</th>
                                <th>Status</th>
                                <th>Durasi (hari)</th>
                                <th>Peak Work Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course->topics as $topic)
                                <tr>
                                    <td>{{ $topic->name }}</td>
                                    <td>Topik PIC</td>
                                    <td>{{ $topic->status }}</td>
                                    <td>--</td>
                                    <td>--</td>
                                </tr>
                                @foreach ($topic->ppts as $ppt)
                                    <tr>
                                        <td>{{ $ppt->name }}</td>
                                        <td>PPT PIC</td>
                                        <td>{{ $ppt->status }}</td>
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
                                            <td>{{ $video->status }}</td>
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
    </div>
@endsection
