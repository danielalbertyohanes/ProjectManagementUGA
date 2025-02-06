<form method="POST" action="{{ route('link_external.update', $link->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="linkName">Nama Link</label>
        <input type="text" class="form-control" id="linkName" name="name" placeholder="Enter Link Name"
            value="{{ $link->name }}" required oninput="this.value = this.value.toUpperCase()">

        <label for="linkValue">URL</label>
        <input type="url" class="form-control" id="linkValue" name="url" placeholder="Enter URL"
            value="{{ $link->url }}" required>
            
        <label for="linkStatus">Status</label>
        <select class="form-control" id="linkStatus" name="status" required>
            <option value="not active" {{ $link->status == 'Not Active' ? 'selected' : '' }}>Not Active</option>
            <option value="active" {{ $link->status == 'Active' ? 'selected' : '' }}>Active</option>
        </select>
    </div>

    <div class="modal-footer">
        <a href="{{ route('link_external.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
