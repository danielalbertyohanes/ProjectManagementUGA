<form method="POST" action="{{ route('course.update', $course->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputType">Name Course</label>
        <input type="text" class="form-control" id="exampleInputType" name="type_hotel_name" placeholder="Enter Name of Type..." value="{{ $course->name }}">
        <small id="nameHelp" class="form-text text-muted">Silahkan Masukkan nama .</small>

        <label for="exampleInputType">Description</label>
        <input type="text" class="form-control" id="exampleInputType" name="type_hotel_name" placeholder="Enter Deskripsi" value="{{ $course->description }}">
        <small id="nameHelp" class="form-text text-muted">Silahkan Masukkan Deskripsi .</small>

        <label for="exampleInputType">Jumlah Video</label>
        <input type="text" class="form-control" id="exampleInputType" name="type_hotel_name" placeholder="Enter Jumlah Video..." value="{{ $course->jumlah_video }}">
        <small id="nameHelp" class="form-text text-muted">Silahkan Masukkan Jumlah Video.</small>

        <label for="exampleInputType">PIC Course</label>
        <input type="text" class="form-control" id="exampleInputType" name="type_hotel_name" placeholder="Enter Pic Course" value="{{ $course->Pic_course }}">
        <small id="nameHelp" class="form-text text-muted">Silahkan Masukkan Pic Course.</small>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>