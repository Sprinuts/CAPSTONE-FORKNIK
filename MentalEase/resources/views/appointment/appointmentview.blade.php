    <div class="main-content">
<div class="container mt-4">
    <h2>My Appointments</h2>
    @if($appointments->isEmpty())
        <p>No appointments found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->client->name ?? 'N/A' }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->start_time }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm">Reschedule</a>
                            <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Complete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</div>