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
            value="{{ $course->jumlah_video }}" required>

        <label for="panduanRPP">Panduan RPP Path</label>
        <input type="text" class="form-control" id="panduanRPP" name="panduan_rpp_path"
            placeholder="Enter Panduan RPP" value="{{ $course->panduan_rpp_path }}">

        <label for="templateRPP">Template RPP Path</label>
        <input type="text" class="form-control" id="templateRPP" name="template_rpp_path"
            placeholder="Enter Template RPP" value="{{ $course->template_rpp_path }}">

        <label for="exampleInputPicCourse">PIC Course</label>
        <input type="text" class="form-control" id="exampleInputPicCourse" name=""
            placeholder="Enter Pic Course" value="{{ $course->user->name }}" disabled>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('course.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
