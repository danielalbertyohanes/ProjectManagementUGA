<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">
<h2>Activity Logs</h2>
<br>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Aksi</th>
                <th>Diproses Oleh</th>
                <th>Rincian</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody id="logTableBody">
            @foreach ($log_ppt as $log)
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
</div>
