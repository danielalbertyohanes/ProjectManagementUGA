@extends('layouts.admin')

@section('content')
    <style>
        p {
            font-size: 1rem;
            padding-top: 1rem;
            font-family: Arial, Helvetica, sans-serif;
            color: #232323;
        }

        h3 {
            font-size: 1.5rem;
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
    <div class="container-fluid">
        <h3 class="h3 mb-2 text-gray-800">Detail Sub Topik</h3>
        <p>Halaman detail subtopik ini menampilkan informasi lengkap mengenai subtopik, termasuk daftar PPT (PowerPoint) dan
            video yang terkait dengan subtopik tersebut.</p>
        <br>
        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
            <a class="btn btn-success mb-3" href="{{ route('ppt.newPpt', $subTopic->id) }}">Tambah PPT</a>
        @endif

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        {{-- Tabel PPT --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">PPT</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Editing</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppts as $ppt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ppt->name }}</td>
                                    <td data-id="{{ $ppt->id }}" class="status-ppt" data-status="{{ $ppt->status }}">
                                        {{ $ppt->status }}
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-ppt" role="progressbar"
                                                style="width: {{ $ppt->progress }}%;" aria-valuenow="{{ $ppt->progress }}"
                                                aria-valuemin="0" aria-valuemax="100" data-id="{{ $ppt->id }}">
                                                {{ $ppt->progress }}%
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <ul class="d-flex list-unstyled"
                                            style="justify-content: center; align-items: center; padding: 0;">
                                            @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                                @if ($ppt->finish_click_ppt)
                                                    <span class="tanggalPpt" data-id="{{ $ppt->id }}"
                                                        data-ppt-editing-finished-at="{{ $ppt->finish_click_ppt }}"
                                                        style="justify-content: center; align-items: center; padding: 0;">
                                                        {{ \Carbon\Carbon::parse($ppt->finish_click_ppt)->format('d-M-Y') }}
                                                    </span>
                                                @else
                                                    <li> <span class="tanggalPpt" data-id="{{ $ppt->id }}"
                                                            data-ppt-editing-finished-at="{{ $ppt->finish_click_ppt }}"style="display:none;">
                                                        </span></li>
                                                    <li><a href="#" class="btn btn-primary m-1 start-ppt-editing"
                                                            data-id="{{ $ppt->id }}">Start</a></li>
                                                    <li><a href="#" class="btn btn-danger m-1 finish-ppt-editing"
                                                            data-id="{{ $ppt->id }}" style="display:none;">Finish</a>
                                                    </li>
                                                @endif
                                            @else
                                                {{ $ppt->finish_click_ppt ? \Carbon\Carbon::parse($ppt->finish_click_ppt)->format('d-M-Y') : '---' }}
                                            @endif

                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="d-flex list-unstyled ">
                                            @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                                <li><a href="#" class="btn btn-warning m-1" data-toggle="modal"
                                                        data-target="#modalEdit"
                                                        onclick="getPptEditForm({{ $ppt->id }})">Edit</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="#" class="btn btn-info  m-1" data-toggle="modal"
                                                    data-target="#modalEditContent"
                                                    onclick="getLogPpt({{ $ppt->id }})">Log</a>
                                            </li>
                                        </ul>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-right">
                    {{-- {{ $ppts->links() }} --}}
                </div>
            </div>
        </div>

        @if ($videos->isNotEmpty())
            <a class="btn btn-success mb-3" href="{{ route('video.newVideo', $subTopic->id) }}">Tambah Video</a>
        @endif


        {{-- Tabel Video --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Video</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">PPT</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Lokasi</th>
                                <th class="text-center">Detail Lokasi</th>
                                <th class="text-center">Recording Video</th>
                                <th class="text-center">Recording PPT</th>
                                <th class="text-center">Editing</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $video->ppt_name }}</td>
                                    <td>{{ $video->name }}</td>
                                    <td data-id="{{ $video->id }}" class="status-video"
                                        data-status="{{ $video->status }}">
                                        {{ $video->status }}
                                    </td>

                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-video" role="progressbar"
                                                style="width: {{ $video->progress }}%;"
                                                aria-valuenow="{{ $video->progress }}" aria-valuemin="0"
                                                aria-valuemax="100" data-id="{{ $video->id }}">
                                                {{ $video->progress }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $video->location }}</td>
                                    <td>{{ $video->detail_location }}</td>

                                    {{-- Recording Video --}}
                                    <td>
                                        <ul class="d-flex list-unstyled"
                                            style="justify-content: center; align-items: center; padding: 0;">
                                            @if ($video->finish_click_video)
                                                <span class="tanggalVideo" data-id="{{ $video->id }}"
                                                    data-video-finished-at="{{ $video->finish_click_video }}">
                                                    {{ \Carbon\Carbon::parse($video->finish_click_video)->format('d-M-Y') }}
                                                </span>
                                            @else
                                                <li> <span class="tanggalVideo" data-id="{{ $video->id }}"
                                                        data-video-finished-at="{{ $video->finish_click_video }}"
                                                        style="display:none;">
                                                    </span></li>
                                                <li><a href="#" class="btn btn-primary m-1 start-video"
                                                        data-id="{{ $video->id }}">Start</a></li>
                                                <li><a href="#" class="btn btn-warning m-1 pause-video"
                                                        data-id="{{ $video->id }}" style="display:none;">Pause</a>
                                                </li>

                                                <li><a href="#" class="btn btn-danger m-1 finish-video"
                                                        data-id="{{ $video->id }}" style="display:none;">Finish</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>

                                    {{-- Recording PPT --}}
                                    <td>
                                        <ul class="d-flex list-unstyled"
                                            style="justify-content: center; align-items: center; padding: 0;">
                                            @if ($video->finish_click_ppt)
                                                <li> <span class="tanggalPptVideo" data-id="{{ $video->id }}"
                                                        data-ppt-finished-at="{{ $video->finish_click_ppt }}">
                                                        {{ \Carbon\Carbon::parse($video->finish_click_ppt)->format('d-M-Y') }}
                                                    </span></li>
                                            @else
                                                <li> <span class="tanggalPptVideo" data-id="{{ $video->id }}"
                                                        data-ppt-finished-at="{{ $video->finish_click_ppt }}"
                                                        style="display:none;">
                                                    </span></li>
                                                <li><a href="#" class="btn btn-primary m-1 start-ppt"
                                                        data-id="{{ $video->id }}">Start</a></li>
                                                <li><a href="#" class="btn btn-warning m-1 pause-ppt"
                                                        data-id="{{ $video->id }}" style="display:none;">Pause</a>
                                                </li>
                                                <li><a href="#" class="btn btn-danger m-1 finish-ppt"
                                                        data-id="{{ $video->id }}" style="display:none;">Finish</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>

                                    {{-- Editing --}}
                                    <td>
                                        <ul class="d-flex list-unstyled"
                                            style="justify-content: center; align-items: center; padding: 0;">
                                            @if ($video->finish_click_editing)
                                                <span>{{ \Carbon\Carbon::parse($video->finish_click_editing)->format('d-M-Y') }}</span>
                                            @else
                                                <li>
                                                    <p class="info" data-id="{{ $video->id }}">Harap selesaikan
                                                        rekaman Video dan PPT terlebih dahulu.</p>
                                                </li>
                                                <li>
                                                    <span class="tanggalEditing" data-id="{{ $video->id }}"
                                                        data-editing-finished-at="{{ $video->finish_click_editing }}"
                                                        style="display:none;">
                                                    </span>
                                                </li>
                                                <li><a href="#" class="btn btn-primary m-1 start-editing"
                                                        data-id="{{ $video->id }}" style="display:none;">Start</a>
                                                </li>
                                                <li><a href="#" class="btn btn-danger m-1 finish-editing"
                                                        data-id="{{ $video->id }}" style="display:none;">Finish</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>

                                    <td>
                                        <ul class="d-flex list-unstyled ">
                                            <li>
                                                <a href="#" class="btn btn-warning m-1" data-toggle="modal"
                                                    data-target="#modalEdit"
                                                    onclick="getVideoEditForm({{ $video->id }})">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#" class="btn btn-info  m-1" data-toggle="modal"
                                                    data-target="#modalEditContent"
                                                    onclick="getLogVideo({{ $video->id }})">Log</a>
                                            </li>
                                        </ul>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-right">
                    {{-- {{ $videos->links() }} --}}
                </div>
            </div>
        </div>

    </div>

    {{-- Edit Modal --}}
    <div class="modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalEditContent">
                    <p>Loading...</p> <!-- Placeholder saat konten sedang dimuat -->
                </div>
            </div>
        </div>
    </div>

    {{-- Log Modal --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Activity Logs</h5>
                    <!-- Button to close modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    {{-- Content will be loaded here via AJAX --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            // Loop through all rows and check if they are ready for editing

            $('.start-editing').each(function() {
                var id = $(this).data('id');
                checkButtonVideo(id);
            });
            $('.start-ppt-editing').each(function() {
                var id = $(this).data('id');
                checkButtonPpt(id);
            });

            // Button Recording Video, Recording PPT, Editing Started
            // Start Video
            $(document).on('click', '.start-video', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'start-video'); // Record the start action
                checkButtonVideo(id);
            });

            // Pause Video
            $(document).on('click', '.pause-video', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'pause-video'); // Record the pause action
                checkButtonVideo(id);
            });


            // Finish Video
            $(document).on('click', '.finish-video', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'finish-video'); // Record the finish action
                checkButtonVideo(id);

            });

            // Start Video PPT
            $(document).on('click', '.start-ppt', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'start-ppt'); // Record the start action
                checkButtonVideo(id);
            });

            // Pause Video PPT
            $(document).on('click', '.pause-ppt', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'pause-ppt'); // Record the pause action
                checkButtonVideo(id);
            });

            // Finish Video PPT
            $(document).on('click', '.finish-ppt', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'finish-ppt'); // Record the finish action
                checkButtonVideo(id);
            });

            // Start Video Editing
            $(document).on('click', '.start-editing', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'start-editing'); // Record the start action
                checkButtonVideo(id);
            });


            // Finish Video Editing
            $(document).on('click', '.finish-editing', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordAction(id, 'finish-editing'); // Record the finish action
                checkButtonVideo(id);
            });


            // Start PPT Editing
            $(document).on('click', '.start-ppt-editing', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordActionPpt(id, 'start-ppt-editing'); // Record the start action
                checkButtonPpt(id);
            });

            // Finish PPT Editing
            $(document).on('click', '.finish-ppt-editing', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $(this).hide();
                recordActionPpt(id, 'finish-ppt-editing'); // Record the finish action
                checkButtonPpt(id);
            });

            $('#modal').on('hidden.bs.modal', function() {
                location.reload();
            });

            $('#modal').modal({
                keyboard: true, // Allow ESC key to close modal
                backdrop: true
            });

            $('.close').click(function() {
                $('#modal').modal('hide');
            });
        });


        function checkButtonVideo(id) {
            $.ajax({
                url: '/logvideo/check-button/' + id,
                type: 'GET',
                success: function(response) {
                    console.log('Response dari server:', response);

                    let video = response.video || {};
                    let ppt = response.ppt || {};
                    let editing = response.editing || {};

                    var currentDate = new Date();
                    var day = currentDate.getDate();
                    var month = currentDate.toLocaleString('default', {
                        month: 'short'
                    });
                    var year = currentDate.getFullYear().toString().slice(-2);
                    var formattedDate = day + '-' + month + '-' + year;

                    // Perbarui tampilan tombol video terlebih dahulu
                    if (video.status === "Start") {
                        $('.start-video[data-id="' + id + '"]').hide();
                        $('.pause-video[data-id="' + id + '"], .finish-video[data-id="' + id + '"]').show();
                    } else if (video.status === "Pause") {
                        $('.start-video[data-id="' + id + '"]').show();
                        $('.pause-video[data-id="' + id + '"], .finish-video[data-id="' + id + '"]').hide();
                    } else if (video.status === "Finish") {
                        $('.start-video[data-id="' + id + '"], .pause-video[data-id="' + id +
                            '"], .finish-video[data-id="' + id + '"]').hide();
                        $('.tanggalVideo[data-id="' + id + '"]').text(formattedDate).show();
                    }

                    // Perbarui tampilan tombol PPT secara terpisah
                    if (ppt.status === "Start") {
                        $('.start-ppt[data-id="' + id + '"]').hide();
                        $('.pause-ppt[data-id="' + id + '"], .finish-ppt[data-id="' + id + '"]').show();
                    } else if (ppt.status === "Pause") {
                        $('.start-ppt[data-id="' + id + '"]').show();
                        $('.pause-ppt[data-id="' + id + '"], .finish-ppt[data-id="' + id + '"]').hide();
                    } else if (ppt.status === "Finish") {
                        $('.start-ppt[data-id="' + id + '"], .pause-ppt[data-id="' + id +
                            '"], .finish-ppt[data-id="' + id + '"]').hide();
                        $('.tanggalPptVideo[data-id="' + id + '"]').text(formattedDate).show();
                    }

                    // Jika Video & PPT sudah selesai, baru tampilkan tombol editing
                    if (video.status === "Finish" && ppt.status === "Finish") {
                        $('.info[data-id="' + id + '"]').hide();

                        if (editing.status === "Start") {
                            $('.start-editing[data-id="' + id + '"]').hide();
                            $('.finish-editing[data-id="' + id + '"]').show();
                        } else if (editing.status === "Finish") {
                            $('.start-editing[data-id="' + id + '"]').hide();
                            $('.finish-editing[data-id="' + id + '"]').hide();
                            $('.tanggalEditing[data-id="' + id + '"]').text(formattedDate).show();
                        } else {
                            $('.info[data-id="' + id + '"]').hide();
                            $('.start-editing[data-id="' + id + '"]').show();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }


        // Function to record actions
        function recordAction(id, action) {
            $.ajax({
                url: '/video/' + id + '/recording/' + action,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Ensure CSRF token is correctly injected
                },
                success: function(response) {

                    console.log('Action recorded:', response);
                    $('td.status-video[data-id="' + id + '"]').text(response.status);

                    // Update progress bar
                    let progressBar = $('.progress-bar-video[data-id="' + id + '"]'); // Target progress bar
                    progressBar.css('width', response.progress + '%'); // Update width
                    progressBar.attr('aria-valuenow', response.progress); // Update ARIA value
                    progressBar.text(response.progress + '%'); // Update progress text
                },
                error: function(xhr, status, error) {
                    console.error('Error recording action:', error);
                }
            });
        }

        function checkButtonPpt(id) {
            $.ajax({
                url: '/logppt/check-button/' + id,
                type: 'GET',
                success: function(response) {
                    let ppt = response.ppt;

                    // Update info with the formatted date in d-MMM-yy format (e.g., 12-Nov-24)
                    var currentDate = new Date(); // Get the current date
                    var day = currentDate.getDate();
                    var month = currentDate.toLocaleString('default', {
                        month: 'short'
                    }); // Get month abbreviation
                    var year = currentDate.getFullYear().toString().slice(-
                        2); // Get last two digits of the year

                    // Format the date as d-MMM-yy
                    var formattedDate = day + '-' + month + '-' + year;

                    // Update tampilan tombol berdasarkan status video
                    if (ppt.status === "Start") {
                        $('.start-ppt-editing[data-id="' + id + '"]').hide(); // Sembunyikan tombol Start
                        $('.finish-ppt-editing[data-id="' + id + '"]')
                            .show(); // Tampilkan tombol Pause dan Finish
                        // Set the value and show the info
                        $('.tanggalPpt[data-id="' + id + '"]').text(formattedDate).hide();

                    } else if (ppt.status === "Finish") {
                        $('.start-ppt-editing[data-id="' + id + '"]').hide(); // Sembunyikan tombol Start
                        $('.finish-ppt-editing[data-id="' + id + '"]')
                            .hide();
                        // Set the value and show the info
                        $('.tanggalPpt[data-id="' + id + '"]').text(formattedDate).show();
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        // Function to record actions
        function recordActionPpt(id, action) {
            $.ajax({
                url: '/ppt/' + id + '/editing/' + action,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Ensure CSRF token is correctly injected
                },
                success: function(response) {

                    console.log('Action PPT editing:', response);
                    $('td.status-ppt[data-id="' + id + '"]').text(response.status);

                    // Update progress bar
                    let progressBar = $('.progress-bar-ppt[data-id="' + id + '"]'); // Target progress bar
                    progressBar.css('width', response.progress + '%'); // Update width
                    progressBar.attr('aria-valuenow', response.progress); // Update ARIA value
                    progressBar.text(response.progress + '%'); // Update progress text

                },
                error: function(xhr, status, error) {
                    console.error('Error recording action:', error);
                }
            });
        }

        function getPptEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('ppt.getPptEditForm') }}', // Menghapus spasi ekstra
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalEditContent').html(data.msg);
                    } else {
                        $('#modalEditContent').html('<p>Error loading form. Please try again.</p>');
                    }
                },
                error: function() {
                    $('#modalEditContent').html('<p>An error occurred. Please try again later.</p>');
                }
            });
        }

        function getLogPpt(id) {
            $.ajax({
                type: 'GET', // GET sesuai konvensi
                url: '{{ route('logPpt.getLogPpt') }}',
                data: {
                    'id': id // Tidak perlu CSRF token untuk GET secara default
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalContent').html(data.msg);
                        $('#modal').modal('show');
                    } else {
                        $('#modalContent').html('<p>Error loading form. Please try again.</p>');

                    }
                },
                error: function() {
                    $('#modalContent').html('<p>An error occurred. Please try again later.</p>');
                }
            });
        }

        function getLogVideo(id) {
            $.ajax({
                type: 'GET',
                url: '{{ route('logVideo.getLogVideo') }}',
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalContent').html(data.msg);
                        $('#modal').modal('show');
                    } else {
                        $('#modalContent').html('<p>Error loading form. Please try again.</p>');
                    }
                },
                error: function() {
                    $('#modalContent').html('<p>An error occurred. Please try again later.</p>');
                }
            });
        }

        function getVideoEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('video.getVideoEditForm') }}', // Menghapus spasi ekstra
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalEditContent').html(data.msg);
                    } else {
                        $('#modalEditContent').html('<p>Error loading form. Please try again.</p>');
                    }
                },
                error: function() {
                    $('#modalEditContent').html('<p>An error occurred. Please try again later.</p>');
                }
            });
        }
    </script>
@endsection
