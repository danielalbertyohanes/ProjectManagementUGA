@extends('layouts.admin')

@section('content')
    <style>
        .panduan-links a {
            display: block;
            /* Ensure links are displayed as block elements */
            margin-bottom: 10px;
            /* Add some space between the links */
        }
    </style>

    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">COURSE</h1>
        <div class="panduan-links">
            <a href="http://">Panduan_rpp_path</a>
            <a href="http://">Panduan_rpp_path</a>
            <a href="http://">Panduan_rpp_path</a>
            <a href="http://">Panduan_rpp_path</a>
            <a href="http://">Panduan_rpp_path</a>
        </div>
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
                                <th class="text-center">Dosen</th>
                                <th class="text-center">Pic_course</th>
                                <th class="text-center">Proggres</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">manage topic & sub topic</th>
                                <th class="text-center">manage ppt & video</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr id="tr_{{ $course->id }}">
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td>{{ $course->created_at }}</td>
                                    <td>{{ $course->jumlah_video }}</td>
                                    <td>
                                        <ul>
                                            @php
                                                $ketua = $course->dosens->where('pivot.role', 'ketua')->first();
                                                $anggota = $course->dosens->where('pivot.role', 'anggota');
                                            @endphp

                                            @if ($ketua)
                                                <li>
                                                    @if ($anggota->isNotEmpty())
                                                        <strong>Ketua:</strong>
                                                    @endif
                                                    {{ $ketua->name }}
                                                </li>
                                            @endif

                                            @if ($anggota->isNotEmpty())
                                                <li>
                                                    <strong>Anggota:</strong>
                                                    @foreach ($anggota as $dosen)
                                                        {{ $dosen->name }},
                                                    @endforeach
                                                </li>
                                            @endif

                                            @if (!$ketua && $anggota->isEmpty())
                                                <li>Tidak ada dosen</li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td>{{ $course->user->name }}</td>
                                    <td>{{ $course->proggres }}</td>
                                    <td>{{ $course->status }}</td>
                                    <td><button>Topic & Subtopic</button></td>
                                    <td>
                                        <a class="btn btn-success" href="#" data-toggle="modal"
                                            data-target="#pptModal" onclick="getDetailData({{ $course->id }})">
                                            Ppt & Video
                                        </a>
                                    </td>

                                    </td>
                                    <td>
                                        @if (Auth::user()->position_id == '3')
                                            <a href="#" class="btn btn-warning" data-toggle="modal"
                                                data-target="#modalEditA"
                                                onclick="getEditForm({{ $course->id }})">EDIT</a>
                                            <form method="POST" action="{{ route('course.destroy', $course->id) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure to delete {{ $course->id }} - {{ $course->name }}?');">
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

    <!-- Modal for displaying PPT details -->
    <div class="modal fade" id="pptModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide" role="document">
            <div class="modal-content" id="msg">
                <img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" alt="Loading..."
                    style="width: 100px;">
                <p>Loading...</p>
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
        function getEditForm(course_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('course.getEditForm') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': course_id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalContent').html(data.msg);
                    }
                }
            });
        }

        function getDetailData(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('course.showAjax') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(data) {
                    $("#msg").html(data.msg);
                }
            });
        }
    </script>
@endsection
