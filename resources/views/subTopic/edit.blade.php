<form method="POST" action="{{ route('subTopic.update', $subTopic->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="course_id" value="">
    <div class="form-group">
        <label for="name">Nama SubTopic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name SubTopic"
            value="{{ $subTopic->name }}" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach (['Not Yet', 'Cancel'] as $status)
                <option value="{{ $status }}" @if ($subTopic->status == $status) selected @endif>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="modal-footer">
        <a href="{{ route('course.show', $subTopic->topic->course_id) }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
