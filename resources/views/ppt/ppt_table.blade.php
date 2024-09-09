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
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $ppt->name }}</td>
                            <td class="text-center">{{ $ppt->status }}</td>
                            <td class="text-center">
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $progressPercentage }}%
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $ppt->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('ppt.edit', $ppt->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
