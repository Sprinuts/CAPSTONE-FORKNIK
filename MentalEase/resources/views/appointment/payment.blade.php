<link rel="stylesheet" href="{{ asset('style/payment.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="payment-container">
    <div class="payment-card">
        <div class="payment-header">
            <h1><i class="fas fa-credit-card"></i> Payment Page</h1>
            <p>Pay for your appointment.</p>
        </div>

        <div class="payment-methods">
            <form action="{{ route('pay') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $data['user_id'] }}">
                <input type="hidden" name="psychometrician_id" value="{{ $data['psychometrician_id'] }}">
                <input type="hidden" name="date" value="{{ $data['date'] }}">
                <input type="hidden" name="start_time" value="{{ $data['start_time'] }}">
                <button type="submit" class="pay-button">
                    <div class="maya-logo-container">
                        <img src="{{ asset('style/assets/maya.jpg') }}" alt="Maya" class="maya-logo">
                    </div>
                    Pay with Maya
                </button>
            </form>
        </div>
    </div>
</div>





