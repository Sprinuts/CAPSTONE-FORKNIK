<link rel="stylesheet" href="{{ asset('style/appointmentpatientview.css') }}">

<div class="container mt-5">
    <h2>Your Upcoming Appointment</h2>
    @if($appointments)
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Appointment Details</h5>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointments->date)->format('F d, Y') }}</p>
                <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($appointments->start_time)->format('h:i A') }}</p>
                <p><strong>Status:</strong> 
                    @if($appointments->complete)
                        Completed
                    @elseif($appointments->confirmed)
                        Confirmed
                    @else
                        Pending
                    @endif
                </p>
                @if($appointments->psychometrician)
                    <p><strong>Psychometrician:</strong> {{ $appointments->psychometrician->name }}</p>
                    <p><strong>Email:</strong> {{ $appointments->psychometrician->email }}</p>
                @else
                    <p><strong>Psychometrician:</strong> Not assigned yet.</p>
                @endif

                <!-- Cancel Button -->
                @if(!$appointments->complete)
                <form action="{{ route('appointments.cancel', $appointments->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel Appointment</button>
                </form>
                @endif

            </div>
        </div>
    @else
        <div class="alert alert-info mt-4">
            You have no upcoming appointments.
        </div>
    @endif
</div>

