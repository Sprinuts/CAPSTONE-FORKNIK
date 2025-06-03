<link rel="stylesheet" href="{{ asset('style/navbar.css') }}">

<!-- Hamburger menu for mobile -->
<button class="sidebar-toggle" id="sidebarToggle" aria-label="Open sidebar">
    <i class="fa fa-bars"></i>
</button>
<!-- Overlay for mobile sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="sidebar">

<div class="sidebar">

    <a class="navbar-brand" href="{{ route('welcomepatient') }}">
        <div class="navbar-brand d-flex align-items-center logo-wrapper">
        <div class="logo-img-wrapper">
            <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo" class="logo-img">
        </div>
        <div class="logo-text">
            <div>MentalEase</div>
            <div>Patient Portal</div>

<nav class="navbar navbar-expand-lg bg-body-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <img src="" alt="home" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('welcomepatient') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('chatbot') }}">ChatBot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route(name: 'appointment.selectPsychometrician') }}">Appointment</a>  
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Assessments
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route(name: 'assessment.stress') }}">Stress</a></li>
                        <li><a class="dropdown-item" href="{{ route(name: 'assessment.emotional') }}">Emotional</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="{{ route('consultation') }}">Online Consultation</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="{{ route('about') }}">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="Btn" href="{{ route('logout') }}">
                    <div class="sign">  
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                    <div class="text">Logout</div>
                </a>
                </li>
            </ul>

        </div>
    </div>
    </a>
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('welcomepatient') ? 'active' : '' }}" href="{{ route('welcomepatient') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('chatbot') ? 'active' : '' }}" href="{{ route('chatbot') }}">
                AI Chatbot
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('appointment.selectPsychometrician') }}">Appointment</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Assessments
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                    <a class="dropdown-item" href="{{ route('assessment.stress') }}">Stress</a>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="nav-link {{ request()->routeIs('welcomepatient') ? 'active' : '' }}" href="{{ route('welcomepatient') }}">

        <a class="navbar-brand" href="{{ route('welcomepatient') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Home Logo">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcomepatient') ? 'active' : '' }}" href="{{ route('welcomepatient') }}">
                        Home
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('chatbot') ? 'active' : '' }}" href="{{ route('chatbot') }}">
                        ChatBot
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appointment') ? 'active' : '' }}" href="{{ route('appointment') }}">
                        Appointment
                    </a>
                    <a class="nav-link " href="{{ route(name: 'appointment.selectPsychometrician') }}">Appointment</a>  
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Assessments
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('assessment.stress') }}">Stress</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('assessment.emotional') }}">Emotional</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                <a class="nav-link " href="{{ route('consultation') }}">Online Consultation</a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="{{ route('about') }}">About</a>
                </li>
            </ul>

            <!-- Right Side (Logout) -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="Btn" href="{{ route('logout') }}">
                        <div class="sign">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </div>
                        <div class="text">Logout</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
