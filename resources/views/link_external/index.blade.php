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
        <h1>MASTER EXTERNAL LINK</h1>
        <p>Modul External Link adalah modul yang digunakan untuk mengelola tautan (link) yang akan tampil pada modul course.
        </p>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <a class="btn btn-success mb-3" href="{{ route('link_external.create') }}">Tambah Eksternal Link</a>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR EKSTERNAL LINK</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">URL</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
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
