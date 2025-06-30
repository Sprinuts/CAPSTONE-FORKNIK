<link rel="stylesheet" href="{{ asset('style/welcomepsy.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="main-content">

<div class="parent">

    <div class="div1">
        <div class="welcome-header">
            <h1><i class="fas fa-user-md me-2"></i> Welcome, {{ session('user')->name }}</h1>
            <div class="date" id="currentDate">Loading date...</div>
        </div>
        
        <div class="appointment-dashboard">
            <div class="dashboard-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $todayAppointments ?? 0 }}</h3>
                        <p>Today's Appointments</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $pendingAppointments ?? 0 }}</h3>
                        <p>Pending Confirmations</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $totalPatients ?? 0 }}</h3>
                        <p>Total Patients</p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $completedAppointments ?? 0 }}</h3>
                        <p>Completed Sessions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="div2">
        <div class="dashboard-card">
            <div class="card-header">
                <span>Today's Appointments</span>
                <i class="fas fa-calendar icon"></i>
            </div>
            <div class="card-body">
                <div class="appointment-list">
                    @php
                        $today = \Carbon\Carbon::now()->format('Y-m-d');
                        
                        // Get the appointments for today and sort by time
                        $todayAppointments = \App\Models\Appointment::where('psychometrician_id', session('user')->id)
                            ->where('date', $today)
                            ->get()
                            ->sortBy('start_time'); // Sort by start_time
                    @endphp
                    
                    @if(count($todayAppointments) > 0)
                        @foreach($todayAppointments as $appointment)
                            <div class="appointment-item">
                                <div class="appointment-date">
                                    <span class="day">{{ \Carbon\Carbon::parse($appointment->date)->format('d') }}</span>
                                    <span class="month">{{ \Carbon\Carbon::parse($appointment->date)->format('M') }}</span>
                                </div>
                                <div class="appointment-details">
                                    @php
                                        $patient = \App\Models\Users::find($appointment->user_id);
                                    @endphp
                                    <h4>{{ $patient->name ?? 'Patient' }}</h4>
                                    <p><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</p>
                                    <p><i class="fas fa-phone"></i> {{ $patient->phone ?? 'N/A' }}</p>
                                </div>
                                <div class="appointment-status">
                                    <span class="status-badge status-confirmed">Today</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-day fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No appointments today</p>
                            <a href="{{ route('schedule.create') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-plus me-1"></i> Create Schedule
                            </a>
                        </div>
                    @endif
                </div>
                
                <div class="text-center mt-3">
                    <a href="{{ route('schedule.view') }}" class="btn btn-outline-primary btn-sm">
                        View All Schedules
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="div3">
        <div class="dashboard-card">
            <div class="card-header">
                <span>Quick Actions</span>
                <i class="fas fa-bolt icon"></i>
            </div>
            <div class="card-body">
                <div class="quick-actions">
                    <a href="{{ route('schedule.create') }}" class="action-button">
                        <i class="fas fa-calendar-plus"></i>
                        Create Schedule
                    </a>
                    <a href="{{ route('schedule.view') }}" class="action-button">
                        <i class="fas fa-calendar-alt"></i>
                        View Schedules
                    </a>
                    <a href="{{ route('appointment.confirmation') }}" class="action-button">
                        <i class="fas fa-clipboard-check"></i>
                        Pending Appointments
                    </a>
                </div>
                
                <div class="dashboard-card mt-4">
                    <div class="card-header">
                        <span>Recent Activity</span>
                        <i class="fas fa-history icon"></i>
                    </div>
                    <div class="card-body">
                        <div class="activity-list">
                            @if(isset($recentActivities) && count($recentActivities) > 0)
                                @foreach($recentActivities as $activity)
                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <p>{{ $activity->description }}</p>
                                            <p class="activity-time">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-3">
                                    <i class="fas fa-history fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">No recent activities</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Display current date
    function updateDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
    }
    
    // Update date on load
    updateDate();
    
    // Update date every minute
    setInterval(updateDate, 60000);
</script>    






