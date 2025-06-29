<div>
    <link rel="stylesheet" href="{{ asset('style/users.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <h3 class="text-center">
        <i class="fas fa-search"></i> 
        <span class="heading-text">Search Results</span>
    </h3>
    <div class="adjust">
        <div class="action-bar">
            <div class="action-buttons">
                <a href="{{ route('users.view') }}" class="btn btn-lg btn-secondary adjustBtn">Back to Users</a>
            </div>
            <div class="filter-container">
                <form action="{{ route('users.search.results') }}" method="GET" class="search-filter">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="term" value="{{ $term }}" placeholder="Search users..." class="search-input">
                    </div>
                    <div class="filter-dropdown">
                        <select name="role" class="form-select">
                            <option value="all" {{ $role == 'all' ? 'selected' : '' }}>All Roles</option>
                            <option value="admin" {{ $role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="psychometrician" {{ $role == 'psychometrician' ? 'selected' : '' }}>Psychometrician</option>
                            <option value="cashier" {{ $role == 'cashier' ? 'selected' : '' }}>Cashier</option>
                            <option value="patient" {{ $role == 'patient' ? 'selected' : '' }}>Patient</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        
        <div class="mb-3">
            <div class="alert alert-info">
                Found {{ $users->count() }} user(s) matching your search.
            </div>
        </div>
        
        <table class="adjustBtn table table-striped table-hover table-light table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($users->count() > 0)
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['status'] == 1 ? 'Activated' : 'Deactivated' }}</td>
                        <td>{{ strtolower($user['role']) == 'itso' ? strtoupper($user['role']) : ucfirst($user['role']) }}</td>
                        <td>
                            <a href="{{ route('users.idview',$user['id']) }}" class="btn btn-sm btn-secondary">View</a>
                            <a href="{{ route('users.edit',$user['id']) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <a href="{{ route('users.disable',$user['id']) }}" class="btn btn-sm btn-danger">Disable</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No users found matching your search criteria.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>