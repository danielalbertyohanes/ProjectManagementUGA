@extends('layouts.admin')

@section('content')
<<<<<<< Updated upstream
    <style>
        .panduan-links a {
            display: block;
            margin-bottom: 10px;
        }
    </style>

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">COURSE</h1>
        {{-- ini harus di tambah dan di ubah lagi --}}
        <p>Info terkait course agar informative</p>
        <br>
=======
    <link href="{{ asset('admin/css/content.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <h1>Master Course</h1>
        <p>Modul Master Course digunakan untuk mengelola informasi terkait kursus atau mata pelajaran dalam sistem. Dengan fitur ini, admin dapat menambahkan, mengedit, dan melihat daftar course. Data yang dikelola mencakup kode, nama, deskripsi, periode, dosen, pic, progress, status, serta detail course.</p>

>>>>>>> Stashed changes
        @if ($links->isNotEmpty())
            <p>Dibawah ini merupakan Link yang dapat di akses: </p>
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
<<<<<<< Updated upstream
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateCourse"
                onclick="loadCreateForm()">+ New Course</button>
=======
            {{-- Button Tambah Course --}}
            <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreateCourse" onclick="loadCreateForm()">Tambah Course</button>
>>>>>>> Stashed changes
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">

<<<<<<< Updated upstream
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
=======
                <div class="input-group" style="max-width: 300px;">
                    <form action="{{ route('course.index') }}" method="GET" class="d-flex">
                        <input type="search" name="search" id="form1" class="form-control" placeholder="Search"
                            aria-label="Search" />
                        <button type="submit" class="btn buttonSimpan">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
>>>>>>> Stashed changes
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<<<<<<< Updated upstream
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Course</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Created_at</th>
                                <th class="text-center">Jumlah_video</th>
                                <th class="text-center">Dosen</th>
                                <th class="text-center">Pic_course</th>
                                <th class="text-center">Proggress</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Details</th>
                                <th class="text-center">Action</th>
=======
                                <th>No</th>
                                <th>Kode</th=>
                                <th>Nama</th=>
                                <th>Deskripsi</th>
                                <th>Periode</th>
                                <th>Dosen</th=>
                                <th>PIC</th=>
                                <th>Progress</th=>
                                <th>Status</th>
                                <th>Detail</ths=>
                                @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                    <th>Kurasi</th>
                                    <th>Aksi</th>
                                @endif
>>>>>>> Stashed changes
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            @php
                                $statusProgressMapping = [
                                    'Not Yet' => 0,
                                    'Progress' => 20,
                                    'Finish Production' => 40,
                                    'On Going CURATION' => 60,
                                    'Publish' => 100,
                                    'Cancel' => 0,
                                ];

                                $progressPercentage = $statusProgressMapping[$course->status] ?? 0;
                            @endphp
                                <tr id="tr_{{ $course->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $course->kode_course }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td>{{ $course->created_at }}</td>
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
<<<<<<< Updated upstream
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $progressPercentage }}%;"
                                                aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $progressPercentage }}%
=======
                                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-course"
                                                role="progressbar" style="width: {{ $course->progress }}%;"
                                                aria-valuenow="{{ $course->progress }}" aria-valuemin="0"
                                                aria-valuemax="100" data-id="{{ $course->id }}">
                                                {{ $course->progress }}%
>>>>>>> Stashed changes
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $course->status }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('course.show', $course->id) }}">
                                            Detail
                                        </a>
                                    </td>
                                    <td>
<<<<<<< Updated upstream
                                        @if (Auth::user()->position_id == '1')
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
                                        @endif
                                    </td>
                                </tr>
