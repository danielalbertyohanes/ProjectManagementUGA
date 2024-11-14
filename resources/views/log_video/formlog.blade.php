<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Action</th>
            <th>Performed By</th>
            <th>Details</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($log_video as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->status }}</td>
                <td>{{ $log->user_name }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
