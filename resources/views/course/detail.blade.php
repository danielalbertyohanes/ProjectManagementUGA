@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="h3 mb-2 text-gray-800">Detail Course</h3>
        <p>Halaman details berisi topik. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's.</p>

        <div class="mb-2">
            <h5 class="text-primary">
                KODE COURSE:
                <span class="text-gray-800">{{ $course->kode_course }}</span>
            </h5>
            <h5 class="text-primary">
                NAMA COURSE:
                <span class="text-gray-800">{{ $course->name }}</span>
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

        <a class="btn btn-success mb-3" href="{{ route('topic.newtopic', ['course_id' => $course->id]) }}">+ New Topic</a>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <a href="#" class="btn btn-warning mb-3" data-toggle="modal" data-target="#modalEditTopics"
            onclick="getEditForm({{ $course->id }})">Edit Topic</a>


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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $number = 1; @endphp
                        @foreach ($topics as $topic)
                            @php
                                $subTopicsForThisTopic = $subTopics->where('topic_id', $topic->id);
                                $rowspan = $subTopicsForThisTopic->count();
                            @endphp
                            <tr>
                                <td rowspan="{{ $rowspan }}">{{ $number }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $topic->name }}</td>
                                <td>{{ $subTopicsForThisTopic->first()->name }}</td>
                                <td>
                                    <a href="{{ route('subTopic.show', $subTopicsForThisTopic->first()->id) }}" class="progress-link">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 70%;"
                                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                        data-target="#modalEditSubTopics"
                                        onclick="getEditSubTopicForm({{ $subTopicsForThisTopic->first()->id }})">Edit</a>
                                </td>
                            </tr>
                            @php $number++; @endphp

                            @foreach ($subTopicsForThisTopic->slice(1) as $subTopic)
                                <tr>
                                    <td>{{ $subTopic->name }}</td>
                                    <td>
                                        <a href="{{ route('subTopic.show', $subTopic->id) }}" class="progress-link">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 70%;"
                                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                            data-target="#modalEditSubTopics"
                                            onclick="getEditSubTopicForm({{ $subTopic->id }})">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>



                </div>
                <div class="d-flex justify-content-right">
                    {{-- {{ $topics->links() }} untuk pindah halaman yang < 1 2 3 4 ... 10> --}}
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="modalEditTopics" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-wide">
                <div class="modal-content">
                    <div class="modal-body" id="modalContent">
                        <!-- Content will be loaded dynamically -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit SubTopic -->
        <div class="modal fade" id="modalEditSubTopics" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-wide">
                <div class="modal-content">
                    <div class="modal-body" id="modalContentSubtopic">
                        <!-- Content will be loaded dynamically -->
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('javascript')
        <script>
            function getEditForm(course_id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('topic.getEditForm') }}', // Pastikan ini sesuai dengan nama rute Anda
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': course_id
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalContent').html(data.msg);
                            $('#modalEditTopics').modal('show'); // Tampilkan modal setelah konten dimuat
                        } else {
                            console.error('Error:', data); // Log error jika status bukan 'ok'
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error); // Log error jika terjadi kesalahan AJAX
                    }
                });
            }

            function getEditSubTopicForm(sub_topic_id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('subtopic.getEditForm') }}', // Pastikan ini sesuai dengan nama rute Anda
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': sub_topic_id
                    },
                    success: function(data) {
                        if (data.status === 'ok') {
                            $('#modalContentSubtopic').html(data.msg);
                            $('#modalEditSubTopics').modal('show'); // Tampilkan modal setelah konten dimuat
                        } else {
                            console.error('Error:', data); // Log error jika status bukan 'ok'
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error); // Log error jika terjadi kesalahan AJAX
                    }
                });
            }
        </script>
    @endsection
