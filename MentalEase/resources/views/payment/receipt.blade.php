@extends('include.headercashier')

<link rel="stylesheet" href="{{ asset('style/payment.css') }}">

<div class="container">
    <div class="page-header">
        <h1><i class="fas fa-receipt"></i> Payment Receipt</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcomecashier') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payment.records') }}">Payment Records</a></li>
                <li class="breadcrumb-item active" aria-current="page">Receipt</li>
            </ol>
        </nav>
    </div>

    <div class="card receipt-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Receipt #{{ $payment->reference_number }}</h2>
            <div class="header-actions">
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Receipt
                </button>
                <a href="{{ route('payment.records') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Records
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="receipt-container" id="receipt">
                <div class="receipt-header">
                    <div class="logo">
                        <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo">
                    </div>
                    <div class="company-info">
                        <h2>MentalEase</h2>
                        <p>Mental Health Services</p>
                        <p>123 Wellness Street, Manila, Philippines</p>
                        <p>Phone: (02) 8123-4567</p>
                        <p>Email: info@mentalease.com</p>
                    </div>
                </div>
                
                <div class="receipt-title">
                    <h1>OFFICIAL RECEIPT</h1>
                    <div class="receipt-number">
                        <span>Receipt #:</span>
                        <span>{{ $payment->reference_number }}</span>
                    </div>
                    <div class="receipt-date">
                        <span>Date:</span>
                        <span>{{ $payment->created_at->format('F d, Y h:i A') }}</span>
                    </div>
                </div>
                
                <div class="receipt-customer">
                    <h3>Customer Information</h3>
                    <div class="customer-details">
                        <div class="detail-row">
                            <span>Name:</span>
                            <span>{{ $payment->patient ? $payment->patient->name : 'Unknown Patient' }}</span>
                        </div>
                        @if($payment->patient)
                            <div class="detail-row">
                                <span>Email:</span>
                                <span>{{ $payment->patient->email }}</span>
                            </div>
                            <div class="detail-row">
                                <span>Phone:</span>
                                <span>{{ $payment->patient->phone ?? 'N/A' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="receipt-items">
                    <h3>Payment Details</h3>
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $payment->service_type }}</td>
                                <td>₱{{ number_format($payment->amount, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>₱{{ number_format($payment->amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="receipt-payment">
                    <h3>Payment Information</h3>
                    <div class="payment-details">
                        <div class="detail-row">
                            <span>Payment Method:</span>
                            <span>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                        </div>
                        <div class="detail-row">
                            <span>Status:</span>
                            <span class="status-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span>
                        </div>
                        @if($payment->notes)
                            <div class="detail-row">
                                <span>Notes:</span>
                                <span>{{ $payment->notes }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="receipt-footer">
                    <div class="thank-you">
                        <p>Thank you for choosing MentalEase!</p>
                    </div>
                    <div class="footer-note">
                        <p>This is an official receipt. Please keep this for your records.</p>
                        <p>For any inquiries, please contact our customer service.</p>
                    </div>
                    <div class="cashier-info">
                        <p>Processed by: {{ session('user')->name ?? 'Cashier' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #receipt, #receipt * {
            visibility: visible;
        }
        #receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .header-actions, .page-header, .breadcrumb {
            display: none !important;
        }
    }
</style>