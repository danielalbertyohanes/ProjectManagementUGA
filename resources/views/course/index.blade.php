@extends('layouts.admin')

@section('content')
    <<<<<<< Updated upstream <style>
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
        max-width: 150px;
        /* Batas lebar kolom */
        white-space: nowrap;
        /* Tampilkan hanya satu baris */
        overflow: hidden;
        /* Potong teks jika terlalu panjang */
        text-overflow: ellipsis;
        /* Tambahkan "..." di akhir teks */
        cursor: pointer;
        /* Tampilkan kursor pointer saat dihover */
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
        bottom: 120%;
        /* Posisi tooltip di atas teks */
        left: 50%;
        transform: translateX(-50%);
        white-space: normal;
        max-width: 200px;
        word-wrap: break-word;
        }

        .tooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        /* Panah di bagian bawah tooltip */
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
        overflow: visible;
        /* Pastikan tooltip bisa terlihat */
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
            <p>Master Course adalah modul yang digunakan untuk mendefinisikan dan mengelola informasi terkait kursus atau
                mata
                pelajaran.</p>

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
                <<<<<<< Updated upstream <button class="btn btn-success mb-3" data-toggle="modal"
                    data-target="#modalCreateCourse" onclick="loadCreateForm()">Tambah Course</button>
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
                                    <<<<<<< Updated upstream <th class="text-center">No</th>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Deskripsi</th>
                                        <th class="text-center">Periode</th>
                                        <th class="text-center">Dosen</th>
                                        <th class="text-center">PIC</th>
                                        <th class="text-center">Progres</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Detail</th>
                                        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                            <th class="text-center">Kurasi</th>
                                            <th class="text-center">Aksi</th>
                                        @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
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
                                                        <a href="#" class="dosen-link" data-id="{{ $ketua->id }}"
                                                            data-name="{{ $ketua->name }}" data-npk="{{ $ketua->npk }}"
                                                            data-fakultas="{{ $ketua->fakultas }}"
                                                            data-phone="{{ $ketua->no_telp }}"
                                                            data-description="{{ $ketua->description }}"
                                                            onclick="showDosenModal(this)">
                                                            {{ $ketua->name }}
                                                        </a>
                                                    </li>
                                                @endif

                                                @if ($anggota->isNotEmpty())
                                                    <li>
                                                        <strong>Anggota:</strong>
                                                        @foreach ($anggota as $dosen)
                                                            <a href="#" class="dosen-link"
                                                                data-id="{{ $dosen->id }}"
                                                                data-name="{{ $dosen->name }}"
                                                                data-npk="{{ $dosen->npk }}"
                                                                data-fakultas="{{ $dosen->fakultas }}"
                                                                data-phone="{{ $dosen->no_telp }}"
                                                                data-description="{{ $dosen->description }}"
                                                                onclick="showDosenModal(this)">
                                                                {{ $dosen->name }}
                                                            </a>
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
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
                                        <td class="status-course" data-status="{{ $course->status }}">
                                            {{ $course->status }}
                                        </td>
                                        <td>
                                            @if ($course->status != 'Cancel')
                                                <a class="btn btn-info" href="{{ route('course.show', $course->id) }}">
                                                    Detail
                                                </a>
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
                                                    <a href="#" class="btn btn-warning mb-2" data-toggle="modal"
                                                        data-target="#modalEditA"
                                                        onclick="getEditForm({{ $course->id }})">
                                                        EDIT
                                                    </a>
                                                    {{-- <form method="POST" action="{{ route('course.destroy', $course->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete {{ $course->id }} - {{ $course->name }}?');">
                                        </form> --}}

                                                    <!-- Button to trigger the modal -->
                                                    <button type="button" class="btn btn-danger cancel"
                                                        data-toggle="modal"
                                                        data-target="#cancelModal_{{ $course->id }}">
                                                        Batal
                                                    </button>
                                                @elseif($course->status === 'Cancel')
                                                    <button type="button" class="btn btn-primary cancel"
                                                        data-toggle="modal"
                                                        data-target="#cancelModal_{{ $course->id }}">
                                                        Buka
                                                    </button>
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
                                                <div class="modal-body">
                                                    @if ($course->status != 'Cancel')
                                                        Apakah Anda yakin ingin membatalkan:
                                                        <strong>{{ $course->name }}</strong>?
                                                    @else
                                                        Apakah Anda yakin ingin membuka:
                                                        <strong>{{ $course->name }}</strong>?
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>

                                                    @if ($course->status != 'Cancel')
                                                        <form method="POST"
                                                            action="{{ route('course.cancel', $course->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-danger">Batalkan</button>
                                                        </form>
                                                    @else
                                                        <form method="POST"
                                                            action="{{ route('course.open', $course->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-primary">Buka</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

                $('#dataTable tbody tr').each(function() {
                    // Dapatkan status dari setiap baris
                    var status = $(this).find('.status-course').data('status');

                    if (status === 'Cancel') {
                        $(this).addClass('bg-danger text-white');
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
            function loadCreateForm() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('course.getCreateForm') }}', // Menghapus spasi tambahan
                    data: {
                        _token: '{{ csrf_token() }}' // Tidak perlu tanda kutip di sekitar nama properti
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalCreateContent').html(data.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error); // Tambahkan error handler untuk debugging
                    }
                });
            }

            // Load Edit Form
            function getEditForm(course_id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('course.getEditForm') }}', // Menghapus spasi tambahan dan memperbaiki tanda kutip
                    data: {
                        _token: '{{ csrf_token() }}', // Tidak perlu tanda kutip di sekitar nama properti
                        id: course_id
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalContent').html(data.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', error); // Tambahkan error handler untuk debugging
                    }
                });
            }

            function showDosenModal(element) {
                let name = element.getAttribute("data-name");
                let npk = element.getAttribute("data-npk");
                let fakultas = element.getAttribute("data-fakultas");
                let phone = element.getAttribute("data-phone");
                let description = element.getAttribute("data-description");

                document.getElementById("modalDosenName").textContent = name;
                document.getElementById("modalDosenNPK").textContent = npk;
                document.getElementById("modalDosenFakultas").textContent = fakultas;
                document.getElementById("modalDosenPhone").textContent = phone;
                document.getElementById("modalDosenDescription").textContent = description || "-";

                let cleanPhone = phone.replace(/[^0-9]/g, ''); // Hapus semua karakter kecuali angka
                if (!cleanPhone.startsWith("62")) {
                    cleanPhone = "62" + cleanPhone.substring(1); // Ubah 0 di awal menjadi 62
                }
                let whatsappLink = `https://wa.me/${cleanPhone}`;


                let phoneElement = document.getElementById("modalDosenPhoneLink");
                phoneElement.href = whatsappLink;

                $("#dosenModal").modal("show");
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Menangani deskripsi dengan tooltip dan pemangkasan teks
                const descriptions = document.querySelectorAll('.description');
                descriptions.forEach(description => {
                    const fullText = description.innerText.trim();
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

                // Menangani penutupan modal saat tombol close diklik
                document.querySelectorAll("[data-dismiss='modal']").forEach(button => {
                    button.addEventListener("click", function() {
                        $("#dosenModal").modal("hide");
                    });
                });

                // Menangani posisi tooltip agar tidak keluar layar
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

                // Fungsi pencarian client-side pada tabel
                document.getElementById('form1').addEventListener('input', function() {
                    const input = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#dataTable tbody tr');

                    rows.forEach(row => {
                        let found = false;
                        row.querySelectorAll('td').forEach(td => {
                            if (td.innerText.toLowerCase().includes(input)) {
                                found = true;
                            }
                        });
                        row.style.display = found ? '' : 'none';
                    });
                });
            });
        </script>
    @endsection
