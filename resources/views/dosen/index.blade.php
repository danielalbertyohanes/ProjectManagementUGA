@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">DOSEN</h1>
        <p>Info terkait dosen agar informative</p>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->position_id == '3')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateDosen"
                onclick="loadCreateForm()">+ New Course</button>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                {{-- <th class="text-center">ID</th> --}}
                                <th class="text-center">Name</th>
                                <th class="text-center">NPK</th>
                                <th class="text-center">Faculty</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $d)
                                <tr id="tr_{{ $d->id }}">
                                    {{-- <td>{{ $d->id }}</td> --}}
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->npk }}</td>
                                    <td>{{ $d->fakultas }}</td>
                                    <td>{{ $d->no_tlpn }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td>
                                        @if (Auth::user()->position_id == '3')
                                            <a href="#" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modalEditA" onclick="getEditForm({{ $d->id }})">EDIT
                                            </a>
                                            <form method="POST" action="{{ route('dosen.destroy', $d->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }}?');">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD -->
    <div class="modal fade" id="modalCreateDosen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content will be loaded dynamically -->
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
