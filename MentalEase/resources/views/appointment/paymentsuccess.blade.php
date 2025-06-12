<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="{{ asset('style/payment.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="payment-container">
        <div class="payment-card success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <div class="success-content">
                <h2>Payment Successful!</h2>
                
                <div class="invoice-details">
                    <div class="invoice-item">
                        <span class="label">Reference:</span>
                        <span class="value">{{ $invoice->reference_number }}</span>
                    </div>
                    
                    <div class="invoice-item">
                        <span class="label">Status:</span>
                        <span class="value status-badge">{{ $invoice->payment_status }}</span>
                    </div>
                </div>
                
                <div class="success-message">
                    <p>Your appointment has been confirmed. Thank you for choosing MentalEase.</p>
                </div>
                
                <div class="action-buttons">
                    <a href="{{ route('welcomepatient') }}" class="btn btn-primary">Continue to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

