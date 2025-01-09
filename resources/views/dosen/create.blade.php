<style>
    label {
        color: #232323;
        padding-top: 10px;
    }
</style>
<form method="POST" action="{{ route('dosen.store') }}">
    @csrf
    <div class="form-group">
        <label for="dosenName">Nama Dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen" required>

        <label for="dosenNpk">NPK</label>
        <input type="text" class="form-control" id="dosenNpk" name="npk" placeholder="Enter NPK" required
            maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK harus berisi 6 digit dan hanya berupa angka">

        <label for="dosenFakultas">Fakultas</label>
        <input type="text" class="form-control" id="dosenFakultas" name="fakultas" placeholder="Masukkan Fakultas"
            required>

        <label for="dosenNoTelp">Nomor Telepon</label>
        <input type="text" class="form-control" id="dosenNoTelp" name="no_telp" placeholder="Masukkan Nomor Telepon"
            required>

        <label for="dosenDescription">Keterangan</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Masukkan Keterangan" required>
    </div>

    <div class="modal-footer">
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
