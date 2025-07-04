<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Users PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Active Users List</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Contact Number</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->client->name ?? 'N/A' }}</td>
                <td>{{ $appointment->date ?? 'N/A' }}</td>
                <td>{{ $appointment->start_time ?? 'N/A' }}</td>
                <td>{{ $appointment->status ?? 'N/A' }}</td>
                <!-- Add more fields as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
