<link rel="stylesheet" href="{{ asset('style/appointments.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="main-content">
    <div class="container mt-4">
        <div class="confirmation-header">
            <h2><i class="fas fa-clipboard-check"></i> Pending Appointments</h2>
            <p>Review and confirm appointment requests from patients</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($appointments->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-calendar-xmark"></i>
                </div>
                <h3>No Pending Appointments</h3>
                <p>There are currently no appointments waiting for confirmation.</p>
                <a href="{{ route('appointment.view') }}" class="btn" style="background-color: #2d6a4f; color: white;">Back to Appointments</a>
            </div>
        @else
            <div class="appointment-list">
                @foreach($appointments as $appointment)
                    <div class="appointment-card">
                        <div class="appointment-info">
                            <div class="client-info">
                                <div class="client-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="client-details">
                                    <h4>{{ $appointment->client->name ?? 'N/A' }}</h4>
                                    <p><i class="fas fa-envelope"></i> {{ $appointment->client->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="appointment-details">
                                <div class="detail-item">
                                    <i class="fas fa-calendar-day"></i>
                                    <span>{{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-tag"></i>
                                    <span class="status-badge pending">{{ $appointment->status }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <a href="{{ route('appointments.showconfirmation', $appointment->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                            <form action="{{ route('appointments.confirming', $appointment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Confirm
                                </button>
                            </form>
                            <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

