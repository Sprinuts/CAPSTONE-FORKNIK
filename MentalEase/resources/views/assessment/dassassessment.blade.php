<link rel="stylesheet" href="{{ asset('style/assessmenttest.css') }}">

<div class="assessment-test-container">
    <div class="assessment-test-header">
        <h1>Depression Anxiety Stress Scale (DASS-21)</h1>
        <p class="assessment-instructions">
            Please read each statement and select the option that indicates how much the statement 
            applied to you over the past week. There are no right or wrong answers. 
            Do not spend too much time on any statement.
        </p>
    </div>

    <form id="dassForm" method="POST" action="{{ route('assessment.dass.submit') }}">
        @csrf

        <div class="question-scale-info">
            <div class="scale-item">0 = Did not apply to me at all</div>
            <div class="scale-item">1 = Applied to me to some degree, or some of the time</div>
            <div class="scale-item">2 = Applied to me to a considerable degree, or a good part of time</div>
            <div class="scale-item">3 = Applied to me very much, or most of the time</div>
        </div>       

   <div class="assessment-questions">
            <!-- Stress Questions (S) -->
            <div class="question-item" id="q1">
                <div class="question-text">
                    <span class="question-number">1.</span>
                    <p>I found it hard to wind down</p>
                </div>
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q1" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q1" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>
            
            <!-- Anxiety Question (A) -->
            <div class="question-item" id="q2">
                <div class="question-text">
                    <span class="question-number">2.</span>
                    <p>I was aware of dryness of my mouth</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q2" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q2" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Depression Question (D) -->
            <div class="question-item" id="q3">
                <div class="question-text">
                    <span class="question-number">3.</span>
                    <p>I couldn’t seem to experience any positive feeling at all </p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q3" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q3" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Anxiety Question (A) -->
            <div class="question-item" id="q4">
                <div class="question-text">
                    <span class="question-number">4.</span>
                    <p>I experienced breathing difficulty 
                        (e.g. excessively rapid breathing, breathlessness in the absence of physical exertion)</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q4" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q4" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Depression Question (D) -->
            <div class="question-item" id="q5">
                <div class="question-text">
                    <span class="question-number">5.</span>
                    <p>I found it difficult to work up the initiative to do things</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q5" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q5" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Stress Question (S) -->
            <div class="question-item" id="q6">
                <div class="question-text">
                    <span class="question-number">6.</span>
                    <p>I tended to over-react to situations</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q6" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q6" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Anxiety Question (A) -->
            <div class="question-item" id="q7">
                <div class="question-text">
                    <span class="question-number">7.</span>
                    <p>I experienced trembling (e.g. in the hands)</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q7" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q7" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Stress Question (S) -->
            <div class="question-item" id="q8">
                <div class="question-text">
                    <span class="question-number">8.</span>
                    <p>I felt that I was using a lot of nervous energy</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q8" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q8" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Anxiety Question (A) -->
            <div class="question-item" id="q9">
                <div class="question-text">
                    <span class="question-number">9.</span>
                    <p>I was worried about situations in which I might panic and make a foo of myself</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q9" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q9" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Depression Question (D) -->
            <div class="question-item" id="q10">
                <div class="question-text">
                    <span class="question-number">10.</span>
                    <p>I felt that I had nothing to look forward to</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q10" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q10" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Stress Question (S) -->
            <div class="question-item" id="q11">
                <div class="question-text">
                    <span class="question-number">11.</span>
                    <p>I found myself getting agitated</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q11" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q11" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q11" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q11" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Stress Question (S) -->
            <div class="question-item" id="q12">
                <div class="question-text">
                    <span class="question-number">12.</span>
                    <p> I found it difficult to relax</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q12" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q12" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q12" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q12" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Depression Question (D) -->
            <div class="question-item" id="q13">
                <div class="question-text">
                    <span class="question-number">13.</span>
                    <p>I felt down-hearted and blue</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q13" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q13" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q13" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q13" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Stress Question (S) -->
            <div class="question-item" id="q14">
                <div class="question-text">
                    <span class="question-number">14.</span>
                    <p>I was intolerant of anything that kept me from getting on with what I was doing</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q14" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q14" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q14" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q14" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Anxiety Question (A) -->
            <div class="question-item" id="q15">
                <div class="question-text">
                    <span class="question-number">15.</span>
                    <p>I felt I was close to panic</p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q15" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q15" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q15" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q15" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

                        <!-- Depression Question (D) -->
            <div class="question-item" id="q16">
                <div class="question-text">
                    <span class="question-number">16.</span>
                    <p>I was unable to become enthusiastic about anything </p>
                </div>                
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q16" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q16" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q16" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q16" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>

            <!-- Depression Question (D) -->
            <div class="question-item" id="q17">
                <p class="question-text">17. I felt I wasn't worth much as a person.</p>
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q17" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q17" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q17" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q17" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>
            
            <!-- Stress Question (S) -->
            <div class="question-item" id="q18">
                <p class="question-text">18. I felt that I was rather touchy.</p>
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q18" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q18" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q18" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q18" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>
            
            <!-- Anxiety Question (A) -->
            <div class="question-item" id="q19">
                <p class="question-text">19. I was aware of the action of my heart in the absence of physical exertion (e.g., sense of heart rate increase, heart missing a beat).</p>
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q19" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q19" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q19" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q19" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>
            
            <!-- Anxiety Question (A) -->
            <div class="question-item" id="q20">
                <p class="question-text">20. I felt scared without any good reason.</p>
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q20" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q20" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q20" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q20" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>
            
            <!-- Depression Question (D) -->
            <div class="question-item" id="q21">
                <p class="question-text">21. I felt that life was meaningless.</p>
                <div class="options-group">
                    <label class="option-label">
                        <input type="radio" name="q21" value="0" required>
                        <span class="option-text">0</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q21" value="1">
                        <span class="option-text">1</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q21" value="2">
                        <span class="option-text">2</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="q21" value="3">
                        <span class="option-text">3</span>
                    </label>
                </div>
            </div>
        </div>
        
        <div class="assessment-progress">
            <div class="progress-bar">
                <div class="progress-indicator" id="progressIndicator"></div>
            </div>
            <div class="progress-text">
                <span id="questionsAnswered">0</span> of 21 questions answered
            </div>
        </div>
        
            <div class="assessment-navigation">
                <button type="submit" class="submit-btn">
                    Submit Assessment
                    <i class="fa-solid fa-check-circle"></i>
                </button>
        </div>
    </form>
</div>
  </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('dassForm');
        const submitBtn = document.getElementById('submitBtn');
        const progressIndicator = document.getElementById('progressIndicator');
        const questionsAnswered = document.getElementById('questionsAnswered');
        const totalQuestions = 21;
        let answeredCount = 0;
        
        // Function to update progress
        function updateProgress() {
            answeredCount = document.querySelectorAll('input[type="radio"]:checked').length;
            const progress = (answeredCount / totalQuestions) * 100;
            
            progressIndicator.style.width = progress + '%';
            questionsAnswered.textContent = answeredCount;
            
            // Enable submit button if all questions are answered
            if (answeredCount === totalQuestions) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }
        
        // Add event listeners to all radio buttons
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('change', updateProgress);
        });
        
        // Initialize progress
        updateProgress();
    });
</script>


