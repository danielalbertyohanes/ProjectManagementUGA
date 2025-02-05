<style>
    label {
        color: #232323;
        padding-top: 10px;
    }
</style>

<form method="POST" action="{{ route('dosen.store') }}">
    @csrf
    <div class="form-group">
        <label for="dosenNpk">NPK</label>
        <input type="text" class="form-control @error('npk') is-invalid @enderror" id="dosenNpk" name="npk"
            placeholder="Enter NPK" required maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK harus berisi 6 digit dan hanya berupa angka" value="{{ old('npk') }}"
            oninput="this.value = this.value.replace(/\D/g, '')">

        @error('npk')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="dosenName">Nama Dosen</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="dosenName" name="name"
            placeholder="Enter Name of dosen" required value="{{ old('name') }}"
            oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="dosenFakultas">Fakultas</label>
        <input type="text" class="form-control @error('fakultas') is-invalid @enderror" id="dosenFakultas"
            name="fakultas" placeholder="Masukkan Fakultas" required value="{{ old('fakultas') }}" 
            oninput="this.value = this.value.toUpperCase()">
        @error('fakultas')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="dosenNoTelp">Nomor Telepon</label>
        <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="dosenNoTelp"
            name="no_telp" placeholder="Masukkan Nomor Telepon" required value="{{ old('no_telp') }}" minlength="10"
            maxlength="13" inputmode="numeric"
            title="Nomor Telepon harus berisi antara 10 sampai 13 digit dan hanya berupa angka"
            oninput="this.value = this.value.replace(/\D/g, '')">

        @error('no_telp')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="dosenDescription">Keterangan</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="dosenDescription"
            name="description" placeholder="Masukkan Keterangan" required value="{{ old('description') }}">

        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="modal-footer">
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
