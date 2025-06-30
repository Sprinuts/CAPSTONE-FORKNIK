<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - MentalEase</title>
    <link rel="stylesheet" href="{{ asset('style/passwordforgot.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <a href="{{ route('login') }}" class="back-icon" style="position: absolute; top: 20px; left: 20px; color: #333; text-decoration: none;">
            <i class="fa-solid fa-arrow-left"></i> Back to Login
        </a>
        
        <form method="POST" action="{{ route('password.email') }}" class="login-form">
            @csrf
            <h2>Forgot Password</h2>
            <p class="subtitle">Enter your email to receive a password reset link</p>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required autofocus>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="login-btn">Send Reset Link</button>
            
            <div class="register-link">
                <span>Remember your password?</span>
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>
