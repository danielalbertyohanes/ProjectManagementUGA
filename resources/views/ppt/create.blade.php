@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('ppt.store') }}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <label for="subTopicId_ppt">Nama Sub Topic</label>
            <input type="hidden" name="sub_topic_id" value="{{ $subTopic->id }}">
            <input type="text" class="form-control" id="name_subtopic" name="name_subtopic" value="{{ $subTopic->name }}"
                required readonly>

            <label for="name_ppt">Nama PPT</label>
            <input type="text" class="form-control" id="name_ppt" name="name_ppt" placeholder="Masukan Nama PPT" required
                oninput="this.value = this.value.toUpperCase()">

        </div>
        <div class="form-group">
            <label for="name_video">Nama Video</label>
            <input type="text" class="form-control" id="name_video" name="name_video" placeholder="Masukan Nama Video"
                required oninput="this.value = this.value.toUpperCase()">

            <input type="hidden" id="status_video" name="status_video" value="Not Yet">

            <label for="location_video">Lokasi</label>
            <select class="form-control" id="location_video" name="location_video" required>
                <option value="Not UBAYA">Not UBAYA</option>
                <option value="UBAYA">UBAYA</option>
            </select>

            <label for="detail_location">Detail Lokasi</label>
            <input type="text" class="form-control" id="detail_location" name="detail_location"
                placeholder="Masukan Detail Lokasi" required>
        </div>

        <div class="modal-footer">
            <a href="{{ route('subTopic.show', $subTopic->id) }}" class="btn btn-danger">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection
