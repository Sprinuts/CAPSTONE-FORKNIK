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
            <small class="d-block">Admin Panel</small>
        </div>
    </div>

    <!-- Navigation Links -->
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('welcomeadmin') ? 'active' : '' }}" href="{{ route('welcomeadmin') }}">
                <i class="fa-solid fa-gauge-high me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('users.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#managingSubmenu" aria-expanded="{{ request()->routeIs('users.*') ? 'true' : 'false' }}">
                <i class="fa-solid fa-users-gear me-2"></i>
                User Management
            </a>
            <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="managingSubmenu">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.view') ? 'active' : '' }}" href="{{ route('users.view') }}">
                            <i class="fa-solid fa-user-check me-2"></i>
                            Active Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.archive') ? 'active' : '' }}" href="{{ route('users.archive') }}">
                            <i class="fa-solid fa-user-slash me-2"></i>
                            Archived Users
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('appointment.records') ? 'active' : '' }}" href="{{ route('appointment.records') }}">
                <i class="fa-solid fa-gauge-high me-2"></i>
                Appointment Records
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('backup.viewbackups') ? 'active' : '' }}" href="{{ route('backup.viewbackups') }}">
                <i class="fa-solid fa-gauge-high me-2"></i>
                View Backups
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('content.management') ? 'active' : '' }}" href="{{ route('content.management') }}">
                <i class="fa-solid fa-gauge-high me-2"></i>
                Content Management
            </a>
        </li> --}}
    </ul>

    <!-- User Profile Section -->
    <div class="user-profile">
        <div class="user-avatar">
            <img src="{{ asset('style/assets/profile2.jpg') }}" alt="Help Desk Avatar">
        </div>
        <div class="user-info">
            <h5>{{ session('user')->name ?? 'Admin User' }}</h5>
            <p>Administrator</p>
            {{-- <a href="#" class="profile-link">View Profile</a> --}}
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

