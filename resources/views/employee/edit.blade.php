<form method="POST" action="{{ route('employee.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="dosenName">Name</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name"
            value="{{ old('name', $user->name) }}" readonly>

        <label for="dosenNpk">NPK</label>
        <input type="text" class="form-control" id="dosenNpk" name="npk" placeholder="Enter NPK" required
            maxlength="6" pattern="\d{6}" inputmode="numeric"
            title="NPK must be exactly 6 digits and only numbers are allowed" value="{{ old('npk', $user->npk) }}">

        <label for="no_tlpn">Phone Number</label>
        <input type="text" class="form-control" id="no_tlpn" name="no_telp" placeholder="Enter Phone Number"
            value="{{ old('no_tlpn', $user->no_telp) }}" required>

        <label for="status">Position</label>
        <select class="form-control" id="status" name="position_id" required>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}" {{ $user->position_id == $position->id ? 'selected' : '' }}>
                    {{ $position->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('employee.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
