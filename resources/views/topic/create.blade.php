<form method="POST" action="{{ route('topic.store') }}">
    @csrf
    <div class="form-group">
        <input type="hidden" id="courseId" name="course_id" value="{{ $course->id }}">
        <label for="course">Nama Course</label>
        <input type="text" class="form-control" id="course" name="course" value="{{ $course->name }}" readonly>

        <label for="name">Nama Topic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic"
            required>
    </div>

    <hr>

    <label for="subtopic">Sub Topic</label>
    <div id="subtopicInputs">
        <div class="form-group">
            <label for="name_subTopic_0">Nama Sub Topic</label>
            <input type="text" class="form-control" id="name_subTopic_0" name="name_subTopic[]"
                placeholder="Enter Name Sub Topic" required>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-primary" id="addSubTopic">Tambah Sub Topic</button>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('course.show', $course->id) }}" class="btn btn-danger">Cancel</a>
    </div>
</form>

<script>
    $(document).ready(function() {
        let subtopicIndex = 1;

        $('#addSubTopic').click(function() {
            $('#subtopicInputs').append(
                `<div class="form-group">
                <label for="name_subTopic_${subtopicIndex}">Nama Sub Topic</label>
                <input type="text" class="form-control" id="name_subTopic_${subtopicIndex}" name="name_subTopic[]"
                    placeholder="Enter Name Sub Topic" required>

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
