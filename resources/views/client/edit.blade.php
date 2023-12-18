
<form action="{{ route('client.update', $client) }}" method="post">
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">UserName</label>
        <input type="text" class="form-control" name="name" value="{{ $client->name }}" required>
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>


    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" pattern="[0-9]{12}" name="phone" value="{{ $client->phone }}" aria-describedby="phone" required>
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    </div>

    <div class="text-center">
        <button class="btn btn-info" type="submit"> Update Client </button>
    </div>

</form>
