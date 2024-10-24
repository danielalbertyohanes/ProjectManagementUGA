@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="h3 mb-2 text-gray-800">Detail Sub Topic</h3>
    <p>Halaman details berisi topik. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
        Ipsum has been the industry's.</p>


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
                            <th class="text-center">No</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Action</th>
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
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $ppt->progress }}%;"
                                        aria-valuenow="{{ $ppt->progress }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ $ppt->progress }}%
                                    </div>
                                </div>
                            </td>
                            <td>{{ $ppt->created_at }}</td>
                            <td>
                                <ul class="d-flex list-unstyled ">
                                    <li><a href="#" class="btn btn-warning m-1" data-toggle="modal"
                                            data-target="#modalEdit"
                                            onclick="getPptEditForm({{ $ppt->id }})">Edit</a></li>
                                    <li>
                                        <a href="#" class="btn btn-info  m-1" data-toggle="modal"
                                            data-target="#modalEditContent"
                                            onclick="getLogPptForm({{ $ppt->id }})">Log</a>
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
                            <th class="text-center">No</th>
                            <th class="text-center">PPT</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Detail Location</th>
                            <th class="text-center">Recording Video</th>
                            <th class="text-center">Recording PPT</th>
                            <th class="text-center">Editing Started</th>
                            <th class="text-center">Action</th>

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
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $progressPercentage }}%;"
                                        aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ $progressPercentage }}%
                                    </div>
                                </div>
                            </td>

                            <td>{{ $video->detail_location }}</td>
                            <td>
                                <ul class="d-flex list-unstyled ">
                                    <li>
                                        <a href="#" class="btn btn-primary m-1">Pause</a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-primary m-1">Play</a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-primary m-1">Done</a>
                                    </li>
                                </ul>

                            </td>
                            <td>
                                <ul class="d-flex list-unstyled ">
                                    <li>
                                        <a href="#" class="btn btn-primary m-1">Pause</a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-primary m-1">Play</a>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-primary m-1">Done</a>
                                    </li>
                                </ul>

                            </td>
                            <td>
                                <ul class="d-flex list-unstyled ">
                                    <li>
                                        <a href="#" class="btn btn-danger m-1">Edit</a>
                                    </li>

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
                                            onclick="getLogVideoForm({{ $video->id }})">Log</a>
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
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
            url: '{{ route("ppt.getPptEditForm") }}', // Menghapus spasi ekstra
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

    function getLogPptForm(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("logPpt.getLogPptForm") }}', // Menghapus spasi ekstra
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function(data) {
                if (data.status === 'ok') {
                    $('#modalEditContent').html(data.msg);
                    $('#modalEdit').modal('show');
                } else {
                    $('#modalEditContent').html('<p>Error loading form. Please try again.</p>');
                }
            },
            error: function() {
                $('#modalEditContent').html('<p>An error occurred. Please try again later.</p>');
            }
        });
    }

    function getLogVideoForm(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("logVideo.getLogVideoForm") }}', // Menghapus spasi ekstra
            data: {
                '_token': '{{ csrf_token() }}',
                'id': id
            },
            success: function(data) {
                if (data.status === 'ok') {
                    $('#modalEditContent').html(data.msg);
                    $('#modalEdit').modal('show');
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
            url: '{{ route("video.getVideoEditForm") }}', // Menghapus spasi ekstra
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