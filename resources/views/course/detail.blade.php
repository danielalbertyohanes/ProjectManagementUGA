@extends('layouts.admin')

@section('content')
<<<<<<< Updated upstream
    <div class="container-fluid">
        <h3 class="h3 mb-2 text-gray-800">Detail Course</h3>
        <p>Halaman details berisi topik. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's.</p>

=======
    <link rel="stylesheet" href="{{ asset('admin/css/content.css') }}">

    <div class="container-fluid">
        <button onclick="window.history.back()" class="btn buttonBatal">Kembali</button>
        <h1>Detail Course</h1>
        <p>Halaman Detail Course digunakan untuk mengelola detail course dalam sistem. Dengan fitur ini, admin dapat melihat detail lengkap dari course yang dipilih, daftar topik yang termasuk dalam course, lengkap dengan status progressnya. Selain itu, halaman ini juga memungkinkan untuk menambahkan topik baru atau mengedit topik yang sudah ada.</p>
>>>>>>> Stashed changes
        <div class="mb-2">
            <h5 class="text-primary">
                KODE COURSE: <span class="text-gray-800">{{ $course->kode_course }}</span>
            </h5>
            <h5 class="text-primary">
                NAMA COURSE: <span class="text-gray-800">{{ $course->name }}</span>
            </h5>
            <h5 class="text-primary">
                PERIODE: <span class="text-gray-800">
                    @foreach ($course->periode as $periode)
                        {{ $periode->name }}<br>
                    @endforeach
                </span>
            </h5>

            <h5 class="text-primary">
                TANGGAL_MULAI: <span class="text-gray-800">
                    @foreach ($course->periode as $periode)
                        {{ \Carbon\Carbon::parse($periode->start_date)->format('d-m-yy') }}</>
                        <br>
                    @endforeach
                </span>
            </h5>

            <h5 class="text-primary">
                TANGGAL_SELESAI: <span class="text-gray-800">
                    @foreach ($course->periode as $periode)
                        {{ \Carbon\Carbon::parse($periode->end_date)->format('d-m-Y') }}</>
                        <br>
                    @endforeach
                </span>
            </h5>

            <h5 class="text-primary">
                TANGGAL_KURASI: <span class="text-gray-800">
                    @foreach ($course->periode as $periode)
                        {{ \Carbon\Carbon::parse($periode->kurasi_date)->format('d-m-Y') }}</>
                        <br>
                    @endforeach
                </span>
            </h5>

            <h5 class="text-primary">
                DRIVE_URL:
                <span class="text-gray-800">
                    <a href="{{ $course->drive_url }}">{{ $course->drive_url }}</a>
                </span>
            </h5>
            <h5 class="text-primary">
                VIDEO_URL:
                <span class="text-gray-800">
                    <a href="{{ $course->video_url }}">{{ $course->video_url }}</a>
                </span>
            </h5>
        </div>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreate"
                onclick="loadCreateForm({{ $course->id }})">Tambah Topic</button>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Course</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Topik</th>
                                <th>Sub-Topik</th>
<<<<<<< Updated upstream
                                <th>Progres</th>
                                <th>Detail</th>
                                @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                    <th>Aksi Sub Topic</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topics as $topic)
                                @php
                                    $subTopicsForThisTopic = $subTopics->where('topic_id', $topic->id);
                                    $subTopicCount = $subTopicsForThisTopic->count();
                                    $rowspan = $subTopicCount > 0 ? $subTopicCount : 1;
                                @endphp

                                @if ($subTopicCount > 0)
                                    @php $firstSubTopic = $subTopicsForThisTopic->first(); @endphp
                                    <tr>
                                        <td rowspan="{{ $rowspan }}">{{ $loop->iteration }}</td>
                                        <td rowspan="{{ $rowspan }}">{{ $topic->name }}</td>
                                        <td>{{ $firstSubTopic->name }}</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width:{{ $firstSubTopic->progress }}%;"
                                                    aria-valuenow="{{ $firstSubTopic->progress }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $firstSubTopic->progress }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-info"
                                                href="{{ route('subTopic.show', $firstSubTopic->id) }}">
                                                Detail
                                            </a>
                                        </td>
                                        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                            <td>
                                                <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                                    data-target="#modalEditSubTopics"
                                                    onclick="getEditSubTopicForm({{ $firstSubTopic->id }})">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('subTopic.destroy', $firstSubTopic->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Hapus" class="btn btn-danger"
                                                        onclick="return confirm('Apa kamu yakin menghapus {{ $firstSubTopic->name }}?');">
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                    @foreach ($subTopicsForThisTopic->skip(1) as $subTopic)
                                        <tr>
                                            <td>{{ $subTopic->name }}</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width:{{ $subTopic->progress }}%;"
                                                        aria-valuenow="{{ $subTopic->progress }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $subTopic->progress }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <a class="btn btn-info"
                                                    href="{{ route('subTopic.show', $subTopic->id) }}">
                                                    Detail
                                                </a>
                                            </td>
                                            @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                                <td>
                                                    <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                                        data-target="#modalEditSubTopics"
                                                        onclick="getEditSubTopicForm({{ $subTopic->id }})">Edit</a>
                                                    <form method="POST"
                                                        action="{{ route('subTopic.destroy', $subTopic->id) }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="Hapus" class="btn btn-danger"
                                                            onclick="return confirm('Apa kamu yakin menghapus {{ $subTopic->name }}?');">
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $topic->name }}</td>
                                        <td colspan="3" class="text-center">Tidak ada Sub-Topik</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateLabel">Create</h5>
                    </div>
                    <div class="modal-body" id="modalCreateContent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit-->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-wide">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit</h5>
                    </div>
                    <div class="modal-body" id="modalContent">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        function loadCreateForm(course_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('topic.getCreateForm') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'course_id': course_id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalCreateContent').html(data.msg);
                        $('#modalCreate').modal('show');
                    } else {
                        console.error('Error:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }

        function getEditFormTopic(topic_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('topic.getEditForm') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': topic_id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalContent').html(data.msg);
                        $('#modalEdit').modal('show');
                    } else {
                        console.error('Error:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }

        function getEditSubTopicForm(sub_topic_id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('subtopic.getEditForm') }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id': sub_topic_id
                },
                success: function(data) {
                    if (data.status === 'ok') {
                        $('#modalContent').html(data.msg);
                        $('#modalEdit').modal('show');
                    } else {
                        console.error('Error:', data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    </script>
@endsection
