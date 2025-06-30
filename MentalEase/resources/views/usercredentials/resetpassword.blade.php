<div class="container mt-5">
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('resetpassword') }}">
        @csrf

        <input type="hidden" name="username" value="{{ $username }}">

        <!-- New Password -->
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
