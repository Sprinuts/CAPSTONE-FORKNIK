@extends('include.headercashier')

<link rel="stylesheet" href="{{ asset('style/payment.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-chart-pie"></i> Financial Reports</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcomecashier') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Financial Reports</li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card report-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-day mb-3" style="font-size: 2rem; color: var(--primary-color);"></i>
                    <div class="report-value">₱{{ number_format($todayRevenue, 2) }}</div>
                    <div class="report-label">Today's Revenue</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card report-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-week mb-3" style="font-size: 2rem; color: var(--primary-color);"></i>
                    <div class="report-value">₱{{ number_format($weeklyRevenue, 2) }}</div>
                    <div class="report-label">Weekly Revenue</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card report-card">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt mb-3" style="font-size: 2rem; color: var(--primary-color);"></i>
                    <div class="report-value">₱{{ number_format($monthlyRevenue, 2) }}</div>
                    <div class="report-label">Monthly Revenue</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Revenue by Payment Method</h2>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="paymentMethodChart"></canvas>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Payment Method</th>
                                    <th>Transactions</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentMethods as $method)
                                    <tr>
                                        <td>{{ ucfirst(str_replace('_', ' ', $method->payment_method)) }}</td>
                                        <td>{{ $method->count }}</td>
                                        <td>₱{{ number_format($method->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2>Revenue by Service Type</h2>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="serviceTypeChart"></canvas>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Transactions</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($serviceTypes as $service)
                                    <tr>
                                        <td>{{ $service->service_type }}</td>
                                        <td>{{ $service->count }}</td>
                                        <td>₱{{ number_format($service->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Monthly Revenue Trend</h2>
                    <div class="header-actions">
                        <select id="yearSelector" class="form-select">
                            <option value="2023">2023</option>
                            <option value="2024" selected>2024</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 400px;">
                        <canvas id="monthlyTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Export Reports</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="report-type">Report Type</label>
                                <select id="report-type" class="form-control">
                                    <option value="daily">Daily Report</option>
                                    <option value="weekly">Weekly Report</option>
                                    <option value="monthly">Monthly Report</option>
                                    <option value="custom">Custom Date Range</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start-date">Start Date</label>
                                <input type="date" id="start-date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end-date">End Date</label>
                                <input type="date" id="end-date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions mt-3">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-file-excel"></i> Export to Excel
                        </button>
                        <button type="button" class="btn btn-secondary">
                            <i class="fas fa-file-pdf"></i> Export to PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment Method Chart
        const paymentMethodCtx = document.getElementById('paymentMethodChart').getContext('2d');
        const paymentMethodChart = new Chart(paymentMethodCtx, {
            type: 'doughnut',
            data: {
                labels: [
                    @foreach($paymentMethods as $method)
                        '{{ ucfirst(str_replace("_", " ", $method->payment_method)) }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($paymentMethods as $method)
                            {{ $method->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#40916C',
                        '#52B788',
                        '#74C69D',
                        '#95D5B2',
                        '#B7E4C7'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Service Type Chart
        const serviceTypeCtx = document.getElementById('serviceTypeChart').getContext('2d');
        const serviceTypeChart = new Chart(serviceTypeCtx, {
            type: 'pie',
            data: {
                labels: [
                    @foreach($serviceTypes as $service)
                        '{{ $service->service_type }}',
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($serviceTypes as $service)
                            {{ $service->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#1B4332',
                        '#2D6A4F',
                        '#40916C',
                        '#52B788',
                        '#74C69D'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Monthly Trend Chart
        const monthlyTrendCtx = document.getElementById('monthlyTrendChart').getContext('2d');
        const monthlyTrendChart = new Chart(monthlyTrendCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Revenue',
                    data: [5000, 7500, 10000, 8500, 12000, 15000, 13500, 17000, 14500, 16000, 18000, 20000],
                    backgroundColor: '#40916C',
                    borderColor: '#2D6A4F',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Date range functionality
        const reportType = document.getElementById('report-type');
        const startDate = document.getElementById('start-date');
        const endDate = document.getElementById('end-date');

        reportType.addEventListener('change', function() {
            const today = new Date();
            
            if (this.value === 'daily') {
                startDate.value = today.toISOString().split('T')[0];
                endDate.value = today.toISOString().split('T')[0];
            } else if (this.value === 'weekly') {
                const weekStart = new Date(today);
                weekStart.setDate(today.getDate() - today.getDay());
                startDate.value = weekStart.toISOString().split('T')[0];
                endDate.value = today.toISOString().split('T')[0];
            } else if (this.value === 'monthly') {
                const monthStart = new Date(today.getFullYear(), today.getMonth(), 1);
                startDate.value = monthStart.toISOString().split('T')[0];
                endDate.value = today.toISOString().split('T')[0];
            } else {
                // Custom - clear the fields
                startDate.value = '';
                endDate.value = '';
            }
        });

        // Initialize with daily report
        reportType.value = 'daily';
        const event = new Event('change');
        reportType.dispatchEvent(event);
    });
</script>