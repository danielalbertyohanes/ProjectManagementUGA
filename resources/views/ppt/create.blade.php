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

            <label for="name_ppt">Name Of PPT</label>
            <input type="text" class="form-control" id="name_ppt" name="name_ppt" placeholder="Enter Name PPT" required>

        </div>
        <div class="form-group">
            <label for="name_video">Name Of Video</label>
            <input type="text" class="form-control" id="name_video" name="name_video" placeholder="Enter Name Video"
                required>
            <input type="hidden" id="status_video" name="status_video" value="Not Yet">


            <label for="location_video">Location</label>
            <select class="form-control" id="location_video" name="location_video" required>
                <option value="Not UBAYA">Not UBAYA</option>
                <option value="UBAYA">UBAYA</option>
            </select>
        </div>

        <div class="form-group">
            <label for="detail_location">Detail Location</label>
            <input type="text" class="form-control" id="detail_location" name="detail_location"
                placeholder="Enter Detail Location" required>
            <input type="hidden" id="status_video" name="status_video" value="Not Yet">
        </div>

        <div class="modal-footer">
            <a href="{{ route('subTopic.show', $subTopic->id) }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
