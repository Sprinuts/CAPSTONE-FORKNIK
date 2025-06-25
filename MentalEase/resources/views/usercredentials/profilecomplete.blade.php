<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Complete Your Profile | MentalEase</title>
    <link rel="stylesheet" href="{{ asset('style/completeprofile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="login-container">
    <a href="{{ route('logout') }}" class="back-icon">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('profile.complete') }}" method="POST" class="login-form">
        @csrf
        <div class="form-header">
            <h2>Complete Your Profile</h2>
            <p class="form-subtitle">Please provide your personal information to continue</p>
        </div>
        
        <div class="form-columns">
            <!-- First Column -->
            <div>
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your first name" required value="{{ old('firstname') }}">
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name" value="{{ old('middle_name') }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required value="{{ old('last_name') }}">
                </div>
                <div class="form-group">
                    <label for="contactnumber">Contact Number</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-phone input-icon"></i>
                        <input type="text" id="contactnumber" name="contactnumber" placeholder="Enter your contact number" required value="{{ old('contactnumber') }}">
                    </div>
                </div>
            </div>
            
            <!-- Second Column -->
            <div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-location-dot input-icon"></i>
                        <input type="text" id="address" name="address" placeholder="Enter your address" required value="{{ old('address') }}">
                    </div>
                </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <div class="select-wrapper">
                    <select id="gender" name="gender" class="form-control" required aria-required="true">
                        <option value="" disabled @selected(!old('gender'))>Select gender</option>
                        <option value="Male" @selected(old('gender') == 'Male')>Male</option>
                        <option value="Female" @selected(old('gender') == 'Female')>Female</option>
                        <option value="Other" @selected(old('gender') == 'Other')>Other</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="civil_status">Civil Status</label>
                <div class="select-wrapper">
                    <select id="civil_status" name="civil_status" class="form-control" required aria-required="true">
                        <option value="" disabled @selected(!old('civil_status'))>Select status</option>
                        <option value="Single" @selected(old('civil_status') == 'Single')>Single</option>
                        <option value="Married" @selected(old('civil_status') == 'Married')>Married</option>
                        <option value="Widowed" @selected(old('civil_status') == 'Widowed')>Widowed</option>
                        <option value="Divorced" @selected(old('civil_status') == 'Divorced')>Divorced</option>
                    </select>
                </div>
            </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <div class="input-with-icon">
                        <i class="fa-solid fa-calendar input-icon"></i>
                        <input type="date" id="birthdate" name="birthdate" required value="{{ old('birthdate') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthplace">Birthplace</label>
                    <input type="text" id="birthplace" name="birthplace" placeholder="Enter your birthplace" required value="{{ old('birthplace') }}">
                </div>
                <div class="form-group">
                    <label for="religion">Religion</label>
                    <input type="text" id="religion" name="religion" placeholder="Enter your religion" required value="{{ old('religion') }}">
                </div>
            </div>
        </div>
        
        <div class="form-footer">
            <button type="submit" class="login-btn">
                <i class="fa-solid fa-check-circle"></i> Complete Profile
            </button>
            <p class="privacy-note">Your information is protected by our <a href="#">Privacy Policy</a></p>
        </div>
    </form>
</div>

</body>
</html>


