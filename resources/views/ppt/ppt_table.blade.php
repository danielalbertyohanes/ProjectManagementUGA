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
                            <td>{{ $ppt->progress }}%</td>
                            <td>{{ $ppt->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
