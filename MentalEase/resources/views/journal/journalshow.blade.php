<link rel="stylesheet" href="{{ asset('style/journal-list.css') }}">

<div class="main-content">
    <div class="top-bar shadow-sm">
        <h1 class="text-2xl font-bold">Journal Entry</h1>
        <a href="{{ route('journal.list') }}" class="view-journals-btn">
            <i class="fas fa-book"></i>
            <span>Back to Journals</span>
        </a>
    </div>

    <div class="journal-container">
        <div class="journal-card single-entry">
            <div class="journal-date">
                <div class="date-day">{{ $journalEntry->created_at->format('d') }}</div>
                <div class="date-month">{{ $journalEntry->created_at->format('M') }}</div>
                <div class="date-year">{{ $journalEntry->created_at->format('Y') }}</div>
            </div>
            <div class="journal-content">
                <div class="journal-time">
                    <i class="far fa-clock"></i> {{ $journalEntry->created_at->format('h:i A') }}
                </div>
                
                <div class="journal-mood">
                    <span class="mood-label">Mood:</span>
                    <span class="mood-value">{{ $journalEntry->mood ?? 'N/A' }}</span>
                    @if($journalEntry->mood)
                        <span class="mood-emoji">
                            @switch($journalEntry->mood)
                                @case('Sad')
                                    😢
                                    @break
                                @case('Meh')
                                    😐
                                    @break
                                @case('Okay')
                                    🙂
                                    @break
                                @case('Good')
                                    😊
                                    @break
                                @case('Great')
                                    😁
                                    @break
                                @default
                                    
                            @endswitch
                        </span>
                    @endif
                </div>
                
                <div class="journal-emotions">
                    @if($journalEntry->emotion)
                        @foreach(explode(',', $journalEntry->emotion) as $emotion)
                            <span class="emotion-tag">{{ $emotion }}</span>
                        @endforeach
                    @else
                        <span class="no-emotions">No emotions recorded</span>
                    @endif
                </div>
                
                <div class="journal-thoughts-full">
                    <h3 class="thoughts-title">Thought:</h3>
                    <p>{{ $journalEntry->thoughts ?? 'No thoughts recorded.' }}</p>
                </div>
                
                <div class="journal-actions mt-4">
                    <a href="{{ route('journal.edit', $journalEntry->id) }}" class="edit-btn">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('journal.delete', $journalEntry->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this journal entry?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


