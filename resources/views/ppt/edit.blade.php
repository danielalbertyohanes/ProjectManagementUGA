<form action="{{ route('ppt.update', $ppt->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name Of PPT</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name PPT"
            value="{{ old('name', $ppt->name) }}">

    </div>

    <div class="modal-footer">
        <a href="{{ route('subTopic.show', $ppt->sub_topic_id) }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
