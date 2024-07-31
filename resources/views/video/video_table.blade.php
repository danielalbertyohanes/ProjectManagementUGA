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
                        <th class="text-center">No</th>
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
                        <th class="text-center">Sent</th>
                        <th class="text-center">ACC</th>
                        <th class="text-center">Uploaded</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">User</th>
                        <th class="text-center">PPT</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
