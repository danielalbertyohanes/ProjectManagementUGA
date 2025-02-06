<form method="POST" action="{{ route('course.store') }}">
    @csrf
    <div class="form-group">
        <label for="courseKode">Kode</label>
        <input type="text" class="form-control" id="courseKode" name="kode_course" placeholder="Enter Name of Course"
            required oninput="this.value = this.value.toUpperCase()">

        <label for="courseName">Nama</label>
        <input type="text" class="form-control" id="courseName" name="name" placeholder="Enter Name of Course"
            required oninput="this.value = this.value.toUpperCase()">

        <label for="courseDescription">Deskripsi</label>
        <textarea type="textArea" class="form-control" id="courseDescription" name="description"
            placeholder="Enter Descriptionss"></textarea>

        <label for="picCourse">Periode</label>
        <select class="form-control" id="periodeCourse" name="periode_id" required>
            <option value="" selected disabled>Pilih Periode</option>
            @foreach ($periode as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>

        <label for="picCourse">PIC</label>
        <select class="form-control" id="picCourse" name="pic_course" required>
            <option value="" selected disabled>Pilih PIC</option>
            @foreach ($pic as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>

        <label for="courseDescription">Drive_URL</label>
        <input type="text" class="form-control" id="courseDrive" name="drive_url" placeholder="Enter Drive_URL"
            required>

        <label for="courseDescription">Video_URL</label>
        <input type="text" class="form-control" id="courseVide" name="video_url" placeholder="Enter Video_URL"
            required>
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
        <button type="button" class="btn btn-sm btn-primary" id="addDosen">Tambah Dosen</button>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("form").on("submit", function() {
            $("button[type='submit']").prop("disabled", true);
        });

        function updateDosenOptions() {
            let selectedDosens = [];
            $("select[name='dosens[]']").each(function() {
                let val = $(this).val();
                if (val) {
                    selectedDosens.push(val);
                }
            });

            $("select[name='dosens[]']").each(function() {
                $(this).find("option").each(function() {
                    if (selectedDosens.includes($(this).val()) && $(this).val() !== $(this)
                        .parent().val()) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        }

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
                '<button type="button" class="btn btn-sm btn-danger remove-input">Hapus</button>' +
                '</div>'
            );
            updateDosenOptions();
        });

        // Update pilihan saat memilih dosen
        $(document).on('change', "select[name='dosens[]']", function() {
            updateDosenOptions();
        });

        // Hapus inputan dosen
        $(document).on('click', '.remove-input', function() {
            $(this).closest('.form-group').remove();
            updateDosenOptions();
        });

        // Inisialisasi pertama kali
        updateDosenOptions();
    });
</script>
