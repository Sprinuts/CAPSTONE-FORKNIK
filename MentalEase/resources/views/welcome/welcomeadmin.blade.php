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
                <button class="refresh-btn"><i class="fas fa-sync-alt"></i></button>
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
                        <p class="stat-number">{{ $totalUsers ?? 245 }}</p>
                        <p class="stat-change positive"><i class="fas fa-arrow-up"></i> 12% from last month</p>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon appointments">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Appointments</h3>
                        <p class="stat-number">{{ $totalAppointments ?? 128 }}</p>
                        <p class="stat-change positive"><i class="fas fa-arrow-up"></i> 8% from last month</p>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon assessments">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Assessments</h3>
                        <p class="stat-number">{{ $totalAssessments ?? 89 }}</p>
                        <p class="stat-change positive"><i class="fas fa-arrow-up"></i> 15% from last month</p>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon psychometricians">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Psychometricians</h3>
                        <p class="stat-number">{{ $totalPsychometricians ?? 12 }}</p>
                        <p class="stat-change neutral"><i class="fas fa-equals"></i> No change</p>
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
                <div class="activity-item">
                    <div class="activity-icon login">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-text"><strong>John Doe</strong> logged into the system</p>
                        <p class="activity-time">5 minutes ago</p>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon appointment">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-text"><strong>Maria Garcia</strong> scheduled an appointment</p>
                        <p class="activity-time">15 minutes ago</p>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon assessment">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-text"><strong>Robert Smith</strong> completed DASS assessment</p>
                        <p class="activity-time">32 minutes ago</p>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon user">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-text"><strong>Admin</strong> added new psychometrician</p>
                        <p class="activity-time">1 hour ago</p>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon settings">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-text"><strong>System</strong> backup completed</p>
                        <p class="activity-time">2 hours ago</p>
                    </div>
                </div>
                
                <div class="activity-item">
                    <div class="activity-icon report">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="activity-details">
                        <p class="activity-text"><strong>System</strong> generated monthly report</p>
                        <p class="activity-time">Yesterday</p>
                    </div>
                </div>
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
                <a href="#" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Appointments</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                </a>
                <a href="#" class="action-btn">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
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
                setTimeout(() => {
                    icon.classList.remove('fa-spin');
                }, 1000);
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




