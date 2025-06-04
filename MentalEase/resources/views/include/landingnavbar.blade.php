<link rel="stylesheet" href="{{ asset('style/landingnavbar.css') }}">

<!-- Top header with logo and contact info -->
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo on the left -->
            <div class="col-md-3">
                <div class="logo">
                    <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo">
                    <span>MentalEase</span>
                </div>
            </div>
            
            <!-- Contact info on the right -->
            <div class="col-md-9">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="icon-circle">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <span class="label">EMERGENCY</span>
                            <span class="value">(+63) 939 939 1293</span>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="icon-circle">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="contact-text">
                            <span class="label">WORK HOUR</span>
                            <span class="value">08:00 - 5:00 Mon - Fri</span>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="icon-circle">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="contact-text">
                            <span class="label">LOCATION</span>
                            <span class="value">1418 Larson Ave, Sampaloc, Manila, 1008 Kalakhang Maynila</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main navigation -->
<nav class="main-nav">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}" class="active">Home</a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-end d-flex align-items-center justify-content-end">
                <a href="{{ route('login') }}" class="login-btn">Login</a>
            </div>
        </div>
    </div>
</nav>


