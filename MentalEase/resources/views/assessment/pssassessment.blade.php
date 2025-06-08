<link rel="stylesheet" href="{{ asset('style/assessmenttest.css') }}">

<div class="assessment-test-container">
    <div class="assessment-test-header">
        <h1>Perceived Stress Scale (PSS)</h1>
        <p class="assessment-instructions">
            The questions in this scale ask you about your feelings and thoughts during the last month. 
            In each case, please indicate how often you felt or thought a certain way.
        </p>
    </div>

    <form id="pssForm" method="POST" action="{{ route('assessment.pss.submit') }}">
        @csrf
        
        <div class="question-scale-info">
            <div class="scale-item">0 = Never</div>
            <div class="scale-item">1 = Almost Never</div>
            <div class="scale-item">2 = Sometimes</div>
            <div class="scale-item">3 = Fairly Often</div>
            <div class="scale-item">4 = Very Often</div>
        </div>

        <div class="assessment-questions">
            <!-- Question 1 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">1.</span>
                    <p>In the last month, how often have you been upset because of something that happened unexpectedly?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q1" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">2.</span>
                    <p>In the last month, how often have you felt that you were unable to control the important things in your life?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q2" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">3.</span>
                    <p>In the last month, how often have you felt nervous and stressed?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q3" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">4.</span>
                    <p>In the last month, how often have you felt confident about your ability to handle your person</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q4" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

                        <!-- Question 5 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">5.</span>
                    <p>In the last month, how often have you felt that things were going your way?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q5" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

                        <!-- Question 6 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">6.</span>
                    <p>In the last month, how often have you found that you could not cope with all the things that you had to do?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q6" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

                        <!-- Question 7 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">7.</span>
                    <p>In the last month, how often have you been able to control irritations in your life?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q7" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

                        <!-- Question 8 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">8.</span>
                    <p>In the last month, how often have you felt that you were on top of things?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q8" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

                        <!-- Question 9 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">9.</span>
                    <p>In the last month, how often have you been angered because of things that happened that were outside of your control?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q9" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

                        <!-- Question 10 -->
            <div class="question-item">
                <div class="question-text">
                    <span class="question-number">10.</span>
                    <p>In the last month, how often have you felt difficulties were piling up so high that you could not overcome them?</p>
                </div>
                <div class="question-options">
                    <label class="option-label">
                        <input type="radio" name="q10" value="0" required>
                        <span class="option-text">Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="1">
                        <span class="option-text">Almost Never</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="2">
                        <span class="option-text">Sometimes</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="3">
                        <span class="option-text">Fairly Often</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="4">
                        <span class="option-text">Very Often</span>
                    </label>
                </div>
            </div>

        <div class="assessment-progress">
            <div class="progress-bar">
                <div class="progress-indicator" id="progressIndicator"></div>
            </div>
            <div class="progress-text">
                <span id="questionsAnswered">0</span> of 10 questions answered
            </div>
        </div>
            
            <div class="assessment-navigation">
                <button type="submit" class="submit-btn">
                    Submit Assessment
                    <i class="fa-solid fa-check-circle"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('pssForm');
    const submitBtn = document.getElementById('submitBtn');
    const progressIndicator = document.getElementById('progressIndicator');
    const questionsAnswered = document.getElementById('questionsAnswered');
    const totalQuestions = 10;
    let answeredCount = 0;

    // Function to update progress
    function updateProgress() {
        answeredCount = document.querySelectorAll('input[type="radio"]:checked').length;
        const progress = (answeredCount / totalQuestions) * 100;

        progressIndicator.style.width = progress + '%';
        questionsAnswered.textContent = answeredCount;

        // Enable submit button if all questions are answered
        submitBtn.disabled = answeredCount !== totalQuestions;
    }

    // Add event listeners to all radio buttons
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', updateProgress);
    });

    updateProgress();

    form.addEventListener('submit', function(event) {
        const questions = form.querySelectorAll('.question-item');
        let allAnswered = true;

        questions.forEach(function(question, index) {
            const questionNumber = index + 1;
            const answered = form.querySelector(`input[name="q${questionNumber}"]:checked`);

            if (!answered) {
                allAnswered = false;
                question.classList.add('unanswered');
            } else {
                question.classList.remove('unanswered');
            }
        });

        if (!allAnswered) {
            event.preventDefault(); 
            alert("Please answer all questions before submitting the form.");
        }
    });
});
</script>




