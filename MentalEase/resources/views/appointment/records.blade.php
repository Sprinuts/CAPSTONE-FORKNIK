<link rel="stylesheet" href="{{ asset('style/users.css') }} ">

<div class="main-content">

<div class="container mt-4">
    <h3 class="text-center">
        <i class="fas fa-calendar-check"></i> 
        <span class="heading-text">Appointment Records</span>
    </h3>
    <a href="{{ route('appointment.pdf') }}" class="btn btn-lg btn-primary adjustBtn" target="_blank">Generate PDF</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->client->name ?? 'N/A' }}</td>
                <td>{{ $appointment->date ?? 'N/A' }}</td>
                <td>{{ $appointment->start_time ?? 'N/A' }}</td>
                <td>{{ $appointment->status ?? 'N/A' }}</td>
                <!-- Add more fields as needed -->
            </tr>   
            @endforeach
        </tbody>
    </table>
</div>
</div>