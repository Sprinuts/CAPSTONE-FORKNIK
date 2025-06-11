<!-- resources/views/payment/success.blade.php -->
<h2>Payment Successful!</h2>
<p>Reference: {{ $invoice->reference_number }}</p>
<p>Status: {{ $invoice->payment_status }}</p>

<a href="{{ route('appointment.success') }}" class="btn btn-primary">Continue</a>