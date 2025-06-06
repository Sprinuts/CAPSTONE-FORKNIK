<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chat with Aira | MentalEase</title>
  <link rel="icon" href="{{ asset('style/botpic.jpg') }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- End JavaScript -->
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('style/chatbot.css') }}">
  <link rel="stylesheet" href="{{ asset('style/navbar.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- End CSS -->
</head>

<body>  
  <div class="chat">
    <!-- Header -->
    <div class="top">
      <img src="{{ asset('style/botpic.jpg') }}" alt="Avatar">
      <div>
        <p>Aira - Mental Health Assistant</p>
        <small><i class="fas fa-circle status-indicator"></i> Online and ready to help</small>
      </div>
    </div>
    <!-- End Header -->

    <!-- Chat -->
    <div class="messages">
      <div class="chat-date">Today</div>
      <div class="left message">
        <img src="{{ asset('style/botpic.jpg') }}" alt="Avatar">
        <p>Hello! I'm Aira, your emotional support assistant. I'm here to listen and help you navigate your feelings. How are you doing today?</p>
      </div>
    </div>
    <!-- End Chat -->

    <!-- Footer -->
    <div class="bottom">
      <form>
        <input type="text" id="message" name="message" placeholder="Type your message here..." autocomplete="off">
        <button type="submit"><i class="fas fa-paper-plane" style="color: white;"></i></button>
      </form>
    </div>
    <!-- End Footer -->
  </div>
</body>

<script>
  // Auto-scroll to bottom of chat when page loads
  $(document).ready(function() {
    scrollToBottom();
    $("#message").focus();
  });

  function scrollToBottom() {
    const messages = document.querySelector('.messages');
    messages.scrollTop = messages.scrollHeight;
  }

  //Broadcast messages
  $("form").submit(function (event) {
    event.preventDefault();

    //Stop empty messages
    if ($("form #message").val().trim() === '') {
      return;
    }

    //Disable form
    $("form #message").prop('disabled', true);
    $("form button").prop('disabled', true);

    // Store the message
    const userMessage = $("form #message").val();

    // Clear input field immediately for better UX
    $("form #message").val('');

    //Populate sending message
    $(".messages > .message").last().after('<div class="right message">' +
      '<p>' + userMessage + '</p>' +
      '<img src="{{ asset('style/botpic.jpg') }}" alt="Avatar">' +
      '</div>');
    
    // Add typing indicator
    $(".messages").append('<div class="left message typing-indicator-container">' +
      '<img src="{{ asset('style/botpic.jpg') }}" alt="Avatar">' +
      '<div class="typing-indicator"><span></span><span></span><span></span></div>' +
      '</div>');
    
    // Scroll to the latest message
    scrollToBottom();

    $.ajax({
      url: "/chatbot",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      },
      data: {
        "model": "gpt-4.1-mini",
        "content": userMessage
      }
    }).done(function (res) {
      // Remove typing indicator
      $(".typing-indicator-container").remove();
      
      //Populate receiving message
      $(".messages > .message").last().after('<div class="left message">' +
        '<img src="{{ asset('style/botpic.jpg') }}" alt="Avatar">' +
        '<p>' + res + '</p>' +
        '</div>');

      //Scroll to bottom
      scrollToBottom();

      //Enable form
      $("form #message").prop('disabled', false);
      $("form button").prop('disabled', false);
      $("form #message").focus();
    });
  });
</script>
</html>

