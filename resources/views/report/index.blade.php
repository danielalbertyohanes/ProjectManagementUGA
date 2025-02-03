@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class=" text-center mb-4 text-black" style="font-size: 3rem;">Workload Analysis</h1>

        @php
            $groupedByPic = $courses->groupBy(function ($course) {
                return $course->user->name;
            });
        @endphp

        <select id="picDropdown" class="form-control mb-4">
            <option value="">Pilih PIC</option>
            @foreach ($groupedByPic as $picName => $groupedCourses)
                <option value="{{ $picName }}">{{ $picName }}</option>
            @endforeach
        </select>
        <div id="coursesContainer">
            @foreach ($groupedByPic as $picName => $groupedCourses)
                <div class="picCourses" id="picCourses-{{ Str::slug($picName) }}" style="display: none;">
                    <h3 class="my-4">{{ $picName }}</h3>

                    @foreach ($groupedCourses as $course)
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
                                            <th>Durasi (hari kerja karyawan)</th>
                                            <th>Peak Work Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course->topics as $topic)
                                            <tr class="table-info">
                                                <td><strong>{{ $topic->name }}</strong></td>
                                                <td>{{ $topic->user->name ?? 'Topik PIC' }}</td>
                                                <td><span
                                                        class="badge {{ $topic->status === 'Finish' ? 'badge-success' : 'badge-warning' }}">{{ $topic->status }}</span>
                                                </td>
                                                <td>--</td>
                                                <td>--</td>
                                            </tr>
                                            @foreach ($topic->subTopics as $subTopic)
                                                @foreach ($subTopic->ppts as $ppt)
                                                    <tr>
                                                        <td>{{ $ppt->name }}</td>
                                                        <td>PPT PIC</td>
                                                        <td><span
                                                                class="badge {{ $ppt->status === 'Finished' ? 'badge-success' : 'badge-warning' }}">{{ $ppt->status }}</span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $started_at = \Carbon\Carbon::parse($ppt->started_at);
                                                                $finished_at = \Carbon\Carbon::parse($ppt->finished_at);
                                                            @endphp
                                                            {{ $finished_at->diffInDays($started_at) }} days
                                                        </td>
                                                        <td>
                                                            {{ $ppt->started_at ? \Carbon\Carbon::parse($ppt->started_at)->format('d-M-Y') : '-' }}
                                                            -
                                                            {{ $ppt->finished_at ? \Carbon\Carbon::parse($ppt->finished_at)->format('d-M-Y') : '-' }}
                                                        </td>
                                                    </tr>
                                                    @foreach ($ppt->videos as $video)
                                                        <tr>
                                                            <td>{{ $video->name }}</td>
                                                            <td>Video PIC</td>
                                                            <td><span
                                                                    class="badge {{ $video->status === 'Edited' ? 'badge-success' : 'badge-warning' }}">{{ $video->status }}</span>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    $started_at = \Carbon\Carbon::parse(
                                                                        $video->started_at,
                                                                    );
                                                                    $finished_at = \Carbon\Carbon::parse(
                                                                        $video->finished_at,
                                                                    );
                                                                @endphp
                                                                {{ $finished_at->diffInDays($started_at) }} days
                                                            </td>
                                                            <td>
                                                                {{ $video->started_at ? \Carbon\Carbon::parse($video->started_at)->format('d-M-Y') : '-' }}
                                                                -
                                                                {{ $video->finished_at ? \Carbon\Carbon::parse($video->finished_at)->format('d-M-Y') : '-' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <script>
        document.getElementById('picDropdown').addEventListener('change', function() {
            // Ambil nilai PIC yang dipilih
            var selectedPic = this.value;

            // Sembunyikan semua div course
            var allPicCourses = document.querySelectorAll('.picCourses');
            allPicCourses.forEach(function(course) {
                course.style.display = 'none';
            });

            // Jika ada PIC yang dipilih, tampilkan div yang sesuai
            if (selectedPic) {
                var picCourses = document.getElementById('picCourses-' + selectedPic.replace(/\s+/g, '-')
                    .toLowerCase());
                if (picCourses) {
                    picCourses.style.display = 'block';
                }
            }
        });
    </script>
