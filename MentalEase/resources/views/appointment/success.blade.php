<link rel="stylesheet" href="{{ asset('style/payment.css') }}">
    <div class="payment-container">
        <div class="payment-card success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Appointment Confirmed!</h2>
            <p>Thank you for booking. Your appointment has been scheduled.</p>
                <div class="action-buttons">
                    <a href="{{ route('appointment.success') }}" class="btn btn-primary">Continue to Dashboard</a>
                </div>
            <div class="success-content">
