<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt #{{ $invoice->reference_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 11pt;
        }
        .receipt-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .receipt-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .logo img {
            max-width: 80px;
        }
        .company-info {
            text-align: right;
            font-size: 10pt;
        }
        .company-info h2 {
            margin: 0 0 5px 0;
            font-size: 14pt;
        }
        .company-info p {
            margin: 0 0 3px 0;
        }
        .receipt-title {
            text-align: center;
            margin-bottom: 10px;
        }
        .receipt-title h1 {
            margin: 0 0 5px 0;
            font-size: 16pt;
        }
        .receipt-title div {
            margin: 2px 0;
        }
        .receipt-customer, .receipt-items, .receipt-payment {
            margin-bottom: 10px;
        }
        .receipt-customer h3, .receipt-items h3, .receipt-payment h3 {
            margin: 5px 0;
            font-size: 12pt;
        }
        .receipt-customer div, .receipt-payment div {
            margin: 2px 0;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        .items-table th {
            background-color: #f2f2f2;
        }
        .receipt-footer {
            margin-top: 15px;
            text-align: center;
            font-size: 10pt;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .receipt-footer p {
            margin: 2px 0;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="receipt-container">
        <div class="receipt-header">
            <div class="logo">
                <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo">
            </div>
            <div class="company-info">
                <h2>MentalEase</h2>
                <p>Sanda Diagnostic Center</p>
                <p>Sanda BLDG, 1418 Lacson Ave, Sampaloc, City Of Manila, 1008 Kalakhang Maynila</p>
                <p>Phone: 0939 929 1293</p>
            </div>
        </div>
        
        <div class="receipt-title">
            <h1>OFFICIAL RECEIPT</h1>
            <div>
                <span>Receipt #: {{ $invoice->reference_number }}</span> | 
                <span>Date: {{ $invoice->created_at->format('F d, Y h:i A') }}</span>
            </div>
        </div>
        
        <div class="receipt-customer">
            <h3>Customer Information</h3>
            <div>
                <span>Name: {{ $invoice->client ? $invoice->client->name : 'Unknown Client' }}</span>
                @if($invoice->client)
                    | <span>Email: {{ $invoice->client->email }}</span>
                    | <span>Phone: {{ $invoice->client->contactnumber ?? 'N/A' }}</span>
                @endif
            </div>
        </div>
        
        <div class="receipt-items">
            <h3>Payment Details</h3>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="width: 25%;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $invoice->service_type ?? 'Mental Health Service' }}</td>
                        <td>₱{{ number_format($invoice->amount, 2) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>₱{{ number_format($invoice->amount, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="receipt-payment">
            <h3>Payment Information</h3>
            <div>
                <span>Payment Method: {{ ucfirst(str_replace('_', ' ', $invoice->payment_method ?? 'Online Payment')) }}</span>
                | <span>Status: {{ ucfirst($invoice->payment_status) }}</span>
                @if(isset($invoice->notes))
                    | <span>Notes: {{ $invoice->notes }}</span>
                @endif
            </div>
        </div>
        
        <div class="receipt-footer">
            <p>Thank you for choosing MentalEase!</p>
            <p>This is an official receipt. Please keep this for your records.</p>
            <p>Processed by: {{ session('user')->name ?? 'Cashier' }}</p>
        </div>
    </div>
</body>
</html>
