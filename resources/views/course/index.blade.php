@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">COURSE</h1>
        @if (@session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (Auth::user()->position_id == '3')
            <a class="btn btn-success" href="">+ new Course</a>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Created_at</th>
                                <th class="text-center">Jumlah_video</th>
                                <th class="text-center">Panduan_rpp_path</th>
                                <th class="text-center">Template_rpp_path</th>
                                <th class="text-center">Uploaded_rpp_path</th>
                                <th class="text-center">Pic_course</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $d)
                                <tr id="tr_{{ $d->id }}">
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td>{{ $d->created_at }}</td>
                                    <td>{{ $d->jumlah_video }}</td>
                                    <td>{{ $d->panduan_rpp_path }}</td>
                                    <td>{{ $d->template_rpp_path }}</td>
                                    <td>{{ $d->uploaded_rpp_path }}</td>
                                    <td>{{ $d->user->name }}</td>
                                    <td>
                                        {{-- <a class="btn btn-success" data-toggle="modal" href="#myModal"
                                                onclick="getDetailData({{ $d->id }})"> Rincian Pembelian</a> --}}

                                        @if (Auth::user()->position_id == '3')
                                            <a class="btn btn-warning" href="{{ route('course.edit', $d->id) }}">Edit</a>

                                            {{-- <a href="#modalEditA" class="btn btn-warning
                                            " data-toggle="modal"
                                                onclick="getEditForm({{ $d->id }})">Edit</a> --}}
                                            {{-- <a href="#" value="DeleteNoReload" class="btn btn-danger"
                                                onclick="if(confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ')) deleteDataRemoveTR({{ $d->id }})">Delete
                                                without Reload</a> --}}

                                            <form method="POST" action="{{ route('course.destroy', $d->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }} ? ');">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
