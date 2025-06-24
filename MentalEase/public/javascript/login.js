document.addEventListener('DOMContentLoaded', function () {
    // Password visibility toggle
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }

    // Attach togglePassword to window so it can be called from inline onclick
    window.togglePassword = togglePassword;

    // Reset login button state (in case of browser back button)
    const loginBtn = document.querySelector('.login-btn');
    if (loginBtn) {
        loginBtn.disabled = false;
        loginBtn.textContent = 'Login';
    }

    // Handle login form submission
    const form = document.querySelector('.login-form');
    if (form) {
        form.addEventListener('submit', function (e) {
            const btn = form.querySelector('.login-btn');
            btn.disabled = true;
            btn.textContent = 'Logging in...';
        });
    }
    
    // Handle page show event (triggered when navigating back)
    window.addEventListener('pageshow', function(event) {
        // If the page is loaded from the browser cache
        if (event.persisted) {
            const loginBtn = document.querySelector('.login-btn');
            if (loginBtn) {
                loginBtn.disabled = false;
                loginBtn.textContent = 'Login';
            }
        }
    });
});



