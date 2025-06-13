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
                    <h2><i class="fas fa-edit me-2"></i>Edit Appointment Schedule</h2>
                    <p>Update the date and time for this appointment slot</p>
                </div>
                
                <form action="{{ route('schedule.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="date" class="form-label">Select Date</label>
                        <input type="text" name="date" id="date" class="form-control" value="{{ $schedule->date }}" required>
                        <div class="form-text">Please select a weekday for your appointment</div>
                    </div>
                    
                    <div class="mb-4" id="time-slot-container">
                        <label for="start_time" class="form-label">Select Time</label>
                        <select name="start_time" id="start_time" class="form-select" required>
                            @php
                                // Get all schedules for this date and psychometrician (excluding current one)
                                $otherSchedules = \App\Models\Schedule::where('psychometrician_id', $schedule->psychometrician_id)
                                    ->where('date', $schedule->date)
                                    ->where('id', '!=', $schedule->id)
                                    ->pluck('start_time')
                                    ->toArray();
                            @endphp
                            
                            @for($hour = 8; $hour <= 17; $hour++)
                                @if($hour != 12 && $hour != 13) {{-- Skip lunch hours --}}
                                    @php
                                        $timeStr = sprintf('%02d:00:00', $hour);
                                        $displayTime = date('g:i A', strtotime($timeStr));
                                        
                                        // Check if this time is already taken by another schedule
                                        $isBooked = in_array($timeStr, $otherSchedules);
                                    @endphp
                                    
                                    @if(!$isBooked || $schedule->start_time == $timeStr)
                                        <option value="{{ $timeStr }}" {{ $schedule->start_time == $timeStr ? 'selected' : '' }}>
                                            {{ $displayTime }}
                                        </option>
                                    @else
                                        <option value="{{ $timeStr }}" disabled>
                                            {{ $displayTime }} (Booked)
                                        </option>
                                    @endif
                                @endif
                            @endfor
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-5">
                        <a href="{{ route('schedule.view') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Store the current schedule's time to keep it selectable
    const currentScheduleTime = "{{ $schedule->start_time }}";
    
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
            
            const psychometricianId = "{{ $schedule->psychometrician_id }}";
            const container = document.getElementById('time-slot-container');
            const currentScheduleId = "{{ $schedule->id }}";
            
            // Show loading indicator
            container.innerHTML = '<label for="start_time" class="form-label">Select Time</label><div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            
            fetch(`/available-times?date=${dateStr}&psychometrician_id=${psychometricianId}&schedule_id=${currentScheduleId}`)
                .then(response => response.json())
                .then(data => {
                    // Create select element
                    container.innerHTML = '<label for="start_time" class="form-label">Select Time</label><select name="start_time" id="start_time" class="form-select" required></select>';
                    const selectElement = document.getElementById('start_time');
                    
                    // Get available and booked times
                    const availableTimes = data.available_times || [];
                    const bookedTimes = data.booked_times || [];
                    
                    // Create all time slots from 8am to 5pm (excluding lunch)
                    for (let hour = 8; hour <= 17; hour++) {
                        if (hour !== 12 && hour !== 13) { // Skip lunch hours
                            const timeStr = `${hour.toString().padStart(2, '0')}:00:00`;
                            const displayTime = new Date(`2000-01-01T${timeStr}`).toLocaleTimeString('en-US', {
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                            });
                            
                            // Check if this time is the current schedule's time
                            const isCurrentTime = timeStr === currentScheduleTime;
                            
                            // Check if this time is booked by another schedule
                            const shortTimeStr = `${hour.toString().padStart(2, '0')}:00`;
                            const isBooked = bookedTimes.includes(shortTimeStr);
                            
                            // Only add this time if it's available or it's the current time
                            // and we're still on the same date
                            const isSameDate = dateStr === "{{ $schedule->date }}";
                            const shouldShow = !isBooked || (isCurrentTime && isSameDate);
                            
                            const option = document.createElement('option');
                            option.value = timeStr;
                            option.text = displayTime;
                            
                            if (isBooked) {
                                option.disabled = true;
                                option.text += ' (Booked)';
                            }
                            
                            if (isCurrentTime && isSameDate) {
                                option.selected = true;
                            }
                            
                            selectElement.appendChild(option);
                        }
                    }
                })
                .catch(error => {
                    container.innerHTML = '<div class="alert alert-danger">Error loading available times. Please try again.</div>';
                    console.error('Error:', error);
                });
        }
    });
</script>



