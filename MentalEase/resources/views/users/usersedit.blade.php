<div class="d-flex align-items-center justify-content-center">
    <link rel="stylesheet" href="{{ asset('style/usersedit.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CDN -->
    <div class="col col-md-7">

        <form action="{{ route('users.edit')}}" method="post" class="adjust">
            <div class="form-group mb-2">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>">
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    </div>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $user['name']; ?>">
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope-open-text"></i></span>
                    </div>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user['email']; ?>">
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="role" class="form-label">Role</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-users-cog"></i></span>
                    </div>
                    <select name="role" id="role" class="form-control">
                        <option value="patient" <?= $user['role'] == 'patient' ? 'selected' : ''; ?>>Patient</option>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="psychometrician" <?= $user['role'] == 'psychometrician' ? 'selected' : ''; ?>>Psychometrician</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
            <br>
                <button type="submit" class="btn btn-success">Save Changes</button>
                <br> 
                <a href="{{ route('users.view')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
