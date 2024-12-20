@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h3 class="h3 mb-2 text-gray-800">Detail Course</h3>
    <h4>Halaman ini menampilkan detail lengkap dari course yang dipilih. Anda dapat melihat daftar topik yang termasuk
        dalam course ini, lengkap dengan status progresnya. Selain itu, halaman ini juga memungkinkan Anda untuk
        menambahkan topik baru atau mengedit topik yang sudah ada.</h4>

    <div class="mb-3 p-3 bg-light border rounded">
        <h5 class="text-primary mb-2">
            <strong>KODE COURSE:</strong>
            <span class="text-dark">{{ $course->kode_course }}</span>
        </h5>
        <h5 class="text-primary mb-2">
            <strong>NAMA COURSE:</strong>
            <span class="text-dark">{{ $course->name }}</span>
        </h5>
        <h5 class="text-primary mb-2">
            <strong>PERIODE:</strong>
            <span class="text-dark">
                @foreach ($course->periode as $periode)
                {{ $periode->name }}<br>
                @endforeach
            </span>
        </h5>
        <h5 class="text-primary mb-2">
            <strong>TANGGAL MULAI:</strong>
            <span class="text-dark">
                @foreach ($course->periode as $periode)
                {{ \Carbon\Carbon::parse($periode->start_date)->format('d M Y') }}<br>
                @endforeach
            </span>
        </h5>
        <h5 class="text-primary mb-2">
            <strong>TANGGAL SELESAI:</strong>
            <span class="text-dark">
                @foreach ($course->periode as $periode)
                {{ \Carbon\Carbon::parse($periode->end_date)->format('d M Y') }}<br>
                @endforeach
            </span>
        </h5>
        <h5 class="text-primary mb-2">
            <strong>DRIVE URL:</strong>
            <span class="text-dark">
                <a href="{{ $course->drive_url }}" target="_blank" class="text-decoration-none text-info">
                    <i class="bi bi-link"></i> {{ $course->drive_url }}
                </a>
            </span>
        </h5>
        <h5 class="text-primary">
            <strong>VIDEO URL:</strong>
            <span class="text-dark">
                <a href="{{ $course->video_url }}" target="_blank" class="text-decoration-none text-info">
                    <i class="bi bi-play-circle"></i> {{ $course->video_url }}
                </a>
            </span>
        </h5>
    </div>

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    {{-- Tombol  --}}
    <!-- Button to trigger modal -->
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCreate"
        onclick="loadCreateForm({{ $course->id }})">+ New Topic Modal</button>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Topik</th>
                            <th>Sub-Topik</th>
                            <th>Progres</th>
                            <th>Detail</th>
                            <th>Aksi Sub Topic</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topics as $topic)
                        @php
                        // Get subtopics associated with the current topic
                        $subTopicsForThisTopic = $subTopics->where('topic_id', $topic->id);
                        $subTopicCount = $subTopicsForThisTopic->count();
                        $rowspan = $subTopicCount > 0 ? $subTopicCount : 1;
                        @endphp

                        @if ($subTopicCount > 0)
                        @php $firstSubTopic = $subTopicsForThisTopic->first(); @endphp

                        <!-- Row for the first sub-topic under this topic -->
                        <tr>
                            <td rowspan="{{ $rowspan }}">{{ $loop->iteration }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $topic->name }}</td>
                            <td>{{ $firstSubTopic->name }}</td>

                            <!-- Progress Bar for the first sub-topic -->
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
                            <td>
                                <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                    data-target="#modalEditSubTopics"
                                    onclick="getEditSubTopicForm({{ $firstSubTopic->id }})">Edit</a>
                                <form method="POST"
                                    action="{{ route('subTopic.destroy', $firstSubTopic->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to delete {{ $firstSubTopic->id }} - {{ $firstSubTopic->name }}?');">
                                </form>
                            </td>
                        </tr>

                        <!-- Loop for the remaining sub-topics under the same topic -->
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
                            <td>
                                <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                    data-target="#modalEditSubTopics"
                                    onclick="getEditSubTopicForm({{ $subTopic->id }})">Edit</a>
                                <form method="POST"
                                    action="{{ route('subTopic.destroy', $subTopic->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger"
                                        onclick="return confirm('Are you sure to delete {{ $subTopic->id }} - {{ $subTopic->name }}?');">
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <!-- If there are no sub-topics, show a single row with 'No Subtopics' -->
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $topic->name }}</td>
                            <td colspan="3" class="text-center">No Subtopics</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="d-flex justify-content-right">
                {{-- {{ $topics->links() }} untuk pindah halaman yang < 1 2 3 4 ... 10> --}}
            </div>
        </div>
    </div>


    {{-- create Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreateLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalCreateContent">
                    <!-- Content will be loaded here via AJAX -->
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Content will be loaded dynamically -->
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
            url: '{{ route("topic.getCreateForm") }}', // Menghapus spasi berlebih pada route
            data: {
                '_token': '{{ csrf_token() }}',
                'course_id': course_id
            },
            success: function(data) {
                console.log(data); // Debug untuk memastikan data diterima
                if (data.status === 'ok') {
                    $('#modalCreateContent').html(data.msg); // Masukkan konten ke modal
                    $('#modalCreate').modal('show'); // Tampilkan modal
                } else {
                    console.error('Error:', data); // Log jika status tidak 'ok'
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error); // Log error dari AJAX
            }
        });
    }

    function getEditFormTopic(topic_id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("topic.getEditForm") }}', // Menghapus spasi berlebih pada route
            data: {
                '_token': '{{ csrf_token() }}',
                'id': topic_id
            },
            success: function(data) {
                console.log(data); // Debug untuk memastikan data diterima
                if (data.status === 'ok') {
                    $('#modalContent').html(data.msg); // Masukkan konten ke modal
                    $('#modalEdit').modal('show'); // Tampilkan modal
                } else {
                    console.error('Error:', data); // Log jika status tidak 'ok'
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error); // Log error dari AJAX
            }
        });
    }

    function getEditSubTopicForm(sub_topic_id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("subtopic.getEditForm") }}', // Menghapus spasi berlebih pada route
            data: {
                '_token': '{{ csrf_token() }}',
                'id': sub_topic_id
            },
            success: function(data) {
                console.log(data); // Debug untuk memastikan data diterima
                if (data.status === 'ok') {
                    $('#modalContent').html(data.msg); // Masukkan konten ke modal
                    $('#modalEdit').modal('show'); // Tampilkan modal
                } else {
                    console.error('Error:', data); // Log jika status tidak 'ok'
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error); // Log error dari AJAX
            }
        });
    }
</script>

@endsection