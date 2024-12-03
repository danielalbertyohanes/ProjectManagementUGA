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

        .description {
            max-width: 150px; /* Batas lebar kolom */
            white-space: nowrap; /* Tampilkan hanya satu baris */
            overflow: hidden; /* Potong teks jika terlalu panjang */
            text-overflow: ellipsis; /* Tambahkan "..." di akhir teks */
            cursor: pointer; /* Tampilkan kursor pointer saat dihover */
        }

        .tooltip-container {
            position: relative;
            display: inline-block;
        }

        .tooltip-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        .tooltip {
            visibility: hidden;
            opacity: 0;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 9999;
            bottom: 120%; /* Posisi tooltip di atas teks */
            left: 50%;
            transform: translateX(-50%);
            white-space: normal;
            max-width: 200px;
            word-wrap: break-word;
        }

        .tooltip::after {
            content: "";
            position: absolute;
            top: 100%; /* Panah di bagian bawah tooltip */
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }

        /* Tooltip otomatis berpindah ke bawah jika tidak cukup ruang */
        .tooltip-container[data-position="top"] .tooltip {
            bottom: auto;
            top: 120%;
            transform: translateX(-50%);
        }

        .tooltip-container[data-position="top"] .tooltip::after {
            top: auto;
            bottom: 100%;
            border-color: transparent transparent #333 transparent;
        }

        .table-container {
            position: relative;
            overflow: visible; /* Pastikan tooltip bisa terlihat */
        }

        h1 {
            color: royalblue;
            font-weight: bold;
            font-size: 2rem;
            font-family: Arial, Helvetica, sans-serif;
        }

        p {
            font-size: 1rem;
            padding-top: 1rem;
            font-family: Arial, Helvetica, sans-serif;
            color: #232323;
        }
        th {
            font-weight: bold;
            text-align: center;
            color: #232323;
            font-family: Arial, Helvetica, sans-serif;
        }

        td {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            color: #232323;
        }
    </style>

    <div class="container-fluid">
        <h1>MASTER COURSE</h1>
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
                onclick="loadCreateForm()">Tambah Course</button>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR COURSE</h6>

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
                                <th class="text-center" >No</th>
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
                                    <th class="text-center">Action</th>
                                @endif
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
                                    <td>
                                        <div class="tooltip-container">
                                            <span class="description">{{ $course->description }}</span>
                                            <span class="tooltip">{{ $course->description }}</span>
                                        </div>
                                    </td>
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
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                                style="width: {{ $progressPercentage }}%;"
                                                aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ $progressPercentage }}%
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $course->status }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('course.show', $course->id) }}">
                                            Detail
                                        </a>
                                    </td>
                                    <td>
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
        document.addEventListener('DOMContentLoaded', function () {
            const descriptions = document.querySelectorAll('.description');

            descriptions.forEach(description => {
                const fullText = description.innerText; // Ambil teks penuh
                const tooltip = document.createElement('span');
                tooltip.className = 'tooltip';
                tooltip.innerText = fullText;

                const container = description.parentElement;
                container.classList.add('tooltip-container');
                container.appendChild(tooltip);

                // Potong teks untuk tampilan di tabel
                if (fullText.length > 20) {
                    description.innerText = fullText.substring(0, 20) + '...';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const tooltips = document.querySelectorAll('.tooltip-container');

            tooltips.forEach(container => {
                const tooltip = container.querySelector('.tooltip');
                container.addEventListener('mouseenter', () => {
                    const containerRect = container.getBoundingClientRect();
                    const tooltipRect = tooltip.getBoundingClientRect();

                    // Cek apakah tooltip keluar layar atas
                    if (containerRect.top - tooltipRect.height < 0) {
                        container.setAttribute('data-position', 'top');
                    } else {
                        container.removeAttribute('data-position');
                    }
                });
            });
        });


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
