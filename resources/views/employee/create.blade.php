<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Tambah Employee</h2>
<form method="POST" action="{{ route('employee.store') }}">
    @csrf

    <label>NPK</label>
    <input type="text" class="form-control @error('npk') is-invalid @enderror" id="dosenNpk" name="npk" required
        maxlength="6" pattern="\d{6}" inputmode="numeric"
        title="NPK must be exactly 6 digits and only numbers are allowed" value="{{ old('npk') }}"
        oninput="this.value = this.value.replace(/\D/g, '').slice(0,6)">
    @error('npk')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label>Nama</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') }}" required autocomplete="name"
        oninput="this.value = this.value.toUpperCase().replace(/[^A-Za-z\s]/g, '')">
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


    <label for="email">Email</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email">
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label for="phone">Nomor Telepon</label>
    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="no_telp"
        value="{{ old('phone') }}" required autocomplete="tel" inputmode="numeric" pattern="\d+"
        title="Phone number must be only digits" oninput="this.value = this.value.replace(/\D/g, '')">
    @error('phone')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label for="password">Password</label>
    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password"
        required value="staffuga" readonly style="background-color: #dadada;">
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label for="position_id">Posisi</label>
    <select id="position_id" class="form-control @error('position_id') is-invalid @enderror" name="position_id" required
        autocomplete="position_id">
        <option value="" selected disabled>Choose Position</option>
        @foreach ($positions as $p)
            @if ($p->name !== 'Dosen')
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endif
        @endforeach
    </select>
    @error('position')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="modal-footer">
        <a href="{{ route('employee.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
    </div>
</form>
