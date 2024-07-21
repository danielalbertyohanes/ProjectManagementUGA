<form method="POST" action="{{ route('dosen.update', $dosen->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen"
            value="{{ $dosen->name }}" required>

        <label for="videoCount">nomor telpon dosen</label>
        <input type="number" class="form-control" id="videoCount" name="no_tlpn" placeholder="Enter Jumlah Video"
            value="{{ $dosen->no_tlpn }}" required>

        <label for="dosenDescription">Description</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Enter Description" value="{{ $dosen->description }}" required>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
