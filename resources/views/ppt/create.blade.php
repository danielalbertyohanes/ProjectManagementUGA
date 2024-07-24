@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('ppt.store') }}">
    @csrf
    <div class="form-group">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


        {{-- ini butuh di tampilin atau ndak  --}}
        {{-- <label for="penginput">Penginput</label>
            <input type="text" class="form-control" id="penginput" name="penginput" value="{{ Auth::user()->name }}"
        readonly> --}}

        <label for="name">Name Of PPT</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name PPT" required>

        <label for="driveUrl">Drive URL</label>
        <input type="url" class="form-control" id="driveUrl" name="drive_url" placeholder="Enter Drive URL" required>

        <label for="subTopicId">Sub Topic</label>
        <select class="form-control" id="subTopicId" name="sub_topic_id" required>
            <option value="" selected disabled>Pilih Sub Topic</option>
            @foreach ($subTopics as $s)
            <option value="{{ $s->id }}">{{ $s->name }}</option>
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
        <a href="{{ route('ppt.index') }}" class="btn btn-danger">Cancel</a>
    </div>
</form>
@endsection