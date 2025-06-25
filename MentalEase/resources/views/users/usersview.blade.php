<div>
    <link rel="stylesheet" href="{{ asset('style/users.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <h3 class="text-center">
        <i class="fas fa-users"></i> 
        <span class="heading-text">List of Users</span>
    </h3>
    <div class="adjust">
        <div class="action-bar">
            <div class="action-buttons">
                <a href="{{ route('users.add') }}" class="btn btn-lg btn-success adjustBtn">Add New User</a>
                <a href="{{ route('users.pdf') }}" class="btn btn-lg btn-primary adjustBtn" target="_blank">Generate PDF</a>
            </div>
            <div class="filter-container">
                <div class="search-filter">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="userSearch" placeholder="Search users..." class="search-input">
                    </div>
                    <div class="filter-dropdown">
                        <button class="filter-btn">
                            <i class="fas fa-filter"></i>
                            <span>Filter Role</span>
                        </button>
                        <div class="filter-menu">
                            <div class="filter-option">
                                <input type="radio" id="all" name="roleFilter" value="all" checked>
                                <label for="all">All Roles</label>
                            </div>
                            <div class="filter-option">
                                <input type="radio" id="admin" name="roleFilter" value="admin">
                                <label for="admin">Admin</label>
                            </div>
                            <div class="filter-option">
                                <input type="radio" id="psychometrician" name="roleFilter" value="psychometrician">
                                <label for="psychometrician">Psychometrician</label>
                            </div>
                            <div class="filter-option">
                                <input type="radio" id="cashier" name="roleFilter" value="cashier">
                                <label for="cashier">Cashier</label>
                            </div>
                            <div class="filter-option">
                                <input type="radio" id="patient" name="roleFilter" value="patient">
                                <label for="patient">Patient</label>
                            </div>
                        </div>
                    </div>
                </div>
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
            <tbody id="userTableBody">
                @foreach($users as $user)
                <tr data-role="{{ strtolower($user['role']) }}">
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
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<script>
    // Toggle filter dropdown
    const filterBtn = document.querySelector('.filter-btn');
    const filterMenu = document.querySelector('.filter-menu');
    
    if (filterBtn) {
        filterBtn.addEventListener('click', function() {
            filterMenu.classList.toggle('show');
        });
        
        // Close the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.filter-dropdown')) {
                filterMenu.classList.remove('show');
            }
        });
    }
    
    // Search and filter functionality
    const searchInput = document.getElementById('userSearch');
    const roleFilters = document.querySelectorAll('input[name="roleFilter"]');
    const userRows = document.querySelectorAll('#userTableBody tr');
    
    // Function to filter table rows
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = document.querySelector('input[name="roleFilter"]:checked').value;
        
        userRows.forEach(row => {
            const content = row.textContent.toLowerCase();
            const roleMatch = selectedRole === 'all' || row.dataset.role === selectedRole;
            const searchMatch = content.includes(searchTerm);
            
            if (roleMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    // Add event listeners
    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }
    
    roleFilters.forEach(filter => {
        filter.addEventListener('change', filterTable);
    });
</script>


