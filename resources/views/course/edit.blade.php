<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Edit Course</h2>
<form method="POST" action="{{ route('course.update', $course->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="courseName">Nama</label>
        <input type="text" class="form-control" id="courseName" name="name" placeholder="Enter Name of Course"
            value="{{ $course->name }}" required oninput="this.value = this.value.toUpperCase()">

        <label for="courseDescription">Deskripsi</label>
        <input type="text" class="form-control" id="courseDescription" name="description"
            placeholder="Enter Description" value="{{ $course->description }}">

        <label for="courseDescription">Drive_URL</label>
        <input type="text" class="form-control" id="courseDrive" name="drive_url" placeholder="Enter Drive_URL"
            value="{{ $course->drive_url }}" required>

        <label for="courseDescription">Video_URL</label>
        <input type="text" class="form-control" id="courseVide" name="video_url" placeholder="Enter Video_URL"
            value="{{ $course->video_url }}" required>

        <label for="exampleInputPicCourse">PIC</label>
        <input type="text" class="form-control" id="exampleInputPicCourse" name=""
            placeholder="Enter Pic Course" value="{{ $course->user->name }}" disabled>
    </div>

    <div class="modal-footer">
        <a href="{{ route('course.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("form").on("submit", function() {
            $("button[type='submit']").prop("disabled", true);
        });
    });
</script>
