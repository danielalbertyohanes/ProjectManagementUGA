@extends('layouts.admin')
@section('content')


<form method="POST" action="{{ route('topic.update', $topic->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="TopicName">Name Topic</label>
        <input type="text" class="form-control" id="TopicName" name="name" placeholder="Enter Name of Course" value="{{ $topic->name }}" required>

        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="" selected disabled>Pilih Status</option>
            @foreach (['Not Yet', 'Progres', 'Finish', 'Cancel'] as $status)
            <option value="{{ $status }}" @if ($topic->status == $status) selected @endif>
                {{ $status }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('course.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
@endsection