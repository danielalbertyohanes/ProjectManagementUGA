<form method="POST" action="{{ route('link_external.store') }}">
    @csrf
    <div class="form-group">
        <label for="dosenName">Name dosen</label>
        <input type="text" class="form-control" id="dosenName" name="name" placeholder="Enter Name of dosen" required>

        <label for="dosenDescription">nomor telpon dosen</label>
        <input type="text" class="form-control" id="dosenDescription" name="no_tlpn" placeholder="Enter Description"
            required>

        <label for="dosenDescription">Description dosen</label>
        <input type="text" class="form-control" id="dosenDescription" name="description"
            placeholder="Enter Description" required>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('dosen.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
