<link rel="stylesheet" href="{{ asset('style/activateaccount.css') }}">

<div class="activation-container">
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

    <form method="POST" action="{{ route('activate', ['username' => $username]) }}">
        @csrf
        <input type="hidden" name="username" value="{{ $username }}">

        <label for="activationcode">Enter 6-digit Activation Code:</label>
        <input type="text" id="activationcode" name="activationcode" maxlength="6" pattern="\d{6}" required autofocus>
        <button type="submit">Activate Account</button>
        
        <div class="help-links">
            <a href="{{ route('resend.activation.code', ['username' => $username]) }}" class="resend-link">
                Didn't receive activation code?
            </a>
        </div>
    </form>
</div>



