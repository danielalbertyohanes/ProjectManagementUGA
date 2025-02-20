<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Tambah Course</h2>
<form method="POST" action="{{ route('course.store') }}">
    @csrf
    <div class="form-group">
<<<<<<< Updated upstream
        <label for="courseName">Name Course</label>
        <input type="text" class="form-control" id="courseName" name="name" placeholder="Enter Name of Course"
            required>

        <label for="courseDescription">Description Course</label>
        <input type="text" class="form-control" id="courseDescription" name="description"
            placeholder="Enter Description" required>

        <label for="videoCount">Jumlah Video</label>
        <input type="number" class="form-control" id="videoCount" name="jumlah_video" placeholder="Enter Jumlah Video"
            required min="1" max="20">

        <label for="picCourse">PIC Course</label>
=======
        <label for="courseKode">Kode</label>
        <input type="text" class="form-control" id="courseKode" name="kode_course" placeholder="Enter Name of Course"
            required oninput="this.value = this.value.toUpperCase()">
        <label for="courseName">Nama</label>
        <input type="text" class="form-control" id="courseName" name="name" placeholder="Enter Name of Course"
            required oninput="this.value = this.value.toUpperCase()">
        <label for="courseDescription">Deskripsi</label>
        <textarea type="textArea" class="form-control" id="courseDescription" name="description"
            placeholder="Enter Descriptions"></textarea>
        <label for="picCourse">Periode</label>
        <select class="form-control" id="periodeCourse" name="periode_id" required>
            <option value="" selected disabled>Pilih Periode</option>
            @foreach ($periode as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
        <label for="picCourse">PIC</label>
>>>>>>> Stashed changes
        <select class="form-control" id="picCourse" name="pic_course" required>
            <option value="" selected disabled>Pilih PIC</option>
            @foreach ($pic as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
<<<<<<< Updated upstream

=======
        <label for="courseDescription">Drive_URL</label>
        <input type="text" class="form-control" id="courseDrive" name="drive_url" placeholder="Enter Drive_URL" required>
        <label for="courseDescription">Video_URL</label>
        <input type="text" class="form-control" id="courseVide" name="video_url" placeholder="Enter Video_URL" required>
>>>>>>> Stashed changes
        <hr>

        <label for="dosen">Dosen</label>
        <div id="dosenInputs">
            <div class="form-group">
                <select class="form-control" name="dosens[]">
                    <option value="" selected disabled>Pilih Dosen</option>
                    @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}">{{ $dosen->name }} - {{ $dosen->npk }} -
                            {{ $dosen->fakultas }}</option>
                    @endforeach
                </select>
            </div>
        </div>
<<<<<<< Updated upstream
        <button type="button" class="btn btn-sm btn-primary" id="addDosen">Add Dosen</button>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
=======
        <button type="button" class="btn btn-sm buttonSimpan" id="addDosen">Tambah Dosen</button>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn buttonBatal" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
    </div>
</form>

<script>
    $(document).ready(function() {
        // Tambah inputan dosen
        $('#addDosen').click(function() {
            $('#dosenInputs').append(
                '<div class="form-group">' +
                '<select class="form-control" name="dosens[]">' +
                '<option value="" selected disabled>Pilih Dosen</option>' +
                '@foreach ($dosens as $dosen)' +
                '<option value="{{ $dosen->id }}">{{ $dosen->name }} - {{ $dosen->npk }} - {{ $dosen->fakultas }}</option>' +
                '@endforeach' +
                '</select>' +
<<<<<<< Updated upstream
                '<button type="button" class="btn btn-sm btn-danger remove-input">Remove</button>' +
=======
                '<button type="button" class="btn btn-sm buttonDelete remove-input mb-3">Hapus</button>' +
>>>>>>> Stashed changes
                '</div>'
            );
        });

        // Hapus inputan dosen
        $(document).on('click', '.remove-input', function() {
            $(this).closest('.form-group').remove();
        });
    });
</script>
