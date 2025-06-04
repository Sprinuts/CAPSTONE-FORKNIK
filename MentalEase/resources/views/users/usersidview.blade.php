<div class="d-flex align-items-center justify-content-center">
    <link rel="stylesheet" href="{{ asset('style/useridview.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="col col-md-7">
        <form action="" method="post" class="adjust">
            @csrf
            <div class="form-group mb-2">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" readonly>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    </div>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
                    </div>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="status" class="form-label">Status</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                    </div>
                    <input type="text" name="status" id="status" class="form-control" value="{{ $user->status == 1 ? 'Activated' : 'Deactivated' }}" readonly>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="role" class="form-label">Role</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                    </div>
                    <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}" readonly>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="contact_number" class="form-label">Contact Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ $user->contactnumber }}" readonly>
                </div>
            </div>
            <div class="form-group">
                <a href="{{ route('users.view') }}" class="btn btn-danger">Go Back</a>
            </div>
        </form>
    </div>
</div>
