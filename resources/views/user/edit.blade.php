<form action="{{ route('user.update', $user) }}" method="post">
    @method('put')
    @csrf

    <div class="mb-3">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control" required>
            <option style="display:none" value="">Selected Role</option>
            @foreach($roles as $role)
                <option {{ $user->role == $role ? 'selected' : '' }}  value="{{$role}}">{{$role}}</option>
            @endforeach
            @error('role')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name"
            aria-describedby="name" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" value="{{ $user->email }}" name="email" id="email"
            aria-describedby="email" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" value="" name="password" id="password"
            aria-describedby="password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Conform Password</label>
        <input type="password" class="form-control" value="" name="password_confirmation" id="password"
            aria-describedby="password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" pattern="[0-9]{12}" class="form-control" name="phone" value="{{ $user->phone }}"
            id="phone" aria-describedby="phone" required>
        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

     <div class="text-center">
        <button class="btn btn-info" type="submit"> Update </button>
    </div>

</form>
