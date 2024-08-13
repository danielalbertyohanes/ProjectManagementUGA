<form action="{{ route('ppt.update', $ppt->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name Of PPT</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name PPT"
            value="{{ old('name', $ppt->name) }}">

        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            @foreach (['Not Yet', 'Progress', 'Finished', 'Cancel'] as $status)
                <option value="{{ $status }}" {{ $ppt->status == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('subTopic.show', $ppt->sub_topic_id) }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
