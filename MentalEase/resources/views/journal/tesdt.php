<link rel="stylesheet" href="{{ asset('style/journal.css') }}">

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <small class="text-muted">
                {{ $journalEntry->created_at ? $journalEntry->created_at->format('F d, Y h:i A') : '' }}
            </small>
        </div>
        <div class="card-body">
            <p class="mb-1"><strong>Mood:</strong> {{ $journalEntry->mood ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Emotion:</strong> {{ $journalEntry->emotion ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Thoughts:</strong> {{ Str::limit($journalEntry->thoughts ?? '') }}</p>
        </div>
        <div class="card-footer text-end">
            <form method="POST" action="{{ route('journal.delete', $journalEntry->id) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this journal entry?')">Delete</button>
            </form>
            <a href="{{ route('journal.list') }}" class="btn btn-secondary ms-2">Back to Journals</a>
        </div>
    </div>
</div>
