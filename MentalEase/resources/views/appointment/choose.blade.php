<h2>Select Available Schedule</h2>
<form method="POST" action="{{ route('appointment.payment') }}">
    @csrf
    <input type="hidden" name="user_id" value="1"> <!-- Replace with actual user ID -->
    <input type="hidden" name="psychometrician_id" value="{{ $psychometrician_id }}">

    <select name="date">
        @foreach($schedules as $schedule)
            <option value="{{ $schedule->date }}">{{ $schedule->date }} - {{ $schedule->start_time }}</option>
        @endforeach
    </select>
    <input type="hidden" name="start_time" value="{{ $schedule->start_time }}">
    <button type="submit">Proceed to Payment</button>
</form>