<form action="{{ route('schedule.store') }}" method="POST">
    @csrf
    <input type="hidden" name="psychometrician_id" value="1"> <!-- Replace with actual psychometrician ID -->
    <label>Date:</label><input type="date" name="date" required>
    <label>Start Time:</label><input type="time" name="start_time" required>
    <button type="submit">Add Schedule</button>
</form>