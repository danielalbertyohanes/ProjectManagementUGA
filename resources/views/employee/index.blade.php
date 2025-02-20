@extends('layouts.admin')

@section('content')
    <link href="{{ asset('admin/css/content.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <h1>Master Employee</h1>
        <p>Modul Master Employee digunakan untuk mengelola informasi karyawan dalam sistem. Dengan fitur ini, admin dapat
            menambahkan, mengedit, dan melihat daftar karyawan. Data yang dikelola mencakup Nomor Pokok Karyawan (NPK),
            nama, nomor telepon, email, serta posisi karyawan dalam organisasi.</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <!-- Button Tambah Employee -->
        <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreateEmployee"
            onclick="loadCreateForm()">Tambah Employee</button>

        <!-- Tabel Employee -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPK</th>
                                <th>Nama</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr id="tr_{{ $user->npk }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->npk }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->no_telp }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->position->name }}</td>
                                    @if ($user->id != '1')
                                        <td>
                                            <a href="#" class="btn buttonEdit" data-toggle="modal"
                                                data-target="#modalEdit" onclick="getEditForm({{ $user->id }})">
                                                Edit
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal ADD --}}
    <div class="modal fade" id="modalCreateEmployee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    {{-- Content will be loaded dynamically --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal EDIT --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    {{-- Content will be loaded dynamically --}}
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
                url: '{{ route('employee.getCreateForm') }}',
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
                url: '{{ route('employee.getEditForm') }}',
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
