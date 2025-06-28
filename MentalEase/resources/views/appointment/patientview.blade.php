<link rel="stylesheet" href="{{ asset('style/appointmentpatientview.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="appointment-container">
    <div class="appointment-header">
        <h1><i class="fas fa-calendar-check"></i> Your Appointment</h1>
        <p>View your upcoming appointment details</p>
    </div>

    @if($appointments)
        <div class="appointment-card">
            <div class="appointment-status-badge 
                @if($appointments->complete) status-completed
                @elseif($appointments->confirmed) status-confirmed
                @else status-pending @endif">
                @if($appointments->complete)
                    <i class="fas fa-check-circle"></i> Completed
                @elseif($appointments->confirmed)
                    <i class="fas fa-calendar-check"></i> Confirmed
                @else
                    <i class="fas fa-hourglass-half"></i> Pending
                @endif
            </div>
            
            <div class="appointment-details">
                <div class="detail-row">
                    <div class="detail-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Date</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($appointments->date)->format('F d, Y') }}</span>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Time</span>
                        <span class="detail-value">{{ \Carbon\Carbon::parse($appointments->start_time)->format('h:i A') }}</span>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Psychometrician</span>
                        <span class="detail-value">
                            @if($appointments->psychometrician)
                                {{ $appointments->psychometrician->name }}
                            @else
                                Not assigned yet
                            @endif
                        </span>
                    </div>
                </div>
                
                @if($appointments->psychometrician)
                <div class="detail-row">
                    <div class="detail-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="detail-content">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $appointments->psychometrician->email }}</span>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="appointment-actions">
                @if(!$appointments->complete)
                    <form action="{{ route('appointments.cancel', $appointments->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-cancel" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                            <i class="fas fa-times-circle"></i> Cancel Appointment
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('patient.appointment.history') }}" class="btn-history">
                    <i class="fas fa-history"></i> View Appointment History
                </a>
            </div>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-calendar-times"></i>
            </div>
            <h3>No Upcoming Appointments</h3>
            <p>You don't have any scheduled appointments at the moment.</p>
            <a href="{{ route('appointment.selectPsychometrician') }}" class="btn-book">
                <i class="fas fa-plus-circle"></i> Book an Appointment
            </a>
        </div>
    @endif
</div>


