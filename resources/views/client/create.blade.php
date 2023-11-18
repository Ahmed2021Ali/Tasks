

<form action="{{ route('client.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" pattern="[0-9]{12}" class="form-control" name="phone" id="phone" aria-describedby="phone" required>
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Add Client </button>
    </div>

</form>
