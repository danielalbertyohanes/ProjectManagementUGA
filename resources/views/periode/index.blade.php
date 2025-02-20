@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/content.css') }}">

    <div class="container-fluid">
        <h1>MASTER PERIODE</h1>
        <p>Modul Master Periode digunakan untuk mengelola informasi karyawan dalam sistem. Dengan fitur ini, admin dapat
            menambahkan, mengedit, dan melihat daftar periode. Data yang dikelola mencakup nama, tanggal mulai, tanggal
            selesai, anggal kurasi, serta status periode. Jika status active maka akan tampil pada inputan tambah course.
        </p>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->position_id == '1')
            {{-- Button Tambah Periode --}}
            <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreatePeriode"
                onclick="loadCreateForm()">Tambah Periode</button>
        @endif

        {{-- Tabel Link External --}}
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
                                <th>Nama</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Tanggal Kurasi</ths=>
                                <th>Status</th=>
                                <th>Aksi</th>
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
                                        <a href="#" class="btn buttonEdit" data-toggle="modal"
                                            data-target="#modalEdit" onclick="getEditForm({{ $periode->id }})">Edit
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
    <div class="modal fade" id="modalCreatePeriode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-wide">
            <div class="modal-content">
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    {{-- Modal EDIT --}}
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
