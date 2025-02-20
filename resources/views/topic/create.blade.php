<<<<<<< Updated upstream
@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('topic.store') }}">
        @csrf
        <div class="form-group">
            <input type="hidden" id="courseId" name="course_id" value="{{ $course->id }}">
            <label for="course">Nama Course</label>
            <input type="text" class="form-control" id="course" name="course" value="{{ $course->name }}" readonly>

            <label for="name">Nama Topic</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic"
                required>

            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Not Yet">Not Yet</option>
                <option value="Progres">Progres</option>
                <option value="Finish">Finish</option>
                <option value="Cancel">Cancel</option>
            </select>
        </div>

        <hr>
=======
<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Tambah Topic</h2>
<form method="POST" action="{{ route('topic.store') }}">
    @csrf
    <div class="form-group">
        <input type="hidden" id="courseId" name="course_id" value="{{ $course->id }}">
        <label for="course">Nama Course</label>
        <input type="text" class="form-control" id="course" name="course" value="{{ $course->name }}" readonly>
        <label for="name">Nama Topic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic" required oninput="this.value = this.value.toUpperCase()">
    </div>
    <hr>
    <label for="subtopic">Sub Topic</label>
    <div id="subtopicInputs">
        <div class="form-group">
            <label for="name_subTopic_0">Nama Sub Topic</label>
            <input type="text" class="form-control" id="name_subTopic_0" name="name_subTopic[]" placeholder="Enter Name Sub Topic" required oninput="this.value = this.value.toUpperCase()">
        </div>
    </div>
    <button type="button" class="btn btn-sm buttonSimpan" id="addSubTopic">Tambah Sub Topic</button>

    <div class="modal-footer">
        <a href="{{ route('course.show', $course->id) }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
    </div>
</form>
>>>>>>> Stashed changes

        <label for="subtopic">Sub Topic</label>
        <div id="subtopicInputs">
            <div class="form-group">
                <label for="name_subTopic_0">Nama Sub Topic</label>
                <input type="text" class="form-control" id="name_subTopic_0" name="name_subTopic[]"
                    placeholder="Enter Name Sub Topic" required>

                <label for="drive_url_0">Url Sub Topic</label>
                <input type="text" class="form-control" id="drive_url_0" name="drive_url[]" placeholder="Enter Drive URL"
                    required>
            </div>
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
            let subtopicIndex = 1;

            $('#addSubTopic').click(function() {
                $('#subtopicInputs').append(
                    `<div class="form-group">
                <label for="name_subTopic_${subtopicIndex}">Nama Sub Topic</label>
                <input type="text" class="form-control" id="name_subTopic_${subtopicIndex}" name="name_subTopic[]"
                    placeholder="Enter Name Sub Topic" required>

                <label for="drive_url_${subtopicIndex}">Url Sub Topic</label>
                <input type="text" class="form-control" id="drive_url_${subtopicIndex}" name="drive_url[]"
                    placeholder="Enter Drive URL" required>

                <button type="button" class="btn btn-sm buttonDelete remove-input">Hapus</button>
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
