@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="h3 mb-2 text-gray-800">Detail Sub Topic</h3>
        <p>Halaman details berisi topik. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's.</p>

        <div class="mb-2">
            <h5 class="text-primary">NAMA SUB TOPIC: <span class="text-gray-800">{{ $subTopic->name }}</span></h5>
            <h5 class="text-primary">DRIVE URL PPT: <span class="text-gray-800"><a
                        href="{{ $subTopic->drive_url }}">{{ $subTopic->drive_url }}</a></span></h5>
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
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ppt->name }}</td>
                                    <td>{{ $ppt->status }}</td>
                                    <td>
                                        {{-- {{ $ppt->progress }}% --}}

                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 70%;"
                                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                        </div>
                                    </td>
                                    <td>{{ $ppt->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-right">
                    {{-- {{ $topics->links() }} untuk pindah halaman yang < 1 2 3 4 ... 10> --}}
                </div>
            </div>
        </div>

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $video->ppt_name }}</td>
                                    <td>{{ $video->name }}</td>
                                    <td>{{ $video->status }}</td>
                                    <td>
                                        {{-- {{ $video->progress }}% --}}
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 70%;"
                                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-right">
                    {{-- {{ $topics->links() }} untuk pindah halaman yang < 1 2 3 4 ... 10> --}}
                </div>
            </div>
        </div>
    @endsection

    @section('javascript')
        <script>
            // Create
            function loadCreateForm() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dosen.getCreateForm') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalCreateContent').html(data.msg);
                        }
                    }
                });
            }

            // EDIT
            function getEditForm(dosen_id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dosen.getEditForm') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': dosen_id
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
