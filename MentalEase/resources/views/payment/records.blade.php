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
            <h2>All Payments</h2>
            <div class="header-actions">
                <a href="{{ route('payment.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> New Payment
                </a>
            </div>
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
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="refunded">Refunded</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="method-filter">Payment Method</label>
                            <select id="method-filter" class="form-control">
                                <option value="">All Methods</option>
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
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
                    <div class="col-md-2 d-flex align-items-end">
                        <button id="apply-filters" class="btn btn-secondary btn-block">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
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
                        @if(isset($payments) && count($payments) > 0)
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->reference_number }}</td>
                                    <td>{{ $payment->patient ? $payment->patient->name : 'Unknown Patient' }}</td>
                                    <td>{{ $payment->service_type }}</td>
                                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                                    <td>
                                        <span class="payment-method {{ $payment->payment_method }}">
                                            @if($payment->payment_method == 'cash')
                                                <i class="fas fa-money-bill-wave"></i>
                                            @elseif($payment->payment_method == 'credit_card' || $payment->payment_method == 'debit_card')
                                                <i class="fas fa-credit-card"></i>
                                            @elseif($payment->payment_method == 'gcash')
                                                <i class="fas fa-mobile-alt"></i>
                                            @elseif($payment->payment_method == 'paymaya')
                                                <i class="fas fa-mobile-alt"></i>
                                            @else
                                                <i class="fas fa-money-check"></i>
                                            @endif
                                            {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $payment->status }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('payment.receipt', $payment->id) }}" class="btn btn-sm btn-info" title="View Receipt">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            @if($payment->status == 'completed')
                                                <button class="btn btn-sm btn-warning" onclick="confirmRefund({{ $payment->id }})" title="Issue Refund">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            @endif
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

            @if(isset($payments) && $payments->hasPages())
                <div class="pagination-container">
                    {{ $payments->links() }}
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
        // Filter functionality would be implemented here
    });
</script>

