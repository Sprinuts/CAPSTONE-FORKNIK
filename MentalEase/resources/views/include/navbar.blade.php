<link rel="stylesheet" href="{{ asset('style/navbar.css') }}">

<!-- Mobile toggle button -->
<button class="sidebar-toggle d-lg-none" id="sidebarToggle" aria-label="Open sidebar">
    <i class="fa fa-bars"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Logo section -->
    <div class="logo-wrapper">
        <div class="logo-img-wrapper">
            <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo" class="logo-img">
        </div>
        <div class="logo-text">
            <span>MentalEase</span>
            <small>Patient Portal</small>
        </div>
    </div>
    
    <!-- Navigation links -->
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('welcomepatient') ? 'active' : '' }}" href="{{ route('welcomepatient') }}">
                <i class="fa-solid fa-home me-2"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('chatbot') ? 'active' : '' }}" href="{{ route('chatbot') }}">
                <i class="fa-solid fa-robot me-2"></i> ChatBot
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('appointment.selectPsychometrician') ? 'active' : '' }}" 
               href="{{ route('appointment.selectPsychometrician') }}">
                <i class="fa-solid fa-calendar-check me-2"></i> Appointment
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('assessment.*') ? 'active' : '' }}" 
               href="#" id="assessmentDropdown" role="button"
               data-bs-toggle="collapse" data-bs-target="#assessmentSubmenu" aria-expanded="false">
                <i class="fa-solid fa-clipboard-check me-2"></i> Assessments
            </a>
            <div class="collapse {{ request()->routeIs('assessment.*') ? 'show' : '' }}" id="assessmentSubmenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('assessment.stress') ? 'active' : '' }}" 
                           href="{{ route('assessment.stress') }}">Stress</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('assessment.emotional') ? 'active' : '' }}" 
                           href="{{ route('assessment.emotional') }}">Emotional</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('myrecords') ? 'active' : '' }}" href="{{ route('myrecords') }}">
                <i class="fa-solid fa-notes-medical me-2"></i> My Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('consultation') ? 'active' : '' }}" href="{{ route('consultation') }}">
                <i class="fa-solid fa-notes-medical me-2"></i> Online Consultation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                <i class="fa-solid fa-info-circle me-2"></i> About
            </a>
        </li>
    </ul>

    <!-- User profile section -->
<div class="user-profile">
    <div class="user-avatar">
        <img src="{{ asset('style/assets/default-avatar.png') }}" alt="User Avatar">
    </div>
    <div class="user-info">
        <h5>{{ session('user')->name ?? 'User' }}</h5>
        <p>{{ session('user')->email ?? '' }}</p>
        <a href="{{ route('profile') }}" class="profile-link">
            <i class="fa-solid fa-user-gear me-1"></i> Manage Profile
        </a>
    </div>
</div>
    
    <!-- Logout button at bottom -->
    <div class="sidebar-logout">
        <a class="Btn w-100" href="{{ route('logout') }}">
            <div class="sign">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <div class="text">Logout</div>
        </a>
    </div>
</div>

<!-- Main content wrapper -->
<div class="main-content">
    <!-- Your page content will go here -->
</div>

<!-- Sidebar JavaScript -->
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
    
    // Handle dropdown toggles within sidebar
   
        });

</script>



