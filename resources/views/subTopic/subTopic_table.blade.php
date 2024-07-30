<!-- resources/views/subTopic/index.blade.php -->

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sub-Topic</h6>
    </div>
    <a class="btn btn-success mb-3" href="{{ route('subTopic.create') }}">+ New Sub-Topic</a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Topic</th>
                        <th>Nama Sub-Topic</th>
                        <th>Tanggal Buat</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subTopics as $subTopic)
                    <tr>
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