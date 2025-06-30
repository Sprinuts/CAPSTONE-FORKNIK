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

    <form method="POST" action="{{ route('resetcode', ['username' => $username]) }}">
        @csrf
        <input type="hidden" name="username" value="{{ $username }}">

        <label for="resetcode">Enter 6-digit Reset Code:</label>
        <input type="text" id="resetcode" name="resetcode" maxlength="6" pattern="\d{6}" required autofocus>
        <button type="submit">Reset Password</button>
    </form>
</div>



