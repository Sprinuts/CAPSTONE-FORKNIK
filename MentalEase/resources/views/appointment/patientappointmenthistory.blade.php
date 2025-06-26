<div class="container">
    <h2>Appointment History</h2>
    @if($appointments->isEmpty())
        <p>No completed appointments found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Psychometrician</th>
                    {{-- <th>Status</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</td>
                        <td>{{ $appointment->psychometrician->name ?? 'N/A' }}</td>
                        {{-- <td>{{ $appointment->completed ? 'Completed' : 'Pending' }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

