<form method="POST" action="{{ route('topic.update', $topic->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama Topic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic"
            value="{{ $topic->name }}" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            @foreach (['Not Yet', 'Progres', 'Finish', 'Cancel'] as $status)
                <option value="{{ $status }}" @if ($topic->status == $status) selected @endif>
                    {{ $status }}</option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('course.show', $topic->course_id) }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
