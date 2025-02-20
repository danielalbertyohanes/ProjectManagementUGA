@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/modal.css') }}">
    <h2>Tambah Video</h2>
    <form method="POST" action="{{ route('video.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>

            <label for="location">Location</label>
            <select class="form-control" id="location" name="location" required>
                <option value="" selected disabled>Select Location</option>
                <option value="UBAYA">UBAYA</option>
                <option value="Not UBAYA">Not UBAYA</option>
            </select>

            <label for="detail_location">Detail Location</label>
            <input type="text" class="form-control" id="detail_location" name="detail_location"
                placeholder="Enter Detail Location" required>

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
<<<<<<< Updated upstream
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ppt.index') }}" class="btn btn-danger">Cancel</a>
=======
            <a href="{{ route('subTopic.show', $subTopicId) }}" class="btn buttonBatal">Batal</a>
            <button type="submit" class="btn buttonSimpan">Simpan</button>
>>>>>>> Stashed changes
        </div>
    </form>
@endsection
