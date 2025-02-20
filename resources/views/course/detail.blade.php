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
<<<<<<< Updated upstream

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Details</h6>
=======
        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
            {{-- Button Tambah Topic --}}
            <button class="btn buttonCreate mb-3" data-toggle="modal" data-target="#modalCreateTopic" onclick="loadCreateForm({{ $course->id }})">Tambah Topic</button>
        @endif

        {{-- Tabel Detail Course --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DETAIL COURSE</h6>
>>>>>>> Stashed changes
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
                                <th>Aksi</th>
=======
                                <th>Progress</th>
                                <th>Detail</th>
                                @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                    <th>Aksi Sub Topic</th>
                                @endif
>>>>>>> Stashed changes
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

                                        <!-- Calculate the progress for the first sub-topic -->
                                        @php
                                            $statusProgressMapping = [
                                                'Not Yet' => 0,
                                                'Progres' => 50,
                                                'Finish' => 100,
                                                'Cancel' => 0,
                                            ];
                                            $progressPercentage = $statusProgressMapping[$firstSubTopic->status] ?? 0;
                                        @endphp

                                        <!-- Progress Bar for the first sub-topic -->
                                        <td>
<<<<<<< Updated upstream
                                            <a href="{{ route('subTopic.show', $firstSubTopic->id) }}" class="progress-link">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                                                        aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                                        {{ $progressPercentage }}%
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                                data-target="#modalEditSubTopics"
                                                onclick="getEditSubTopicForm({{ $firstSubTopic->id }})">Edit</a>
                                        </td>
=======
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                                    style="width:{{ $firstSubTopic->progress }}%;"
                                                    aria-valuenow="{{ $firstSubTopic->progress }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $firstSubTopic->progress }}%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn buttonDetail"
                                                href="{{ route('subTopic.show', $firstSubTopic->id) }}">
                                                Detail
                                            </a>
                                        </td>
                                        @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                            <td>
                                                <a href="#" class="btn buttonEdit mb-3" data-toggle="modal"
                                                    data-target="#modalEditSubTopics"
                                                    onclick="getEditSubTopicForm({{ $firstSubTopic->id }})">Edit</a>
                                                <form method="POST"
                                                    action="{{ route('subTopic.destroy', $firstSubTopic->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Hapus" class="btn buttonDelete mb-3"
                                                        onclick="return confirm('Apa kamu yakin menghapus {{ $firstSubTopic->name }}?');">
                                                </form>
                                            </td>
                                        @endif
>>>>>>> Stashed changes
                                    </tr>

                                    <!-- Loop for the remaining sub-topics under the same topic -->
                                    @foreach ($subTopicsForThisTopic->skip(1) as $subTopic)
                                        @php
                                            // Calculate the progress for each remaining sub-topic
                                            $progressPercentage = $statusProgressMapping[$subTopic->status] ?? 0;
                                        @endphp

                                        <tr>
                                            <td>{{ $subTopic->name }}</td>
                                            <td>
<<<<<<< Updated upstream
                                                <a href="{{ route('subTopic.show', $subTopic->id) }}" class="progress-link">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                                                            aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                                            {{ $progressPercentage }}%
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning mb-3" data-toggle="modal"
                                                    data-target="#modalEditSubTopics"
                                                    onclick="getEditSubTopicForm({{ $subTopic->id }})">Edit</a>
                                            </td>
=======
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                                        style="width:{{ $subTopic->progress }}%;"
                                                        aria-valuenow="{{ $subTopic->progress }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $subTopic->progress }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <a class="btn buttonDetail"
                                                    href="{{ route('subTopic.show', $subTopic->id) }}">
                                                    Detail
                                                </a>
                                            </td>
                                            @if (Auth::user()->position_id == '1' || Auth::user()->position_id == '2')
                                                <td>
                                                    <a href="#" class="btn buttonEdit mb-3" data-toggle="modal"
                                                        data-target="#modalEditSubTopics"
                                                        onclick="getEditSubTopicForm({{ $subTopic->id }})">Edit</a>
                                                    <form method="POST"
                                                        action="{{ route('subTopic.destroy', $subTopic->id) }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="Hapus" class="btn buttonDelete mb-3"
                                                            onclick="return confirm('Apa kamu yakin menghapus {{ $subTopic->name }}?');">
                                                    </form>
                                                </td>
                                            @endif
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                <div class="d-flex justify-content-right">
                    {{-- {{ $topics->links() }} untuk pindah halaman yang < 1 2 3 4 ... 10> --}}
=======
            </div>
        </div>

        <!-- Modal ADD -->
        <div class="modal fade" id="modalCreateTopic" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-wide">
                <div class="modal-content">
                    <div class="modal-body" id="modalCreateContent">
                        {{-- Content will be loaded dynamically --}}
                    </div>
>>>>>>> Stashed changes
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
<<<<<<< Updated upstream
        <div class="modal fade" id="modalEditTopics" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-wide">
                <div class="modal-content">
                    <div class="modal-body" id="modalContent">
                        <!-- Content will be loaded dynamically -->
=======
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-wide">
                <div class="modal-content">
                    <div class="modal-body" id="modalContent">
                        {{-- Content will be loaded dynamically --}}
>>>>>>> Stashed changes
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
