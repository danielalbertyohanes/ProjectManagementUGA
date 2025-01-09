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
        <h1>MASTER PERIODE</h1>
        <p>Master Periode adalah modul yang digunakan untuk mendefinisikan dan mengelola periode waktu akademik dimana kursus-kursus atau mata pelajaran diselenggarakan.</p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->position_id == '1')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreateDosen"
                onclick="loadCreateForm()">Tambah Periode</button>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DAFTAR PERIODE</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tanggal Mulai</th>
                                <th class="text-center">Tanggal Selesai</th>
                                <th class="text-center">Tanggal Kurasi</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periodes as $periode)
                                <tr id="tr_{{ $periode->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $periode->name }}</td>
                                    <td>{{ $periode->start_date }}</td>
                                    <td>{{ $periode->end_date }}</td>
                                    <td>{{ $periode->kurasi_date }}</td>
                                    <td>{{ $periode->status }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalEditA" onclick="getEditForm({{ $periode->id }})">EDIT
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
    <!-- Modal Create -->
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
                url: '{{ route('periode.getCreateForm') }}',
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
        function getEditForm(periode_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('periode.getEditForm') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': periode_id
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
