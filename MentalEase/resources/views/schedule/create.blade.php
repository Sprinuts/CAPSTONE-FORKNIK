<!-- Add in your <head> or before your script -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@php
    $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
@endphp

<form action="{{ route('schedule.store') }}" method="POST">
    @csrf
    <input type="hidden" name="psychometrician_id" value="{{ $psychometrician->id }}">
    <label>Date:</label>
    <input type="text" name="date" id="date" required>
    <div id="time-slot-container">
        <label>Select a time after picking a date:</label><br>
    </div>
    <button type="submit">Submit</button>
</form>


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

            fetch(`/available-times?date=${dateStr}&psychometrician_id=${psychometricianId}`)
                .then(response => response.json())
                .then(times => {
                    const container = document.getElementById('time-slot-container');
                    container.innerHTML = ""; // clear previous

                    if (times.length === 0) {
                        container.innerHTML = "<p>No available times for this date.</p>";
                        return;
                    }

                    container.innerHTML = "<label>Start Time:</label><br>";

                    times.forEach(time => {
                        const [hour, minute] = time.split(":");
                        let hour12 = hour % 12 || 12;
                        const ampm = hour < 12 || hour == 24 ? 'AM' : 'PM';

                        container.innerHTML += `
                            <label>
                                <input type="radio" name="start_time" value="${time}" required>
                                ${hour12}:00 ${ampm}
                            </label><br>
                        `;
                    });
                });
        }
    });
</script>