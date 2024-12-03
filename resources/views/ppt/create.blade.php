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
            <input type="text" class="form-control" id="name_video" name="name_video" placeholder="Enter Name" required>

            <input type="hidden" id="status_video" name="status_video" value="Not Yet">
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ppt.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection
