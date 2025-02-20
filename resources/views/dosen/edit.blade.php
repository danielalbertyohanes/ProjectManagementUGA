<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">
<h2>Edit Kontributor</h2>
<form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="dosenNpk">NPK</label>
        <input type="text" class="form-control" id="dosenNpk" name="npk" placeholder="Enter NPK" required
            maxlength="6" pattern="\d{6}" inputmode="numeric" title="NPK harus berisi 6 digit dan hanya berupa angka"
            value="{{ $dosen->npk }}" oninput="this.value = this.value.replace(/\D/g, '')">

        <label for="dosenName">Nama Dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen"
            value="{{ $dosen->name }}" required
            oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">

        <label for="dosenFakutlas">Fakultas</label>
        <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Masukkan Fakultas"
            required value="{{ $dosen->fakultas }}" oninput="this.value = this.value.toUpperCase()">

        <label for="no_tlpn">Nomor Telepon</label>
        <input type="text" class="form-control" id="no_tlpn" name="no_telp" placeholder="Enter No_tlpn"
            value="{{ $dosen->no_telp }}" required oninput="this.value = this.value.replace(/\D/g, '')">

        <label for="dosenDescription">Keterangan</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Enter Description" value="{{ $dosen->description }}" required>

    </div>

    <div class="modal-footer">
        <a href="{{ route('dosen.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>

    </div>
</form>
