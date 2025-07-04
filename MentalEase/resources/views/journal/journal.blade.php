<link rel="stylesheet" href="{{ asset('style/journal.css') }}">

<div class="main-content">
    <div class="top-bar shadow-sm">
        <h1 class="text-2xl font-bold">Journal</h1>
        <a href="{{ route('journal.list') }}" class="view-journals-btn">
            <i class="fas fa-book"></i>
            <span>View My Journals</span>
        </a>
    </div>

    <div class="dashboard-header">
        <div class="dashboard-title-button">
            <h2 class="text-xl font-semibold">My Wellness Journal</h2>
            <div class="flex items-center">
                <span class="date-display mr-2">{{ date('l, F j, Y') }}</span>
                <span class="entry-badge">Daily Entry</span>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('journal.store') }}" class="journal-form">
        @csrf
        <div class="journal-card">
            
            <!-- Mood Section -->
            <div class="form-section">
                <h2 class="section-title">
                    How are you feeling today?
                </h2>
                <div class="mood-container">
                    @foreach([
                        ['Sad', '😢', 'bg-blue-100'], 
                        ['Meh', '😐', 'bg-gray-100'], 
                        ['Okay', '🙂', 'bg-green-100'], 
                        ['Good', '😊', 'bg-yellow-100'], 
                        ['Great', '😁', 'bg-orange-100']
                    ] as [$mood, $emoji, $bgColor])
                        <button type="button" 
                            class="mood-btn {{ $bgColor }}"
                            data-mood="{{ $mood }}">
                            <span class="mood-emoji">{{ $emoji }}</span>
                            <span class="mood-text">{{ $mood }}</span>
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="mood" id="selected-mood">
                <div id="mood-feedback" class="feedback-message hidden">
                    You're feeling <span id="selected-mood-text"></span> today
                </div>
            </div>

            <!-- Emotions Section -->
            <div class="form-section">
                <h3 class="section-title">
                    What emotions are you experiencing?
                </h3>
                <p class="section-subtitle">Select all that apply to you right now</p>
                <div class="emotions-container">
                    @foreach([
                        // Primary emotions (inner wheel)
                        ['Joy', '😊', 'bg-yellow-50'],
                        ['Trust', '🤝', 'bg-green-50'],
                        ['Fear', '😨', 'bg-purple-50'],
                        ['Surprise', '😲', 'bg-blue-50'],
                        ['Sadness', '😢', 'bg-indigo-50'],
                        ['Disgust', '🤢', 'bg-teal-50'],
                        ['Anger', '😠', 'bg-red-50'],
                        ['Anticipation', '🤔', 'bg-orange-50'],
                        
                        // Secondary emotions (middle wheel)
                        ['Serenity', '😌', 'bg-yellow-100'],
                        ['Acceptance', '👍', 'bg-green-100'],
                        ['Apprehension', '😰', 'bg-purple-100'],
                        ['Distraction', '😵', 'bg-blue-100'],
                        ['Pensiveness', '😔', 'bg-indigo-100'],
                        ['Boredom', '😒', 'bg-teal-100'],
                        ['Annoyance', '😤', 'bg-red-100'],
                        ['Interest', '🧐', 'bg-orange-100'],
                        
                        // Tertiary emotions (outer wheel)
                        ['Ecstasy', '🥳', 'bg-yellow-200'],
                        ['Admiration', '🥰', 'bg-green-200'],
                        ['Terror', '😱', 'bg-purple-200'],
                        ['Amazement', '😮', 'bg-blue-200'],
                        ['Grief', '😭', 'bg-indigo-200'],
                        ['Loathing', '🤮', 'bg-teal-200'],
                        ['Rage', '😡', 'bg-red-200'],
                        ['Vigilance', '👀', 'bg-orange-200']
                    ] as [$emotion, $emoji, $bgColor])
                        <button type="button" 
                            class="emotion-btn {{ $bgColor }}"
                            data-emotion="{{ $emotion }}">
                            <span class="emotion-emoji">{{ $emoji }}</span>
                            <span class="emotion-text">{{ $emotion }}</span>
                        </button>
                    @endforeach
                </div>
                <input type="hidden" name="emotion" id="selected-emotions">
                <div id="emotions-count" class="feedback-message hidden">
                    <span id="emotions-selected">0</span> emotions selected
                </div>
            </div>

            <!-- Thoughts Section -->
            <div class="form-section">
                <h3 class="section-title">
                    What's on your mind?
                </h3>
                <div class="relative">
                    <textarea 
                        name="thoughts" 
                        class="input-field" 
                        rows="5" 
                        placeholder="Share your thoughts, feelings, or experiences..."
                    ></textarea>
                    <div class="char-counter">
                        <span id="char-count">0</span> characters
                    </div>
                </div>
            </div>

            {{-- <!-- Gratitude Section -->
            <div class="form-section">
                <h3 class="section-title">
                    What are you grateful for today?
                </h3>
                <input 
                    type="text" 
                    name="gratitude" 
                    class="input-field" 
                    placeholder="I am grateful for..."
                >
            </div> --}}

            <!-- Submit Button -->
            <div class="form-actions">
                <button type="submit" class="submit-button">
                    Save Journal Entry
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    // Mood selection (single)
    document.querySelectorAll('.mood-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const mood = this.dataset.mood;
            document.getElementById('selected-mood').value = mood;
            document.getElementById('selected-mood-text').textContent = mood.toLowerCase();
            document.getElementById('mood-feedback').classList.remove('hidden');
            
            // Visual feedback
            document.querySelectorAll('.mood-btn').forEach(b => {
                b.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });

    // Emotions selection (multiple)
    const selectedEmotions = [];
    document.querySelectorAll('.emotion-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const emotion = this.dataset.emotion;
            
            if (selectedEmotions.includes(emotion)) {
                selectedEmotions.splice(selectedEmotions.indexOf(emotion), 1);
                this.classList.remove('selected');
            } else {
                selectedEmotions.push(emotion);
                this.classList.add('selected');
            }
            
            document.getElementById('selected-emotions').value = selectedEmotions.join(',');
            
            // Update counter
            const count = selectedEmotions.length;
            document.getElementById('emotions-selected').textContent = count;
            document.getElementById('emotions-count').classList.toggle('hidden', count === 0);
        });
    });

    // Character counter for thoughts
    const textarea = document.querySelector('textarea[name="thoughts"]');
    const charCount = document.getElementById('char-count');
    
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // Add animation when form loads
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.journal-card');
        setTimeout(() => {
            form.classList.add('fade-in');
        }, 300);
    });
</script>










