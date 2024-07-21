<form method="POST" action="{{ route('link_external.update', $link->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="linkName">Link Name</label>
        <input type="text" class="form-control" id="linkName" name="name" placeholder="Enter Link Name"
            value="{{ $link->name }}" required>

        <label for="linkStatus">Status</label>
        <select class="form-control" id="linkStatus" name="status" required>
            <option value="not active" {{ $link->status == 'not active' ? 'selected' : '' }}>Not Active</option>
            <option value="active" {{ $link->status == 'active' ? 'selected' : '' }}>Active</option>
        </select>

        <label for="linkValue">URL</label>
        <input type="url" class="form-control" id="linkValue" name="value" placeholder="Enter URL"
            value="{{ $link->value }}" required>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('link_external.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
