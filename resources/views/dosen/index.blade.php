@extends('layouts.admin')

@section('content')
<<<<<<< Updated upstream
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">DOSEN</h1>
        <p>Info terkait dosen agar informative</p>
=======
    <link rel="stylesheet" href="{{ asset('admin/css/content.css') }}">

    <div class="container-fluid">
        <h1>MASTER KONTRIBUTOR</h1>
        <p>Modul Master Kontributor digunakan untuk mengelola informasi kontributor dalam sistem. Dengan fitur ini admin dapat menambahkan, mengedit, menghapus dan melihat daftar kontributor atau dosen. Data yang dikelola mencakup Nomor Pokok Karyawan (NPK), nama, fakultas, nomor telepon, serta deskripsi kontributor.</p>

>>>>>>> Stashed changes
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

<<<<<<< Updated upstream
        @if (Auth::user()->position_id == '3')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateDosen"
                onclick="loadCreateForm()">+ New Course</button>
        @endif
=======
        {{-- Button Tambah Kontributor --}}
        <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreateDosen" onclick="loadCreateForm()">Tambah Kontributor</button>
>>>>>>> Stashed changes

        {{-- Tabel Kontributor --}}
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
<<<<<<< Updated upstream
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
=======
                                        {{-- @if (Auth::user()->position_id == '3') --}}
                                        <a href="#" class="btn buttonEdit" data-toggle="modal"
                                            data-target="#modalEditA" onclick="getEditForm({{ $d->id }})">Edit
                                        </a>
                                        <a href="#" class="btn buttonDelete" onclick="confirmDelete('{{ route('dosen.destroy', $d->id) }}', '{{ $d->name }}')">
                                            Delete
                                        </a>
>>>>>>> Stashed changes
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

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalDeleteConfirm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <strong id="deleteDosenName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn buttonBatal" data-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn buttonDelete">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // ADD
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

        // DELETE
        function confirmDelete(actionUrl, dosenName) {
            $('#deleteDosenName').text(dosenName);
            $('#deleteForm').attr('action', actionUrl);
            $('#modalDeleteConfirm').modal('show');
        }

        $(document).ready(function () {
            $('#modalDeleteConfirm').on('hidden.bs.modal', function () {
                $('#deleteDosenName').text('');
                $('#deleteForm').attr('action', '');
            });

            $('.buttonBatal').on('click', function () {
                $('#modalDeleteConfirm').modal('hide');
            });

            $('.close').on('click', function () {
                $('#modalDeleteConfirm').modal('hide');
            });
        });
    </script>
@endsection
