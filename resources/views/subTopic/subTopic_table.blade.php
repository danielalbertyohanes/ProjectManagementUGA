<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sub-Topic</h6>
    </div>
    <a class="btn btn-success mb-3" href="{{ route('subTopic.create') }}">+ New Sub-Topic</a>
    <!-- Perbaiki route ke create -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Topic</th>
                        <th class="text-center">Nama Sub-Topic</th>
                        <th class="text-center">Tanggal Buat</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Progress</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subtopics as $subTopic)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subTopic->topic_name }}</td>
                            <td>{{ $subTopic->sub_topic_name }}</td>
                            <td>{{ $subTopic->created_at }}</td>
                            <td>{{ $subTopic->status }}</td>
                            <td>{{ $subTopic->progress }}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
