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
                {{ str_repeat('*', strlen($user->name)) }}
            </h2>
            <button onclick="toggleName()" class="visibility-toggle" title="Toggle name visibility">
                <i id="eyeIcon" class="bi bi-eye"></i>
            </button>
        </div>
        
        <p class="user-email">{{ $user->email }}</p>
        
        <div class="profile-actions">
            <button class="btn btn-primary action-btn" type="button" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-pencil-square"></i> Edit Profile
            </button>
            <button class="btn btn-outline-secondary action-btn" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                <i class="bi bi-key"></i> Change Password
            </button>
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
                    <div class="accordion-body">
                        <div class="info-grid">
                            <!-- Contact Number -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Contact</span>
                                    <span class="info-value">{{ $user->contactnumber ?? 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Address</span>
                                    <span class="info-value">{{ $user->address ?? 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Age -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Age</span>
                                    <span class="info-value">{{ $user->age ? $user->age . ' years old' : 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Gender -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-gender-ambiguous"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Gender</span>
                                    <span class="info-value">{{ $user->gender ? ucfirst($user->gender) : 'Not provided' }}</span>
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
                    <div class="accordion-body">
                        <div class="info-grid">
                            <!-- Civil Status -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-heart"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Civil Status</span>
                                    <span class="info-value">{{ $user->civil_status ? ucfirst($user->civil_status) : 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Birthdate -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-calendar-date"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Birthdate</span>
                                    <span class="info-value">{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') : 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Birthplace -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-pin-map"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Birthplace</span>
                                    <span class="info-value">{{ $user->birthplace ?? 'Not provided' }}</span>
                                </div>
                            </div>
                            
                            <!-- Religion -->
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="bi bi-book"></i>
                                </div>
                                <div class="info-content">
                                    <span class="info-label">Religion</span>
                                    <span class="info-value">{{ $user->religion ?? 'Not provided' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to toggle name -->
<script>
    const actualName = @json($user->name);
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




