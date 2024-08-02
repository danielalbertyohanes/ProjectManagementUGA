@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('topic.update', $topic->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="course">Nama Course</label>
            <input type="text" class="form-control" id="course" name="course" value="{{ $course->name }}" readonly>

            <label for="name">Nama Topic</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic"
                value="{{ $topic->name }}" required>

            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                @foreach (['Not Yet', 'Progres', 'Finish', 'Cancel'] as $status)
                    <option value="{{ $status }}" @if ($topic->status == $status) selected @endif>
                        {{ $status }}</option>
                @endforeach
            </select>
        </div>

        <hr>

        <label for="subtopic">Sub Topic</label>
        <div id="subtopicInputs">
            @foreach ($topic->subTopics as $index => $subTopic)
                <div class="form-group">
                    <label for="name_subTopic_{{ $index }}">Nama Sub Topic</label>
                    <input type="text" class="form-control" id="name_subTopic_{{ $index }}" name="name_subTopic[]"
                        placeholder="Enter Name Sub Topic" value="{{ $subTopic->name }}" required>

                    <label for="drive_url_{{ $index }}">Url Sub Topic</label>
                    <input type="text" class="form-control" id="drive_url_{{ $index }}" name="drive_url[]"
                        placeholder="Enter Drive URL" value="{{ $subTopic->drive_url }}" required>

                    <button type="button" class="btn btn-sm btn-danger remove-input">Remove</button>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-sm btn-primary" id="addSubTopic">Tambah Sub Topic</button>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('topic.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            let subtopicIndex = {{ $topic->subTopics->count() }};

            $('#addSubTopic').click(function() {
                $('#subtopicInputs').append(
                    `<div class="form-group">
                        <label for="name_subTopic_${subtopicIndex}">Nama Sub Topic</label>
                        <input type="text" class="form-control" id="name_subTopic_${subtopicIndex}" name="name_subTopic[]"
                            placeholder="Enter Name Sub Topic" required>

                        <label for="drive_url_${subtopicIndex}">Url Sub Topic</label>
                        <input type="text" class="form-control" id="drive_url_${subtopicIndex}" name="drive_url[]"
                            placeholder="Enter Drive URL" required>

                        <button type="button" class="btn btn-sm btn-danger remove-input">Remove</button>
                    </div>`
                );
                subtopicIndex++;
            });

            $(document).on('click', '.remove-input', function() {
                $(this).closest('.form-group').remove();
            });
        });
    </script>
@endsection
