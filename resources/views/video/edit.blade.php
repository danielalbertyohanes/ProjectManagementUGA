<link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">

<h2>Edit Video</h2>
<form action="{{ route('video.update', $video->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama Video</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama Video"
            value="{{ old('name', $video->name) }}" oninput="this.value = this.value.toUpperCase()">

        <label for="location">Lokasi</label>
        <select class="form-control" id="location" name="location" required>
            @foreach (['UBAYA', 'Not UBAYA'] as $location)
                <option value="{{ $location }}" {{ $video->location == $location ? 'selected' : '' }}>
                    {{ $location }}
                </option>
            @endforeach
        </select>

        <label for="description_location">Detail Lokasi</label>
        <input type="text" class="form-control" id="detail_location" name="detail_location"
            placeholder="Masukan Detail Lokasi" value="{{ old('detail_location', $video->detail_location) }}">
    </div>

    <div class="modal-footer">
        <a href="{{ route('subTopic.show', $video->ppt->sub_topic_id) }}" class="btn buttonBatal"
            data-dismiss="modal">Batal</a>
        <button type="submit" class="btn buttonSimpan">Simpan</button>
    </div>
</form>
