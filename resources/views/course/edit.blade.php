<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Edit Course</h2>
<form method="POST" action="{{ route('course.update', $course->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="courseName">Name Course</label>
        <input type="text" class="form-control" id="courseName" name="name" placeholder="Enter Name of Course"
            value="{{ $course->name }}" required>

        <label for="courseDescription">Description</label>
        <input type="text" class="form-control" id="courseDescription" name="description"
            placeholder="Enter Description" value="{{ $course->description }}" required>

        <label for="videoCount">Jumlah Video</label>
        <input type="number" class="form-control" id="videoCount" name="jumlah_video" placeholder="Enter Jumlah Video"
            value="{{ $course->jumlah_video }}" required min="1" max="20">

        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            @foreach (['Not Yet', 'Progress', 'Finish Production', 'On Going CURATION', 'Publish', 'Cancel'] as $status)
                <option value="{{ $status }}" {{ $course->status == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <label for="exampleInputPicCourse">PIC Course</label>
        <input type="text" class="form-control" id="exampleInputPicCourse" name=""
            placeholder="Enter Pic Course" value="{{ $course->user->name }}" disabled>
    </div>

    <div class="modal-footer">
<<<<<<< Updated upstream
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('course.index') }}" class="btn btn-danger">Cancel</a>
=======
        <a href="{{ route('course.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
    </div>
</form>
