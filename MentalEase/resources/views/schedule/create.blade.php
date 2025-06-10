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
    <div>
        <label>Start Time:</label>
        <br>
        @for ($hour = 8; $hour <= 17; $hour++)
            @if ($hour != 12 && $hour != 13)
                @php
                    $displayHour = $hour > 12 ? $hour - 12 : $hour;
                    $ampm = $hour < 12 ? 'AM' : 'PM';
                    $timeValue = sprintf('%02d:00', $hour);
                    $display = $displayHour . ':00 ' . $ampm;
                @endphp
                <label>
                    <input type="radio" name="start_time" value="{{ $timeValue }}" required>
                    {{ $display }}
                </label><br>
            @endif
        @endfor
    </div>
    <button type="submit">Submit</button>
</form>


<script>
    flatpickr("#date", {
        minDate: "{{ $tomorrow }}",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 6);
            }
        ]
    });
</script>