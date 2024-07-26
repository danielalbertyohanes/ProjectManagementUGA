<form method="POST" action="{{ route('periode.update', $periode->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="periodeName">Periode Name</label>
        <input type="text" class="form-control" id="periodeName" name="name" placeholder="Enter Periode Name"
            value="{{ $periode->name }}" required>

        <label for="startDate">Start Date</label>
        <input type="date" class="form-control" id="startDate" name="start_date" value="{{ $periode->start_date }}"
            required>

        <label for="endDate">End Date</label>
        <input type="date" class="form-control" id="endDate" name="end_date" value="{{ $periode->end_date }}"
            required>

        <label for="kurasiDate">Kurasi Date</label>
        <input type="date" class="form-control" id="kurasiDate" name="kurasi_date"
            value="{{ $periode->kurasi_date }}" required>

        <label for="periodeStatus">Status</label>
        <select class="form-control" id="periodeStatus" name="status" required>
            <option value="Not Active" {{ $periode->status == 'Not Active' ? 'selected' : '' }}>Not Active</option>
            <option value="Active" {{ $periode->status == 'Active' ? 'selected' : '' }}>Active</option>
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('periode.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
