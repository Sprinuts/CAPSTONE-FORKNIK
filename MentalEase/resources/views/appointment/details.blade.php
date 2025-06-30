<link rel="stylesheet" href="{{ asset('style/appointmentdetails.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="details-container">
    <div class="details-header">
        <a href="{{ route('patient.appointment.history') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to History
        </a>
        <h2>Appointment Details</h2>
    </div>
    
    <div class="appointment-card">
        <div class="appointment-status-banner {{ $appointment->complete ? 'completed' : ($appointment->cancelled ? 'cancelled' : 'pending') }}">
            <i class="fas {{ $appointment->complete ? 'fa-check-circle' : ($appointment->cancelled ? 'fa-times-circle' : 'fa-clock') }}"></i>
            {{ $appointment->complete ? 'Completed' : ($appointment->cancelled ? 'Cancelled' : 'Pending') }}
        </div>

        @if($appointment->cancelled && $appointment->cancellation_reason)
        <div class="cancellation-reason">
            <p><strong>Cancellation Reason:</strong> {{ $appointment->cancellation_reason }}</p>
        </div>
        @endif
        
        <div class="appointment-info">
            <div class="info-group">
                <div class="info-label">Date</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($appointment->date)->format('l, F d, Y') }}</div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Time</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                    {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                </div>
            </div>
            
            <div class="info-group">
                <div class="info-label">Psychometrician</div>
                <div class="info-value">{{ $appointment->psychometrician->name ?? 'Not Assigned' }}</div>
            </div>
            
            @if($appointment->psychometrician)
            <div class="info-group">
                <div class="info-label">Contact</div>
                <div class="info-value">{{ $appointment->psychometrician->contactnumber ?? 'N/A' }}</div>
            </div>
            @endif
            
            <div class="info-group">
                <div class="info-label">Booking Date</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y') }}</div>
            </div>
        </div>
        
        @if(!$appointment->complete && !$appointment->cancelled)
        <div class="appointment-actions">
            <form action="{{ route('appointment.cancel', $appointment->id) }}" method="POST">
                @csrf
                <button type="submit" class="cancel-btn" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                    <i class="fas fa-times-circle"></i> Cancel Appointment
                </button>
            </form>
        </div>
        @endif
    </div>
</div>



