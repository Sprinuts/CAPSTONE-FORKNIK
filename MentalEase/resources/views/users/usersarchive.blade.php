<div>
    <link rel="stylesheet" href="{{ asset('style/users_cs.css') }} ">
    <h3 class="text-center">Archived Users</h3>
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
            <div>
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center mt-4">
                <strong>Nothing to see here...</strong>
            </div>
        @endif
    </div>
</div>
