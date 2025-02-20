<<<<<<< Updated upstream
=======
<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Edit Kontributor</h2>
>>>>>>> Stashed changes
<form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen"
            value="{{ $dosen->name }}" required>

        <label for="dosenNpk">NPK</label>
<<<<<<< Updated upstream
        <input type="text" class="form-control" id="dosenNpk" name="npk" placeholder="Enter NPK" required
            maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK must be exactly 6 digits and only numbers are allowed" value="{{ $dosen->npk }}">

        <label for="dosenFakutlas">Fakultas</label>
        <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Enter Fakultas" required
            value="{{ $dosen->fakultas }}">

        <label for="no_tlpn">Nomor Telpon Dosen</label>
        <input type="text" class="form-control" id="no_tlpn" name="no_tlpn" placeholder="Enter No_tlpn"
            value="{{ $dosen->no_telp }}" required>

        <label for="dosenDescription">Description</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Enter Description" value="{{ $dosen->description }}" required>
=======
        <input type="text" class="form-control" id="dosenNpk" name="npk" placeholder="Enter NPK" required maxlength="6" pattern="\d{6}" inputmode="numeric" title="NPK harus berisi 6 digit dan hanya berupa angka" value="{{ $dosen->npk }}" oninput="this.value = this.value.replace(/\D/g, '')">
        <label for="dosenName">Nama Dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen" value="{{ $dosen->name }}" required oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">
        <label for="dosenFakutlas">Fakultas</label>
        <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Masukkan Fakultas" required value="{{ $dosen->fakultas }}" oninput="this.value = this.value.toUpperCase()">
        <label for="no_tlpn">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_tlpn" name="no_telp" placeholder="Enter No_tlpn" value="{{ $dosen->no_telp }}" required oninput="this.value = this.value.replace(/\D/g, '')">
        <label for="dosenDescription">Keterangan</label>
        <input type="text" class="form-control" id="dosenDescription" name="description" placeholder="Masukkan Keterangan" value="{{ $dosen->description }}" required>
>>>>>>> Stashed changes
    </div>
    
    <div class="modal-footer">
<<<<<<< Updated upstream
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
=======
        <a href="{{ route('dosen.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
    </div>
</form>
