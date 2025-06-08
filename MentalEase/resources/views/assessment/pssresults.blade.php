<link rel="stylesheet" href="{{ asset('style/assessmentresults.css') }}">

<div class="results-container">
    <div class="results-header">
        <div class="back-button">
            <a href="{{ route('welcomepatient') }}" class="back-to-home">
                <i class="fa-solid fa-arrow-left"></i> Back to Home
            </a>
        </div>
        <h1>Your PSS Assessment Results</h1>
        <div class="results-icon">
            <i class="fa-solid fa-chart-line"></i>
        </div>
    </div>
    
    <div class="results-content">
                <div class="results-summary">
            <p>The DASS-21 measures three related states of depression, anxiety and stress. Your results indicate:</p>
            
            <div class="severity-legend">
                <div class="legend-title">Severity Levels:</div>
                <div class="legend-items">
                    <div class="legend-item">
                        <span class="legend-color normal"></span>
                        <span class="legend-label">Normal</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color mild"></span>
                        <span class="legend-label">Mild</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color moderate"></span>
                        <span class="legend-label">Moderate</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color severe"></span>
                        <span class="legend-label">Severe</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color extremely"></span>
                        <span class="legend-label">Extremely Severe</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="score-section">
            <div class="score-display">
                <div class="score-circle">
                    <span class="score-value">{{ $score }}</span>
                    <span class="score-max">/40</span>
                </div>
            </div>
            
            <div class="stress-level {{ strtolower(str_replace(' ', '-', $stressLevel)) }}">
                <h2>{{ $stressLevel }}</h2>
                <div class="stress-meter">
                    <div class="stress-bar">
                        <div class="stress-indicator" style="width: {{ ($score / 40) * 100 }}%"></div>
                    </div>
                    <div class="stress-labels">
                        <span>Low</span>
                        <span>Moderate</span>
                        <span>High</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="results-interpretation">
            <h3>What Your Score Means</h3>
            <p>
                The Perceived Stress Scale (PSS) measures your perception of stress in your life. 
                Scores ranging from 0-13 would be considered low stress, 14-26 moderate stress, 
                and 27-40 high perceived stress.
            </p>
            
            @if($stressLevel == 'Low Stress')
                <p>
                    Your score indicates that you're managing stress well. This suggests you have good coping 
                    mechanisms and resilience to life's challenges. Continue with your current stress management 
                    practices.
                </p>
            @elseif($stressLevel == 'Moderate Stress')
                <p>
                    Your score indicates a moderate level of perceived stress. While some stress is normal, 
                    it's important to develop effective coping strategies to prevent stress from becoming 
                    overwhelming.
                </p>
            @else
                <p>
                    Your score indicates a high level of perceived stress. This suggests you may be experiencing 
                    challenges in managing life's demands. It's important to address these stressors and develop 
                    effective coping strategies.
                </p>
            @endif
        </div>
        
        <div class="recommendations-section">
            <h3>Recommendations</h3>
            <ul class="recommendations-list">
                @foreach($recommendations as $recommendation)
                    <li>{{ $recommendation }}</li>
                @endforeach
            </ul>
        </div>
        
        <div class="next-steps">
            <h3>Next Steps</h3>
            <div class="next-steps-options">
                <a href="{{ route('assessment.dass') }}" class="next-step-card">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <h4>Take DASS-21 Assessment</h4>
                    <p>Assess depression, anxiety, and stress symptoms</p>
                </a>
                
                <a href="{{ route('appointment.selectPsychometrician') }}" class="next-step-card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h4>Schedule Consultation</h4>
                    <p>Speak with a mental health professional</p>
                </a>
                
                <a href="#" class="next-step-card">
                    <i class="fa-solid fa-book-open"></i>
                    <h4>Explore Resources</h4>
                    <p>Learn stress management techniques</p>
                </a>
            </div>
        </div>
    </div>
</div>
