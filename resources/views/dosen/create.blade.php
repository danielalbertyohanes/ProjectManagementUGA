<form method="POST" action="{{ route('dosen.store') }}">
    @csrf
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen" required>

        <label for="dosenNpk">NPK</label>
        <input type="text" class="form-control" id="dosenNpk" name="npk" placeholder="Enter NPK" required
            maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK must be exactly 6 digits and only numbers are allowed">

        <label for="dosenFakultas">Fakultas</label>
        <input type="text" class="form-control" id="dosenFakultas" name="fakultas" placeholder="Enter Fakultas"
            required>

        <label for="dosenNoTelp">Nomor Telpon dosen</label>
        <input type="text" class="form-control" id="dosenNoTelp" name="no_telp" placeholder="Enter Nomor Telpon"
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
