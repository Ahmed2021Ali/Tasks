

<form action="{{ route('role.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Permission of Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Add Permission </button>
    </div>

</form>
