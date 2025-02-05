<form method="POST" action="{{ route('topic.update', $topic->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama Topic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic"
            value="{{ $topic->name }}" required oninput="this.value = this.value.toUpperCase()">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            @foreach (['Not Yet', 'Cancel'] as $status)
                <option value="{{ $status }}" @if ($topic->status == $status) selected @endif>
                    {{ $status }}</option>
            @endforeach
        </select>
    </div>
    <label for="subtopic">Sub Topic</label>
    <div id="subtopicInputs">
        @foreach ($topic->sub_topics as $index => $subTopic)
            <div class="form-group">
                <label for="name_subTopic_{{ $index }}">Nama Sub Topic</label>
                <input type="text" class="form-control" id="name_subTopic_{{ $index }}" name="name_subTopic[]"
                    placeholder="Enter Name Sub Topic" value="{{ $subTopic->name }}" readonly
                    oninput="this.value = this.value.toUpperCase()">
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-primary" id="addSubTopic">Tambah Sub Topic</button>

    <div class="modal-footer">
        <a href="{{ route('course.show', $topic->course_id) }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


<script>
    $(document).ready(function() {
        let subtopicIndex = {{ $topic->sub_topics->count() }};

        // Function to add a new sub-topic input
        $('#addSubTopic').click(function() {
            $('#subtopicInputs').append(
                `<div class="form-group">
                    <label for="name_subTopic_${subtopicIndex}">Nama Sub Topic</label>
                    <input type="text" class="form-control" id="name_subTopic_${subtopicIndex}" name="name_subTopic[]"
                        placeholder="Enter Name Sub Topic" required oninput="this.value = this.value.toUpperCase()">

                    <button type="button" class="btn btn-sm btn-danger remove-input">Remove</button>
                </div>`
            );
            subtopicIndex++;
        });

        // Function to remove a sub-topic input
        $(document).on('click', '.remove-input', function() {
            $(this).closest('.form-group').remove();
        });
    });
</script>
