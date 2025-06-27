// Global profile completion check
(function() {
    function checkProfileCompletion() {
        // Get user data from a data attribute
        const userDataElement = document.getElementById('userData');
        if (userDataElement) {
            try {
                const userData = JSON.parse(userDataElement.dataset.user || '{}');
                if (userData.id && userData.has_completed_profile === false) {
                    // Check if we're already on the profile completion page
                    if (!window.location.pathname.includes('/profile/complete') && 
                        !window.location.pathname.includes('/logout')) {
                        // Redirect to profile completion page
                        window.location.replace('/profile/complete');
                        return true;
                    }
                }
            } catch (e) {
                console.error('Error parsing user data:', e);
            }
        }
        return false;
    }

    // Run check when page loads
    document.addEventListener('DOMContentLoaded', checkProfileCompletion);
    
    // Run check when navigating with browser history
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            checkProfileCompletion();
        }
    });
    
    // Run check periodically
    setInterval(checkProfileCompletion, 2000);
    
    // Handle tab/window close for users with incomplete profiles
    window.addEventListener('beforeunload', function(event) {
        const userDataElement = document.getElementById('userData');
        if (userDataElement) {
            try {
                const userData = JSON.parse(userDataElement.dataset.user || '{}');
                if (userData.id && userData.has_completed_profile === false) {
                    // Send a beacon to logout the user
                    navigator.sendBeacon('/logout/auto');
                }
            } catch (e) {
                console.error('Error parsing user data:', e);
            }
        }
    });
})();


