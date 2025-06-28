
@extends('include.headercashier')

<link rel="stylesheet" href="{{ asset('style/payment.css') }}">

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-file-invoice-dollar"></i> Payment Records</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcomecashier') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment Records</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
              <h2 style="color: white;">All Payments</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="filters mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status-filter">Status</label>
                            <select id="status-filter" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="paid">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="method-filter">Payment Method</label>
                            <select id="method-filter" class="form-control">
                                <option value="">All Methods</option>
                                <option value="online">Online</option>
                                <option value="gcash">GCash</option>
                                <option value="paymaya">PayMaya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date-range">Date Range</label>
                            <div class="input-group">
                                <input type="date" id="date-from" class="form-control">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">to</span>
                                </div>
                                <input type="date" id="date-to" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover payment-table">
                    <thead>
                        <tr>
                            <th>Reference #</th>
                            <th>Patient</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($invoices) && count($invoices) > 0)
                            @foreach($invoices as $payment)
                                <tr>
                                    <td>{{ $payment->reference_number }}</td>
                                    <td>{{ $payment->client ? $payment->client->name : 'Unknown Patient' }}</td>
                                    <td>{{ $payment->service_type ?? 'Consultation' }}</td>
                                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                                    <td>
                                        <span class="payment-method {{ $payment->payment_method ?? 'unknown' }}">
                                            @if(isset($payment->payment_method) && $payment->payment_method == 'cash')
                                                <i class="fas fa-money-bill-wave"></i>
                                            @elseif(isset($payment->payment_method) && ($payment->payment_method == 'credit_card' || $payment->payment_method == 'debit_card'))
                                                <i class="fas fa-credit-card"></i>
                                            @elseif(isset($payment->payment_method) && $payment->payment_method == 'gcash')
                                                <i class="fas fa-mobile-alt"></i>
                                            @elseif(isset($payment->payment_method) && $payment->payment_method == 'paymaya')
                                                <i class="fas fa-mobile-alt"></i>
                                            @else
                                                <i class="fas fa-money-check"></i>
                                            @endif
                                            {{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'Online')) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge" style="
                                            @if($payment->payment_status == 'pending')
                                                background-color: rgba(255, 140, 0, 0.15); 
                                                color: #FF8C00;
                                            @elseif($payment->payment_status == 'cancelled')
                                                background-color: rgba(220, 53, 69, 0.15); 
                                                color: #DC3545;
                                            @elseif($payment->payment_status == 'completed' || $payment->payment_status == 'paid')
                                                background-color: rgba(40, 167, 69, 0.15); 
                                                color: #28A745;
                                            @elseif($payment->payment_status == 'failed')
                                                background-color: rgba(220, 53, 69, 0.15); 
                                                color: #DC3545;
                                            @elseif($payment->payment_status == 'refunded')
                                                background-color: rgba(23, 162, 184, 0.15); 
                                                color: #17A2B8;
                                            @endif
                                        ">
                                            {{ ucfirst($payment->payment_status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('payment.receipt', $payment->id) }}" class="btn btn-sm btn-info" title="View Receipt">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">No payment records found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if(isset($invoices) && method_exists($invoices, 'hasPages') && $invoices->hasPages())
                <div class="pagination-container">
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmRefund(paymentId) {
        if (confirm('Are you sure you want to issue a refund for this payment? This action cannot be undone.')) {
            // Submit refund request
            alert('Refund functionality will be implemented here.');
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const applyFilters = document.getElementById('apply-filters');
        if (applyFilters) {
            applyFilters.addEventListener('click', function() {
                const status = document.getElementById('status-filter').value;
                const method = document.getElementById('method-filter').value;
                const dateFrom = document.getElementById('date-from').value;
                const dateTo = document.getElementById('date-to').value;
                
                // Create URL with query parameters
                let url = new URL(window.location.href);
                
                // Clear existing parameters
                url.search = '';
                
                // Add new parameters if they have values
                if (status) url.searchParams.append('status', status);
                if (method) url.searchParams.append('method', method);
                if (dateFrom) url.searchParams.append('from', dateFrom);
                if (dateTo) url.searchParams.append('to', dateTo);
                
                // Navigate to the filtered URL
                window.location.href = url.toString();
            });
        }
        
        // Client-side filtering for immediate results
        function applyClientSideFilters() {
            const status = document.getElementById('status-filter').value.toLowerCase();
            const method = document.getElementById('method-filter').value.toLowerCase();
            const dateFrom = document.getElementById('date-from').value;
            const dateTo = document.getElementById('date-to').value;
            
            const fromDate = dateFrom ? new Date(dateFrom) : null;
            const toDate = dateTo ? new Date(dateTo) : null;
            
            // Get all payment rows
            const rows = document.querySelectorAll('.payment-table tbody tr');
            
            rows.forEach(row => {
                let showRow = true;
                
                // Status filter
                if (status) {
                    const statusCell = row.querySelector('td:nth-child(6)');
                    if (statusCell) {
                        const statusText = statusCell.textContent.trim().toLowerCase();
                        if (!statusText.includes(status)) {
                            showRow = false;
                        }
                    }
                }
                
                // Method filter
                if (showRow && method) {
                    const methodCell = row.querySelector('td:nth-child(5)');
                    if (methodCell) {
                        const methodText = methodCell.textContent.trim().toLowerCase();
                        if (!methodText.includes(method.replace('_', ' '))) {
                            showRow = false;
                        }
                    }
                }
                
                // Date range filter
                if (showRow && (fromDate || toDate)) {
                    const dateCell = row.querySelector('td:nth-child(7)');
                    if (dateCell) {
                        const dateText = dateCell.textContent.trim();
                        const rowDate = new Date(dateText);
                        
                        if (fromDate && rowDate < fromDate) {
                            showRow = false;
                        }
                        
                        if (toDate) {
                            // Add one day to include the end date fully
                            const adjustedToDate = new Date(toDate);
                            adjustedToDate.setDate(adjustedToDate.getDate() + 1);
                            
                            if (rowDate > adjustedToDate) {
                                showRow = false;
                            }
                        }
                    }
                }
                
                // Show or hide the row
                row.style.display = showRow ? '' : 'none';
            });
        }
        
        // Set up event listeners for immediate filtering
        document.getElementById('status-filter').addEventListener('change', applyClientSideFilters);
        document.getElementById('method-filter').addEventListener('change', applyClientSideFilters);
        document.getElementById('date-from').addEventListener('change', applyClientSideFilters);
        document.getElementById('date-to').addEventListener('change', applyClientSideFilters);
        
        // Initialize filters from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('status')) {
            document.getElementById('status-filter').value = urlParams.get('status');
        }
        if (urlParams.has('method')) {
            document.getElementById('method-filter').value = urlParams.get('method');
        }
        if (urlParams.has('from')) {
            document.getElementById('date-from').value = urlParams.get('from');
        }
        if (urlParams.has('to')) {
            document.getElementById('date-to').value = urlParams.get('to');
        }
        
        // Apply filters on page load if any are set
        if (urlParams.toString()) {
            applyClientSideFilters();
        }
    });
</script>






