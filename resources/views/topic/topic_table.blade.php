@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Topic</h1>
        <p>Info terkait dosen agar informative</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Topic</h6>
            </div>
            <a class="btn btn-success mb-3" href="{{ route('topic.create') }}">+ New Topic</a>
            <!-- Perbaiki route ke create -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No1</th>
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $topic->name }}</td>
                                    <td>{{ $topic->created_at }}</td>
                                    <td>{{ $topic->status }}</td>
                                    <td>{{ $topic->progress }}</td>
                                    <td>
                                        <a class="btn btn-success" href="#">+ Add Sub-Topic</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('javascript')
        <script>
            // Create
            function loadCreateForm() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dosen.getCreateForm') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalCreateContent').html(data.msg);
                        }
                    }
                });
            }

            // EDIT
            function getEditForm(dosen_id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dosen.getEditForm') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': dosen_id
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalContent').html(data.msg);
                        }
                    }
                });
            }
        </script>
    @endsection
