@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="d-flex justify-content-center my-4">
    <a href="{{ route('appointment.confirmation') }}" class="btn btn-success mx-2">
        Confirm Appointment
    </a>
    <a href="{{ route('appointment.viewconfirmed') }}" class="btn btn-primary mx-2">
        Upcoming Appointment
    </a>
</div>