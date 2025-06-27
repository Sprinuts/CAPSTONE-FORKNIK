<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('style/loginview.css') }}">
    <title>Login | MentalEase</title>

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
    <form action="{{ route('login') }}" method="POST" class="login-form">
        @csrf
        <h2>Login</h2>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
                <i id="eyePassword" class="fa-solid fa-eye-slash toggle-icon" onclick="togglePassword('password', 'eyePassword')"></i>
            </div>
        </div>
        <button type="submit" class="login-btn">Login</button>
        <div class="register-link" style="margin-top: 15px; text-align: center;">
            <span>Don't have an account?</span>
            <a href="{{ route('register') }}">Register here</a>
        </div>
    </form>
</div>

<script src="{{ asset('javascript/login.js') }}"></script>

<script>
    // Check if user is already logged in
    document.addEventListener('DOMContentLoaded', function() {
        // If there's a user session, redirect to appropriate dashboard
        @if(session('user'))
            @php
                $redirectUrl = '';
                $user = session('user');
                switch($user->role) {
                    case 'patient':
                        $redirectUrl = route('welcomepatient');
                        break;
                    case 'admin':
                        $redirectUrl = route('welcomeadmin');
                        break;
                    case 'psychometrician':
                        $redirectUrl = route('welcomepsychometrician');
                        break;
                    case 'cashier':
                        $redirectUrl = route('welcomecashier');
                        break;
                }
            @endphp
            
            // Replace history and redirect
            window.history.replaceState(null, '', '{{ $redirectUrl }}');
            window.location.href = '{{ $redirectUrl }}';
        @endif
    });
</script>

<script>
    // Check if user came from profile completion page
    document.addEventListener('DOMContentLoaded', function() {
        // If there's no user session and the referrer was the profile completion page,
        // redirect to the landing page
        const referrer = document.referrer;
        if (referrer && referrer.includes('/profile/complete') && !@json(session('user'))) {
            window.location.href = '{{ route("welcome") }}';
        }
    });
</script>


