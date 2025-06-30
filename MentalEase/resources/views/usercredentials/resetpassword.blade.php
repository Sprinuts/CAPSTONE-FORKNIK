<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - MentalEase</title>
    <link rel="stylesheet" href="{{ asset('style/forgotpassword.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <a href="{{ route('login') }}" class="back-icon" style="position: absolute; top: 20px; left: 20px; color: #333; text-decoration: none;">
            <i class="fa-solid fa-arrow-left"></i> Back to Login
        </a>
        
        <form method="POST" action="{{ route('resetpassword') }}" class="login-form">
            @csrf
            <h2>Reset Password</h2>
            <p class="subtitle">Create a new secure password for your account</p>
            
            <input type="hidden" name="username" value="{{ $username }}">
            
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password" placeholder="Enter new password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password"
                       name="password_confirmation" required autocomplete="new-password" placeholder="Confirm new password">
            </div>
            
            <button type="submit" class="login-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>

