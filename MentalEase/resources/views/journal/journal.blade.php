<div class="container">
    <h2>Your Journals</h2>
    <a href="{{ route('journal.add') }}" class="btn btn-primary mb-3">Add Journal</a>
    @if(empty($journals))
        <p>You have no journal entries yet.</p>
    @else
        <div class="list-group">
            @foreach($journals as $journal)
                <a href="{{ route('journal.show', $journal->id) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">Journal</h5>
                    <small>{{ $journal->created_at->format('F d, Y') }}</small>
                    <p class="mb-1"><strong>Mood:</strong> {{ $journal->mood ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Emotion:</strong> {{ $journal->emotion ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Thoughts:</strong> {{ Str::limit($journal->thoughts ?? '', 100) }}</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
