

<link rel="stylesheet" href="{{ asset('style/welcomecashier.css') }}">

<div class="main-content">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="header-content">
            <h1><i class="fas fa-cash-register"></i> Cashier Dashboard</h1>
            <p class="current-date">{{ date('l, F d, Y') }}</p>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="stats-row">
        <div class="stats-card">
            <div class="stats-icon"><i class="fas fa-receipt"></i></div>
            <div class="stats-info">
                <h3>Today's Transactions</h3>
                <p class="stats-value">{{ $todayTransactions }}</p>
            </div>
            <div class="stats-amount">₱{{ number_format($todayRevenue, 2) }}</div>
        </div>
        
        <div class="stats-card">
            <div class="stats-icon"><i class="fas fa-clock"></i></div>
            <div class="stats-info">
                <h3>Pending Payments</h3>
                <p class="stats-value">{{ $pendingPayments }}</p>
            </div>
            <div class="stats-amount">₱{{ number_format($pendingAmount, 2) }}</div>
        </div>
    </div>
    
    <!-- Recent Transactions -->
    <div class="recent-transactions">
        <div class="section-header">
            <h2>Recent Transactions</h2>
            <a href="{{ route('payment.records') }}" class="view-all">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->id }}</td>
                        <td>{{ $transaction->patient_name }}</td>
                        <td>{{ $transaction->service_type }}</td>
                        <td>₱{{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ $transaction->payment_method }}</td>
                        <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




