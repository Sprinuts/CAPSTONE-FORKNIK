// Getting Elements from DOM
const joinButton = document.getElementById("joinBtn");
const leaveButton = document.getElementById("leaveBtn");
const toggleMicButton = document.getElementById("toggleMicBtn");
const toggleWebCamButton = document.getElementById("toggleWebCamBtn");
const createButton = document.getElementById("createMeetingBtn");
const videoContainer = document.getElementById("videoContainer");
const textDiv = document.getElementById("textDiv");

// Declare Variablesfo
let meeting = null;
let meetingId = "";
let isMicOn = false;
let isWebCamOn = false;

function initializeMeeting() {}

function createLocalParticipant() {}

function createVideoElement() {}

function createAudioElement() {}

function setTrack() {}

// Join Meeting Button Event Listener
joinButton.addEventListener("click", async () => {
    document.getElementById("join-screen").style.display = "none";
    textDiv.textContent = "Joining the meeting...";

    roomId = document.getElementById("meetingIdTxt").value;
    meetingId = roomId;

    initializeMeeting();
});

// Create Meeting Button Event Listener
createButton.addEventListener("click", async () => {
    document.getElementById("join-screen").style.display = "none";
    textDiv.textContent = "Please wait, we are joining the meeting";

    // API call to create meeting
    const url = `https://api.videosdk.live/v2/rooms`;
    const options = {
        method: "POST",
        headers: { Authorization: TOKEN, "Content-Type": "application/json" },
    };

    const { roomId } = await fetch(url, options)
        .then((response) => response.json())
        .catch((error) => alert("error", error));
    meetingId = roomId;

    initializeMeeting();
});


// Initialize meeting
function initializeMeeting() {
    window.VideoSDK.config(TOKEN);

    meeting = window.VideoSDK.initMeeting({
        meetingId: meetingId, // required
        name: window.userName, // required
        micEnabled: false, // optional, default: true
        webcamEnabled: false, // optional, default: true
    });

    // Set initial states for toggles
    isMicOn = false;
    isWebCamOn = false;
    
    toggleMicButton.classList.add('disabled');
    toggleMicButton.classList.remove('disabled');
    toggleMicButton.setAttribute('data-tooltip', 'Microphone Off');
    toggleMicButton.innerHTML = '<i class="fas fa-microphone-slash"></i>';
    
    toggleWebCamButton.classList.add('disabled');
    toggleWebCamButton.classList.remove('disabled');
    toggleWebCamButton.setAttribute('data-tooltip', 'Camera Off');
    toggleWebCamButton.innerHTML = '<i class="fas fa-video-slash"></i>';

    meeting.join();

    // Creating local participant
    createLocalParticipant();

    // Setting local participant stream
    meeting.localParticipant.on("stream-enabled", (stream) => {
        setTrack(stream, null, meeting.localParticipant, true);
    });

    // Also listen for stream-disabled to show placeholder at the beginning
    meeting.localParticipant.on("stream-disabled", (stream) => {
        if (stream.kind === "video") {
            const localId = meeting.localParticipant.id;
            const videoElm = document.getElementById(`v-${localId}`);
            const placeholderElm = document.getElementById(`placeholder-${localId}`);
            if (videoElm) videoElm.style.display = "none";
            if (placeholderElm) placeholderElm.style.display = "flex";
        }
    });


    // meeting joined event
    meeting.on("meeting-joined", () => {
        textDiv.style.display = "none";
        document.getElementById("grid-screen").style.display = "block";
        document.getElementById(
        "meetingIdHeading"
        ).textContent = `Meeting Id: ${meetingId}`;
    });

    // meeting left event
    meeting.on("meeting-left", () => {
        videoContainer.innerHTML = "";
    });

    // Remote participants Event
    // participant joined
    meeting.on("participant-joined", (participant) => {
        let videoElement = createVideoElement(
        participant.id,
        participant.displayName
        );
        let audioElement = createAudioElement(participant.id);
        // stream-enabled
        participant.on("stream-enabled", (stream) => {
        setTrack(stream, audioElement, participant, false);
        });
        videoContainer.appendChild(videoElement);
        videoContainer.appendChild(audioElement);
    });

    // participants left
    meeting.on("participant-left", (participant) => {
        let vElement = document.getElementById(`f-${participant.id}`);
        vElement.remove(vElement);

        let aElement = document.getElementById(`a-${participant.id}`);
        aElement.remove(aElement);
    });

    // leave Meeting Button Event Listener
    leaveButton.addEventListener("click", async () => {
        meeting?.leave();
        document.getElementById("grid-screen").style.display = "none";
        document.getElementById("join-screen").style.display = "block";
    });

    // Toggle Mic Button Event Listener
    toggleMicButton.addEventListener("click", async () => {
        if (isMicOn) {
            // Disable Mic in Meeting
            meeting?.muteMic();
            toggleMicButton.classList.remove('active');
            toggleMicButton.classList.add('disabled');
            toggleMicButton.setAttribute('data-tooltip', 'Microphone Off');
            toggleMicButton.innerHTML = '<i class="fas fa-microphone-slash"></i>';
        } else {
            // Enable Mic in Meeting
            meeting?.unmuteMic();
            toggleMicButton.classList.remove('disabled');
            toggleMicButton.classList.add('active');
            toggleMicButton.setAttribute('data-tooltip', 'Microphone On');
            toggleMicButton.innerHTML = '<i class="fas fa-microphone"></i>';
        }
        isMicOn = !isMicOn;
    });

    // Toggle Web Cam Button Event Listener
    toggleWebCamButton.addEventListener("click", async () => {
        const placeholder = document.getElementById(`placeholder-${meeting.localParticipant.id}`);
        const videoElm = document.getElementById(`v-${meeting.localParticipant.id}`);

        if (isWebCamOn) {
            // Disable Webcam in Meeting
            meeting?.disableWebcam();
            toggleWebCamButton.classList.remove('active');
            toggleWebCamButton.classList.add('disabled');
            toggleWebCamButton.setAttribute('data-tooltip', 'Camera Off');
            toggleWebCamButton.innerHTML = '<i class="fas fa-video-slash"></i>';

            if (videoElm) videoElm.style.display = "none";
            if (placeholder) placeholder.style.display = "flex";
        } else {
            // Enable Webcam in Meeting
            meeting?.enableWebcam();
            toggleWebCamButton.classList.remove('disabled');
            toggleWebCamButton.classList.add('active');
            toggleWebCamButton.setAttribute('data-tooltip', 'Camera On');
            toggleWebCamButton.innerHTML = '<i class="fas fa-video"></i>';

            if (videoElm) videoElm.style.display = "block";
            if (placeholder) placeholder.style.display = "none";
        }

        isWebCamOn = !isWebCamOn;
    });


}

