<div class="activation-container">
    <form method="POST" action="{{ route('activate') }}">
        @csrf
        <label for="activationcode">Enter 6-digit Activation Code:</label>
        <input type="text" id="activationcode" name="activationcode" maxlength="6" pattern="\d{6}" required autofocus>
        <button type="submit">Activate Account</button>
    </form>
</div>
