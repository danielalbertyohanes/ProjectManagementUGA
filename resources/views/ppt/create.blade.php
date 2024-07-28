@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('ppt.store') }}">
        @csrf
        <div class="form-group">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <label for="name_ppt">Name Of PPT</label>
            <input type="text" class="form-control" id="name_ppt" name="name_ppt" placeholder="Enter Name PPT" required>

            <label for="subTopicId_ppt">Sub Topic</label>
            <select class="form-control" id="subTopicId_ppt" name="sub_topic_id_ppt" required>
                <option value="" selected disabled>Pilih Sub Topic</option>
                @foreach ($subTopics as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>

            <label for="status_ppt">Status</label>
            <select class="form-control" id="status_ppt" name="status_ppt" required>
                <option value="Not Yet">Not Yet</option>
                <option value="Progres">Progres</option>
                <option value="Finish">Finish</option>
                <option value="Cancel">Cancel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="name_video">Name Of Video</label>
            <input type="text" class="form-control" id="name_video" name="name_video" placeholder="Enter Name" required>

            <label for="location_video">Location Video</label>
            <select class="form-control" id="location_video" name="location_video" required>
                <option value="UBAYA">UBAYA</option>
                <option value="Not UBAYA">Not UBAYA</option>
            </select>

            <label for="detail_location_video">Detail Location Video</label>
            <input type="text" class="form-control" id="detail_location_video" name="detail_location_video"
                placeholder="Enter Detail Location" required>

            <input type="hidden" id="status_video" name="status_video" value="Not Yet">
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ppt.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection
