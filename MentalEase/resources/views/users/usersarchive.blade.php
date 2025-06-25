<div>
    <link rel="stylesheet" href="{{ asset('style/users.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <h3 class="text-center">
        <i class="fas fa-user-slash"></i> 
        <span class="heading-text">Archived Users</span>
    </h3>
    <div class="adjust">
        @if($users->count() > 0)
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
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['status'] == 1 ? 'Activated' : 'Deactivated' }}</td>
                        <td>{{ strtolower($user['role']) == 'itso' ? strtoupper($user['role']) : ucfirst($user['role']) }}</td>
                        <td>
                            <a href="{{ route('users.idview.disabled', $user['id']) }}" class="btn btn-sm btn-secondary">View</a>
                            <a href="{{ route('users.enable', $user['id']) }}" class="btn btn-sm btn-primary">Enable</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-container">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="text-center mt-4">
                <strong>Nothing to see here...</strong>
            </div>
        @endif
    </div>
</div>

