@extends('layouts.admin')

@section('content')
    <style>
        .panduan-links a {
            display: block;
            margin-bottom: 10px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group input {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">COURSE</h1>
        {{-- ini harus di tambah dan di ubah lagi --}}
        <p>Master Course adalah modul yang digunakan untuk mendefinisikan dan mengelola informasi terkait kursus atau mata
            pelajaran.</p>
        <br>
        @if ($links->isNotEmpty())
            <p>Dibawah ini adalah Link yang bisa di akses: </p>
            <div class="panduan-links">
                @foreach ($links as $link)
                    <a href="{{ $link->url }}">{{ $link->name }}</a>
                @endforeach
            </div>
        @endif


        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateCourse"
                onclick="loadCreateForm()">+ New Course</button>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>

                <div class="input-group" style="max-width: 300px;">
                    <form action="{{ route('course.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" id="form1" class="form-control" placeholder="Search"
                            aria-label="Search" />
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Course</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Jumlah_video</th>
                                <th class="text-center">Dosen</th>
                                <th class="text-center">Pic_course</th>
                                <th class="text-center">Proggress</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Detail</th>
                                @if (Auth::user()->position_id == '1')
                                    <th class="text-center">Kurasi</th>
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr id="tr_{{ $course->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->kode_course }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td>
                                        @foreach ($course->periode as $periode)
                                            {{ $periode->name }}<br>
                                        @endforeach
                                    </td>

                                    <td>{{ $course->jumlah_video }}</td>
                                    <td>
                                        <ul>
                                            @php
                                                $ketua = $course->dosens->where('pivot.role', 'ketua')->first();
                                                $anggota = $course->dosens->where('pivot.role', 'anggota');
                                            @endphp

                                            @if ($ketua)
                                                <li>
                                                    @if ($anggota->isNotEmpty())
                                                        <strong>Ketua:</strong>
                                                    @endif
                                                    {{ $ketua->name }}
                                                </li>
                                            @endif

                                            @if ($anggota->isNotEmpty())
                                                <li>
                                                    <strong>Anggota:</strong>
                                                    @foreach ($anggota as $dosen)
                                                        {{ $dosen->name }},
                                                    @endforeach
                                                </li>
                                            @endif

                                            @if (!$ketua && $anggota->isEmpty())
                                                <li>Tidak ada dosen</li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>{{ $course->user->name }}</td>

                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped bg-danger progress-bar-course"
                                                role="progressbar" style="width: {{ $course->progress }}%;"
                                                aria-valuenow="{{ $course->progress }}" aria-valuemin="0"
                                                aria-valuemax="100" data-id="{{ $course->id }}">
                                                {{ $course->progress }}%
                                            </div>
                                        </div>
                                    </td>

                                    <td class="status-course" data-status="{{ $course->status }}">{{ $course->status }}
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('course.show', $course->id) }}">
                                            Detail
                                        </a>
                                    </td>
                                    @if (Auth::user()->position_id == '1')
                                        <td>
                                            @if ($course->progress >= 50)
                                                <ul class="d-flex list-unstyled"
                                                    style="justify-content: center; align-items: center; padding: 0;">
                                                    <li>
                                                        <a href="#" class="btn btn-primary m-1 kurasi"
                                                            data-id="{{ $course->id }}">Kurasi</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="btn btn-danger m-1 publish"
                                                            data-id="{{ $course->id }}" style="display:none;">
                                                            Publish
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <p class="info" data-id="{{ $course->id }}"
                                                            style="display:none;">Course Publish</p>
                                                    </li>
                                                </ul>
                                            @else
                                                <p>Harap selesaikan semua topik pada course ini terlebih dahulu.</p>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modalEditA"
                                                onclick="getEditForm({{ $course->id }})">EDIT</a>
                                            <form method="POST" action="{{ route('course.destroy', $course->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete {{ $course->id }} - {{ $course->name }}?');">
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD -->
    <div class="modal fade" id="modalCreateCourse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('.publish').each(function() {
                var id = $(this).data('id');
                checkButton(id);
            });
        });

        $(document).on('click', '.kurasi', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            recordAction(id, 'kurasi'); // Record the start action
            checkButton(id);
        });


        $(document).on('click', '.publish', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            recordAction(id, 'publish'); // Record the start action
            checkButton(id);
        });

        function checkButton(id) {
            $.ajax({
                url: '/course/check-button/' + id, // Ensure the URL matches your GET route
                type: 'GET', // Change this to GET
                success: function(response) {
                    if (response.course) { // Validasi response.course
                        let course = response.course;
                        if (course.progress === 75 && course.status === 'On Going CURATION') {
                            $('.kurasi[data-id="' + id + '"]').hide();
                            $('.info[data-id="' + id + '"]').hide();
                            $('.publish[data-id="' + id + '"]').show();
                        } else if (course.progress === 100 && course.status === 'Publish') {
                            $('.kurasi[data-id="' + id + '"]').hide();
                            $('.publish[data-id="' + id + '"]').hide();
                            $('.info[data-id="' + id + '"]').show();
                        }
                    } else {
                        console.warn('Invalid response:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }


        function recordAction(id, action) {
            $.ajax({
                url: '/course/' + id + '/' + action, // Tambahkan '/' sebelum action
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Ensure CSRF token is correctly injected
                },
                success: function(response) {
                    $('td.status-course[data-id="' + id + '"]').text(response.status);
                    // Update progress bar
                    let progressBar = $('.progress-bar-course[data-id="' + id + '"]'); // Target progress bar
                    progressBar.css('width', response.progress + '%'); // Update width
                    progressBar.attr('aria-valuenow', response.progress); // Update ARIA value
                    progressBar.text(response.progress + '%'); // Update progress text
                },
                error: function(xhr, status, error) {
                    console.error('Error recording action:', error);
                }
            });
        }

        // Load Create Form
        function loadCreateForm() {
            $.ajax({
                type: 'POST',
                url: '{{ route('course.getCreateForm') }}', // Removed extra space
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalCreateContent').html(data.msg);
                    }
                }
            });
        }

        // Load Edit Form
        function getEditForm(course_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('course.getEditForm') }}', // Removed extra space
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': course_id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalContent').html(data.msg);
                    }
                }
            });
        }
    </script>


    <script>
        // Client-side search function
        document.getElementById('form1').addEventListener('input', function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll('#dataTable tbody tr');

            rows.forEach(function(row) {
                var found = false;
                row.querySelectorAll('td').forEach(function(td) {
                    if (td.innerText.toLowerCase().indexOf(input) > -1) {
                        found = true;
                    }
                });
                row.style.display = found ? '' : 'none';
            });
        });
    </script>
@endsection
