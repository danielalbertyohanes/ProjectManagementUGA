<form method="POST" action="{{ route('logVideo.store', $video->id) }}">
    @csrf

    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach (['Start', 'Pause', 'Finish', 'Retake', 'Cancel'] as $status)
            <option value="{{ $status }}" @if ($video->status == $status) selected @endif>
                {{ $status }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Masukan Log</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <input type="hidden" name="video_id" value="{{ $video->id }}">

    <button type="submit" class="btn btn-primary">Save</button>
</form>