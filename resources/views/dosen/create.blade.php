<form method="POST" action="{{ route('dosen.store') }}">
    @csrf
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen" required>

        <label for="dosenNpk">NPK</label>
        <input type="number" class="form-control" id="dosenDescription" name="npk" placeholder="Enter NPK" required
            min="0" maxlength="6">

        <label for="dosenFakutlas">Fakultas</label>
        <input type="text" class="form-control" id="dosenFakultas" name="fakultas" placeholder="Enter Fakultas"
            required>

        <label for="dosenDescription">nomor telpon dosen</label>
        <input type="text" class="form-control" id="dosenDescription" name="no_telp" placeholder="Enter Description"
            required>

        <label for="dosenDescription">Description dosen</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Enter Description" required>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
