  <form wire:submit="create_sub_task" >
   {{--    <div class="mb-3">
        <label for="role">Assigned To</label>
        <select name="assigned_to" id="assigned_to" class="form-control" required>
            <option value="" style="display:none">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input wire:model="title" type="text" class="form-control" name="title" id="name" aria-describedby="title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea wire:model="description" class="form-control" name="description" id="description" aria-describedby="description" required></textarea>
    </div>

    <?php $current_time = now(); ?>
    <div class="mb-3">
        <label for="request_at" class="form-label">Request_At</label>
        <input wire:model="request_at" type="datetime-local" class="form-control" name="request_at" id="request_at"
            value="{{ $current_time->format('Y-m-d H:i:s') }}" aria-describedby="request_at" required>
        @error('request_at')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="dateline" class="form-label">DateLine</label>
        <input wire:model="dateline" type="datetime-local" class="form-control" name="dateline"
            min="{{ $current_time->format('Y-m-d H:i:s') }}" max="2040-11-06 10:22:50" id="dateline"
            aria-describedby="dateline" value="{{ $current_time->format('Y-m-d H:i:s') }}" required>
    </div>

    <div class="mb-3">
        <label for="notinotifyfy_client" class="form-label">Notify Client</label>
        <input wire:model="notify" type="checkbox" class="form-control" name="notify" id="notify" aria-describedby="notify">
    </div>  --}}

    <div class="jsutify-content-end">
        <button class="btn btn-primary" type="submit">Add SubTask</button>
    </div>
</form>

