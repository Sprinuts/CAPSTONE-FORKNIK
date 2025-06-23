<link rel="stylesheet" href="{{ asset('style/navbar.css') }}">

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('welcomepatient') }}">
            <div class="logo-wrapper">
                <div class="logo-img-wrapper">
                    <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo" class="logo-img">
                </div>
                <div class="logo-text">
                    <span>MentalEase</span>
                </div>
            </div>
        </a>
        
        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <!-- Combine related items into a Services dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('chatbot') || request()->routeIs('consultation') ? 'active' : '' }}" 
                       href="#" id="servicesDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('chatbot') ? 'active' : '' }}" 
                               href="{{ route('chatbot') }}">Emotional Support Chatbot</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('consultation') ? 'active' : '' }}" 
                               href="{{ route('consultation') }}">Online Consultation</a>
                        </li>
                    </ul>
                </li>
                
                @php
                    $hasAppointment = \App\Models\Appointment::where('user_id', session('user')->id ?? null)
                        ->where('cancelled', false)
                        ->where('complete', false)
                        ->exists();
                @endphp

                <li class="nav-item">
                    @if($hasAppointment)
                        <a class="nav-link {{ request()->routeIs('appointment.patientview') ? 'active' : '' }}" 
                           href="{{ route('appointment.patientview') }}">
                            Appointment
                        </a>
                    @else
                        <a class="nav-link {{ request()->routeIs('appointment.selectPsychometrician') ? 'active' : '' }}" 
                           href="{{ route('appointment.selectPsychometrician') }}">
                            Appointment
                        </a>
                    @endif
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('journal') ? 'active' : '' }}" 
                       href="{{ route('journal') }}">
                        Journal
                    </a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('assessment.*') ? 'active' : '' }}" 
                       href="#" id="assessmentDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Assessments
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="assessmentDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('assessment.pss') ? 'active' : '' }}" 
                               href="{{ route('assessment.pss') }}">PSS Assessment</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('assessment.dass') ? 'active' : '' }}" 
                               href="{{ route('assessment.dass') }}">DASS-21 Assessment</a>
                        </li>
                    </ul>
                </li>
                
                <!-- Combine Records and Journal into a single dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('myrecords') || request()->routeIs('journal.record') ? 'active' : '' }}" 
                       href="#" id="recordsDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        My Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="recordsDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('myrecords') ? 'active' : '' }}" 
                               href="{{ route('myrecords') }}">Medical Records</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('journal.record') ? 'active' : '' }}" 
                               href="{{ route('journal.record') }}">Appointment History</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            <!-- User dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('style/assets/defaultprofile.jpg') }}" alt="User Avatar" class="user-avatar-small">
                        <span class="d-none d-md-inline-block ms-2">{{ session('user')->name ?? 'User' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa-solid fa-user-gear me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main content wrapper -->

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










