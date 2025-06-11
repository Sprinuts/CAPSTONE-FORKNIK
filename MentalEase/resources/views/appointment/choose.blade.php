<link rel="stylesheet" href="{{ asset('style/choose.css') }}">

<div class="schedule-selection-container">
    <div class="selection-header">
        <h1>Select Available Schedule</h1>
        <p class="selection-subtitle">Choose a date and time for your consultation</p>
    </div>

    <form method="POST" action="{{ route('appointment.payment') }}" id="scheduleForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ session('user')->id }}">
        <input type="hidden" name="psychometrician_id" value="{{ $psychometrician_id }}">
        <input type="hidden" name="date" id="selected_date" value="">
        <input type="hidden" name="start_time" id="selected_time" value="">

        <div class="schedule-options">
            @php
                $groupedSchedules = $schedules->groupBy('date');
            @endphp

            @foreach($groupedSchedules as $date => $dateSchedules)
                <div class="date-group">
                    <h3 class="date-header">
                        <i class="fa-solid fa-calendar-day"></i>
                        {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}
                    </h3>
                    
                    <div class="time-slots">
                        @foreach($dateSchedules as $schedule)
                            <div class="time-slot-option" 
                                 data-date="{{ $schedule->date }}" 
                                 data-time="{{ $schedule->start_time }}">
                                <i class="fa-solid fa-clock"></i>
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div class="selection-summary">
            <div class="summary-header">
                <i class="fa-solid fa-calendar-check"></i>
                <h3>Your Selection</h3>
            </div>
            <div class="summary-details">
                <p id="selected_date_display">No date selected</p>
                <p id="selected_time_display">No time selected</p>
            </div>
            <button type="submit" id="proceed_button" disabled>
                <i class="fa-solid fa-credit-card"></i>
                Proceed to Payment
            </button>
        </div>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const timeSlots = document.querySelectorAll('.time-slot-option');
        const selectedDateInput = document.getElementById('selected_date');
        const selectedTimeInput = document.getElementById('selected_time');
        const selectedDateDisplay = document.getElementById('selected_date_display');
        const selectedTimeDisplay = document.getElementById('selected_time_display');
        const proceedButton = document.getElementById('proceed_button');
        
        // Get current date and time
        const now = new Date();
        
        timeSlots.forEach(slot => {
            // Check if the date is in the past
            const slotDate = new Date(slot.getAttribute('data-date'));
            const slotTime = slot.getAttribute('data-time');
            
            // Create a datetime by combining date and time
            const [hours, minutes] = slotTime.split(':');
            slotDate.setHours(parseInt(hours), parseInt(minutes), 0);
            
            // If the slot datetime is in the past, disable it
            if (slotDate < now) {
                slot.classList.add('disabled');
                slot.setAttribute('title', 'This time slot is no longer available');
            } else {
                slot.addEventListener('click', function() {
                    // Only proceed if the slot is not disabled
                    if (!this.classList.contains('disabled')) {
                        // Remove active class from all slots
                        timeSlots.forEach(s => s.classList.remove('active'));
                        
                        // Add active class to selected slot
                        this.classList.add('active');
                        
                        // Update hidden inputs
                        const date = this.getAttribute('data-date');
                        const time = this.getAttribute('data-time');
                        selectedDateInput.value = date;
                        selectedTimeInput.value = time;
                        
                        // Update display
                        const formattedDate = new Date(date).toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        
                        const formattedTime = new Date(`2000-01-01T${time}`).toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });
                        
                        selectedDateDisplay.innerHTML = `<strong>Date:</strong> ${formattedDate}`;
                        selectedTimeDisplay.innerHTML = `<strong>Time:</strong> ${formattedTime}`;
                        
                        // Enable proceed button
                        proceedButton.disabled = false;
                    }
                });
            }
        });
    });
</script>

