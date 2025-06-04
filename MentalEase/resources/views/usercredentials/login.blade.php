<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('style/loginview.css') }}">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="{{ ('register') }}" class="sign-up-form" method="POST" id="sign-up-form">
            @csrf
            <h1>Register</h1>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="text" name="name" id="name" placeholder="Full Name" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="tel" name="contactnumber" id="contactnumber" placeholder="Contact Number" required>
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i id="eyePassword" class="fa-solid fa-eye-slash toggle-icon" onclick="togglePassword('password', 'eyePassword')"></i>
            </div>
            <button type="submit" id="sign-up-btn">Register</button>
        </form>
    </div>
    <div class="form-container sign-in">
        <form action="{{ url('login') }}" method="POST">
            @csrf
            <h1>Log In</h1>
            <input type="text" name="username" id="username" placeholder="Username">
            <div class="input-wrapper">
                <input type="password" name="password" id="password" placeholder="Password">
                <i id="eyePassword" class="fa-solid fa-eye-slash toggle-icon" onclick="togglePassword('password', 'eyePassword')"></i>
            </div>

            <button type="submit" id="sign-in-btn">Log In</button>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome!</h1>
                <p>Login?</p>
                <button class="hidden" id="login">Log In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Not Registered?</p>
                <button class="hidden" id="register">Register</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('javascript/login.js') }}"></script>