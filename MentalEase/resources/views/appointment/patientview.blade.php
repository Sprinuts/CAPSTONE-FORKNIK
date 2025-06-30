<link rel="stylesheet" href="{{ asset('style/appointmentpatientview.css') }}">

<div class="container">
    <div class="page-header">
        <h2>Your Appointment</h2>
    </div>
    
    @if($appointments)
        <div class="appointment-card card">
            <div class="card-header">
                <div class="header-content">
                    <h5>Appointment Details</h5>
                    <span class="status-badge 
                        @if($appointments->complete) status-completed 
                        @elseif($appointments->confirmed) status-confirmed 
                        @else status-pending @endif">
                        @if($appointments->complete) Completed
                        @elseif($appointments->confirmed) Confirmed
                        @else Pending @endif
                    </span>
                </div>
                <div class="appointment-date">
                    <span class="day">{{ \Carbon\Carbon::parse($appointments->date)->format('d') }}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($appointments->date)->format('M') }}</span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="details-grid">
                    <div class="detail-row">
                        <div class="detail-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Date</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($appointments->date)->format('l, F d, Y') }}</div>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Time</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($appointments->start_time)->format('h:i A') }}</div>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Psychometrician</div>
                            <div class="detail-value">
                                @if($appointments->psychometrician)
                                    {{ $appointments->psychometrician->name }}
                                @else
                                    Not assigned yet
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($appointments->psychometrician)
                    <div class="detail-row">
                        <div class="detail-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Contact Email</div>
                            <div class="detail-value">{{ $appointments->psychometrician->email }}</div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($appointments->notes)
                <div class="appointment-notes">
                    <h6><i class="fas fa-sticky-note me-2"></i>Notes</h6>
                    <p>{{ $appointments->notes }}</p>
                </div>
                @endif
            </div>
            
            @if(!$appointments->complete)
            <div class="card-footer">
                <div class="footer-actions">
                    <form action="{{ route('appointments.cancel', $appointments->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-cancel" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                            <i class="fas fa-times-circle me-2"></i>Cancel Appointment
                        </button>
                    </form>
                    
                    @if(!$appointments->confirmed)
                    <div class="pending-note">
                        <i class="fas fa-info-circle me-2"></i>
                        Your appointment is pending confirmation from the psychometrician.
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        
        @if($appointments->complete)
        <div class="follow-up-card">
            <div class="follow-up-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="follow-up-content">
                <h4>Appointment Completed</h4>
                <p>Thank you for attending your appointment. Would you like to schedule a follow-up?</p>
                <a href="{{ route('appointments.create') }}" class="btn btn-follow-up">
                    <i class="fas fa-calendar-plus me-2"></i>Schedule Follow-up
                </a>
            </div>
        </div>
        @endif
    @else
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h3>No Upcoming Appointments</h3>
            <p>You don't have any scheduled appointments at the moment.</p>
            <a href="{{ route('appointments.create') }}" class="btn btn-schedule">
                <i class="fas fa-plus-circle me-2"></i>Schedule an Appointment
            </a>
        </div>
    @endif
</div>


