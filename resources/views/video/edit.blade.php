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

        <label for="description_location">Description Location</label>
        <input type="text" class="form-control" id="description_location" name="description_location" placeholder="Enter Description Location" 
            value="{{ old('description_location', $video->description_location) }}">

        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            @foreach (['Not Yet', 'Recording', 'Recorded', 'PPT Recording', 'PPT Recorded', 'Editing', 'Edited', 'Pause Recording'] as $status)
                <option value="{{ $status }}" {{ $video->status == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>  
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="#" class="btn btn-danger" data-dismiss="modal">Cancel</a>
    </div>
</form>
