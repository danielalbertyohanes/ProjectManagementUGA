<style>
    label {
        color: #232323;
        padding-top: 10px;
    }
</style>
<form method="POST" action="{{ route('periode.update', $periode->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="periodeName">Nama Periode</label>
        <input type="text" class="form-control" id="periodeName" name="name" placeholder="Masukkan Nama Periode"
            value="{{ $periode->name }}" required>

        <label for="startDate">Tanggal Mulai</label>
        <input type="date" class="form-control" id="startDate" name="start_date" value="{{ $periode->start_date }}"
            required>

        <label for="endDate">Tanggal Selesai</label>
        <input type="date" class="form-control" id="endDate" name="end_date" value="{{ $periode->end_date }}"
            required>

        <label for="kurasiDate">Tanggal Kurasi</label>
        <input type="date" class="form-control" id="kurasiDate" name="kurasi_date"
            value="{{ $periode->kurasi_date }}" required>

        <label for="periodeStatus">Status</label>
        <select class="form-control" id="periodeStatus" name="status" required>
            <option value="Not Active" {{ $periode->status == 'Not Active' ? 'selected' : '' }}>Not Active</option>
            <option value="Active" {{ $periode->status == 'Active' ? 'selected' : '' }}>Active</option>
        </select>
    </div>

    <div class="modal-footer">
        <a href="{{ route('periode.index') }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
