<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Consultation | MentalEase</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/consultation.css') }}">
</head>
<body>
    <div class="container">
        <!-- Status notification area -->
        <div id="statusNotification" class="status-notification">
            <div class="status-content">
                <i id="statusIcon" class="status-icon"></i>
                <span id="statusMessage">Ready to start your consultation</span>
                <button id="dismissStatus" class="dismiss-btn"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="consultation-container">
            <div id="join-screen" class="join-section">
                <div class="logo-section">
                    <img src="{{ asset('style/assets/mentaleaselogo.png') }}" alt="MentalEase Logo" class="logo">
                    <h2>Online Consultation</h2>
                </div>
                
                <div class="join-options">
                    <div class="option-card">
                        <h3><i class="fas fa-video"></i> Create New Meeting</h3>
                        <p>Start a new consultation session</p>
                        <button id="createMeetingBtn" class="btn-primary">Create Meeting</button>
                    </div>
                    
                    <div class="option-divider">OR</div>
                    
                    <div class="option-card">
                        <h3><i class="fas fa-sign-in-alt"></i> Join Existing Meeting</h3>
                        <p>Enter a meeting ID to join</p>
                        <div class="input-group">
                            <input type="text" id="meetingIdTxt" placeholder="Enter Meeting ID" class="form-control" />
                            <button id="joinBtn" class="btn-secondary">Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meeting status display -->
            <div id="textDiv" class="status-message"></div>

            <!-- Video conference screen -->
            <div id="grid-screen" class="conference-screen">
                <div class="conference-header">
                    <h3 id="meetingIdHeading" class="meeting-id"></h3>
                    <div class="controls">
                        <button id="toggleMicBtn" class="control-btn active" data-tooltip="Microphone On">
                            <i class="fas fa-microphone"></i>
                        </button>
                        <button id="toggleWebCamBtn" class="control-btn active" data-tooltip="Camera On">
                            <i class="fas fa-video"></i>
                        </button>
                        <button id="leaveBtn" class="leave-btn">
                            <i class="fas fa-phone-slash"></i> Leave
                        </button>
                    </div>
                </div>
                
                <div id="videoContainer" class="video-grid"></div>
            </div>
        </div>
    </div>

    <!-- Add VideoSDK script -->
    <script src="https://sdk.videosdk.live/js-sdk/0.1.6/videosdk.js"></script>
    <script>
        window.user = @json(session('user'));
        window.userName = "{{ session('user')->name ?? '' }}";
    </script>
    <script src="{{ asset('javascript/config.js') }}"></script>
    <script src="{{ asset('javascript/consultation.js') }}"></script>
</body>


