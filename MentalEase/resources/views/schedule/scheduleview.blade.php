
<link rel="stylesheet" href="{{ asset('style/createandnviewsched.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container py-3">
    <div class="schedule-header text-center mb-4">
        <h2><i class="fas fa-calendar-check me-2"></i>Psychometrician's Schedules</h2>
        <p>View all appointments and consultations</p>
    </div>
    
    @php
        $today = \Carbon\Carbon::now()->startOfDay();
        
        // Filter upcoming schedules and sort by date and time
        $upcomingSchedules = $schedules->filter(function($schedule) use ($today) {
            $scheduleDate = \Carbon\Carbon::parse($schedule->date)->startOfDay();
            return $scheduleDate->greaterThanOrEqualTo($today);
        })->sortBy(function($schedule) {
            // Sort by date first, then by time
            return $schedule->date . ' ' . $schedule->start_time;
        });
        
        // Filter past schedules and sort by date and time (most recent first)
        $pastSchedules = $schedules->filter(function($schedule) use ($today) {
            $scheduleDate = \Carbon\Carbon::parse($schedule->date)->startOfDay();
            return $scheduleDate->lessThan($today);
        })->sortByDesc(function($schedule) {
            // Sort by date first, then by time
            return $schedule->date . ' ' . $schedule->start_time;
        });
    @endphp

    @if($schedules->isEmpty())
        <div class="empty-state text-center py-5">
            <i class="fas fa-calendar-xmark empty-icon mb-3"></i>
            <h3>No Schedules Found</h3>
            <p class="text-muted">There are currently no scheduled appointments.</p>
        </div>
    @else
        <div class="row">
            <!-- Upcoming Appointments Section -->
            <div class="col-md-6">
                <div class="schedule-container h-100">
                    <div class="section-header">
                        <h3><i class="fas fa-calendar-day me-2"></i>Upcoming Appointments</h3>
                    </div>
                    
                    @if($upcomingSchedules->isEmpty())
                        <div class="empty-state-mini text-center py-3">
                            <p class="text-muted">No upcoming appointments scheduled.</p>
                        </div>
                    @else
                        <div class="schedule-list">
                            @foreach($upcomingSchedules as $schedule)
                                <div class="schedule-item">
                                    <div class="schedule-date">
                                        <span class="date-day">{{ \Carbon\Carbon::parse($schedule->date)->format('d') }}</span>
                                        <span class="date-month">{{ \Carbon\Carbon::parse($schedule->date)->format('M') }}</span>
                                    </div>
                                    <div class="schedule-details">
                                        <h4 class="schedule-time">
                                            <i class="fas fa-clock me-2"></i>
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                                        </h4>
                                        <div class="schedule-client">
                                            <i class="fas fa-user me-2"></i>
                                            <span>
                                                @if(isset($schedule->appointment) && $schedule->appointment->users)
                                                    {{ $schedule->appointment->users->name }}
                                                @elseif($schedule->scheduled)
                                                    <em>Scheduled Client</em>
                                                @else
                                                    <em>Available Slot</em>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="schedule-actions">
                                        @if(!$schedule->scheduled)
                                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                    <i class="fas fa-trash"></i>
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
            
            <!-- Past Appointments Section -->
            <div class="col-md-6">
                <div class="schedule-container h-100">
                    <div class="section-header d-flex justify-content-between align-items-center">
                        <h3><i class="fas fa-calendar-week me-2"></i>Past Appointments</h3>
                        <span class="past-toggle"><i class="fas fa-chevron-down"></i>Show/Hide</span>
                    </div>
                    
                    @if($pastSchedules->isEmpty())
                        <div class="empty-state-mini text-center py-3">
                            <p class="text-muted">No past appointments found.</p>
                        </div>
                    @else
                        <div class="schedule-list past-list">
                            @foreach($pastSchedules as $schedule)
                                <div class="schedule-item past-item">
                                    <div class="schedule-date past-date">
                                        <span class="date-day">{{ \Carbon\Carbon::parse($schedule->date)->format('d') }}</span>
                                        <span class="date-month">{{ \Carbon\Carbon::parse($schedule->date)->format('M') }}</span>
                                    </div>
                                    <div class="schedule-details">
                                        <h4 class="schedule-time">
                                            <i class="fas fa-clock me-2"></i>
                                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                                        </h4>
                                        <div class="schedule-client">
                                            <i class="fas fa-user me-2"></i>
                                            <span>
                                                @if(isset($schedule->appointment) && $schedule->appointment->users)
                                                    {{ $schedule->appointment->users->name }}
                                                @elseif($schedule->scheduled)
                                                    <em>Scheduled Client</em>
                                                @else
                                                    <em>Available Slot</em>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="schedule-actions">
                                        <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this schedule?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add toggle functionality for past appointments
    const pastSection = document.querySelector('.past-list');
    const toggle = document.querySelector('.past-toggle');
    
    if (pastSection && toggle) {
        toggle.addEventListener('click', function() {
            if (pastSection.style.display === 'none') {
                pastSection.style.display = 'flex';
                this.classList.remove('collapsed');
            } else {
                pastSection.style.display = 'none';
                this.classList.add('collapsed');
            }
        });
    }
});
</script>








