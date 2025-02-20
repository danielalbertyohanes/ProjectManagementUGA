@extends('layouts.admin')

@section('content')
<<<<<<< Updated upstream
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Link External</h1>
        <p>Info terkait link agar informative</p>
=======
    <link rel="stylesheet" href="{{ asset('admin/css/content.css') }}">

    <div class="container-fluid">
        <h1>MASTER EXTERNAL LINK</h1>
        <p>Modul External Link digunakan untuk mengelola informasi link external dalam sistem.
        Dengan fitur ini, admin dapat menambahkan, mengedit, dan melihat daftar link external. Data yang dikelola mencakup nama, url, serta status link external. Jika status active maka akan tampil pada halaman master course.</p>

>>>>>>> Stashed changes
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

<<<<<<< Updated upstream
        <a class="btn btn-success mb-3" href="{{ route('link_external.create') }}">+ New Link</a>
=======
        {{-- Button Tambah Link External --}}
        <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreateLink" onclick="loadCreateForm()">Tambah External Link</button>
>>>>>>> Stashed changes

        {{-- Tabel Link External --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
<<<<<<< Updated upstream
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
=======
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR EXTERNAL LINK</h6>
>>>>>>> Stashed changes
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<<<<<<< Updated upstream
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
=======
                                <th>No</th>
                                <th>Nama</th>
                                <th>URL</th>
                                <th>Status</ths=>
                                <th>Aksi</th>
>>>>>>> Stashed changes
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $link)
                                <tr id="tr_{{ $link->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $link->name }}</td>
                                    <td>{{ $link->url }}</td>
                                    <td>{{ $link->status }}</td>
                                    <td>
                                        <a href="#" class="btn buttonEdit" data-toggle="modal"
                                            data-target="#modalEdit" onclick="getEditForm({{ $link->id }})">Edit
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

    {{-- Modal ADD --}}
    <div class="modal fade" id="modalCreateLink" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    {{-- Content will be loaded dynamically --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
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
        // ADD
        function loadCreateForm() {
            $.ajax({
                type: 'POST',
                url: '{{ route('link_external.getCreateForm') }}',
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
