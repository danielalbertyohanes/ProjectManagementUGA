@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('course.store') }}">
        @csrf
        <div class="form-group">
            <label for="courseName">Name Course</label>
            <input type="text" class="form-control" id="courseName" name="name" placeholder="Enter Name of Course"
                required>

            <label for="courseDescription">Description Course</label>
            <input type="text" class="form-control" id="courseDescription" name="description"
                placeholder="Enter Description" required>

            <label for="videoCount">Jumlah Video</label>
            <input type="number" class="form-control" id="videoCount" name="jumlah_video" placeholder="Enter Jumlah Video"
                required>

            <label for="panduanRPP">Panduan RPP Path</label>
            <input type="text" class="form-control" id="panduanRPP" name="panduan_rpp_path"
                placeholder="Enter Panduan RPP">

            <label for="templateRPP">Template RPP Path</label>
            <input type="text" class="form-control" id="templateRPP" name="template_rpp_path"
                placeholder="Enter Template RPP">

            <label for="picCourse">PIC Course</label>
            <select class="form-control" id="picCourse" name="pic_course" required>
                <option value="" selected disabled>Pilih PIC</option>
                @foreach ($pic as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('course.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
@endsection
