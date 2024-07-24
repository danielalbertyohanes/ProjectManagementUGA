<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Topic</h6>
    </div>
    <a class="btn btn-success mb-3" href="{{ route('topic.create') }}">+ New Topic</a> <!-- Perbaiki route ke create -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Tanggal Buat</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topics as $topic)
                    <tr>
                        <td>{{ $topic->id }}</td>
                        <td>{{ $topic->name }}</td>
                        <td>{{ $topic->created_at }}</td>
                        <td>{{ $topic->status }}</td>
                        <td>{{ $topic->progress }}</td>
                        <td>
                            <a class="btn btn-success" href="#">+ Add Sub-Topic</a> <!-- Sesuaikan jika perlu -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>