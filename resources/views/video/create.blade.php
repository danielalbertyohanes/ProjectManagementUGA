@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('video.store') }}">
        @csrf
        <div class="form-group">

            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>

            <label for="location">Location</label>
            <select class="form-control" id="location" name="location" required>
                <option value="UBAYA">UBAYA</option>
                <option value="Not UBAYA">Not UBAYA</option>
            </select>

            <label for="detail_location">Detail Location</label>
            <input type="text" class="form-control" id="detail_location" name="detail_location"
                placeholder="Enter Detail Location" required>

            <input type="hidden" id="status_video" name="status_video" value="Not Yet">

            <label for="ppt_id">PPT ID</label>
            <input type="text" class="form-control" id="ppt_id" name="ppt_id" placeholder="Enter PPT ID" required>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('ppt.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection
