<link rel="stylesheet" href="{{ asset('style/assessmentresults.css') }}">

<div class="results-container">
    <div class="results-header">
        <div class="back-button">
            <a href="{{ route('welcomepatient') }}" class="back-to-home">
                <i class="fa-solid fa-arrow-left"></i> Back to Home
            </a>
        </div>
        <h1>Your DASS-21 Assessment Results</h1>
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
        
        <div class="results-scores">
            <div class="score-card">
                <div class="score-header">
                    <h3>Depression</h3>
                    <i class="fa-solid fa-face-sad-tear"></i>
                </div>
                <div class="score-value {{ strtolower($depressionLevel) }}">
                    {{ $depressionLevel }}
                </div>
                <div class="score-details">
                    Score: {{ $depressionScore }}/42
                </div>
                <div class="score-meter">
                    <div class="meter-bar">
                        <div class="meter-indicator" style="width: {{ ($depressionScore / 42) * 100 }}%"></div>
                    </div>
                    <div class="meter-labels">
                        <span>Normal</span>
                        <span>Mild</span>
                        <span>Moderate</span>
                        <span>Severe</span>
                        <span>Extreme</span>
                    </div>
                </div>
                <div class="score-description">
                    <p>Measures hopelessness, low self-esteem, and lack of interest in life.</p>
                </div>
            </div>
            
            <div class="score-card">
                <div class="score-header">
                    <h3>Anxiety</h3>
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div class="score-value {{ strtolower($anxietyLevel) }}">
                    {{ $anxietyLevel }}
                </div>
                <div class="score-details">
                    Score: {{ $anxietyScore }}/42
                </div>
                <div class="score-meter">
                    <div class="meter-bar">
                        <div class="meter-indicator" style="width: {{ ($anxietyScore / 42) * 100 }}%"></div>
                    </div>
                    <div class="meter-labels">
                        <span>Normal</span>
                        <span>Mild</span>
                        <span>Moderate</span>
                        <span>Severe</span>
                        <span>Extreme</span>
                    </div>
                </div>
                <div class="score-description">
                    <p>Measures autonomic arousal, skeletal muscle effects, and situational anxiety.</p>
                </div>
            </div>
            
            <div class="score-card">
                <div class="score-header">
                    <h3>Stress</h3>
                    <i class="fa-solid fa-brain"></i>
                </div>
                <div class="score-value {{ strtolower($stressLevel) }}">
                    {{ $stressLevel }}
                </div>
                <div class="score-details">
                    Score: {{ $stressScore }}/42
                </div>
                <div class="score-meter">
                    <div class="meter-bar">
                        <div class="meter-indicator" style="width: {{ ($stressScore / 42) * 100 }}%"></div>
                    </div>
                    <div class="meter-labels">
                        <span>Normal</span>
                        <span>Mild</span>
                        <span>Moderate</span>
                        <span>Severe</span>
                        <span>Extreme</span>
                    </div>
                </div>
                <div class="score-description">
                    <p>Measures difficulty relaxing, nervous arousal, and being easily agitated.</p>
                </div>
            </div>
        </div>
        
        <div class="results-interpretation">
            <h3>What Your Score Means</h3>
            <p>
                The DASS-21 is not a clinical diagnostic tool, but it can help identify symptoms of depression, 
                anxiety, and stress that may benefit from professional support.
            </p>
            
            <div class="interpretation-details">
                @if($depressionLevel != 'Normal')
                <div class="interpretation-item">
                    <h4>Depression: {{ $depressionLevel }}</h4>
                    <p>
                        @if($depressionLevel == 'Mild')
                            You're experiencing some symptoms of depression that are slightly above normal.
                        @elseif($depressionLevel == 'Moderate')
                            You're experiencing notable symptoms of depression that may be impacting your daily life.
                        @elseif($depressionLevel == 'Severe')
                            You're experiencing significant symptoms of depression that are likely impacting multiple areas of your life.
                        @elseif($depressionLevel == 'Extremely Severe')
                            You're experiencing very intense symptoms of depression that are significantly impacting your quality of life.
                        @endif
                    </p>
                </div>
                @endif
                
                @if($anxietyLevel != 'Normal')
                <div class="interpretation-item">
                    <h4>Anxiety: {{ $anxietyLevel }}</h4>
                    <p>
                        @if($anxietyLevel == 'Mild')
                            You're experiencing some symptoms of anxiety that are slightly above normal.
                        @elseif($anxietyLevel == 'Moderate')
                            You're experiencing notable symptoms of anxiety that may be impacting your daily life.
                        @elseif($anxietyLevel == 'Severe')
                            You're experiencing significant symptoms of anxiety that are likely impacting multiple areas of your life.
                        @elseif($anxietyLevel == 'Extremely Severe')
                            You're experiencing very intense symptoms of anxiety that are significantly impacting your quality of life.
                        @endif
                    </p>
                </div>
                @endif
                
                @if($stressLevel != 'Normal')
                <div class="interpretation-item">
                    <h4>Stress: {{ $stressLevel }}</h4>
                    <p>
                        @if($stressLevel == 'Mild')
                            You're experiencing some symptoms of stress that are slightly above normal.
                        @elseif($stressLevel == 'Moderate')
                            You're experiencing notable symptoms of stress that may be impacting your daily life.
                        @elseif($stressLevel == 'Severe')
                            You're experiencing significant symptoms of stress that are likely impacting multiple areas of your life.
                        @elseif($stressLevel == 'Extremely Severe')
                            You're experiencing very intense symptoms of stress that are significantly impacting your quality of life.
                        @endif
                    </p>
                </div>
                @endif
            </div>
        </div>
        
        <div class="recommendations">
            <h3>Recommendations</h3>
            
            @if(isset($recommendations['depression']) && $depressionLevel != 'Normal')
            <div class="recommendation-section">
                <h4>For Depression</h4>
                <ul>
                    @foreach($recommendations['depression'] as $recommendation)
                    <li>{{ $recommendation }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if(isset($recommendations['anxiety']) && $anxietyLevel != 'Normal')
            <div class="recommendation-section">
                <h4>For Anxiety</h4>
                <ul>
                    @foreach($recommendations['anxiety'] as $recommendation)
                    <li>{{ $recommendation }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if(isset($recommendations['stress']) && $stressLevel != 'Normal')
            <div class="recommendation-section">
                <h4>For Stress</h4>
                <ul>
                    @foreach($recommendations['stress'] as $recommendation)
                    <li>{{ $recommendation }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if($depressionLevel == 'Normal' && $anxietyLevel == 'Normal' && $stressLevel == 'Normal')
            <div class="recommendation-section">
                <h4>Maintaining Your Well-being</h4>
                <ul>
                    <li>Continue your current mental wellness practices</li>
                    <li>Maintain social connections and activities you enjoy</li>
                    <li>Regular exercise and healthy diet</li>
                    <li>Practice mindfulness and relaxation techniques</li>
                    <li>Get adequate sleep and rest</li>
                </ul>
            </div>
            @endif
        </div>
        
        <div class="next-steps">
            <h3>Next Steps</h3>
            <div class="next-steps-options">
                <a href="{{ route('assessment.pss') }}" class="next-step-card">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <h4>Take PSS Assessment</h4>
                    <p>Assess your perceived stress levels</p>
                </a>
                
                <a href="{{ route('appointment.selectPsychometrician') }}" class="next-step-card">
                    <i class="fa-solid fa-calendar-check"></i>
                    <h4>Schedule Consultation</h4>
                    <p>Speak with a mental health professional</p>
                </a>
                
                <a href="#" class="next-step-card">
                    <i class="fa-solid fa-book-open"></i>
                    <h4>Explore Resources</h4>
                    <p>Learn coping strategies and techniques</p>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate the meter indicators
    const indicators = document.querySelectorAll('.meter-indicator');
    
    indicators.forEach(indicator => {
        const finalWidth = indicator.style.width;
        indicator.style.width = '0';
        
        setTimeout(() => {
            indicator.style.width = finalWidth;
        }, 300);
    });
    
    // Add threshold markers to the meter bars
    const meterBars = document.querySelectorAll('.meter-bar');
    
    meterBars.forEach((bar, index) => {
        // Different thresholds for depression, anxiety, and stress
        let thresholds = [];
        
        if (index === 0) {
            // Depression thresholds: Normal (0-9), Mild (10-13), Moderate (14-20), Severe (21-27), Extremely Severe (28+)
            thresholds = [9/42, 13/42, 20/42, 27/42];
        } else if (index === 1) {
            // Anxiety thresholds: Normal (0-7), Mild (8-9), Moderate (10-14), Severe (15-19), Extremely Severe (20+)
            thresholds = [7/42, 9/42, 14/42, 19/42];
        } else {
            // Stress thresholds: Normal (0-14), Mild (15-18), Moderate (19-25), Severe (26-33), Extremely Severe (34+)
            thresholds = [14/42, 18/42, 25/42, 33/42];
        }
        
        thresholds.forEach(threshold => {
            const marker = document.createElement('div');
            marker.className = 'threshold-marker';
            marker.style.left = (threshold * 100) + '%';
            bar.appendChild(marker);
        });
    });
});
</script>
