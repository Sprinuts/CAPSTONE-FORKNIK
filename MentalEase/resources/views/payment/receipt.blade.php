@extends('include.headercashier')

<link rel="stylesheet" href="{{ asset('style/payment.css') }}">

<script>
    function printReceipt() {
        // Focus on the receipt content
        document.getElementById('receipt').focus();
        
        // Print the page
        window.print();
        
        return false;
    }
</script>

<div class="container py-4">
    <div class="page-header mb-4">
        <h1 class="text-primary-dark"><i class="fas fa-receipt"></i> Payment Receipt</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 rounded">
                <li class="breadcrumb-item"><a href="{{ route('welcomecashier') }}" class="text-primary">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('payment.records') }}" class="text-primary">Payment Records</a></li>
                <li class="breadcrumb-item active" aria-current="page">Receipt</li>
            </ol>
        </nav>
    </div>

    <div class="card receipt-card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 style="color: white;">Receipt #{{ $invoice->reference_number }}</h2>
            <div class="header-actions">
                <a href="{{ route('payment.receipt.pdf', $invoice->id) }}" class="btn" 
                   style="background: linear-gradient(to right, var(--primary-color), var(--primary-light)); 
                          color: white; 
                          border-radius: var(--radius-md);
                          padding: 8px 16px;
                          font-weight: 600;
                          box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                          transition: all 0.3s ease;" 
                   onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';" 
                   onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';"
                   target="_blank">
                    <i class="fas fa-print mr-2"></i> Print Receipt
                </a>
            </div>
        </div>
        <div class="card-body bg-white">
            <div class="receipt-container p-4 border rounded" id="receipt">
                <div class="receipt-header">
                    <div class="logo">
                        <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo" class="img-fluid">
                    </div>
                    <div class="company-info">
                        <h2 class="text-primary-dark">MentalEase</h2>
                        <p>Sanda Diagnostic Center</p>
                        <p>Sanda BLDG, 1418 Lacson Ave, Sampaloc, City Of Manila, 1008 Kalakhang Maynila</p>
                        <p>Phone: 0939 929 1293</p>
                    </div>
                </div>
                
                <div class="receipt-title text-center my-4">
                    <h1 class="text-primary-dark">OFFICIAL RECEIPT</h1>
                    <div class="receipt-number d-flex justify-content-center">
                        <span class="font-weight-bold mr-2">Receipt #:</span>
                        <span>{{ $invoice->reference_number }}</span>
                    </div>
                    <div class="receipt-date d-flex justify-content-center">
                        <span class="font-weight-bold mr-2">Date:</span>
                        <span>{{ $invoice->created_at->format('F d, Y h:i A') }}</span>
                    </div>
                </div>
                
                <div class="receipt-customer mb-4">
                    <h3 class="text-primary-dark border-bottom pb-2">Customer Information</h3>
                    <div class="customer-details row mt-3">
                        <div class="detail-row col-md-4">
                            <span class="font-weight-bold text-muted">Name:</span>
                            <span>{{ $invoice->client ? $invoice->client->name : 'Unknown Client' }}</span>
                        </div>
                        @if($invoice->client)
                            <div class="detail-row col-md-4">
                                <span class="font-weight-bold text-muted">Email:</span>
                                <span>{{ $invoice->client->email }}</span>
                            </div>
                            <div class="detail-row col-md-4">
                                <span class="font-weight-bold text-muted">Phone:</span>
                                <span>{{ $invoice->client->contactnumber ?? 'N/A' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="receipt-items mb-4">
                    <h3 class="text-primary-dark border-bottom pb-2">Payment Details</h3>
                    <table class="items-table table table-bordered mt-3">
                        <thead class="bg-light">
                            <tr>
                                <th>Description</th>
                                <th class="text-right" style="width: 30%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $invoice->service_type ?? 'Mental Health Service' }}</td>
                                <td class="text-right">₱{{ number_format($invoice->amount, 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <th>Total</th>
                                <th class="text-right">₱{{ number_format($invoice->amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="receipt-payment mb-4">
                    <h3 class="text-primary-dark border-bottom pb-2">Payment Information</h3>
                    <div class="payment-details row mt-3">
                        <div class="detail-row col-md-4">
                            <span class="font-weight-bold text-muted">Payment Method:</span>
                            <span>{{ ucfirst(str_replace('_', ' ', $invoice->payment_method ?? 'Online Payment')) }}</span>
                        </div>
                        <div class="detail-row col-md-4">
                            <span class="font-weight-bold text-muted">Status:</span>
                            <span class="text-{{ $invoice->payment_status == 'paid' ? 'success' : 'warning' }} font-weight-bold">
                                {{ ucfirst($invoice->payment_status) }}
                            </span>
                        </div>
                        @if(isset($invoice->notes))
                            <div class="detail-row col-md-4">
                                <span class="font-weight-bold text-muted">Notes:</span>
                                <span>{{ $invoice->notes }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="receipt-footer text-center mt-5">
                    <div class="thank-you mb-2">
                        <p class="font-weight-bold">Thank you for choosing MentalEase!</p>
                    </div>
                    <div class="footer-note mb-3">
                        <p class="text-muted">This is an official receipt. Please keep this for your records.</p>
                        <p class="text-muted">For any inquiries, please contact our customer service.</p>
                    </div>
                    <div class="cashier-info mt-4 pt-3 border-top">
                        <p class="font-italic">Processed by: {{ session('user')->name ?? 'Cashier' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-primary-dark {
        color: var(--primary-dark);
    }
    
    .text-primary {
        color: var(--primary-color) !important;
    }
    
    .receipt-card {
        border: none;
        border-radius: var(--radius-md);
        overflow: hidden;
    }
    
    .receipt-container {
        background-color: white;
        box-shadow: var(--shadow-sm);
    }
    
    .badge-success {
        background-color: var(--success);
    }
    
    .badge-warning {
        background-color: var(--warning);
        color: #212529;
    }
    
    @media print {
        /* Reset visibility for all elements */
        body * {
            visibility: visible !important;
            display: none;
        }
        
        /* Only show the receipt */
        #receipt, #receipt * {
            visibility: visible !important;
            display: block;
        }
        
        #receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 15px;
        }
        
        /* Hide unnecessary elements */
        .header-actions, .page-header, .breadcrumb, nav, footer, .card-header {
            display: none !important;
        }
        
        /* Ensure tables display properly */
        table, tr, td, th {
            display: table;
            display: table-row;
            display: table-cell;
        }
        
        /* Ensure the logo displays */
        .logo img {
            display: block !important;
            max-width: 100px;
        }
    }
</style>






















