<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Edit Sub Topik</h2>
<form method="POST" action="{{ route('subTopic.update', $subTopic->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="course_id" value="">
    <div class="form-group">
        <label for="name">Nama SubTopic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name SubTopic"
            value="{{ $subTopic->name }}" required oninput="this.value = this.value.toUpperCase()">
    </div>

    <div class="modal-footer">
<<<<<<< Updated upstream
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('course.show', $subTopic->topic->course_id) }}" class="btn btn-danger">Cancel</a>
=======
        <a href="{{ route('course.show', $subTopic->topic->course_id) }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
    </div>
</form>
