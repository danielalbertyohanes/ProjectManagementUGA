@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-black" style="font-size: 3rem;">Workload Analysis</h1>

        <!-- Filters Row -->
        <div class="row mb-4">
            <div class="col-md-6">
                <select id="periodeDropdown" class="form-control">
                    <option value="">Semua Periode</option>
                    @foreach ($periodes as $periode)
                        <option value="{{ $periode->id }}" {{ $periode->id == $activePeriodeId ? 'selected' : '' }}>
                            {{ $periode->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <select id="picDropdown" class="form-control">
                    <option value="">Semua PIC</option>
                    @foreach ($groupedByPic as $picName => $groupedCourses)
                        <option value="{{ $picName }}">{{ $picName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="coursesContainer">
            @foreach ($groupedByPic as $picName => $groupedCourses)
                <div class="picCourses" id="picCourses-{{ Str::slug($picName) }}" data-pic="{{ $picName }}"
                    data-periode="{{ $groupedCourses->pluck('periode')->flatten()->pluck('id')->unique()->implode(',') }}">
                    <h3 class="my-4">{{ $picName }}</h3>

                    @foreach ($groupedCourses as $course)
                        <div class="card shadow-lg mb-4">
                            <div class="card-header bg-primary text-white">
                                <h3 class="mb-0">{{ $course->name }}</h3>
                                <p class="mb-1"><strong>Deskripsi:</strong> {{ $course->description }}</p>
                                <p class="mb-1"><strong>Status:</strong> {{ ucfirst($course->status) }}</p>
                                <p class="mb-0"><strong>PIC:</strong> {{ $course->user->name }}</p>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Tugas</th>
                                            <th>Tugas</th>
                                            <th>Status</th>
                                            <th>Durasi (hari kerja)</th>
                                            <th>Waktu Puncak Kerja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course->topics as $topic)
                                            <tr class="table-info">
                                                <td><strong>{{ $topic->name }}</strong></td>
                                                <td>Topic</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $topic->status === 'Finish' ? 'badge-success' : 'badge-warning' }}">
                                                        {{ $topic->status }}
                                                    </span>
                                                </td>
                                                <td>--</td>
                                                <td>--</td>
                                            </tr>
                                            @foreach ($topic->subTopics as $subTopic)
                                                @foreach ($subTopic->ppts as $ppt)
                                                    <tr>
                                                        <td>{{ $ppt->name }}</td>
                                                        <td>PPT</td>
                                                        <td>
                                                            <span
                                                                class="badge {{ $ppt->status === 'Finished' ? 'badge-success' : 'badge-warning' }}">
                                                                {{ $ppt->status }}
                                                            </span>
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
                                                            <td>Video</td>
                                                            <td>
                                                                <span
                                                                    class="badge {{ $video->status === 'Edited' ? 'badge-success' : 'badge-warning' }}">
                                                                    {{ $video->status }}
                                                                </span>
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
@endsection
@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const picDropdown = document.getElementById('picDropdown');
            const periodeDropdown = document.getElementById('periodeDropdown');

            function filterCourses() {
                const selectedPIC = picDropdown.value;
                const selectedPeriode = periodeDropdown.value;

                document.querySelectorAll('.picCourses').forEach(container => {
                    const coursePIC = container.dataset.pic;
                    const coursePeriodes = container.dataset.periode.split(',');

                    const picMatch = !selectedPIC || selectedPIC === coursePIC;
                    const periodeMatch = !selectedPeriode || coursePeriodes.includes(selectedPeriode);

                    container.style.display = (picMatch && periodeMatch) ? 'block' : 'none';
                });
            }

            // Initial filter based on active period
            filterCourses();

            // Event listeners
            picDropdown.addEventListener('change', filterCourses);
            periodeDropdown.addEventListener('change', filterCourses);
        });
    </script>
@endsection
