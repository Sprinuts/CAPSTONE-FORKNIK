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
            <a class="nav-link {{ request()->routeIs('payment.records') ? 'active' : '' }}" href="{{ route('payment.records') }}">
                <i class="fa-solid fa-gauge-high me-2"></i>
                Payment Records
            </a>
        </li>
    </ul>

    <!-- User Profile Section -->
    <div class="user-profile">
        <div class="user-avatar">
            <img src="{{ asset('style/assets/default-avatar.png') }}" alt="Admin Avatar">
        </div>
        <div class="user-info">
            <h5>{{ session('user')->name ?? 'Admin User' }}</h5>
            <p>Administrator</p>
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

