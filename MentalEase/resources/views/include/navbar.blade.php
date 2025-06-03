<link rel="stylesheet" href="{{ asset('style/navbar.css') }}">

<!-- Mobile sidebar components -->
<button class="sidebar-toggle d-lg-none" id="sidebarToggle" aria-label="Open sidebar">
    <i class="fa fa-bars"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Main navigation -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <!-- Logo -->


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
                    <a class="nav-link {{ request()->routeIs('appointment.selectPsychometrician') ? 'active' : '' }}" 
                       href="{{ route('appointment.selectPsychometrician') }}">
                        Appointment
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('assessment.*') ? 'active' : '' }}" 
                       href="#" id="navbarDropdown" role="button"
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
                    <a class="nav-link {{ request()->routeIs('consultation') ? 'active' : '' }}" href="{{ route('consultation') }}">
                        Online Consultation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About
                    </a>
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

<!-- Add sidebar JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    if (sidebarToggle && sidebar && sidebarOverlay) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });
        
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });
    }
});
</script>

