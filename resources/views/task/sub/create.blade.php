<form action="{{ route('sub.store', $main_task->main_id) }}" method="post">

    @csrf

    <div class="mb-3">
        <label for="role">Assigned To</label>
        <select name="assigned_to" id="assigned_to" class="form-control" required>
            <option style="display:none" value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('assigned_to')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="name" aria-describedby="title" required>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea class="form-control" name="description" id="description" aria-describedby="description"
        required></textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
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
        <input type="datetime-local" class="form-control" name="dateline" min="{{$current_time->format('Y-m-d H:i:s')}}" max="2040-11-06" id="dateline" aria-describedby="dateline"
        value="{{$current_time->format('Y-m-d H:i:s')}}" required>
    </div>

    <div class="mb-3">
        <label for="notify" class="form-label">Notify Client</label>
        <input type="checkbox" class="form-control" name="notify" id="notify" aria-describedby="notify">
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Add Sub Task </button>
    </div>

</form>
