@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">
    <h2>Tambah Video</h2>
    <form method="POST" action="{{ route('video.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama Video</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama video" required
                oninput="this.value = this.value.toUpperCase()">

            <label for="location">Lokasi</label>
            <select class="form-control" id="location" name="location" required>
                <option value="" selected disabled>Pilih Lokasi</option>
                <option value="UBAYA">UBAYA</option>
                <option value="Not UBAYA">Not UBAYA</option>
            </select>

            <label for="detail_location">Detail Lokasi</label>
            <input type="text" class="form-control" id="detail_location" name="detail_location"
                placeholder="Masukan Detail Lokasi" required>

            <input type="hidden" id="status_video" name="status_video" value="Not Yet">

            <label for="ppt">PPT</label>
            <select class="form-control" id="ppt" name="ppt_id" required>
                <option value="" selected disabled>Select PPT</option>
                @foreach ($ppts as $ppt)
                    <option value="{{ $ppt->id }}">{{ $ppt->name }}</option>
                @endforeach
            </select>

            <input type="hidden" name="sub_topic_id" value="{{ $subTopicId }}">
        </div>

        <div class="modal-footer">
            <a href="{{ route('subTopic.show', $subTopicId) }}" class="btn buttonBatal">Batal</a>
            <button type="submit" class="btn buttonSimpan">Simpan</button>
        </div>
    </form>
@endsection
