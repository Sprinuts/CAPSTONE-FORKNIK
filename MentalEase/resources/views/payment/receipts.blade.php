<link rel="stylesheet" href="{{ asset('style/payment.css') }}">

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-receipt"></i> Payment Receipts</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcomecashier') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment Receipts</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>All Receipts</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover payment-table">
                    <thead>
                        <tr>
                            <th>Receipt #</th>
                            <th>Client</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($invoices) > 0)
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->reference_number }}</td>
                                    <td>{{ $invoice->client ? $invoice->client->name : 'Unknown Client' }}</td>
                                    <td>₱{{ number_format($invoice->amount, 2) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $invoice->payment_status }}">
                                            {{ ucfirst($invoice->payment_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('payment.receipt', $invoice->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('payment.receipt.pdf', $invoice->id) }}" class="btn btn-primary" target="_blank">
                                            <i class="fas fa-print"></i> Print Receipt
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No receipts found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function printReceipt() {
        // Focus on the receipt content
        document.getElementById('receipt').focus();
        
        // Print the page
        window.print();
        
        return false;
    }
</script>

