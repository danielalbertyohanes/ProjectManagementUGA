<form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen"
            value="{{ $dosen->name }}" required>

        <label for="dosenNpk">NPK</label>
        <input type="number" class="form-control" id="npk" name="npk" placeholder="Enter NPK" required
            min="1" maxlength="6" value="{{ $dosen->npk }}">

        <label for="dosenFakutlas">Fakultas</label>
        <input type="text" class="form-control" id="fakultas" name="fakultas" placeholder="Enter Fakultas" required
            value="{{ $dosen->fakultas }}">

        <label for="no_tlpn">Nomor Telpon Dosen</label>
        <input type="text" class="form-control" id="no_tlpn" name="no_tlpn" placeholder="Enter No_tlpn"
            value="{{ $dosen->no_telp }}" required>

        <label for="dosenDescription">Description</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Enter Description" value="{{ $dosen->description }}" required>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
