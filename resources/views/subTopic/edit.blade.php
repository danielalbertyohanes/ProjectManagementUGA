@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ route('subTopic.update', $subTopic->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="subTopicName">Name subTopic</label>
        <input type="text" class="form-control" id="subTopicName" name="name" placeholder="Enter Name of Course" value="{{ $subTopic->name }}" required>

        <label for="status">Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="" selected disabled>Pilih Status</option>
            @foreach (['Not Yet', 'Progres', 'Finish', 'Cancel'] as $status)
            <option value="{{ $status }}" @if ($subTopic->status == $status) selected @endif>
                {{ $status }}
            </option>
            @endforeach
        </select>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('course.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</form>