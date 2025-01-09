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
            padding-bottom: 2rem;
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
        <h1>MASTER EMPLOYEE</h1>
        <p>Master Employee adalah modul yang digunakan untuk mendefinisikan dan mengelola data karyawan.</p>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR EMPLOYEE</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPK</th>
                                <th>Nama Employee</ths=>
                                <th>Nomor Telepon</th>
                                <th>Email</th=>
                                <th>Posisi</th=>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr id="tr_{{ $user->npk }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->npk }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->no_telp }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->position->name }}</td>
                                    <td> <a href="#" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalEdit" onclick="getEditForm({{ $user->id }})">EDIT
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
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <!-- Content for editing a lecturer goes here -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
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
