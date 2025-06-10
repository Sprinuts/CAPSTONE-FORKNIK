// Add this to your existing JavaScript file to handle status messages

// Function to show status message with different states
function showStatus(message, type = 'default', autoHide = true, duration = 5000) {
    const statusDiv = document.getElementById('textDiv');
    const statusText = statusDiv.querySelector('.status-text');
    const statusSpinner = statusDiv.querySelector('.status-spinner');
    
    // Clear existing classes
    statusDiv.classList.remove('success', 'warning', 'error', 'info');
    
    // Add appropriate class based on type
    if (type !== 'default') {
        statusDiv.classList.add(type);
    }
    
    // Set message text
    statusText.textContent = message;
    
    // Show/hide spinner based on if we're in a loading state
    if (type === 'loading') {
        statusSpinner.style.display = 'inline-block';
    } else {
        statusSpinner.style.display = 'none';
    }
    
    // Show the status with animation
    statusDiv.style.display = 'flex';
    statusDiv.classList.remove('animate-out');
    statusDiv.classList.add('animate-in');
    
    // Auto-hide after duration if specified
    if (autoHide) {
        setTimeout(() => {
            hideStatus();
        }, duration);
    }
}

// Function to hide status message
function hideStatus() {
    const statusDiv = document.getElementById('textDiv');
    statusDiv.classList.remove('animate-in');
    statusDiv.classList.add('animate-out');
    
    // After animation completes, hide the element
    setTimeout(() => {
        statusDiv.style.display = 'none';
    }, 300);
}

// Example usage for different status types:
// showStatus('Creating your meeting...', 'loading', false);
// showStatus('Meeting created successfully!', 'success');
// showStatus('Please check your connection.', 'warning');
// showStatus('Failed to join the meeting.', 'error');
// showStatus('Your meeting ID has been copied.', 'info');

// Set up event listener for dismiss button
document.getElementById('dismissStatus').addEventListener('click', hideStatus);
