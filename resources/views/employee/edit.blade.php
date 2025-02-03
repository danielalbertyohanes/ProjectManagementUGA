<style>
    label {
        color: #232323;
        padding-top: 10px;
    }
</style>
<form method="POST" action="{{ route('employee.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama Employee</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Employee"
            value="{{ old('name', $user->name) }}" readonly>

        <label for="npk">NPK</label>
        <input type="numeric" class="form-control" id="npk" name="npk" placeholder="Masukkan NPK" required
            maxlength="6" pattern="\d{6}" inputmode="numeric" title="NPK harus berisi 6 digit dan hanya berupa angka"
            value="{{ old('npk', $user->npk) }}">

        <label for="no_tlpn">Nomor Telepon</label>
        <input type="numeric" class="form-control" id="no_tlpn" name="no_telp" placeholder="Masukkan Nomor Telepon"
            minlength="10" maxlength="13" inputmode="numeric"
            title="Nomor Telepon  harus berisi antara 10 sampai 13 digit dan hanya berupa angka"
            value="{{ old('no_tlpn', $user->no_telp) }}" required>

        <label for="status">Position</label>
        <select class="form-control" id="status" name="position_id" required>
            @foreach ($positions as $position)
                @if ($position->name !== 'Dosen')
                    <option value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endif
            @endforeach
        </select>

    </div>

    <div class="modal-footer">
        <a href="{{ route('employee.index') }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
