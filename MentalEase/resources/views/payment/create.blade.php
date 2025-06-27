@extends('include.headercashier')

<link rel="stylesheet" href="{{ asset('style/payment.css') }}">

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-plus-circle"></i> Create New Payment</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcomecashier') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Payment</li>
            </ol>
        </nav>
    </div>

    <div class="card payment-card">
        <div class="card-header">
            <h2>Payment Details</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('payment.store') }}" method="POST" id="paymentForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="patient_id">Patient</label>
                            <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="service_id">Service</label>
                            <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service['id'] }}" data-price="{{ $service['price'] }}">{{ $service['name'] }} - ₱{{ number_format($service['price'], 2) }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="amount">Amount (₱)</label>
                            <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" min="0" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                <option value="">Select Payment Method</option>
                                @foreach($paymentMethods as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('payment_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" rows="3"></textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="payment-summary mt-4">
                    <h3>Payment Summary</h3>
                    <div class="summary-item">
                        <span>Service:</span>
                        <span id="summary-service">-</span>
                    </div>
                    <div class="summary-item">
                        <span>Amount:</span>
                        <span id="summary-amount">₱0.00</span>
                    </div>
                    <div class="summary-item">
                        <span>Payment Method:</span>
                        <span id="summary-method">-</span>
                    </div>
                </div>

                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-check-circle"></i> Process Payment
                    </button>
                    <a href="{{ route('welcomecashier') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times-circle"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('service_id');
        const amountInput = document.getElementById('amount');
        const paymentMethodSelect = document.getElementById('payment_method');
        
        const summaryService = document.getElementById('summary-service');
        const summaryAmount = document.getElementById('summary-amount');
        const summaryMethod = document.getElementById('summary-method');
        
        // Update amount when service changes
        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            
            if (price) {
                amountInput.value = price;
                summaryService.textContent = selectedOption.textContent.split(' - ')[0];
                summaryAmount.textContent = '₱' + parseFloat(price).toFixed(2);
            } else {
                amountInput.value = '';
                summaryService.textContent = '-';
                summaryAmount.textContent = '₱0.00';
            }
        });
        
        // Update summary when amount changes
        amountInput.addEventListener('input', function() {
            summaryAmount.textContent = '₱' + parseFloat(this.value || 0).toFixed(2);
        });
        
        // Update summary when payment method changes
        paymentMethodSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            summaryMethod.textContent = selectedOption.textContent || '-';
        });
    });
</script>