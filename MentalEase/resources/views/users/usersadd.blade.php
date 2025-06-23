<div class="d-flex align-items-center justify-content-center">
    <!-- Connect External CSS -->
    <link rel="stylesheet" href="{{ asset('style/user-forms.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <div class="col col-md-6 form-container">
        <div class="form-header">
            <h2><i class="fas fa-user-plus"></i> Add New User</h2>
            <p>Create a new user account with the form below</p>
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

        <form action="{{ route('users.add') }}" method="post" class="adjust">
            @csrf
            <div class="form-group mb-3">
                <label for="username" class="form-label">
                    <i class="fas fa-user-tag"></i> Username
                </label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" placeholder="Enter username">
            </div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email address">
            </div>

            <div class="form-group mb-3">
                <label for="role" class="form-label">
                    <i class="fas fa-user-shield"></i> Role
                </label>
                <select name="role" id="role" class="form-control">
                    <option value="" disabled selected>Select a role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="psychometrician" {{ old('role') == 'psychometrician' ? 'selected' : '' }}>Psychometrician</option>
                    <option value="cashier" {{ old('role') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                </select>
            </div>

            <div class="form-group-button">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Add User
                </button>
                <a href="{{ route('users.view') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>

