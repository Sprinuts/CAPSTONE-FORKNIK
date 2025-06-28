<link rel="stylesheet" href="{{ asset('style/appointmenthistory.css') }}">
<link rel="stylesheet" href="{{ asset('style/payment.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container mt-4">
    <div class="tabs-container">
        <div class="tab-header">
            <a href="{{ route('patient.appointment.history') }}" class="tab-item">
                Appointments
            </a>
            <a href="#" class="tab-item active">
                Receipts
            </a>
        </div>
    </div>

    <div class="receipt-container">
        <h2 class="section-title">Receipts & Invoices</h2>
        
        <div class="receipt-card">
            <div class="receipt-header">
                <div class="receipt-date">
                    {{ \Carbon\Carbon::parse($invoice->created_at)->format('M d, Y') }}
                </div>
                <div class="receipt-title">
                    Consultation with {{ $invoice->appointment->psychometrician->name ?? 'Provider' }}
                </div>
                <div class="receipt-service">
                    {{ $invoice->service_type ?? 'Mental Health Consultation' }}
                </div>
            </div>
            
            <div class="receipt-provider-section">
                <div class="provider-label">Provider:</div>
                <div class="provider-name">{{ $invoice->appointment->psychometrician->name ?? 'Provider' }}</div>
                <div class="provider-role">Psychometrician</div>
            </div>
            
            <hr class="receipt-divider">
            
            <div class="receipt-details">
                <div class="receipt-amount-row">
                    <div class="amount-label">Total Amount:</div>
                    <div class="amount-value">₱{{ number_format($invoice->amount, 2) }}</div>
                </div>
                
                <div class="receipt-payment-method">
                    Payment Method: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method ?? 'Online Payment')) }}
                </div>
                
                <div class="receipt-reference">
                    <div class="reference-label">Reference:</div>
                    <div class="reference-value">
                        <span class="reference-code">{{ $invoice->reference_number }}</span>
                        <button class="copy-btn" onclick="copyToClipboard('{{ $invoice->reference_number }}')">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="receipt-actions">
                <a href="{{ route('payment.receipt.pdf', $invoice->id) }}" class="btn-download" target="_blank">
                    <i class="fas fa-download"></i> Download Receipt
                </a>
                <a href="{{ route('patient.appointment.history') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Appointments
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .tabs-container {
        background: white;
        border-radius: 50px;
        padding: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    
    .tab-header {
        display: flex;
        justify-content: space-between;
    }
    
    .tab-item {
        flex: 1;
        text-align: center;
        padding: 12px 20px;
        border-radius: 50px;
        color: #666;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .tab-item.active {
        background-color: #e6f7f9;
        color: #00b5d8;
    }
    
    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }
    
    .receipt-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 25px;
        margin-bottom: 20px;
    }
    
    .receipt-header {
        margin-bottom: 20px;
    }
    
    .receipt-date {
        color: #666;
        font-size: 16px;
    }
    
    .receipt-title {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        margin: 5px 0;
    }
    
    .receipt-service {
        color: #666;
        font-size: 16px;
    }
    
    .receipt-provider-section {
        background: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .provider-label {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }
    
    .provider-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }
    
    .provider-role {
        color: #666;
        font-size: 14px;
    }
    
    .receipt-divider {
        border: none;
        height: 1px;
        background-color: #eee;
        margin: 20px 0;
    }
    
    .receipt-details {
        margin-bottom: 25px;
    }
    
    .receipt-amount-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .amount-label {
        font-size: 16px;
        color: #666;
    }
    
    .amount-value {
        font-size: 22px;
        font-weight: 700;
        color: #333;
    }
    
    .receipt-payment-method {
        color: #666;
        margin-bottom: 15px;
    }
    
    .receipt-reference {
        background: #f9f9f9;
        border-radius: 8px;
        padding: 12px;
        display: flex;
        align-items: center;
    }
    
    .reference-label {
        color: #666;
        margin-right: 10px;
    }
    
    .reference-value {
        display: flex;
        align-items: center;
        flex: 1;
    }
    
    .reference-code {
        font-family: monospace;
        color: #333;
        background: #eee;
        padding: 5px 10px;
        border-radius: 4px;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .copy-btn {
        background: none;
        border: none;
        color: #00b5d8;
        cursor: pointer;
        margin-left: 10px;
        padding: 5px;
    }
    
    .receipt-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    
    .btn-download, .btn-back {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .btn-download {
        background-color: #00b5d8;
        color: white;
    }
    
    .btn-download:hover {
        background-color: #0097b5;
    }
    
    .btn-back {
        background-color: #f1f1f1;
        color: #666;
    }
    
    .btn-back:hover {
        background-color: #e5e5e5;
    }
    
    .btn-download i, .btn-back i {
        margin-right: 8px;
    }
</style>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Reference number copied to clipboard!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>



