@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="h3 mb-2 text-gray-800">Detail Course</h3>
        <p>Halaman details berisi topik. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's.</p>

        <div class="mb-2">
            <h5 class="text-primary">KODE COURSE: <span class="text-gray-800">{{ $course->kode_course }}</span></h5>
            <h5 class="text-primary">NAMA COURSE: <span class="text-gray-800">{{ $course->name }}</span></h5>
        </div>
        <a class="btn btn-success mb-3" href="{{ route('topic.newtopic', ['course_id' => $course->id]) }}">+ New Topic</a>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
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
                                <th>Media Pembelajaran</th>
                                <th>Progres</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topics as $topic)
                                <tr>
                                    <td rowspan="{{ $subTopics->where('topic_id', $topic->id)->count() }}">
                                        {{ $loop->iteration }}</td>
                                    <td rowspan="{{ $subTopics->where('topic_id', $topic->id)->count() }}">
                                        {{ $topic->name }}</td>
                                    @foreach ($subTopics->where('topic_id', $topic->id) as $subTopic)
                                        @if (!$loop->first)
                                <tr>
                            @endif
                            <td>{{ $subTopic->name }}</td>
                            <td>
                                <ul>
                                    <li>Link: <a href="{{ $subTopic->drive_url }}">{{ $subTopic->drive_url }}</a></li>
                                    <li>Video Pembelajaran</li>
                                    <li>PDF</li>
                                </ul>
                            </td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70"
                                        aria-valuemin="0" aria-valuemax="100">70%</div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="#">Edit</a>
                            </td>
                            @if (!$loop->last)
                                </tr>
                            @endif
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-right">
                    {{-- {{ $topics->links() }} untuk pindah halaman yang < 1 2 3 4 ... 10> --}}
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
                    url: '{{ route('dosen.getCreateForm') }}',
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
            function getEditForm(dosen_id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dosen.getEditForm') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': dosen_id
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
