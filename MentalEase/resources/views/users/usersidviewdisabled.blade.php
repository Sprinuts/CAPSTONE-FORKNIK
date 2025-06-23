<div class="d-flex align-items-center justify-content-center">
    <link rel="stylesheet" href="{{ asset('style/user-forms.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <div class="col col-md-7 form-container">
        <div class="form-header">
            <h2><i class="fas fa-user-slash"></i> Archived User</h2>
            <p>Viewing information for {{ $user->name }}</p>
        </div>
        
        <form action="" method="post" class="adjust">
            @csrf
            <div class="form-group mb-3">
                <label for="username" class="form-label">
                    <i class="fas fa-user-tag"></i> Username
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" readonly>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> First Name
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" readonly>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="middle_name" class="form-label">
                    <i class="fas fa-user"></i> Middle Name
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $user->middle_name }}" readonly>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="last_name" class="form-label">
                    <i class="fas fa-user"></i> Last Name
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}" readonly>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="status" class="form-label">
                    <i class="fas fa-check-circle"></i> Status
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="status" id="status" class="form-control" value="{{ $user->status == 1 ? 'Activated' : 'Deactivated' }}" readonly>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="role" class="form-label">
                    <i class="fas fa-user-shield"></i> Role
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}" readonly>
                </div>
            </div>
            
            <div class="form-group-button">
                <a href="{{ route('users.archive') }}" class="btn btn-danger">
                    <i class="fas fa-arrow-left"></i> Go Back
                </a>
            </div>
        </form>
    </div>
</div>


