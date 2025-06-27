<div class="container">
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
</div>