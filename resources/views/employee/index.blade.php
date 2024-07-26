@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Employee</h1>
        <p>Info terkait dosen agar informative</p>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->position_id == '3')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateDosen">+ New Course</button>
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
                                <th class="text-center">NPK</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Position</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr id="tr_{{ $user->npk }}">
                                    <td>{{ $user->npk }}</td>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->no_telp }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->position_name }}</td>
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
                    <!-- Content for adding a new lecturer goes here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalContent">
                    <!-- Content for editing a lecturer goes here -->
                </div>
            </div>
        </div>
    </div>
@endsection
