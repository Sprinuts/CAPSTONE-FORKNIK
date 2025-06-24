<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('style/userprofile.css') }}">


<div class="profile-container">
    <div class="profile-header">
        <div class="profile-cover"></div>
        <div class="profile-avatar">
            <img src="{{ asset('style/assets/defaultprofile.jpg') }}" alt="Profile Picture" class="rounded-circle shadow">
            <button class="avatar-edit-btn" title="Change profile picture">
                <i class="bi bi-camera-fill"></i>
            </button>
        </div>
    </div>

    <div class="profile-card">
        <div class="name-section">
            <h2 id="userName" class="user-name">
                {{ str_repeat('*', strlen($user->username)) }}
            </h2>
            <button onclick="toggleName()" class="visibility-toggle" title="Toggle name visibility">
                <i id="eyeIcon" class="bi bi-eye"></i>
            </button>
        </div>
        
        <p class="user-email">{{ $user->email }}</p>
        
        <div class="profile-actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary action-btn">
                <i class="bi bi-pencil-square"></i> Edit Profile
            </a>
        </div>

        <!-- User Details Accordion -->
        <div class="profile-details-accordion" id="userDetailsAccordion">
<!-- Personal Information -->
<div class="accordion-item">
    <h2 class="accordion-header" id="personalInfoHeading">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#personalInfoCollapse" aria-expanded="false" aria-controls="personalInfoCollapse">
            <i class="bi bi-person-lines-fill me-2"></i> Personal Information
        </button>
    </h2>
    <div id="personalInfoCollapse" class="accordion-collapse collapse" aria-labelledby="personalInfoHeading" data-bs-parent="#userDetailsAccordion">
        <div class="accordion-body p-0">
            <div class="info-container">
                <!-- Full Name -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">
                            {{ ($user->name && $user->last_name) ? 
                               $user->name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->last_name : 
                               'Not provided' }}
                        </div>
                    </div>
                </div>
                
                <!-- Contact Number -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Contact</div>
                        <div class="info-value">{{ $user->contactnumber ?? 'Not provided' }}</div>
                    </div>
                </div>
                
                <!-- Address -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $user->address ?? 'Not provided' }}</div>
                    </div>
                </div>
                
                <!-- Age -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Age</div>
                        <div class="info-value">{{ $user->age ? $user->age . ' years old' : 'Not provided' }}</div>
                    </div>
                </div>
                
                <!-- Gender -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-gender-ambiguous"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Gender</div>
                        <div class="info-value">{{ $user->gender ? ucfirst($user->gender) : 'Not provided' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Information -->
<div class="accordion-item">
    <h2 class="accordion-header" id="additionalInfoHeading">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#additionalInfoCollapse" aria-expanded="false" aria-controls="additionalInfoCollapse">
            <i class="bi bi-card-list me-2"></i> Additional Information
        </button>
    </h2>
    <div id="additionalInfoCollapse" class="accordion-collapse collapse" aria-labelledby="additionalInfoHeading" data-bs-parent="#userDetailsAccordion">
        <div class="accordion-body p-0">
            <div class="info-container">
                <!-- Civil Status -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Civil Status</div>
                        <div class="info-value">{{ $user->civil_status ? ucfirst($user->civil_status) : 'Not provided' }}</div>
                    </div>
                </div>
                
                <!-- Birthdate -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-calendar-date"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Birthdate</div>
                        <div class="info-value">{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') : 'Not provided' }}</div>
                    </div>
                </div>
                
                <!-- Birthplace -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-pin-map"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Birthplace</div>
                        <div class="info-value">{{ $user->birthplace ?? 'Not provided' }}</div>
                    </div>
                </div>
                
                <!-- Religion -->
                <div class="info-row">
                    <div class="info-icon-container">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Religion</div>
                        <div class="info-value">{{ $user->religion ?? 'Not provided' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to toggle name -->
<script>
    const actualName = @json($user->username);
    const hiddenName = '*'.repeat(actualName.length);

    function toggleName() {
        const nameEl = document.getElementById("userName");
        const icon = document.getElementById("eyeIcon");

        if (nameEl.textContent === hiddenName) {
            nameEl.textContent = actualName;
            icon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            nameEl.textContent = hiddenName;
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
    
    // Initialize Bootstrap components
    document.addEventListener('DOMContentLoaded', function() {
        // Enable all tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Enable all popovers
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    });
</script>












