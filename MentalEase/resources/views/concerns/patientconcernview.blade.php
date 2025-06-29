
<div class="container mt-4">
    <h2>Patient Concern Details</h2>
    <div class="card mt-3">
        <div class="card-header">
            <strong>{{ $concern->subject }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $concern->name }}</p>
            <p><strong>Email:</strong> {{ $concern->email }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $concern->message }}</p>
            <p><strong>Submitted At:</strong> {{ $concern->created_at->format('Y-m-d H:i') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('patient.concerns') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

