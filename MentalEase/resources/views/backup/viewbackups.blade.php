<link rel="stylesheet" href="{{ asset('style/viewbackups.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

{{-- <div class="container">
    <h2>Available Backups</h2>
    @if($files->isEmpty())
        <p>No backups found.</p>
    @else
        <ul>
            @foreach($files as $file)
                <li>
                    {{ $file }}
                    <a href="{{ route('backups.download', $file) }}" class="btn btn-sm btn-primary">Download</a>
                </li>
            @endforeach
        </ul>
    @endif
</div> --}}

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Backup Files</h2>
        <a href="{{ route('backups.create') }}" class="btn btn-primary">
            Backup Now
        </a>
    </div>

    @if ($backups->isEmpty())
        <p>No backups found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Filename</th>
                    <th>Size</th>
                    <th>Last Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($backups as $backup)
                    <tr>
                        <td>{{ $backup['name'] }}</td>
                        <td>{{ number_format($backup['size'] / 1024, 2) }} KB</td>
                        <td>{{ \Carbon\Carbon::createFromTimestamp($backup['last_modified'])->toDayDateTimeString() }}</td>
                        <td>
                            <a href="{{ route('backups.download', $backup['name']) }}" class="btn btn-success btn-sm">
                                Download
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
