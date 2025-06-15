<link rel="stylesheet" href="{{ asset('style/journal-list.css') }}">

<div class="main-content">
    <div class="top-bar shadow-sm">
        <h1 class="text-2xl font-bold">My Journal Entries</h1>
        <a href="{{ route('journal') }}" class="new-entry-btn">
            <i class="fas fa-plus"></i>
            <span>New Entry</span>
        </a>
    </div>

    <div class="journal-container">
        <div class="journal-header">
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="journalSearch" placeholder="Search journals..." class="search-input">
                </div>
                <div class="filter-dropdown">
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>
                    <div class="filter-menu">
                        <div class="filter-option">
                            <input type="radio" id="all" name="filter" value="all" checked>
                            <label for="all">All Entries</label>
                        </div>
                        <div class="filter-option">
                            <input type="radio" id="thisWeek" name="filter" value="thisWeek">
                            <label for="thisWeek">This Week</label>
                        </div>
                        <div class="filter-option">
                            <input type="radio" id="thisMonth" name="filter" value="thisMonth">
                            <label for="thisMonth">This Month</label>
                        </div>
                        <div class="filter-option">
                            <input type="radio" id="lastMonth" name="filter" value="lastMonth">
                            <label for="lastMonth">Last Month</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="journals-grid">
            @if($journals->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>No Journal Entries Yet</h3>
                    <p>Start documenting your wellness journey today.</p>
                    <a href="{{ route('journal') }}" class="create-first-btn">Create Your First Entry</a>
                </div>
            @else
                @foreach($journals as $journal)
                    <div class="journal-card">
                        <div class="journal-date">
                            <div class="date-day">{{ $journal->created_at->format('d') }}</div>
                            <div class="date-month">{{ $journal->created_at->format('M') }}</div>
                            <div class="date-year">{{ $journal->created_at->format('Y') }}</div>
                        </div>
                        <div class="journal-content">
                            <div class="journal-mood">
                                <span class="mood-label">Mood:</span>
                                <span class="mood-value">{{ $journal->mood ?? 'N/A' }}</span>
                                @if($journal->mood)
                                    <span class="mood-emoji">
                                        @switch($journal->mood)
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
                                @if($journal->emotion)
                                    @foreach(explode(',', $journal->emotion) as $emotion)
                                        <span class="emotion-tag">{{ $emotion }}</span>
                                    @endforeach
                                @else
                                    <span class="no-emotions">No emotions recorded</span>
                                @endif
                            </div>
                            <div class="journal-thoughts">
                                <p>{{ Str::limit($journal->thoughts ?? '', 120) }}</p>
                            </div>
                            <div class="journal-actions">
                                <a href="{{ route('journal.show', $journal->id) }}" class="view-btn">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        @if(!$journals->isEmpty() && $journals->hasPages())
        <div class="pagination-container">
            {{ $journals->links('pagination::bootstrap-4') }}
        </div>
        @endif
    </div>
</div>

<script>
    // Toggle filter dropdown
    const filterBtn = document.querySelector('.filter-btn');
    const filterMenu = document.querySelector('.filter-menu');
    
    if (filterBtn) {
        filterBtn.addEventListener('click', function() {
            filterMenu.classList.toggle('show');
        });
        
        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.filter-dropdown')) {
                filterMenu.classList.remove('show');
            }
        });
    }
    
    // Search functionality
    const searchInput = document.getElementById('journalSearch');
    const journalCards = document.querySelectorAll('.journal-card');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            journalCards.forEach(card => {
                const content = card.textContent.toLowerCase();
                if (content.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>



