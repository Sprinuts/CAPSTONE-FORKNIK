<link rel="stylesheet" href="{{ asset('style/welcomeadmin.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="dashboard-header">
    <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
    <p class="current-date" id="currentDate">Loading date...</p>
</div>

<div class="parent">
    <div class="div1 dashboard-card">
        <div class="card-header">
            <h2>System Overview</h2>
            <div class="card-actions">
                <button class="refresh-btn" id="refreshStats"><i class="fas fa-sync-alt"></i></button>
                <button class="more-btn"><i class="fas fa-ellipsis-v"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-icon users">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Total Users</h3>
                        <p class="stat-number">{{ $totalUsers }}</p>
                        <p class="stat-change {{ $userChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-{{ $userChange >= 0 ? 'arrow-up' : 'arrow-down' }}"></i> 
                            {{ abs($userChange) }}% from last month
                        </p>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon appointments">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Appointments</h3>
                        <p class="stat-number">{{ $totalAppointments }}</p>
                        <p class="stat-change {{ $appointmentChange >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-{{ $appointmentChange >= 0 ? 'arrow-up' : 'arrow-down' }}"></i> 
                            {{ abs($appointmentChange) }}% from last month
                        </p>
                    </div>
                </div>
                
                
                <div class="stat-item">
                    <div class="stat-icon psychometricians">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Psychometricians</h3>
                        <p class="stat-number">{{ $totalPsychometricians }}</p>
                        <p class="stat-change {{ $psychometricianChange != 0 ? ($psychometricianChange > 0 ? 'positive' : 'negative') : 'neutral' }}">
                            @if($psychometricianChange == 0)
                                <i class="fas fa-equals"></i> No change
                            @else
                                <i class="fas fa-{{ $psychometricianChange > 0 ? 'arrow-up' : 'arrow-down' }}"></i> 
                                {{ abs($psychometricianChange) }}% from last month
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="div2 dashboard-card">
        <div class="card-header">
            <h2>Recent Activity</h2>
            <div class="card-actions">
                <button class="refresh-btn"><i class="fas fa-sync-alt"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="activity-list">
                @foreach($recentActivities as $activity)
                    @php
                        // Map type to icon and class
                        $iconMap = [
                            'login' => ['icon' => 'sign-in-alt', 'class' => 'login'],
                            'appointment' => ['icon' => 'calendar-plus', 'class' => 'appointment'],
                            'assessment' => ['icon' => 'tasks', 'class' => 'assessment'],
                            'user' => ['icon' => 'user-plus', 'class' => 'user'],
                            'settings' => ['icon' => 'cog', 'class' => 'settings'],
                            'report' => ['icon' => 'chart-pie', 'class' => 'report'],
                        ];
                        $type = $activity->type;
                        $icon = $iconMap[$type]['icon'] ?? 'info-circle';
                        $iconClass = $iconMap[$type]['class'] ?? 'default';
                    @endphp
                    <div class="activity-item">
                        <div class="activity-icon {{ $iconClass }}">
                            <i class="fas fa-{{ $icon }}"></i>
                        </div>
                        <div class="activity-details">
                            <p class="activity-text"><strong>{{ $activity->name }}</strong> {{ $activity->log }}</p>
                            <p class="activity-time">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
                @if($recentActivities->isEmpty())
                    <div class="activity-item">
                        <div class="activity-details">
                            <p class="activity-text">No recent activity.</p>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="view-all-container">
                <button class="view-all-btn">View All Activity <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
    
    <div class="div3 dashboard-card">
        <div class="card-header expandable-header" id="quickActionsHeader">
            <h2>Quick Actions</h2>
            <div class="expand-icon">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
        <div class="card-body" id="quickActionsBody">
            <div class="quick-actions">
                <a href="{{ route('users.add') }}" class="action-btn">
                    <i class="fas fa-user-plus"></i>
                    <span>Add User</span>
                </a>
                <a href="{{ route('users.view') }}" class="action-btn">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
                <a href="{{ route('appointment.records') }}" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Appointments</span>
                </a>
                <a href="{{ route('backup.viewbackups') }}" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    <span>Backup</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set current date
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
        
        // Refresh buttons functionality
        const refreshButtons = document.querySelectorAll('.refresh-btn');
        refreshButtons.forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.add('fa-spin');
                
                // If this is the stats refresh button, fetch new data
                if (this.id === 'refreshStats') {
                    fetch('{{ route("admin.refresh-stats") }}')
                        .then(response => response.json())
                        .then(data => {
                            // Update user stats
                            document.querySelector('.stat-item:nth-child(1) .stat-number').textContent = data.totalUsers;
                            const userChangeEl = document.querySelector('.stat-item:nth-child(1) .stat-change');
                            userChangeEl.className = `stat-change ${data.userChange >= 0 ? 'positive' : 'negative'}`;
                            userChangeEl.innerHTML = `<i class="fas fa-${data.userChange >= 0 ? 'arrow-up' : 'arrow-down'}"></i> ${Math.abs(data.userChange)}% from last month`;
                            
                            // Update appointment stats
                            document.querySelector('.stat-item:nth-child(2) .stat-number').textContent = data.totalAppointments;
                            const apptChangeEl = document.querySelector('.stat-item:nth-child(2) .stat-change');
                            apptChangeEl.className = `stat-change ${data.appointmentChange >= 0 ? 'positive' : 'negative'}`;
                            apptChangeEl.innerHTML = `<i class="fas fa-${data.appointmentChange >= 0 ? 'arrow-up' : 'arrow-down'}"></i> ${Math.abs(data.appointmentChange)}% from last month`;
                            
                            // Update assessment stats
                            document.querySelector('.stat-item:nth-child(3) .stat-number').textContent = data.totalAssessments;
                            const assessChangeEl = document.querySelector('.stat-item:nth-child(3) .stat-change');
                            assessChangeEl.className = `stat-change ${data.assessmentChange >= 0 ? 'positive' : 'negative'}`;
                            assessChangeEl.innerHTML = `<i class="fas fa-${data.assessmentChange >= 0 ? 'arrow-up' : 'arrow-down'}"></i> ${Math.abs(data.assessmentChange)}% from last month`;
                            
                            // Update psychometrician stats
                            document.querySelector('.stat-item:nth-child(4) .stat-number').textContent = data.totalPsychometricians;
                            const psychChangeEl = document.querySelector('.stat-item:nth-child(4) .stat-change');
                            
                            if (data.psychometricianChange == 0) {
                                psychChangeEl.className = 'stat-change neutral';
                                psychChangeEl.innerHTML = '<i class="fas fa-equals"></i> No change';
                            } else {
                                psychChangeEl.className = `stat-change ${data.psychometricianChange > 0 ? 'positive' : 'negative'}`;
                                psychChangeEl.innerHTML = `<i class="fas fa-${data.psychometricianChange > 0 ? 'arrow-up' : 'arrow-down'}"></i> ${Math.abs(data.psychometricianChange)}% from last month`;
                            }
                        })
                        .catch(error => console.error('Error refreshing stats:', error))
                        .finally(() => {
                            setTimeout(() => {
                                icon.classList.remove('fa-spin');
                            }, 1000);
                        });
                } else {
                    setTimeout(() => {
                        icon.classList.remove('fa-spin');
                    }, 1000);
                }
            });
        });
        
        // Period buttons functionality
        const periodButtons = document.querySelectorAll('.period-btn');
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                periodButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>








