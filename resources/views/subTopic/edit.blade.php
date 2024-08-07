<form method="POST" action="{{ route('subTopic.update', $subTopic->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama SubTopic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name SubTopic"
            value="{{ $subTopic->name }}" required>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach (['Not Yet', 'Progres', 'Finish', 'Cancel'] as $status)
                <option value="{{ $status }}" @if ($subTopic->status == $status) selected @endif>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="progress">Progres</label>
        <input type="number" class="form-control" id="progress" name="progress" placeholder="Enter Progress"
            value="{{ $subTopic->progress }}" min="0" max="100">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('subTopic.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
