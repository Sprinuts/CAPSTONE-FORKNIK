
<div class="container mt-4">
    <h2>Payment Records</h2>
    {{-- <a href="{{ route('appointment.pdf') }}" class="btn btn-lg btn-primary adjustBtn" target="_blank">Generate PDF</a> --}}
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Reference Number</th>
                <th>User Name</th>
                <th>Status</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->reference_number}}
                <td>{{ $invoice->client ? $invoice->client->name : 'N/A' }}</td>
                <td>{{ $invoice->payment_status }}</td>
                <!-- Add more fields as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
