<link rel="stylesheet" href="{{ asset('style/assessment.css') }}">

<div class="assessment-fullscreen">
    <div class="assessment-header">
        <h1>Depression Anxiety Stress Scale-21 Assessment</h1>
        <div class="assessment-icon">
            <i class="fa-solid fa-heart-pulse"></i>
        </div>
    </div>
    
    <div class="assessment-content">
        <div class="assessment-intro">
            <h2>About This Assessment</h2>
            <p>This questionnaire is designed to assess your emotional state over the past week. 
                It includes 21 statements relating to symptoms of depression, anxiety, and stress.
            </p>
            <p> Your responses are confidential and will be used to generate personalized 
                feedback about your emotional well-being.</p>
        </div>
        
        <div class="assessment-details-row">
            <div class="detail-item">
                <i class="fa-regular fa-clock"></i>
                <span>Time: 10-15 minutes</span>
            </div>
            <div class="detail-item">
                <i class="fa-solid fa-list-check"></i>
                <span>Questions: 21</span>
            </div>
            <div class="detail-item">
                <i class="fa-solid fa-lock"></i>
                <span>Confidential Results</span>
            </div>
        </div>
        
        <div class="assessment-benefits">
            <h3>Benefits</h3>
            <ul>
                <li>Gain insights into your emotional patterns</li>
                <li>Identify areas for personal growth</li>
                <li>Receive tailored recommendations</li>
                <li>Track your emotional well-being over time</li>
            </ul>
        </div>
        
        <div class="assessment-action">
            <a href="{{ route('assessment.dass.take') }}" class="btn btn-primary start-btn">
                <span>Start Assessment</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

