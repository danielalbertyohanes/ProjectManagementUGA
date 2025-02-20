<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Tambah Periode</h2>
<form method="POST" action="{{ route('periode.store') }}">
    @csrf
    <div class="form-group">
        <label for="periodeName">Nama Periode</label>
        <input type="text" class="form-control" id="periodeName" name="name" placeholder="Masukkan Nama Periode" required oninput="this.value = this.value.toUpperCase()">
        <label for="startDate">Tanggal Mulai</label>
        <input type="date" class="form-control" id="startDate" name="start_date" placeholder="Masukkan Tanggal Selesai" required>
        <label for="endDate">Tanggal Selesai</label>
        <input type="date" class="form-control" id="endDate" name="end_date" placeholder="Masukkan Tanggal Selesai" required>
        <label for="kurasiDate">Tanggal Kurasi</label>
        <input type="date" class="form-control" id="kurasiDate" name="kurasi_date" placeholder="Masukkan Tanggal Kurasi" required>
        <label for="periodeStatus">Status</label>
        <select class="form-control" id="periodeStatus" name="status" required>
            <option value="Not Active">Not Active</option>
            <option value="Active">Active</option>
        </select>
    </div>

    <div class="modal-footer">
        <a href="{{ route('periode.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
    </div>


    {{-- pengecekan terkait start date sama end date nya masih belum bisa --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const form = document.getElementById('periodeForm');

            function validateDates() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);

                if (startDate && endDate && endDate < startDate) {
                    endDateInput.setCustomValidity('End date must be after start date.');
                } else {
                    endDateInput.setCustomValidity('');
                }
            }

            startDateInput.addEventListener('change', validateDates);
            endDateInput.addEventListener('change', validateDates);

            form.addEventListener('submit', function(event) {
                validateDates(); // Check validation on form submission
                if (!form.checkValidity()) {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });
        }); --}}
    </script>
</form>