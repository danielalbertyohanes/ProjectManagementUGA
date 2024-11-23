<form action="{{ route('video.update', $video->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name Of Video</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Video Name"
            value="{{ old('name', $video->name) }}">

        <label for="location">Location</label>
        <select class="form-control" id="location" name="location" required>
            @foreach (['UBAYA', 'Not UBAYA'] as $location)
                <option value="{{ $location }}" {{ $video->location == $location ? 'selected' : '' }}>
                    {{ $location }}
                </option>
            @endforeach
        </select>

        <label for="description_location">Detail Location</label>
        <input type="text" class="form-control" id="detail_location" name="detail_location"
            placeholder="Enter Detail Location" value="{{ old('detail_location', $video->detail_location) }}">
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
    </div>
</form>
