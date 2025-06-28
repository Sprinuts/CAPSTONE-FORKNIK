  <link rel="stylesheet" href="{{ asset('style/appointmenthistory.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="history-container">
    <div class="history-header">
        <i class="fas fa-history"></i>
        <h2>My Appointment History</h2>
    </div>
    
    @if($appointments->isEmpty())
        <div class="history-empty">
            <i class="fas fa-calendar-xmark"></i>
            <p>You don't have any completed appointments yet.</p>
            <a href="{{ route('appointment.selectPsychometrician') }}" class="book-appointment-btn">
                <i class="fas fa-calendar-plus"></i> Book Your First Appointment
            </a>
        </div>
    @else
        <div class="history-summary">
            <div class="summary-item">
                <div class="summary-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="summary-info">
                    <span class="summary-value">{{ $appointments->count() }}</span>
                    <span class="summary-label">Total Sessions</span>
                </div>
            </div>
            
            <div class="summary-item">
                <div class="summary-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="summary-info">
                    <span class="summary-value">{{ $appointments->unique('psychometrician_id')->count() }}</span>
                    <span class="summary-label">Psychometricians</span>
                </div>
            </div>
            
            <div class="summary-item">
                <div class="summary-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="summary-info">
                    <span class="summary-value">{{ $appointments->count() }}</span>
                    <span class="summary-label">Hours of Therapy</span>
                </div>
            </div>
        </div>
        
        <table class="history-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Psychometrician</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td class="appointment-date">
                            {{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}
                            @if(\Carbon\Carbon::parse($appointment->date)->isToday())
                                <span class="date-badge today">Today</span>
                            @elseif(\Carbon\Carbon::parse($appointment->date)->isPast())
                                <span class="date-badge past">Past</span>
                            @endif
                        </td>
                        <td class="appointment-time">
                            <i class="far fa-clock"></i>
                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                        </td>
                        <td class="appointment-provider">
                            <i class="fas fa-user-doctor"></i>
                            {{ $appointment->psychometrician->name ?? 'N/A' }}
                        </td>
                        <td>
                            <span class="appointment-status {{ $appointment->complete ? 'status-completed' : 'status-pending' }}">
                                {{ $appointment->complete ? 'Completed' : 'Pending' }}
                            </span>
                        </td>
                        <td class="appointment-actions">
                            <a href="{{ route('appointment.details', $appointment->id) }}" class="action-btn" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('patient.receipt', $appointment->id) }}" class="action-btn" title="View Receipt">
                                <i class="fas fa-receipt"></i>
                            </a>
                            @if(!$appointment->complete && !$appointment->cancelled)
                                <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="action-btn" title="Cancel Appointment" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="history-footer">
            <a href="{{ route('appointment.selectPsychometrician') }}" class="book-appointment-btn">
                <i class="fas fa-calendar-plus"></i> Book New Appointment
            </a>
        </div>
    @endif
</div>














