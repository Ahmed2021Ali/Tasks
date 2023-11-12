<form action="{{ route('sub.extend_option', $task->id) }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea class="form-control" name="description" id="description" aria-describedby="description" required></textarea>
    </div>
    <?php $current_time = now(); ?>
    <div class="mb-3">
        <label for="dateline" class="form-label">Extend Request</label>
        <input type="datetime-local" class="form-control" value="{{ $task->dateline }}" min="{{ $task->dateline }}" max="2040-11-06" name="extend_request"
            id="dateline" aria-describedby="dateline" required>
    </div>

    <div class="jsutify-content-end">
        <button class="btn btn-warning" type="submit">Extend Request</button>
    </div>

</form>
