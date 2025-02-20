<style>
    label {
        color: #232323;
        padding-top: 10px;
    }
</style>

<form method="POST" action="{{ route('employee.update', ['user' => $user->id, 'from' => 'employee']) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="npk">NPK</label>
        <input type="text" class="form-control @error('npk') is-invalid @enderror" id="npk" name="npk"
            placeholder="Masukkan NPK" required maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK harus berisi 6 digit dan hanya berupa angka" value="{{ old('npk', $user->npk) }}"
            oninput="this.value = this.value.replace(/\D/g, '')" readonly>
        @error('npk')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="name">Nama</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="Masukkan Nama Employee" value="{{ old('name', $user->name) }}" required
            oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="no_tlpn">Nomor Telepon</label>
        <input type="tel" class="form-control @error('no_telp') is-invalid @enderror" id="no_tlpn" name="no_telp"
            placeholder="Masukkan Nomor Telepon" minlength="10" maxlength="13" inputmode="numeric"
            title="Nomor Telepon harus berisi antara 10 sampai 13 digit dan hanya berupa angka"
            value="{{ old('no_telp', $user->no_telp) }}" required oninput="this.value = this.value.replace(/\D/g, '')">
        @error('no_telp')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

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
        @error('position_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="modal-footer">
        <a href="{{ route('employee.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>