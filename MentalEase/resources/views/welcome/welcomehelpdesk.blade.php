<link rel="stylesheet" href="{{ asset('style/welcomehelpdesk.css') }}">

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1><i class="fas fa-headset"></i> Help Desk Dashboard</h1>
            <p class="current-date">{{ date('l, F d, Y') }}</p>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-reply"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $pendingReplies ?? 0 }}</h3>
                <p>Pending Replies</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $resolvedConcerns ?? 0 }}</h3>
                <p>Resolved Today</p>
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
    </div>

    <!-- Recent Concerns Section -->
    <div class="card recent-tickets">
        <div class="card-header">
            <h2><i class="fas fa-comments"></i> Recent Patient Concerns</h2>
            <a href="{{ route('patient.concerns') }}" class="btn-primary">View All</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Date</th>

                    </tr>
                </thead>
                <tbody>
                    @if(isset($recentConcerns) && count($recentConcerns) > 0)
                        @foreach($recentConcerns as $concern)
                        <tr>
                            <td>#{{ $concern->id }}</td>
                            <td>{{ $concern->name }}</td>
                            <td>{{ $concern->subject }}</td>
                            <td>{{ $concern->created_at->format('M d, Y') }}</td>

                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No recent concerns found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>