// creating video element
function createVideoElement(pId, name) {
    let videoFrame = document.createElement("div");
    videoFrame.setAttribute("id", `f-${pId}`);
    videoFrame.classList.add("video-frame-wrapper");

    // Video element
    let videoElement = document.createElement("video");
    videoElement.classList.add("video-frame");
    videoElement.setAttribute("id", `v-${pId}`);
    videoElement.setAttribute("playsinline", true);
    videoElement.setAttribute("width", "300");
    videoElement.setAttribute("height", "225");
    videoElement.setAttribute("autoplay", true);
    videoElement.setAttribute("muted", true);
    videoFrame.appendChild(videoElement);

    // Placeholder when webcam is off
    let placeholder = document.createElement("div");
    placeholder.setAttribute("id", `placeholder-${pId}`);
    placeholder.classList.add("video-placeholder");
    placeholder.innerText = name || "Camera Off";
    videoFrame.appendChild(placeholder);

    return videoFrame;
}



// creating local participant
function createLocalParticipant() {
    let localParticipant = createVideoElement(
        meeting.localParticipant.id,
        meeting.localParticipant.displayName
    );
    videoContainer.appendChild(localParticipant);
    }



// setting media track
function setTrack(stream, audioElement, participant, isLocal) {
    const placeholder = document.getElementById(`placeholder-${participant.id}`);
    const videoElm = document.getElementById(`v-${participant.id}`);

    if (stream.kind === "video") {
        isWebCamOn = true;

        // Show video and hide placeholder
        const mediaStream = new MediaStream();
        mediaStream.addTrack(stream.track);
        videoElm.srcObject = mediaStream;
        videoElm.play().catch(err => console.error("video play failed", err));
        if (placeholder) placeholder.style.display = "none";

    } else if (stream.kind === "audio") {
        const mediaStream = new MediaStream();
        mediaStream.addTrack(stream.track);
        if (!isLocal && audioElement) {
            audioElement.srcObject = mediaStream;
            audioElement.play().catch(err => console.error("audio play failed", err));
        }
    }

    if (stream.kind === "audio") {
        const mediaStream = new MediaStream();
        mediaStream.addTrack(stream.track);
        if (!isLocal && audioElement) {
            audioElement.srcObject = mediaStream;
            audioElement
                .play()
                .catch((error) => console.error("audioElem.play() failed", error));
        }
    }

    // Toggle placeholder when stream disabled/enabled
    participant.on("stream-disabled", (s) => {
        if (s.kind === "video") {
            if (videoElm) videoElm.style.display = "none";
            if (placeholderElm) placeholderElm.style.display = "flex";
        }
    });

    participant.on("stream-enabled", (s) => {
        if (s.kind === "video") {
            const mediaStream = new MediaStream();
            mediaStream.addTrack(s.track);
            if (videoElm) {
                videoElm.srcObject = mediaStream;
                videoElm.style.display = "block";
                videoElm.play().catch((error) =>
                    console.error("videoElem.play() failed", error)
                );
            }
            if (placeholderElm) placeholderElm.style.display = "none";
        }
    });
}


