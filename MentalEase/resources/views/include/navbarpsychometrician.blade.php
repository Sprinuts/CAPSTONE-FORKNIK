<link rel="stylesheet" href="{{ asset('style/navbaradminpsyc.css') }}">

<!-- Sidebar -->
<nav class="sidebar">
    <!-- Logo -->
    <div class="logo-wrapper">
        <div class="logo-img-wrapper">
            <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo" class="logo-img">
        </div>
        <div class="logo-text">
            <span>MentalEase</span>
            <small class="d-block">Psychometrician Panel</small>
        </div>
    </div>

    <!-- Navigation Links -->
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('welcomepsychometrician') ? 'active' : '' }}" href="{{ route('welcomepsychometrician') }}">
                <i class="fa-solid fa-home me-2"></i>
                Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('schedule.create') ? 'active' : '' }}" href="{{ route('schedule.create') }}">
                <i class="fa-solid fa-calendar-plus me-2"></i>
                Create Schedule
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('schedule.view') ? 'active' : '' }}" href="{{ route('schedule.view') }}">
                <i class="fa-solid fa-calendar-days me-2"></i>
                View Schedules
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('appointment.view') ? 'active' : '' }}" href="{{ route('appointment.view') }}">
                <i class="fa-solid fa-calendar-days me-2"></i>
                View Appointments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('consultationpsychometrician') ? 'active' : '' }}" href="{{ route('consultationpsychometrician') }}">
            <i class="fa-solid fa-comments me-2"></i>
            Online Consultation
            </a>
        </li>
    </ul>

    <!-- User Profile Section -->
    <div class="user-profile">
        <div class="user-avatar">
            <img src="{{ asset('style/assets/profile2.jpg') }}" alt="Psychometrician Avatar">
        </div>
        <div class="user-info">
            <h5>{{ session('user')->name ?? 'Psychometrician' }}</h5>
            <p>Psychometrician</p>
            <a href="#" class="profile-link">View Profile</a>
        </div>
    </div>

    <!-- Logout Button -->
    <div class="sidebar-logout">
        <a href="{{ route('logout') }}" class="Btn">
            <div class="sign">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <div class="text">Logout</div>
        </a>
    </div>
</nav>

<!-- Mobile Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- JavaScript for sidebar functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
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

