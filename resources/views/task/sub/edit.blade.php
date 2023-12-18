<form action="{{ route('task.update', $task) }}" method="post">
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="role">Assigned To</label>
        <select name="assigned_to" id="assigned_to" class="form-control" required>
            <option  style="display:none" value="">Select User</option>
            @foreach ($users as $user)
                <option {{ $user->id == $task->assigned_to ? 'selected' : '' }} value="{{ $user->id }}">
                    {{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" value="{{ $task->title }}" name="title" id="name"
            aria-describedby="title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea class="form-control" name="description" id="description" aria-describedby="description"
        required>{{ $task->description }}</textarea>
    </div>

    <?php $current_time = now() ?>
    <div class="mb-3">
        <label for="request_at" class="form-label">Request_At</label>
        <input type="datetime-local" class="form-control" name="request_at" id="request_at"
        value="{{$current_time->format('Y-m-d H:i:s')}}"  aria-describedby="request_at" required>
        @error('request_at')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="dateline" class="form-label">DateLine</label>
        <input type="datetime-local" class="form-control" name="dateline" min="{{$current_time->format('Y-m-d H:i:s')}}" max="2040-11-06 10:22:50" id="dateline" aria-describedby="dateline"
        value="{{$current_time->format('Y-m-d H:i:s')}}" required>
    </div>

    <div class="mb-3">
        <label for="notify" class="form-label">Notify</label>
        <input type="checkbox" class="form-control" name="notify" id="notify"
            aria-describedby="notify">
    </div>

    <div class="text-center">
        <button class="btn btn-info" type="submit"> Update Task </button>
    </div>
</form>
