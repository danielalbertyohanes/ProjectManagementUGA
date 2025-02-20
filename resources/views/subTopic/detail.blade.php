@extends('layouts.admin')

@section('content')
<<<<<<< Updated upstream
    <div class="container-fluid">
        <h3 class="h3 mb-2 text-gray-800">Detail Sub Topic</h3>
        <p>Halaman details berisi topik. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's.</p>
=======
    <link rel="stylesheet" href="{{ asset('admin/css/content.css') }}">

    <div class="container-fluid">
        <h1>Detail Sub Topik</h1>
        <p>Halaman Detail Sub Topik digunakan untuk mengelola detail Sub Topic dalam sistem. Dengan fitur ini, admin dapat melihat detail lengkap dari sub topic yang termasuk dalam topic course yang dipilih. Selain itu, halaman ini juga memungkinkan untuk menambahkan PPT dan Video, melakukan pencatatan durasi pengerjaannya.</p>

        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
            <a class="btn buttonCreate mb-3" href="{{ route('ppt.newPpt', $subTopic->id) }}">Tambah PPT</a>
        @endif
>>>>>>> Stashed changes

        <div class="mb-2">
            <h5 class="text-primary">NAMA SUB TOPIC: <span class="text-gray-800">{{ $subTopic->name }}</span></h5>
        </div>
        <a class="btn btn-success mb-3" href="{{ route('ppt.newPpt', $subTopic->id) }}">+ New PPT</a>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">PPT</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<<<<<<< Updated upstream
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Action</th>
=======
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Progres</th>
                                <th>Editing</th>
                                <th>Aksi</th>
>>>>>>> Stashed changes
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ppts as $ppt)
                            @php
                                $statusProgressMapping = [
                                    'Not Yet' => 0,
                                    'Progress' => 50,
                                    'Finished' => 100,
                                    'Cancel' => 0,
                                ];

                                $progressPercentage = $statusProgressMapping[$ppt->status] ?? 0;
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ppt->name }}</td>
                                    <td>{{ $ppt->status }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
<<<<<<< Updated upstream
                                            <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $progressPercentage }}%
=======
                                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-ppt" role="progressbar"
                                                style="width: {{ $ppt->progress }}%;" aria-valuenow="{{ $ppt->progress }}"
                                                aria-valuemin="0" aria-valuemax="100" data-id="{{ $ppt->id }}">
                                                {{ $ppt->progress }}%
>>>>>>> Stashed changes
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $ppt->created_at }}</td>
                                    <td>
<<<<<<< Updated upstream
                                        <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                            data-target="#modalEdit" onclick="getPptEditForm({{ $ppt->id }})">Edit</a>
=======
                                        <ul class="d-flex list-unstyled"
                                            style="justify-content: center; align-items: center; padding: 0;">
                                            @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                                @if ($ppt->finish_click_ppt)
                                                    <span class="tanggalPpt" data-id="{{ $ppt->id }}"
                                                        data-ppt-editing-finished-at="{{ $ppt->finish_click_ppt }}">
                                                        {{ \Carbon\Carbon::parse($ppt->finish_click_ppt)->format('d-M-Y') }}
                                                    </span>
                                                @else
                                                    <li>
                                                        <span class="tanggalPpt" data-id="{{ $ppt->id }}"
                                                            data-ppt-editing-finished-at="{{ $ppt->finish_click_ppt }}"
                                                            style="display:none;"></span>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="btn buttonCreate m-1 start-editing-ppt"
                                                            data-id="{{ $ppt->id }}">Start</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="btn buttonPublish m-1 finish-editing-ppt"
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
                                                <li><a href="#" class="btn buttonEdit m-1" data-toggle="modal"
                                                        data-target="#modalEdit"
                                                        onclick="getPptEditForm({{ $ppt->id }})">Edit</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="#" class="btn buttonDetail  m-1" data-toggle="modal"
                                                    data-target="#modalEditContent"
                                                    onclick="getLogPpt({{ $ppt->id }})">Log</a>
                                            </li>
                                        </ul>

>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
=======
        @if ($videos->isNotEmpty())
            <a class="btn buttonCreate mb-3" href="{{ route('video.newVideo', $subTopic->id) }}">Tambah Video</a>
        @endif

        {{-- Tabel Video --}}
>>>>>>> Stashed changes
        <div class="card shadow mb-4">
            @if ($videos->isNotEmpty())
                <a class="btn btn-success mb-3" href="{{ route('video.newVideo', $subTopic->id) }}">+ New Video</a>
            @endif

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Video</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<<<<<<< Updated upstream
                                <th class="text-center">No</th>
                                <th class="text-center">PPT</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Progress</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Detail Location</th>
                                <th class="text-center">Recording Started</th>
                                <th class="text-center">Recording Finished</th>
                                <th class="text-center">Recording ppt Started</th>
                                <th class="text-center">Recording ppt Finished</th>
                                <th class="text-center">Editing Started</th>
                                <th class="text-center">Editing Finished</th>
                                <th class="text-center">Action</th>
