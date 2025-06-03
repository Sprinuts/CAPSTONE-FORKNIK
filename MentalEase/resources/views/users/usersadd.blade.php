<div class="d-flex align-items-center justify-content-center">
    <!-- Connect External CSS -->
    <link rel="stylesheet" href="{{ asset('style/usersadd.css') }}">

    <!-- Inline styles for additional customizations -->
    <div class="col col-md-6" style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <form action="{{ route('users.add') }}" method="post" class="adjust">
            <div class="form-group mb-3">
                <label for="username" class="form-label" style="font-weight: bold; font-size: 16px;">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" style="border-radius: 5px; padding: 10px; border: 1px solid #ddd;">
            </div>
            <div class="form-group mb-3">
                <label for="name" class="form-label" style="font-weight: bold; font-size: 16px;">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" style="border-radius: 5px; padding: 10px; border: 1px solid #ddd;">
            </div>

            <div class="form-group mb-3">
                <label for="contact_number" class="form-label" style="font-weight: bold; font-size: 16px;">Contact Number</label>
                <input type="tel" name="contact_number" id="contact_number" class="form-control" value="{{ old('contact_number') }}" style="border-radius: 5px; padding: 10px; border: 1px solid #ddd;">
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label" style="font-weight: bold; font-size: 16px;">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" style="border-radius: 5px; padding: 10px; border: 1px solid #ddd;">
            </div>

            <div class="form-group mb-3">
                <label for="role" class="form-label" style="font-weight: bold; font-size: 16px;">Role</label>
                <select name="role" id="role" class="form-control" style="border-radius: 5px; padding: 10px; border: 1px solid #ddd;">
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="psychometrician" {{ old('role') == 'psychometrician' ? 'selected' : '' }}>Psychometrician</option>
                </select>
            </div>

            <div class="form-group-button">
                <button type="submit" class="btn btn-success">Add User</button>
                <a href="{{ route('users.view') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
