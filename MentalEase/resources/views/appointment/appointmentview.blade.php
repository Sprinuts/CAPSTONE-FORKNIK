<link rel="stylesheet" href="{{ asset('style/appointmentview.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<div class="main-content">
<div class="appointment-container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="appointment-header">
        <h1><i class="fas fa-calendar-alt"></i> Appointment Management</h1>
        <p>View and manage your patient appointments</p>
    </div>

    <div class="appointment-actions">
        <a href="{{ route('appointment.confirmation') }}" class="action-button pending">
            <div class="action-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="action-content">
                <h3>Pending Appointments</h3>
                <p>Review and confirm appointment requests</p>
            </div>
            <div class="action-badge">{{ $pendingAppointments ?? 0 }}</div>
        </a>
        
        <a href="{{ route('appointment.viewconfirmed') }}" class="action-button upcoming">
            <div class="action-icon">
                <i class="fas fa-calendar-day"></i>
            </div>
            <div class="action-content">
                <h3>All Appointments</h3>
                <p>View your confirmed appointments</p>
            </div>
        </a>
    </div>

    <div class="recent-appointments">
        <div class="section-header">
            <h2><i class="fas fa-history"></i> Recent Appointments</h2>
            <a href="{{ route('appointment.viewconfirmed') }}" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div class="appointments-list">
            @if(isset($recentAppointments) && count($recentAppointments) > 0)
                @foreach($recentAppointments as $appointment)
                    <div class="appointment-item">
                        <div class="appointment-date">
                            <span class="month">{{ \Carbon\Carbon::parse($appointment->date)->format('M') }}</span>
                            <span class="day">{{ \Carbon\Carbon::parse($appointment->date)->format('d') }}</span>
                        </div>
                        
                        <div class="appointment-details">
                            <h4>{{ $appointment->client->name ?? 'Patient' }}</h4>
                            <p><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</p>
                            @if($appointment->client && $appointment->client->phone)
                                <p><i class="fas fa-phone"></i> {{ $appointment->client->phone }}</p>
                            @endif
                        </div>
                        
                        <div class="appointment-status">
                            @if($appointment->confirmed && !$appointment->complete)
                                <span class="status-badge confirmed">Confirmed</span>
                            @elseif($appointment->complete)
                                <span class="status-badge completed">Completed</span>
                            @else
                                <span class="status-badge pending">Pending</span>
                            @endif
                        </div>
                        
                        <div class="appointment-actions">
                            @if($appointment->confirmed && !$appointment->complete && \Carbon\Carbon::parse($appointment->date)->isToday())
                                <a href="{{ route('consultationpsychometrician') }}" class="action-btn start">
                                    <i class="fas fa-video"></i> Start
                                </a>
                            @endif
                            
                            @if(!$appointment->confirmed)
                                <form action="{{ route('appointment.confirm', $appointment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="action-btn confirm">
                                        <i class="fas fa-check"></i> Confirm
                                    </button>
                                </form>
                            @endif
                            
                            <button class="action-btn details" data-bs-toggle="modal" data-bs-target="#appointmentModal{{ $appointment->id }}">
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                        </div>
                    </div>
                    
                    <!-- Appointment Details Modal -->
                    <div class="modal fade" id="appointmentModal{{ $appointment->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Appointment Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="patient-info">
                                        <h4>Patient Information</h4>
                                        <p><strong>Name:</strong> {{ $appointment->client->name ?? 'N/A' }}</p>
                                        <p><strong>Email:</strong> {{ $appointment->client->email ?? 'N/A' }}</p>
                                        <p><strong>Phone:</strong> {{ $appointment->client->phone ?? 'N/A' }}</p>
                                    </div>
                                    
                                    <div class="appointment-info">
                                        <h4>Appointment Details</h4>
                                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('F d, Y') }}</p>
                                        <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</p>
                                        <p><strong>Status:</strong> 
                                            @if($appointment->confirmed && !$appointment->complete)
                                                <span class="badge bg-success">Confirmed</span>
                                            @elseif($appointment->complete)
                                                <span class="badge bg-primary">Completed</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </p>
                                        <p><strong>Booked on:</strong> {{ \Carbon\Carbon::parse($appointment->created_at)->format('F d, Y g:i A') }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    @if(!$appointment->confirmed)
                                        <form action="{{ route('appointment.confirm', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Confirm Appointment</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-appointments">
                    <i class="fas fa-calendar-xmark"></i>
                    <p>No recent appointments found</p>
                    <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create Schedule</a>
                </div>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Bootstrap JS for modals -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




