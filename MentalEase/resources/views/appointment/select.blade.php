<link rel="stylesheet" href="{{ asset('style/select.css') }}">

<div class="psychometrician-selection">
    <div class="selection-header">
        <h1>Select a Psychometrician</h1>
        <p class="selection-subtitle">Choose a professional for your mental health consultation</p>
    </div>

    <div class="psychometricians-list">
        @foreach($psychometricians as $psy)
            <div class="psychometrician-item">
                <div class="psychometrician-profile">
                    <div class="profile-image">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div class="profile-details">
                        <h3 class="psychometrician-name">{{ $psy->name }}</h3>
                        <p class="psychometrician-credentials">Ph.D. in Clinical Psychology</p>
                        <p class="psychometrician-specialty">Mental Health Specialist</p>
                        <div class="psychometrician-rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <span class="rating-count">4.8 (24 reviews)</span>
                        </div>
                    </div>
                </div>
                
                <div class="psychometrician-info-section">
                    <div class="info-column">
                        <h4>Expertise</h4>
                        <ul class="expertise-list">
                            <li>Anxiety Disorders</li>
                            <li>Depression</li>
                            <li>Stress Management</li>
                            <li>Cognitive Behavioral Therapy</li>
                        </ul>
                    </div>
                    
                    <div class="info-column">
                        <h4>Availability</h4>
                        <p>not synchronized with schedule</p>
                        <div class="availability-status">
                            <div class="availability-badge available">
                                <i class="fa-solid fa-calendar-check"></i> Available Today
                            </div>
                            <p class="availability-times">Next slots: 2:00 PM, 4:30 PM</p>
                        </div>
                    </div>
                    
                    <div class="info-column action-column">
                        <a href="{{ route('appointment.choose', $psy->id) }}" class="schedule-button">
                            <i class="fa-solid fa-calendar-plus"></i> Schedule Appointment
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

