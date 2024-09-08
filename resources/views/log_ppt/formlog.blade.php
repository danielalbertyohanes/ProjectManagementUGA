<form method="POST" action="{{ route('logPpt.store', $ppt->id) }}">
    @csrf
    @method('POST')

    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach (['Not Yet', 'Progress', 'Finish', 'Cancel'] as $status)
            <option value="{{ $status }}" @if ($ppt->status == $status) selected @endif>
                {{ $status }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Masukan Log</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <input type="hidden" name="ppt_id" value="{{ $ppt->id }}">

    <button type="submit" class="btn btn-primary">Save</button>
</form>