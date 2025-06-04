<div>
    <link rel="stylesheet" href="{{ asset('style/users_cs.css') }} ">
    <h3 class="text-center">List of Users</h3>
    <div class="adjust">
        <a href="{{ route('users.add') }}" class="btn btn-lg btn-success adjustBtn">Add New User</a>
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
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['status'] == 1 ? 'Activated' : 'Deactivated'; ?></td>
                    <td><?= strtolower($user['role']) == 'itso' ? strtoupper($user['role']) : ucfirst($user['role']); ?></td>
                    <td>
                        <a href="{{ route('users.idview',$user['id']) }}  " class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('users.edit',$user['id']) }}  " class="btn btn-sm btn-secondary">Edit</a>
                        <a href="{{ route('users.disable',$user['id']) }} " class="btn btn-sm btn-danger">Disable</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>
