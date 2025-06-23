<link rel="stylesheet" href="{{ asset('style/completeprofile.css') }}">

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
    <a href="{{ route('welcome') }}" class="back-icon" style="position: absolute; top: 20px; left: 20px; color: #333; text-decoration: none;">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <form action="{{ route('profile.complete') }}" method="POST" class="login-form">
        @csrf
        <h2>Complete Profile</h2>
        <div style="display: flex; gap: 30px;">
            <!-- First Column -->
            <div style="flex: 1;">
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
                    <input type="text" id="contactnumber" name="contactnumber" placeholder="Enter your contact number" required value="{{ old('contactnumber') }}">
                </div>
            </div>
            <!-- Second Column -->
            <div style="flex: 1;">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter your address" required value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="civil_status">Civil Status</label>
                    <select id="civil_status" name="civil_status" required>
                        <option value="" disabled {{ old('civil_status') ? '' : 'selected' }}>Select status</option>
                        <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="Divorced" {{ old('civil_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" id="birthdate" name="birthdate" required value="{{ old('birthdate') }}">
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
        <button type="submit" class="login-btn">Submit</button>
    </form>
</div>