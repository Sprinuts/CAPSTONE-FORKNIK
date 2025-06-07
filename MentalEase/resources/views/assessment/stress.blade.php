<link rel="stylesheet" href="{{ asset('style/assessment.css') }}">

<div class="assessment-fullscreen">
    <div class="assessment-header">
        <h1>Stress Assessment</h1>
        <div class="assessment-icon">
            <i class="fa-solid fa-brain"></i>
        </div>
    </div>
    
    <div class="assessment-content">
        <div class="assessment-intro">
            <h2>About This Assessment</h2>
            <p>
                This assessment will help you evaluate your current stress levels. 
                Please answer the questions honestly to get the most accurate results. 
                Your responses are confidential and will be used to provide personalized feedback.
            </p>
        </div>
        
        <div class="assessment-details-row">
            <div class="detail-item">
                <i class="fa-regular fa-clock"></i>
                <span>Time: 5-10 minutes</span>
            </div>
            <div class="detail-item">
                <i class="fa-solid fa-list-check"></i>
                <span>Questions: 15</span>
            </div>
            <div class="detail-item">
                <i class="fa-solid fa-lock"></i>
                <span>Confidential Results</span>
            </div>
        </div>
        
        <div class="assessment-benefits">
            <h3>Benefits</h3>
            <ul>
                <li>Identify your stress triggers</li>
                <li>Understand your stress response patterns</li>
                <li>Receive personalized coping strategies</li>
                <li>Track your stress levels over time</li>
            </ul>
        </div>
        
        <div class="assessment-action">
            <a href="{{ route('assessment.stress.take') }}" class="btn btn-primary start-btn">
                <span>Start Assessment</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>


