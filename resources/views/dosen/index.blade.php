@extends('layouts.admin')

@section('content')
<style>
    h1 {
        color: royalblue;
        font-weight: bold;
        font-size: 2rem;
        font-family: Arial, Helvetica, sans-serif;
    }

    p {
        font-size: 1rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-family: Arial, Helvetica, sans-serif;
        color: #232323;
    }
    th {
        font-weight: bold;
        text-align: center;
        color: #232323;
        font-family: Arial, Helvetica, sans-serif;
    }

    td {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        color: #232323;
    }
</style>
    <div class="container-fluid">
        <h1>MASTER KONTRIBUTOR</h1>
        <p>Master Kontributor adalah modul yang digunakan untuk mendefinisikan dan mengelola data dosen atau
            kontributor.</p>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateDosen" onclick="loadCreateForm()">Tambah Kontributor</button>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR KONTRIBUTOR</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NPK</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Fakultas</th>
                                <th class="text-center">Nomor Telepon</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $d)
                                <tr id="tr_{{ $d->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->npk }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->fakultas }}</td>
                                    <td>{{ $d->no_telp }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td>
                                        {{-- @if (Auth::user()->position_id == '3') --}}
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
                                        {{-- @endif --}}
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
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
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
