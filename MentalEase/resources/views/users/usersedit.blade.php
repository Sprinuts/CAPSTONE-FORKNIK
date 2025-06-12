<div class="d-flex align-items-center justify-content-center">
    <link rel="stylesheet" href="{{ asset('style/user-forms.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <div class="col col-md-7 form-container">
        <div class="form-header">
            <h2><i class="fas fa-user-edit"></i> Edit User</h2>
            <p>Update user information using the form below</p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('users.edit', $user->id)}}" method="post" class="adjust">
            @csrf
            <div class="form-group mb-3">
                <label for="username" class="form-label">
                    <i class="fas fa-user-tag"></i> Username
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}">
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> Full Name
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="role" class="form-label">
                    <i class="fas fa-user-shield"></i> Role
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <select name="role" id="role" class="form-control">
                        <option value="patient" {{ old('role', $user->role) == 'patient' ? 'selected' : '' }}>Patient</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="psychometrician" {{ old('role', $user->role) == 'psychometrician' ? 'selected' : '' }}>Psychometrician</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group mb-3">
                <label for="contactnumber" class="form-label">
                    <i class="fas fa-phone"></i> Contact Number
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="contactnumber" id="contactnumber" class="form-control" value="{{ old('contactnumber', $user->contactnumber) }}">
                </div>
            </div>
            
            <div class="form-group-button">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('users.view')}}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

