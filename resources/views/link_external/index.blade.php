@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Link External</h1>
        <p>Info terkait link agar informative</p>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <a class="btn btn-success mb-3" href="{{ route('link_external.create') }}">+ New Link</a>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr id="tr_{{ $link->id }}">
                                    <td>{{ $link->name }}</td>
                                    <td>{{ $link->value }}</td>
                                    <td>{{ $link->status }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalEditA" onclick="getEditForm({{ $link->id }})">EDIT
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // EDIT
        function getEditForm(link_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('link.getEditForm') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': link_id
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