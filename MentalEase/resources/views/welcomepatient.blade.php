<link rel="stylesheet" href="{{ asset('style/welcomepatient.css') }}">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="main-content">
    <div class="top-bar">
        <h1>Dashboard</h1>
        <div class="date-time">
            <span id="current-date"></span>
        </div>
    </div>

    <div class="dashboard-header">
        <div class="dashboard-title-button">
            <h2>My Wellness Dashboard</h2>
            <button class="new-appointment" onclick="window.location.href='{{ route('appointment.selectPsychometrician') }}'">
                + New Appointment
            </button>
        </div>
    </div>

    <!-- Quote of the Day Section -->
    <div class="quote-section">
        <div class="quote-card">
            <div class="quote-icon">
                <i class="fas fa-quote-left"></i>
            </div>
            <div class="quote-content">
                <p id="quote-text">Loading your daily inspiration...</p>
                <p id="quote-author" class="quote-author">- Author</p>
            </div>
        </div>
    </div>

    <!-- Dashboard Overview -->
    <div class="dashboard-overview">
        <div class="row">
            <!-- Upcoming Appointments -->
            <div class="col-md-6">
                <div class="overview-card">
                    <div class="card-header">
                        <h3><i class="fas fa-calendar-check"></i> Upcoming Appointment</h3>
                    </div>
                    <div class="card-content">
                        @php
                            $today = \Carbon\Carbon::now()->startOfDay();
                            $upcomingAppointments = $appointments->filter(function($appointment) use ($today) {
                                return \Carbon\Carbon::parse($appointment->date)->startOfDay()->greaterThanOrEqualTo($today);
                            })->sortBy(function($appointment) {
                                return $appointment->date . ' ' . $appointment->start_time;
                            })->take(3);
                        @endphp
                        
                        @if(count($upcomingAppointments) > 0)
                            @foreach($upcomingAppointments as $appointment)
                                <div class="appointment-item">
                                    <div class="appointment-date">
                                        <span class="day">{{ \Carbon\Carbon::parse($appointment->date)->format('d') }}</span>
                                        <span class="month">{{ \Carbon\Carbon::parse($appointment->date)->format('M') }}</span>
                                    </div>
                                    <div class="appointment-details">
                                        <p>
                                            <i class="fas fa-user-md"></i>
                                            {{ $appointment->psychometrician->name ?? 'Psychometrician' }}
                                        </p>
                                        <p>
                                            <i class="fas fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}
                                            -
                                            {{ \Carbon\Carbon::parse($appointment->end_time)->format('g:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No upcoming appointments.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Reminders -->
            <div class="col-md-6">
                <div class="overview-card">
                    <div class="card-header">
                        <h3><i class="fas fa-bell"></i> Reminders</h3>
                        <button class="add-reminder" id="add-reminder-btn"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-content" id="reminders-container">
                        <!-- Reminders will be loaded here dynamically -->
                        <p id="no-reminders-message">No reminders yet. Click the + button to add one.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wellness Services -->
    <div class="wellness-services">
        <h3>Wellness Services</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h4>Counseling</h4>
                    <p>Talk to a professional about your concerns</p>
                    <a href="{{ route('appointment.selectPsychometrician') }}" class="service-link">Book Session</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h4>Assessments</h4>
                    <p>Evaluate your mental wellbeing</p>
                    <a href="{{ route('assessment.pss') }}" class="service-link">Take Assessment</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h4>Journal</h4>
                    <p>Track your thoughts and feelings</p>
                    <a href="{{ route('journal') }}" class="service-link">Write Entry</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h4>AI Support</h4>
                    <p>Get 24/7 emotional support</p>
                    <a href="{{ route('chatbot') }}" class="service-link">Chat Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Wellness Tips -->
    <div class="wellness-tips">
        <h3>Wellness Tips</h3>
        <div class="tip-card">
            <div class="tip-icon">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="tip-content">
                <h4>Practice Mindfulness</h4>
                <p>• Taking just 5 minutes each day for mindful breathing can significantly reduce stress and improve focus.</p>
                <p>• Just 10 minutes of mindful movement can alleviate symptoms of depression and boost cognitive function.</p>
                <p>• Even a brief mindful pause can help you manage overwhelming emotions and prevent burnout.</p>
    
            </div>
        </div>
    </div>

    <!-- Add Reminder Modal -->
    <div class="modal" id="reminder-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Reminder</h3>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="reminder-form">
                    <div class="form-group">
                        <label for="reminder-title">Title</label>
                        <input type="text" id="reminder-title" placeholder="Enter reminder title" required>
                    </div>
                    <div class="form-group">
                        <label for="reminder-date">Due Date</label>
                        <input type="date" id="reminder-date" required>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-cancel">Cancel</button>
                        <button type="submit" class="btn-save">Save Reminder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- JavaScript for functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date for reminder date input to today
        const reminderDateInput = document.getElementById('reminder-date');
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format: YYYY-MM-DD
        reminderDateInput.setAttribute('min', formattedDate);
        
        // Display current date
        const currentDate = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = currentDate.toLocaleDateString('en-US', options);
        
        // Quote of the Day API
        fetchQuote();
        
        // Load saved reminders
        loadReminders();
        
        // Reminder Modal
        const modal = document.getElementById('reminder-modal');
        const addReminderBtn = document.getElementById('add-reminder-btn');
        const closeModal = document.querySelector('.close-modal');
        const cancelBtn = document.querySelector('.btn-cancel');
        
        addReminderBtn.addEventListener('click', function() {
            modal.style.display = 'block';
        });
        
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        cancelBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        
        // Add new reminder
        const reminderForm = document.getElementById('reminder-form');
        reminderForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = document.getElementById('reminder-title').value;
            const date = document.getElementById('reminder-date').value;
            
            saveReminder(title, date);
            
            // Reset form and close modal
            reminderForm.reset();
            modal.style.display = 'none';
        });
        
        // Handle reminder actions (delete, check)
        const remindersContainer = document.getElementById('reminders-container');
        remindersContainer.addEventListener('click', function(e) {
            // Handle delete button click
            if (e.target.classList.contains('fa-trash') || e.target.classList.contains('delete-reminder')) {
                const reminderItem = e.target.closest('.reminder-item');
                const reminderId = reminderItem.getAttribute('data-id');
                deleteReminder(reminderId);
            }
            
            // Handle checkbox click
            if (e.target.type === 'checkbox') {
                const reminderItem = e.target.closest('.reminder-item');
                const reminderId = reminderItem.getAttribute('data-id');
                toggleReminderComplete(reminderId, e.target.checked);
            }
        });
    });
    
    // Fetch quote from API
    function fetchQuote() {
        fetch('https://api.quotable.io/random?tags=inspirational,wisdom')
            .then(response => response.json())
            .then(data => {
                document.getElementById('quote-text').textContent = data.content;
                document.getElementById('quote-author').textContent = `- ${data.author}`;
            })
            .catch(error => {
                console.error('Error fetching quote:', error);
                document.getElementById('quote-text').textContent = "The greatest glory in living lies not in never falling, but in rising every time we fall.";
                document.getElementById('quote-author').textContent = "- Nelson Mandela";
            });
    }
    
    // Load reminders from localStorage
    function loadReminders() {
        const remindersContainer = document.getElementById('reminders-container');
        const noRemindersMessage = document.getElementById('no-reminders-message');
        
        // Get reminders from localStorage
        let reminders = JSON.parse(localStorage.getItem('reminders') || '[]');
        
        // Sort reminders by date
        reminders.sort((a, b) => new Date(a.date) - new Date(b.date));
        
        // Clear container
        remindersContainer.innerHTML = '';
        
        if (reminders.length === 0) {
            remindersContainer.appendChild(noRemindersMessage);
            return;
        }
        
        // Add reminders to container
        reminders.forEach(reminder => {
            const reminderHTML = createReminderElement(reminder);
            remindersContainer.insertAdjacentHTML('beforeend', reminderHTML);
            
            // Set checkbox state
            if (reminder.completed) {
                const checkbox = document.getElementById(`reminder-${reminder.id}`);
                if (checkbox) checkbox.checked = true;
            }
        });
    }

    // Save a new reminder
    function saveReminder(title, date) {
        // Get existing reminders
        let reminders = JSON.parse(localStorage.getItem('reminders') || '[]');
        
        // Create new reminder
        const newReminder = {
            id: Date.now().toString(), // Use timestamp as ID
            title: title,
            date: date,
            completed: false
        };
        
        // Add to array
        reminders.push(newReminder);
        
        // Save to localStorage
        localStorage.setItem('reminders', JSON.stringify(reminders));
        
        // Reload reminders
        loadReminders();
    }

    // Delete a reminder
    function deleteReminder(id) {
        // Get existing reminders
        let reminders = JSON.parse(localStorage.getItem('reminders') || '[]');
        
        // Filter out the reminder to delete
        reminders = reminders.filter(reminder => reminder.id !== id);
        
        // Save to localStorage
        localStorage.setItem('reminders', JSON.stringify(reminders));
        
        // Reload reminders
        loadReminders();
    }

    // Toggle reminder complete status
    function toggleReminderComplete(id, completed) {
        // Get existing reminders
        let reminders = JSON.parse(localStorage.getItem('reminders') || '[]');
        
        // Find and update the reminder
        reminders = reminders.map(reminder => {
            if (reminder.id === id) {
                reminder.completed = completed;
            }
            return reminder;
        });
        
        // Save to localStorage
        localStorage.setItem('reminders', JSON.stringify(reminders));
    }

    // Create HTML for a reminder
    function createReminderElement(reminder) {
        return `
            <div class="reminder-item" data-id="${reminder.id}">
                <div class="reminder-checkbox">
                    <input type="checkbox" id="reminder-${reminder.id}" ${reminder.completed ? 'checked' : ''}>
                    <label for="reminder-${reminder.id}"></label>
                </div>
                <div class="reminder-details">
                    <h4>${reminder.title}</h4>
                    <p><i class="fas fa-clock"></i> Due by ${formatDate(reminder.date)}</p>
                </div>
                <div class="reminder-actions">
                    <button class="delete-reminder"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
    }

    // Format date for display
    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { month: 'short', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }
</script>

<!-- Auto-hide success alerts after 3 seconds -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000); // 3 seconds
        }
    });
</script>




