<!-- Add in your <head> or before your script -->
<link rel="stylesheet" href="{{ asset('style/createandnviewsched.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@php
    $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="schedule-container">
                <div class="schedule-header">
                    <h2><i class="fas fa-calendar-alt me-2"></i>Schedule Your Appointment</h2>
                    <p>Select your preferred date and time for the consultation</p>
                </div>
                
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="psychometrician_id" value="{{ $psychometrician->id }}">
                    
                    <div class="mb-4">
                        <label for="date" class="form-label">Select Date</label>
                        <input type="text" name="date" id="date" class="form-control" required>
                        <div class="form-text">Please select a weekday for your appointment</div>
                    </div>
                    
                    <div class="mb-4" id="time-slot-container">
                        <label class="form-label">Select a time after picking a date</label>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-5">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check-circle me-2"></i>Confirm Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    flatpickr("#date", {
        minDate: "{{ $tomorrow }}",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6); // Disable Sat/Sun
            }
        ],
        onChange: function(selectedDates, dateStr) {
            if (!dateStr) return;

            const psychometricianId = "{{ $psychometrician->id }}";
            const container = document.getElementById('time-slot-container');
            
            // Show loading indicator
            container.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

            fetch(`/available-times?date=${dateStr}&psychometrician_id=${psychometricianId}`)
                .then(response => response.json())
                .then(data => {
                    container.innerHTML = ""; // clear previous
                    
                    if (!data.available_times || data.available_times.length === 0) {
                        container.innerHTML = '<div class="alert alert-info">No available times for this date. Please select another date.</div>';
                        return;
                    }

                    container.innerHTML = '<label class="form-label fw-bold">Available Time Slots:</label><div class="time-slots-grid">';
                    
                    // Get available and booked times
                    const availableTimes = data.available_times || [];
                    const bookedTimes = data.booked_times || [];
                    
                    // Create all time slots from 8am to 5pm (excluding lunch)
                    const allTimeSlots = [];
                    for (let hour = 8; hour <= 17; hour++) {
                        if (hour !== 12 && hour !== 13) { // Skip lunch hours
                            const timeStr = `${hour.toString().padStart(2, '0')}:00`;
                            allTimeSlots.push(timeStr);
                        }
                    }
                    
                    allTimeSlots.forEach(time => {
                        const [hour, minute] = time.split(":");
                        let hour12 = hour % 12 || 12;
                        const ampm = hour < 12 || hour === 24 ? 'AM' : 'PM';
                        const isAvailable = availableTimes.includes(time);
                        const isBooked = bookedTimes.includes(time);
                        
                        if (isAvailable) {
                            // Available time slot
                            container.innerHTML += `
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="start_time" id="time_${time}" value="${time}" required>
                                    <label class="form-check-label" for="time_${time}">
                                        ${hour12}:00 ${ampm}
                                    </label>
                                </div>
                            `;
                        } else if (isBooked) {
                            // Booked time slot (disabled)
                            container.innerHTML += `
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="start_time" id="time_${time}" value="${time}" disabled>
                                    <label class="form-check-label text-muted" for="time_${time}">
                                        ${hour12}:00 ${ampm} <small>(Booked)</small>
                                    </label>
                                </div>
                            `;
                        }
                    });
                    
                    container.innerHTML += '</div>';
                })
                .catch(error => {
                    container.innerHTML = '<div class="alert alert-danger">Error loading available times. Please try again.</div>';
                    console.error('Error:', error);
                });
        }
    });
</script>






