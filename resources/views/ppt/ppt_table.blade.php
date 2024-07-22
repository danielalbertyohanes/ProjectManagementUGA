<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">PPT</h6>
    </div>
    <a class="btn btn-success mb-3" href="{{ route('ppt.create') }}">+ New PPT</a>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Drive URL</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ppts as $ppt)
                        <tr>
                            <td>{{ $ppt->id }}</td>
                            <td>{{ $ppt->name }}</td>
                            <td>
                                <a href="{{ $ppt->drive_url }}" target="_blank">{{ $ppt->drive_url }}</a>
                            </td>
                            <td>{{ $ppt->status }}</td>
                            <td>{{ $ppt->progres }}%</td>
                            <td>{{ $ppt->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