=======
                                <th>No</th>
                                <th>PPT</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Progres</th>
                                <th>Lokasi</th>
                                <th>Detail Lokasi</th>
                                <th>Recording Video</th>
                                <th>Recording PPT</th>
                                <th>Editing</th>
                                <th>Aksi</th>
>>>>>>> Stashed changes
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                            @php
                                $statusProgressMapping = [
                                    'Not Yet' => 0,
                                    'Recording' => 15,
                                    'Recorded' => 30,
                                    'PPT Recording' => 45,
                                    'PPT Recorded' => 60,
                                    'Editing' => 75,
                                    'Edited' => 90,
                                    'Pause Recording' => 50,
                                ];

                                $progressPercentage = $statusProgressMapping[$video->status] ?? 0;
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $video->ppt_name }}</td>
                                    <td>{{ $video->name }}</td>
                                    <td>{{ $video->status }}</td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
<<<<<<< Updated upstream
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $progressPercentage }}%;"
                                                aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                                {{ $progressPercentage }}%
=======
                                            <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-video" role="progressbar"
                                                style="width: {{ $video->progress }}%;"
                                                aria-valuenow="{{ $video->progress }}" aria-valuemin="0"
                                                aria-valuemax="100" data-id="{{ $video->id }}">
                                                {{ $video->progress }}%
>>>>>>> Stashed changes
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $video->location }}</td>
                                    <td>{{ $video->detail_location }}</td>
                                    <td>{{ $video->recording_video_started_at }}</td>
                                    <td>{{ $video->recording_video_finished_at }}</td>
                                    <td>{{ $video->recording_ppt_started_at }}</td>
                                    <td>{{ $video->recording_ppt_finished_at }}</td>
                                    <td>{{ $video->editing_started_at }}</td>
                                    <td>{{ $video->editing_finished_at }}</td>
                                    <td>
<<<<<<< Updated upstream
                                        <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                            data-target="#modalEdit"
                                            onclick="getVideoEditForm({{ $video->id }})">Edit</a>
=======
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
                                                <li><a href="#" class="btn buttonCreate m-1 start-recording-video"
                                                        data-id="{{ $video->id }}">Start</a></li>
                                                <li><a href="#" class="btn buttonBatal m-1 pause-recording-video"
                                                        data-id="{{ $video->id }}" style="display:none;">Pause</a>
                                                </li>

                                                <li><a href="#" class="btn buttonPublish m-1 finish-recording-video"
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
                                                <li><a href="#" class="btn buttonCreate m-1 start-recording-ppt"
                                                        data-id="{{ $video->id }}">Start</a></li>
                                                <li><a href="#" class="btn buttonBatal m-1 pause-recording-ppt"
                                                        data-id="{{ $video->id }}" style="display:none;">Pause</a>
                                                </li>
                                                <li><a href="#" class="btn buttonPublish m-1 finish-recording-ppt"
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
                                                <li><a href="#" class="btn buttonCreate m-1 start-editing"
                                                        data-id="{{ $video->id }}" style="display:none;">Start</a>
                                                </li>
                                                <li><a href="#" class="btn buttonPublish m-1 finish-editing"
                                                        data-id="{{ $video->id }}" style="display:none;">Finish</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>

                                    <td>
                                        <ul class="d-flex">
                                            <li>
                                                <a href="#" class="btn buttonEdit m-1" data-toggle="modal"
                                                    data-target="#modalEdit"
                                                    onclick="getVideoEditForm({{ $video->id }})">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#" class="btn buttonDetail  m-1" data-toggle="modal"
                                                    data-target="#modalEditContent"
                                                    onclick="getLogVideo({{ $video->id }})">Log</a>
                                            </li>
                                        </ul>

>>>>>>> Stashed changes
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
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modalEditContent">
<<<<<<< Updated upstream
=======
                    <p>Loading...</p> <!-- Placeholder saat konten sedang dimuat -->
                </div>
            </div>
        </div>
    </div>

    {{-- Log Modal --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide" role="document">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
>>>>>>> Stashed changes
                    {{-- Content will be loaded here via AJAX --}}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function getPptEditForm(id) {

            $.ajax({
                type: 'POST',
                url: '{{ route('ppt.getPptEditForm') }}',
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

        function getVideoEditForm(id) {

            $.ajax({
                type: 'POST',
                url: '{{ route('video.getVideoEditForm') }}',
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
