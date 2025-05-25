<div class="activation-container">
    <form method="POST" action="{{ route('activate.account') }}">
        @csrf
        <label for="activation_code">Enter 6-digit Activation Code:</label>
        <input type="text" id="activation_code" name="activation_code" maxlength="6" pattern="\d{6}" required autofocus>
        <button type="submit">Activate Account</button>
    </form>
</div>
