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
                    
                    <div class="mb-4">
                        <label for="start_time" class="form-label">Select Time</label>
                        <select name="start_time" id="start_time" class="form-select" required>
                            @for($hour = 8; $hour <= 17; $hour++)
                                @if($hour != 12 && $hour != 13) {{-- Skip lunch hours --}}
                                    @php
                                        $timeStr = sprintf('%02d:00:00', $hour);
                                        $displayTime = date('g:i A', strtotime($timeStr));
                                    @endphp
                                    <option value="{{ $timeStr }}" {{ $schedule->start_time == $timeStr ? 'selected' : '' }}>
                                        {{ $displayTime }}
                                    </option>
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
    flatpickr("#date", {
        minDate: "{{ $tomorrow }}",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                return (date.getDay() === 0 || date.getDay() === 6); // Disable Sat/Sun
            }
        ]
    });
</script>