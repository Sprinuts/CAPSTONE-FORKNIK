<link rel="stylesheet" href="{{ asset('style/userprofile.css') }}">
<link rel="stylesheet" href="{{ asset('style/editprofile.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <div class="edit-profile-header">
        <h2><i class="bi bi-person-gear"></i> Edit Profile</h2>
        <p>Update your personal information</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="edit-profile-form">
        @csrf
        <div class="form-section">
            <h3>Personal Information</h3>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                </div>
                <div class="col-md-4">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}">
                </div>
                <div class="col-md-4">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="" {{ !old('gender', $user->gender) ? 'selected' : '' }}>Select gender</option>
                        <option value="male" {{ strtolower(old('gender', $user->gender)) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ strtolower(old('gender', $user->gender)) == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ strtolower(old('gender', $user->gender)) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="civil_status" class="form-label">Civil Status</label>
                    <select class="form-select" id="civil_status" name="civil_status">
                        <option value="" {{ !old('civil_status', $user->civil_status) ? 'selected' : '' }}>Select status</option>
                        <option value="single" {{ strtolower(old('civil_status', $user->civil_status)) == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ strtolower(old('civil_status', $user->civil_status)) == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="divorced" {{ strtolower(old('civil_status', $user->civil_status)) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ strtolower(old('civil_status', $user->civil_status)) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Contact Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
                <div class="col-md-6">
                    <label for="contactnumber" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contactnumber" name="contactnumber" value="{{ old('contactnumber', $user->contactnumber) }}">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
            </div>
        </div>

        <div class="form-section">
            <h3>Birth Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}">
                </div>
                <div class="col-md-6">
                    <label for="birthplace" class="form-label">Birthplace</label>
                    <input type="text" class="form-control" id="birthplace" name="birthplace" value="{{ old('birthplace', $user->birthplace) }}">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Additional Information</h3>
            <div class="mb-3">
                <label for="religion" class="form-label">Religion</label>
                <input type="text" class="form-control" id="religion" name="religion" value="{{ old('religion', $user->religion) }}">
            </div>
        </div>

        <div class="form-section">
            <h3>Account Information</h3>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="{{ $user->username }}" disabled>
                <div class="form-text">Username cannot be changed</div>
            </div>
        </div>

        <div class="form-section">
            <h3>Privacy & Security</h3>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#changePasswordSection">
                        <i class="bi bi-pencil"></i> Change Password
                    </button>
                </div>
            </div>
            
            <div class="collapse" id="changePasswordSection">
                <div class="card card-body mb-3">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('profile') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Save Changes
            </button>
        </div>
    </form>
</div>

