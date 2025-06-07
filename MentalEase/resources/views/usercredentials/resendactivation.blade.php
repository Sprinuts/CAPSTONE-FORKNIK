<link rel="stylesheet" href="{{ asset('style/activateaccount.css') }}">

<div class="activation-container resend-container">
    <h2>Resend Activation Code</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <p class="resend-info">
        Please confirm your email address below to receive a new activation code.
    </p>
    
    <form method="POST" action="{{ route('resend.activation.code.submit') }}">
        @csrf
        <input type="hidden" name="username" value="{{ $username }}">
        
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <button type="submit" class="resend-btn">Send New Code</button>
        
        <div class="help-links">
            <a href="{{ route('activate', ['username' => $username]) }}" class="back-link">
                Back to activation
            </a>
        </div>
    </form>
</div>