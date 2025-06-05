<h2>Payment Page</h2>
<p>Pay for your appointment.</p>
<form action="{{ route('appointment.confirm') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $data['user_id'] }}">
    <input type="hidden" name="psychometrician_id" value="{{ $data['psychometrician_id'] }}">
    <input type="hidden" name="date" value="{{ $data['date'] }}">
    <input type="hidden" name="start_time" value="{{ $data['start_time'] }}">
    <button type="submit">Confirm Payment</button>

    <pre>{{ print_r($data, true) }}</pre>
</form>