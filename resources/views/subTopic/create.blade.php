@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('subTopic.store') }}">
    @csrf
    <div class="form-group">
        <label for="name">Nama Sub-Topic</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name Topic" required>

        <label for="topicId">Topic</label>
        <select class="form-control" id="topicId" name="topic_id" required>
            <option value="" selected disabled>Pilih Topic</option>
            @foreach ($topics as $topic)
            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
            @endforeach
        </select>

        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="Not Yet">Not Yet</option>
            <option value="Progres">Progres</option>
            <option value="Finish">Finish</option>
            <option value="Cancel">Cancel</option>
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('subTopic.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
@endsection