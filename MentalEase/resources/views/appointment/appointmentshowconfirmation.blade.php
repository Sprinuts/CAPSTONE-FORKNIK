
<div class="main-content">

<div class="container mt-4">
    <a href="{{ route('appointment.confirmation') }}" class="btn btn-secondary mb-3">Go Back</a>
    <h2>Appointment Details</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Client: {{ $client->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $client->email }}</p>
            <p class="card-text"><strong>Appointment Date:</strong> {{ $appointment->date }}</p>
            <p class="card-text"><strong>Time:</strong> {{ $appointment->start_time }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $appointment->status }}</p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Psychometrician: {{ $psychometrician->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $psychometrician->email }}</p>
        </div>
    </div>
</div>
</div>
