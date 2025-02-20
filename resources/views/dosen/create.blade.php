<<<<<<< Updated upstream
=======
<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Tambah Kontributor</h2>
>>>>>>> Stashed changes
<form method="POST" action="{{ route('dosen.store') }}">
    @csrf
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen" required>

        <label for="dosenNpk">NPK</label>
<<<<<<< Updated upstream
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
=======
        <input type="text" class="form-control @error('npk') is-invalid @enderror" id="dosenNpk"
            name="npk" placeholder="Masukkan NPK" required maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK harus berisi 6 digit angka" value="{{ old('npk') }}" oninput="this.value = this.value.replace(/\D/g, '')">
        <label for="dosenName">Nama Dosen</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="dosenName"
            name="name" placeholder="Masukkan Nama Dosen" required value="{{ old('name') }}"
            oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">
        <label for="dosenFakultas">Fakultas</label>
        <input type="text" class="form-control @error('fakultas') is-invalid @enderror" id="dosenFakultas"
            name="fakultas" placeholder="Masukkan Fakultas" required value="{{ old('fakultas') }}"
            oninput="this.value = this.value.toUpperCase()">
        <label for="dosenNoTelp">Nomor Telepon</label>
        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="dosenNoTelp"
            name="no_telp" placeholder="Masukkan Nomor Telepon" required value="{{ old('no_telp') }}"
            minlength="10" maxlength="13" inputmode="numeric"
            title="Nomor Telepon harus berisi 10-13 digit angka"
            oninput="this.value = this.value.replace(/\D/g, '')">
        <label for="dosenDescription">Keterangan</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="dosenDescription"
            name="description" placeholder="Masukkan Keterangan" required>{{ old('description') }}</textarea>
    </div>

    <div class="modal-footer">
        <a href="{{ route('dosen.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
    </div>
</form>
