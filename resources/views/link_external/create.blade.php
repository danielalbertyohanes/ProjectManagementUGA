<<<<<<< Updated upstream
@extends('layouts.admin')
@section('content')
    <form method="POST" action="{{ route('link_external.store') }}">
        @csrf
        <div class="form-group">
            <label for="linkName">Link Name</label>
            <input type="text" class="form-control" id="linkName" name="name" placeholder="Enter Link Name" required>
=======
<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">
>>>>>>> Stashed changes

<h2>Tambah External Link</h2>
<form method="POST" action="{{ route('link_external.store') }}">
    @csrf
    <div class="form-group">
        <label for="linkName">Nama Link</label>
        <input type="text" class="form-control" id="linkName" name="name" placeholder="Enter Link Name" required oninput="this.value = this.value.toUpperCase()">
        <label for="linkValue">URL</label>
        <input type="url" class="form-control" id="linkValue" name="url" placeholder="Enter URL" required>
        <label for="linkStatus">Status</label>
        <select class="form-control" id="linkStatus" name="status" required>
            <option value="not active">Not Active</option>
            <option value="active">Active</option>
        </select>
    </div>

<<<<<<< Updated upstream
            <label for="linkStatus">Status</label>
            <select class="form-control" id="linkStatus" name="status" required>
                <option value="not active">Not Active</option>
                <option value="active">Active</option>
            </select>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('link_external.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection
=======
    <div class="modal-footer">
        <a href="{{ route('link_external.index') }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
    </div>
</form>
>>>>>>> Stashed changes
