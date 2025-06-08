<link rel="stylesheet" href="{{ asset('style/assessment.css') }}">

<div class="assessment-fullscreen">
    <div class="assessment-header">
        <h1>Perceived Stress Scale Assessment</h1>
        <div class="assessment-icon">
            <i class="fa-solid fa-brain"></i>
        </div>
    </div>
    
    <div class="assessment-content">
        <div class="assessment-intro">
            <h2>About This Assessment</h2>
            <p>
            This assessment will help you evaluate your current stress levels based on how unpredictable, 
            uncontrollable, and overloaded you find your life.
            </p>
            <p>Please answer each question honestly to get the most accurate results.
            There are no right or wrong answers — reflect on your feelings and thoughts over the past month.
            </p>
            <p>Your responses are confidential and will be used to provide personalized 
            feedback to support your emotional well-being. </p>
        </div>
        
        <div class="assessment-details-row">
            <div class="detail-item">
                <i class="fa-regular fa-clock"></i>
                <span>Time: 5-10 minutes</span>
            </div>
            <div class="detail-item">
                <i class="fa-solid fa-list-check"></i>
                <span>Questions: 10</span>
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
            <a href="{{ route('assessment.pss.take') }}" class="btn btn-primary start-btn">
                <span>Start Assessment</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>


