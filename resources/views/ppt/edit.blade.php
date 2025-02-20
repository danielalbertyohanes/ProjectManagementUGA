<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Edit PPT</h2>
<form action="{{ route('ppt.update', $ppt->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama PPT</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name PPT"
            value="{{ old('name', $ppt->name) }}"  oninput="this.value = this.value.toUpperCase()">
    </div>

    <div class="modal-footer">
        <a href="{{ route('subTopic.show', $ppt->sub_topic_id) }}" class="btn buttonBatal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
    </div>
</form>
