<<<<<<< Updated upstream
<form method="POST" action="{{ route('user.update', $dosen->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen"
            value="{{ $dosen->name }}" required>

        <label for="dosenNpk">NPK</label>
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
<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<form method="POST" action="{{ route('employee.update', ['user' => $user->id, 'from' => 'employee']) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="npk">NPK</label>
        <input type="text" class="form-control @error('npk') is-invalid @enderror" id="npk" name="npk"
            placeholder="Masukkan NPK" required maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK harus berisi 6 digit dan hanya berupa angka" value="{{ old('npk', $user->npk) }}"
            oninput="this.value = this.value.replace(/\D/g, '')" readonly>
        <label for="name">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="Masukkan Nama Employee" value="{{ old('name', $user->name) }}" required
            oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">
        <label for="no_tlpn">Nomor Telepon</label>
        <input type="tel" class="form-control @error('no_telp') is-invalid @enderror" id="no_tlpn" name="no_telp"
            placeholder="Masukkan Nomor Telepon" minlength="10" maxlength="13" inputmode="numeric"
            title="Nomor Telepon harus berisi antara 10 sampai 13 digit dan hanya berupa angka"
            value="{{ old('no_telp', $user->no_telp) }}" required oninput="this.value = this.value.replace(/\D/g, '')">
        <label for="status">Posisi</label>
        <select class="form-control @error('position_id') is-invalid @enderror" id="status" name="position_id"
            required>
            @foreach ($positions as $position)
                @if ($position->name !== 'Dosen')
                    <option value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endif
            @endforeach
        </select>
>>>>>>> Stashed changes
    </div>
    
    <div class="modal-footer">
<<<<<<< Updated upstream
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
=======
        <a href="{{ route('employee.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
    </div>
</form>
