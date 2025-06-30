<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Complete Your Profile | MentalEase</title>
    <link rel="stylesheet" href="{{ asset('style/completeprofile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="login-container">
    <a href="{{ route('logout') }}" class="back-icon">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('profile.complete') }}" method="POST" class="login-form">
        @csrf
        <div class="form-header">
            <h2>Complete Your Profile</h2>
            <p class="form-subtitle">Please provide your personal information to continue</p>
            <div class="alert alert-warning">
                <i class="fa-solid fa-exclamation-triangle"></i> 
                Note: If you close this page without completing your profile, you will be automatically logged out.
            </div>
        </div>
        
        <div class="form-columns">
            <!-- First Column -->
            <div>
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your first name" required value="{{ old('firstname') }}">
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name" value="{{ old('middle_name') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required value="{{ old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="contactnumber">Contact Number</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" id="contactnumber" name="contactnumber" placeholder="Enter your contact number" required value="{{ old('contactnumber') }}">
                    </div>
                </div>
            </div>
            
            <!-- Second Column -->
            <div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-location-dot input-icon"></i>
                        <input type="text" id="address" name="address" placeholder="Enter your address" required value="{{ old('address') }}">
                    </div>
                </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <div class="select-wrapper">
                    <select id="gender" name="gender" class="form-control" required aria-required="true">
                        <option value="" disabled @selected(!old('gender'))>Select gender</option>
                        <option value="Male" @selected(old('gender') == 'Male')>Male</option>
                        <option value="Female" @selected(old('gender') == 'Female')>Female</option>
                        <option value="Other" @selected(old('gender') == 'Other')>Other</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="civil_status">Civil Status</label>
                <div class="select-wrapper">
                    <select id="civil_status" name="civil_status" class="form-control" required aria-required="true">
                        <option value="" disabled @selected(!old('civil_status'))>Select status</option>
                        <option value="Single" @selected(old('civil_status') == 'Single')>Single</option>
                        <option value="Married" @selected(old('civil_status') == 'Married')>Married</option>
                        <option value="Widowed" @selected(old('civil_status') == 'Widowed')>Widowed</option>
                        <option value="Divorced" @selected(old('civil_status') == 'Divorced')>Divorced</option>
                    </select>
                </div>
            </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-calendar input-icon"></i>
                        <input type="date" id="birthdate" name="birthdate" required value="{{ old('birthdate') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthplace">Birthplace</label>
                    <input type="text" id="birthplace" name="birthplace" placeholder="Enter your birthplace" required value="{{ old('birthplace') }}">
                </div>
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <input type="text" id="religion" name="religion" placeholder="Enter your religion" value="{{ old('religion') }}">
                </div>
            </div>
        </div>

        <!-- Terms and Conditions Section -->
        <div class="terms-section">
            <div class="form-group terms-checkbox">
                <input type="checkbox" id="terms_agree" name="terms_agree" required @checked(old('terms_agree'))>
                <label for="terms_agree">I agree to the <a href="#" id="termsLink">Terms and Conditions</a> and <a href="#" id="privacyLink">Privacy Policy</a></label>
            </div>
        </div>

        <!-- Terms and Conditions Modal -->
        <div id="termsModal" class="terms-modal">
            <div class="terms-modal-content">
                <span class="close-modal">&times;</span>
                <h3>Terms and Conditions</h3>
                <div class="terms-content">
                    <p><b>Welcome to Mentalease.</b></p>
                    <p>By accessing or using our mobile application and services, you agree to be bound by the following Terms and Conditions. Please read them carefully.</p>
                    
                    <h4>1. Acceptance of Terms</h4>
                    <p>By creating an account, accessing, or using Mentalease, you confirm that you are at least 18 years old and agree to comply with these Terms and all applicable rules and policies. If you are under 18, do not use the app.</p>
                    
                    <h4>2. Services Provided</h4>
                    <p>Mentalease offers tools and support for mental wellness through:</p>
                    <ul>
                        <li>AI-powered chatbots</li>
                        <li>Appointment booking with licensed psychometricians</li>
                        <li>Mood tracking features</li>
                        <li>Journaling tools</li>
                    </ul>
                    <p>These services assist users in managing emotional wellness but do not replace professional medical treatment.</p>
                    
                    <h4>3. Professional Disclaimer</h4>
                    <p>All clinical cases requiring intervention are managed by licensed psychometricians registered in the Philippines.</p>
                    <p>AI-generated responses are for general guidance only and do not substitute psychological diagnosis or treatment.</p>
                    <p>Users are encouraged to seek help from hospitals or medical professionals for serious conditions.</p>
                    
                    <h4>4. User Accounts</h4>
                    <p>Registration is required.</p>
                    <p>Users are responsible for safeguarding their login credentials.</p>
                    <p>Accounts are for individual use only and managed securely by Mentalease.</p>
                    <p>Account data is not shared outside the platform.</p>
                    
                    <h4>5. Appointments and Cancellations</h4>
                    <p>Appointments must be booked via the app.</p>
                    <p>Cancellations within the appointment window are non-refundable.</p>
                    <p>Missed appointments are not eligible for refund or reschedule.</p>
                    <p>Refunds or reschedules require valid reasons and are subject to approval by the psychometrician.</p>
                    
                    <h4>6. Payment and Refund Policy</h4>
                    <p>Payments are processed securely through trusted third-party services.</p>
                    <p>All payments are final.</p>
                    <p>Refunds/reschedules will not be granted if policies are violated.</p>
                    
                    <h4>7. User Conduct</h4>
                    <p>By using Mentalease, users agree to:</p>
                    <ul>
                        <li>Use the app only for its intended purpose.</li>
                        <li>Behave respectfully toward professionals and other users.</li>
                        <li>Avoid impersonation or false information.</li>
                        <li>Not abuse, disrupt, or misuse services.</li>
                    </ul>
                    <p>Violations may result in suspension or permanent termination.</p>
                    
                    <h4>8. Ethical Standards and Staff Responsibility</h4>
                    <p>As per Sanda Diagnostic Center's integrated policies:</p>
                    <ul>
                        <li>All staff and partners are expected to uphold high ethical and professional standards.</li>
                        <li>Department heads are responsible for accuracy and service delivery.</li>
                        <li>Users can report concerns via the support email.</li>
                    </ul>
                    
                    <h4>9. Modifications to the Terms</h4>
                    <p>We may update these Terms from time to time. Continued use of the app indicates your acceptance of the latest version.</p>
                    
                    <h4>10. Termination</h4>
                    <p>We reserve the right to suspend or terminate accounts that violate our Terms or threaten the integrity and safety of the platform.</p>
                    
                    <h4>11. Contact Information</h4>
                    <p>For feedback or concerns about these Terms:</p>
                    <p>📧 theforknik@gmail.com</p>
                </div>
            </div>
        </div>

        <!-- Privacy Policy Modal -->
        <div id="privacyModal" class="terms-modal">
            <div class="terms-modal-content">
                <span class="close-modal">&times;</span>
                <h3>Privacy Policy</h3>
                <div class="terms-content">
                    <p><strong>Effective Date: June 2025</strong></p>
                    <p>At Mentalease, we respect and protect your privacy. This Privacy Policy explains how we collect, use, and safeguard your information.</p>
                    
                    <h4>1. Information We Collect</h4>
                    <p>When you use Mentalease, we may collect:</p>
                    <ul>
                        <li>Personal information (e.g., name, email, age)</li>
                        <li>Appointment and usage history</li>
                        <li>Mood tracking and journaling entries (optional and user-controlled)</li>
                        <li>AI chat interactions</li>
                    </ul>
                    
                    <h4>2. Use of Your Information</h4>
                    <p>Your information is used to:</p>
                    <ul>
                        <li>Provide and improve services</li>
                        <li>Enable appointment scheduling and mood tracking</li>
                        <li>Ensure secure access to your account</li>
                        <li>Personalize your experience</li>
                        <li>Maintain service quality standards with Sanda Diagnostic Center</li>
                    </ul>
                    
                    <h4>3. Data Storage and Security</h4>
                    <p>All data is securely stored in a centralized system managed by authorized Mentalease administrators.</p>
                    <p>We follow strict security protocols to prevent unauthorized access.</p>
                    <p>Only authorized personnel have access to user data.</p>
                    
                    <h4>4. Data Sharing</h4>
                    <p>We do not sell, share, or disclose your information to third parties.</p>
                    <p>Data may be accessed by professionals only for service delivery purposes.</p>
                    <p>External sharing only occurs if required by law or with your explicit consent.</p>
                    
                    <h4>5. AI Interaction Notice</h4>
                    <p>AI responses are not stored unless explicitly saved by the user (e.g., in journals).</p>
                    <p>Users are advised not to disclose sensitive personal or medical details during AI interactions.</p>
                    
                    <h4>6. Your Rights</h4>
                    <p>You have the right to:</p>
                    <ul>
                        <li>Access or update your data</li>
                        <li>Request deletion of your account</li>
                        <li>Withdraw consent to data processing (where applicable)</li>
                        <li>Report misuse or privacy concerns</li>
                    </ul>
                    
                    <h4>8. Updates to this Privacy Policy</h4>
                    <p>This Privacy Policy may be revised. Continued use of the app signifies agreement with the latest version.</p>
                    
                    <h4>9. Contact Us</h4>
                    <p>For privacy-related concerns or data requests, contact:</p>
                    <p>📧 theforknik@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="login-btn">
                <i class="fa-solid fa-check-circle"></i> Complete Profile
            </button>
            <p class="privacy-note">Your information is protected by our <a href="#" id="privacyFooterLink">Privacy Policy</a></p>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get modal elements
        const termsModal = document.getElementById('termsModal');
        const privacyModal = document.getElementById('privacyModal');
        const termsLink = document.getElementById('termsLink');
        const privacyLink = document.getElementById('privacyLink');
        const privacyFooterLink = document.getElementById('privacyFooterLink');
        const closeButtons = document.querySelectorAll('.close-modal');
        const acceptButtons = document.querySelectorAll('.accept-terms-btn');
        const termsCheckbox = document.getElementById('terms_agree');
        
        // Open terms modal
        termsLink.addEventListener('click', function(e) {
            e.preventDefault();
            termsModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
        
        // Open privacy modal
        privacyLink.addEventListener('click', function(e) {
            e.preventDefault();
            privacyModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
        
        // Open privacy modal from footer link
        privacyFooterLink.addEventListener('click', function(e) {
            e.preventDefault();
            privacyModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
        
        // Close modals when clicking close button
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                termsModal.style.display = 'none';
                privacyModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        });
        
        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == termsModal) {
                termsModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
            if (event.target == privacyModal) {
                privacyModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
        
        // Accept terms and close modal
        acceptButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                termsModal.style.display = 'none';
                privacyModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                termsCheckbox.checked = true;
            });
        });
        
        // Form validation
        const form = document.querySelector('.login-form');
        form.addEventListener('submit', function(e) {
            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert('You must agree to the Terms and Conditions to continue.');
                return false;
            }
        });
    });

    // Prevent going back to previous page if profile is not complete
    (function() {
        // Push a new state to replace the current one
        window.history.pushState(null, '', window.location.href);
        
        // When the user navigates back, push another state to prevent it
        window.addEventListener('popstate', function() {
            window.history.pushState(null, '', window.location.href);
            alert('Please complete your profile before navigating away from this page.');
        });
    })();

    // Auto-logout when closing the profile completion page
    window.addEventListener('beforeunload', function() {
        // Send a beacon to logout the user
        navigator.sendBeacon('/logout/auto');
    });
</script>

</body>
</html>








