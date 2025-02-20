@extends('layouts.admin')

@section('content')
<<<<<<< Updated upstream
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Employee</h1>
        <p>Info terkait dosen agar informative</p>
=======
    <link href="{{ asset('admin/css/content.css') }}" rel="stylesheet">

    <div class="container-fluid">
        <h1>Master Employee</h1>
        <p>Modul Master Employee digunakan untuk mengelola informasi karyawan dalam sistem. Dengan fitur ini, admin dapat menambahkan, mengedit, dan melihat daftar karyawan. Data yang dikelola mencakup Nomor Pokok Karyawan (NPK), nama, nomor telepon, email, serta posisi karyawan dalam organisasi.</p>

>>>>>>> Stashed changes
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

<<<<<<< Updated upstream
        @if (Auth::user()->position_id == '3')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateDosen">+ New Course</button>
        @endif
=======
        <!-- Button Tambah Employee -->
        <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreateEmployee" onclick="loadCreateForm()">Tambah Employee</button>
>>>>>>> Stashed changes

        <!-- Tabel Employee -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR EMPLOYEE</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<<<<<<< Updated upstream
                                <th class="text-center">No</th>
                                <th class="text-center">NPK</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Position</th>

=======
                                <th>No</th>
                                <th>NPK</th>
                                <th>Nama</th>
                                <th>Nomor Telepon</th>
                                <th>Email</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                                    <td>{{ $user->position_name }}</td>
=======
                                    <td>{{ $user->position->name }}</td>
                                    @if ($user->id != '1')
                                        <td>
                                            <a href="#" class="btn buttonEdit" data-toggle="modal"
                                                data-target="#modalEdit" onclick="getEditForm({{ $user->id }})">
                                                Edit
                                            </a>
                                        </td>
                                    @endif
>>>>>>> Stashed changes
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<<<<<<< Updated upstream
    <!-- Modal ADD -->
    <div class="modal fade" id="modalCreateDosen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content for adding a new lecturer goes here -->
=======
    {{-- Modal ADD --}}
    <div class="modal fade" id="modalCreateEmployee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    {{-- Content will be loaded dynamically --}}
>>>>>>> Stashed changes
                </div>
            </div>
        </div>
    </div>

<<<<<<< Updated upstream
    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
=======
    {{-- Modal EDIT --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
>>>>>>> Stashed changes
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    {{-- Content will be loaded dynamically --}}
                </div>
            </div>
        </div>
    </div>
@endsection
