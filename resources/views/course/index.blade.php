@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">COURSE</h1>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (Auth::user()->position_id == '3')
        <a class="btn btn-success mb-3" href="{{ route('course.create') }}">+ New Course</a>
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
                                    @if (Auth::user()->position_id == '3')
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalEditA"
                                            onclick="getEditForm({{ $d->id }})">EDIT
                                        </a>
                                        <form method="POST" action="{{ route('course.destroy', $d->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete {{ $d->id }} - {{ $d->name }}?');">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTypeModalLabel">Add Type Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form will be loaded here using AJAX -->
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

// Add
// $(document).ready(function () {
//         $('[data-target="#"]').on('click', function () {
//             $.ajax({
//                 url: ,
//                 method: 'GET',
//                 success: function (data) {
//                     $('# .modal-body').html(data);
//                 },
//                 error: function (jqXHR, textStatus, errorThrown) {
//                     console.error('AJAX request failed: ' + textStatus + ', ' + errorThrown);
//                 }
//             });
//         });
//     });

// EDIT
    function getEditForm(course_id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("course.getEditForm") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'id': course_id
            },
            success: function (data) {
                if (data.status === 'ok') {
                    $('#modalContent').html(data.msg);
                }
            }
        });
    }
</script>
@endsection