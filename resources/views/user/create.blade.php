<form action="{{ route('user.store') }}" method="post">
    @csrf

    <div class="mb-3">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control" required>
            <option style="display:none" value="">Select Role</option>
            <option value="manger">Manger</option>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
        </select>
        @error('role')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Username</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="email" required>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Conform Password</label>
        <input type="password" class="form-control" name="password_confirmation" id="password" aria-describedby="password" required>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone" required
            pattern="[0-9]{12}">
        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit"> Add </button>
    </div>

</form>
