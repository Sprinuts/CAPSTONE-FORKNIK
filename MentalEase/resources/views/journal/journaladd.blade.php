<form method="POST" action="{{ route('journal.store') }}">
    @csrf
    <div class="max-w-md mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">How are you feeling today?</h2>
        <div class="flex space-x-2 mb-6">
            @foreach(['Sad', 'Meh', 'Okay', 'Good', 'Great'] as $mood)
                <button type="button" 
                    class="px-4 py-2 rounded bg-gray-200 hover:bg-blue-200 focus:bg-blue-400 mood-btn"
                    data-mood="{{ $mood }}">
                    {{ $mood }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="mood" id="selected-mood">

        <h3 class="text-lg font-semibold mb-2">What emotions are you feeling?</h3>
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach(['Anxious', 'Calm', 'Joyful', 'Angry', 'Excited', 'Tired', 'Hopeful', 'Frustrated'] as $emotion)
                <button type="button" 
                    class="px-3 py-1 rounded-full bg-gray-100 hover:bg-blue-100 focus:bg-blue-300 emotion-btn"
                    data-emotion="{{ $emotion }}">
                    {{ $emotion }}
                </button>
            @endforeach
        </div>
        <input type="hidden" name="emotion" id="selected-emotions">

        <h3 class="text-lg font-semibold mb-2">What's on your mind?</h3>
        <textarea name="thoughts" class="w-full p-2 border rounded mb-4" rows="4" placeholder="Share your thoughts..."></textarea>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Save Journal Entry</button>
    </div>
</form>

<script>
    // Mood selection (single)
    document.querySelectorAll('.mood-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('selected-mood').value = this.dataset.mood;
            document.querySelectorAll('.mood-btn').forEach(b => b.classList.remove('bg-blue-400', 'text-white'));
            this.classList.add('bg-blue-400', 'text-white');
        });
    });

    // Emotions selection (multiple)
    const selectedEmotions = [];
    document.querySelectorAll('.emotion-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const emotion = this.dataset.emotion;
            if (selectedEmotions.includes(emotion)) {
                selectedEmotions.splice(selectedEmotions.indexOf(emotion), 1);
                this.classList.remove('bg-blue-300', 'text-white');
            } else {
                selectedEmotions.push(emotion);
                this.classList.add('bg-blue-300', 'text-white');
            }
            document.getElementById('selected-emotions').value = selectedEmotions.join(', ');
        });
    });
</script>
