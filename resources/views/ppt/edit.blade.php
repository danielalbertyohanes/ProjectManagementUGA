<form action="{{ route('ppt.update', $ppt->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama PPT</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name PPT"
            value="{{ old('name', $ppt->name) }}"  oninput="this.value = this.value.toUpperCase()">
    </div>

    <div class="modal-footer">
        <a href="{{ route('subTopic.show', $ppt->sub_topic_id) }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
