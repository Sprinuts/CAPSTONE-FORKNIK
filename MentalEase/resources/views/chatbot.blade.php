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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- End CSS -->
</head>

<body>  
  @include('include.navbar')
  
  <div class="page-container">
    <div class="chat-container">
      <!-- Chat Header -->
      <div class="chat-header">
        <div class="chat-title">
          <a href="/welcomepatient" class="back-link"><i class="fas fa-arrow-left"></i></a>
          <img src="{{ asset('style/assets/chatbottt.gif') }}" alt="Aira" class="header-avatar">
          <div>
            <h2>Aira - Mental Health Assistant</h2>
            <span class="status"><i class="fas fa-circle status-indicator"></i> Online and ready to help</span>
          </div>
        </div>
        <button class="new-chat-btn">
          <i class="fas fa-plus"></i> New Chat
        </button>
      </div>

      <!-- User Profile Bar -->
      <div class="user-profile-bar">
        <div class="user-profile-info">
          <img src="{{ asset('style/assets/defaultprofile.jpg') }}" alt="User" class="user-profile-avatar">
          <div class="user-profile-details">
            <h4>{{ session('user')->name ?? 'User' }}</h4>
            <span>Patient</span>
          </div>
        </div>
        <div class="chat-actions">
          <span class="chat-session-id">Session #{{ rand(1000, 9999) }}</span>
        </div>
      </div>

      <!-- Messages Area -->
      <div class="messages-container">
        <div class="messages">
          <div class="chat-date">Today</div>
          
          <div class="message-row bot">
            <div class="avatar">
              <img src="{{ asset('style/assets/chatbottt.gif') }}" alt="Aira">
            </div>
            <div class="message-content">
              <div class="message-bubble">
                <p>Hello! I'm Aira, your emotional support assistant. I'm here to listen and help you navigate your feelings. How are you doing today?</p>
              </div>
            </div>
          </div>
          
          <!-- Messages will be added here dynamically -->
        </div>
      </div>

      <!-- Input Area -->
      <div class="input-container">
        <form id="message-form">
          <div class="input-wrapper">
            <input type="text" id="message" name="message" placeholder="Message Aira..." autocomplete="off">
            <button type="submit" class="send-button">
              <i class="fas fa-arrow-right"></i> 

            </button>
          </div>
          <div class="input-footer">
            <small>Aira is an AI assistant and may produce inaccurate information. If you're in crisis, please contact emergency services.</small>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Auto-scroll to bottom of chat when page loads
    $(document).ready(function() {
      // Keep these lines to ensure consistency
      $(".message-row.bot .avatar img").attr("src", "{{ asset('style/assets/chatbottt.gif') }}");
      $(".header-avatar").attr("src", "{{ asset('style/assets/chatbottt.gif') }}");
      
      scrollToBottom();
      $("#message").focus();
      
      // Handle new chat button
      $(".new-chat-btn").click(function() {
        $(".messages").html('<div class="chat-date">Today</div><div class="message-row bot"><div class="avatar"><img src="{{ asset("style/assets/chatbottt.gif") }}" alt="Aira"></div><div class="message-content"><div class="message-bubble"><p>Hello! I\'m Aira, your emotional support assistant. I\'m here to listen and help you navigate your feelings. How are you doing today?</p></div></div></div>');
        scrollToBottom();
      });
    });

    function scrollToBottom() {
      const messages = document.querySelector('.messages');
      messages.scrollTop = messages.scrollHeight;
    }

    // Send messages
    $("#message-form").submit(function (event) {
      event.preventDefault();

      // Stop empty messages
      if ($("#message").val().trim() === '') {
        return;
      }

      // Disable form
      $("#message").prop('disabled', true);
      $(".send-button").prop('disabled', true);

      // Store the message
      const userMessage = $("#message").val();

      // Clear input field immediately for better UX
      $("#message").val('');

      // Add user message to chat
      $(".messages").append(`
        <div class="message-row user">
          <div class="message-content">
            <div class="message-bubble">
              <p>${userMessage}</p>
            </div>
          </div>
          <div class="avatar user-avatar">
            <img src="{{ asset('style/assets/default-avatar.png') }}" alt="User">
          </div>
        </div>
      `);
      
      // Add typing indicator
      $(".messages").append(`
        <div class="message-row bot typing">
          <div class="avatar">
            <img src="{{ asset('style/assets/chatbottt.gif') }}" alt="Aira">
          </div>
          <div class="message-content">
            <div class="typing-indicator">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
      `);
      
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
        $(".typing").remove();
        
        // Add bot response
        $(".messages").append(`
          <div class="message-row bot">
            <div class="avatar">
              <img src="{{ asset('style/assets/chatbottt.gif') }}" alt="Aira">
            </div>
            <div class="message-content">
              <div class="message-bubble">
                <p>${res}</p>
              </div>
            </div>
          </div>
        `);

        // Scroll to bottom
        scrollToBottom();

        // Enable form
        $("#message").prop('disabled', false);
        $(".send-button").prop('disabled', false);
        $("#message").focus();
      });
    });
  </script>
</body>
</html>














