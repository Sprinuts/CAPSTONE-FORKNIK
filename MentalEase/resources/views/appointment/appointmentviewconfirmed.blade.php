<link rel="stylesheet" href="{{ asset('style/appointments.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="main-content">
    <div class="container mt-4">
        <div class="confirmation-header">
            <h2><i class="fas fa-calendar-check"></i> All Appointments</h2>
            <p>View and manage all your scheduled appointments</p>
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
                <h3>No Appointments Found</h3>
                <p>You don't have any appointments in the system.</p>
                <a href="{{ route('appointment.view') }}" class="btn btn-primary">Back to Dashboard</a>
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
                                <div>
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
                                    @if($appointment->confirmed && !$appointment->complete)
                                        <span class="status-badge confirmed">Confirmed</span>
                                    @elseif($appointment->complete)
                                        <span class="status-badge completed">Completed</span>
                                    @else
                                        <span class="status-badge pending">Pending</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="appointment-actions">
                            <form action="{{ route('appointments.show', $appointment->id) }}" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-outline-info">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                            </form>
                            @if(!$appointment->confirmed)
                                <form action="{{ route('appointment.confirm', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check"></i> Confirm
                                    </button>
                                </form>
                            @endif
                            @if(!$appointment->complete && $appointment->confirmed)
                                <form action="{{ route('appointments.complete', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check-double"></i> Complete
                                    </button>
                                </form>
                            @endif
                            @if(!$appointment->complete)
                                <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>








