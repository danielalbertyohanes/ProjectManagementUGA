<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Video</h6>
    </div>

    <a class="btn btn-success mb-3" href="{{ route('video.create') }}">+ New Video</a>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Location</th>
                        <th>Detail Location</th>
                        <th>Recording Started</th>
                        <th>Recording Finished</th>
                        <th>Recording ppt Started</th>
                        <th>Recording ppt Finished</th>
                        <th>Editing Started</th>
                        <th>Editing Finished</th>
                        <th>Sent</th>
                        <th>ACC</th>
                        {{-- <th>URL Video</th> --}}
                        <th>Uploaded</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>User</th>
                        <th>PPT</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>{{ $video->name }}</td>
                            <td>{{ $video->status }}</td>
                            <td>{{ $video->progress }}%</td>
                            <td>{{ $video->location }}</td>
                            <td>{{ $video->detail_location }}</td>
                            <td>{{ $video->recording_video_started_at }}</td>
                            <td>{{ $video->recording_video_finished_at }}</td>
                            <td>{{ $video->recording_ppt_started_at }}</td>
                            <td>{{ $video->recording_ppt_finished_at }}</td>
                            <td>{{ $video->editing_started_at }}</td>
                            <td>{{ $video->editing_finished_at }}</td>
                            <td>{{ $video->sent_at }}</td>
                            <td>{{ $video->acc_at }}</td>
                            {{-- <td>
                                <a href="{{ $video->url_video }}" target="_blank">{{ $video->url_video }}</a>
                            </td> --}}
                            <td>{{ $video->uploaded_at }}</td>
                            <td>{{ $video->created_at }}</td>
                            <td>{{ $video->updated_at }}</td>
                            <td>{{ $video->ppt_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
