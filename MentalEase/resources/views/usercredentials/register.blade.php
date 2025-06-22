@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="login-container">
    <a href="{{ route('welcome') }}" class="back-icon" style="position: absolute; top: 20px; left: 20px; color: #333; text-decoration: none;">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('register') }}" method="POST" class="login-form">
        @csrf
        <h2>Register</h2>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username" required value="{{ old('username') }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <i id="eyePassword" class="fa-solid fa-eye-slash toggle-icon" onclick="togglePassword('password', 'eyePassword')"></i>
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-wrapper">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                <i id="eyePasswordConfirm" class="fa-solid fa-eye-slash toggle-icon" onclick="togglePassword('password_confirmation', 'eyePasswordConfirm')"></i>
            </div>
        </div>
        <button type="submit" class="login-btn">Register</button>
        <div class="register-link" style="margin-top: 15px; text-align: center;">
            <span>Already have an account?</span>
            <a href="{{ route('login') }}">Login here</a>
        </div>
    </form>
</div>
