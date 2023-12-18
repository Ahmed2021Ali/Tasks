<form action="{{ route('sub.upload_file', $task) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Upload file</label>
        <input type="file" class="form-control" value="{{ $task->file }}" name="file" id="file"
            aria-describedby="file" required>
    </div>

    <div class="jsutify-content-end">
        <button class="btn btn-success" type="submit">Upload file</button>
    </div>
</form>
