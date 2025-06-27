<!DOCTYPE html>
<html>
<head>
    <title>Database Backup</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { background: #f0f0f0; padding: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 5px; }
    </style>
</head>
<body>
    <h1>Database Backup - {{ now()->toDateTimeString() }}</h1>

    @foreach($data as $table => $records)
        <h2>{{ $table }}</h2>
        @if(count($records))
        <table>
            <thead>
                <tr>
                    @foreach(array_keys((array)$records[0]) as $column)
                        <th>{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($records as $row)
                    <tr>
                        @foreach((array)$row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No records found.</p>
        @endif
    @endforeach
</body>
</html>