=======
                                        @if ($course->status != 'Cancel')
                                            <a class="btn buttonDetail" href="{{ route('course.show', $course->id) }}">Detail</a>
                                        @else
                                            <p class="info" style="text-align: center">Course Cancel</p>
                                        @endif
                                    </td>
                                    @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                        <td>
                                            @if ($course->status != 'Cancel')
                                                @if ($course->progress >= 50)
                                                    <ul class="d-flex list-unstyled"
                                                        style="justify-content: center; align-items: center; padding: 0;">
                                                        <li>
                                                            <a href="#" class="btn buttonKurasi m-1 kurasi"
                                                                data-id="{{ $course->id }}">Kurasi</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="btn buttonPublish m-1 publish"
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
                                                    <p class="info" style="text-align: center">Harap selesaikan semua
                                                        topik pada course
                                                        ini terlebih dahulu.</p>
                                                @endif
                                            @else
                                                <p class="info" style="text-align: center">Course Dibatalkan</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->status != 'Cancel' && $course->status != 'Publish')
                                                <a href="#" class="btn buttonEdit mb-3" data-toggle="modal"
                                                    data-target="#modalEdit" onclick="getEditForm({{ $course->id }})">
                                                    Edit
                                                </a>
                                                {{-- <form method="POST" action="{{ route('course.destroy', $course->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete {{ $course->id }} - {{ $course->name }}?');">
                                        </form> --}}

                                                <!-- Button to trigger the modal -->
                                                <button type="button" class="btn buttonDelete cancel" data-toggle="modal" data-target="#cancelModal_{{ $course->id }}">Batal</button>
                                            @elseif($course->status === 'Cancel')
                                                <button type="button" class="btn buttonSimpan cancel" data-toggle="modal" data-target="#cancelModal_{{ $course->id }}">Buka</button>
                                            @else
                                                <p></p>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                <!-- Modal Batal -->
                                <div class="modal fade" id="cancelModal_{{ $course->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="cancelModalLabel_{{ $course->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-wide">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLabel_{{ $course->id }}">
                                                    @if ($course->status != 'Cancel')
                                                        Konfirmasi Pembatalan
                                                    @else
                                                        Konfirmasi Buka
                                                    @endif
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body modal-dialog-centered">
                                                @if ($course->status != 'Cancel')
                                                    Apakah Anda yakin ingin membatalkan:
                                                    <strong>{{ $course->name }}</strong>?
                                                @else
                                                    Apakah Anda yakin ingin membuka:
                                                    <strong>{{ $course->name }}</strong>?
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn buttonBatal"
                                                    data-dismiss="modal">Tutup</button>

                                                @if ($course->status != 'Cancel')
                                                    <form method="POST"
                                                        action="{{ route('course.cancel', $course->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn buttonDelete">Batalkan</button>
                                                    </form>
                                                @else
                                                    <form method="POST"
                                                        action="{{ route('course.open', $course->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn buttonCreate">Buka</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
>>>>>>> Stashed changes
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD -->
    <div class="modal fade" id="modalCreateCourse" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream
=======

    <!-- Modal Dosen -->
    <div class="modal fade" id="dosenModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dosenModalLabel">Profil Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama:</strong> <span id="modalDosenName"></span></p>
                    <p><strong>NPK:</strong> <span id="modalDosenNPK"></span></p>
                    <p><strong>Fakultas:</strong> <span id="modalDosenFakultas"></span></p>
                    <p><strong>No. Telepon:</strong>
                        <a href="#" id="modalDosenPhoneLink" target="_blank">
                            <span id="modalDosenPhone"></span>
                        </a>
                    </p>
                    <p><strong>Deskripsi:</strong></p>
                    <p id="modalDosenDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn buttonDelete" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
>>>>>>> Stashed changes
@endsection

@section('javascript')
    <script>
<<<<<<< Updated upstream
        // ADD
=======
        $(document).ready(function() {
            $('.publish').each(function() {
                var id = $(this).data('id');
                checkButton(id);
            });

            $('#dataTable tbody tr').each(function() {
                // Dapatkan status dari setiap baris
                var status = $(this).find('.status-course').data('status');

                if (status === 'Cancel') {
                    $(this).addClass('bg-red-300 text-white');
                }
            });

            $(document).on('click', '.cancel', function(e) {
                e.preventDefault(); // Mencegah perilaku default link
                var id = $(this).data('id'); // Mendapatkan ID kursus
                console.log('Membuka modal untuk kursus ID: ' + id); // Log debugging
                // Menampilkan modal dengan ID unik untuk setiap kursus
                $('#cancelModal_' + id).modal('show');
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
>>>>>>> Stashed changes
        function loadCreateForm() {
            $.ajax({
                type: 'POST',
                url: '{{ route('course.getCreateForm') }}',
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

        // EDIT
        function getEditForm(course_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('course.getEditForm') }}',
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
@endsection
