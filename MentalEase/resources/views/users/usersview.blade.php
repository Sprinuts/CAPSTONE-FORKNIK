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
                <form action="{{ route('users.search.results') }}" method="GET" class="search-filter">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="term" placeholder="Search users..." class="search-input">
                    </div>
                    <div class="filter-dropdown">
                        <select name="role" class="form-select">
                            <option value="all">All Roles</option>
                            <option value="admin">Admin</option>
                            <option value="psychometrician">Psychometrician</option>
                            <option value="cashier">Cashier</option>
                            <option value="patient">Patient</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div id="searchResults" class="mb-3" style="display: none;">
            <div class="alert alert-info">
                <span id="resultCount"></span>
                <button type="button" class="btn btn-sm btn-outline-secondary float-end" id="clearSearch">
                    <i class="fas fa-times"></i> Clear Search
                </button>
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
        <div class="pagination-container" id="paginationContainer">
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
    const searchResults = document.getElementById('searchResults');
    const resultCount = document.getElementById('resultCount');
    const clearSearchBtn = document.getElementById('clearSearch');
    const paginationContainer = document.getElementById('paginationContainer');
    
    // Debounce function to limit how often a function can be called
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, wait);
        };
    }
    
    // Function to search users via AJAX
    const searchUsers = debounce(function() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const selectedRole = document.querySelector('input[name="roleFilter"]:checked').value;
        
        // If search term is empty and role is "all", show regular pagination
        if (searchTerm === '' && selectedRole === 'all') {
            searchResults.style.display = 'none';
            paginationContainer.style.display = '';
            
            // Reload the page to reset to original state
            window.location.reload();
            return;
        }
        
        // Show loading indicator
        const tableBody = document.getElementById('userTableBody');
        tableBody.innerHTML = '<tr><td colspan="5" class="text-center"><i class="fas fa-spinner fa-spin"></i> Searching...</td></tr>';
        
        // Make AJAX request to search users
        fetch(`/users/search?term=${encodeURIComponent(searchTerm)}&role=${encodeURIComponent(selectedRole)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Clear the table body
                tableBody.innerHTML = '';
                
                // Hide pagination when searching
                paginationContainer.style.display = 'none';
                
                // Show search results info
                searchResults.style.display = 'block';
                resultCount.textContent = `Found ${data.length} user(s) matching your search.`;
                
                // Add the search results to the table
                if (data.length > 0) {
                    data.forEach(user => {
                        const row = document.createElement('tr');
                        row.dataset.role = user.role.toLowerCase();
                        
                        row.innerHTML = `
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.status == 1 ? 'Activated' : 'Deactivated'}</td>
                            <td>${user.role.toLowerCase() === 'itso' ? user.role.toUpperCase() : user.role.charAt(0).toUpperCase() + user.role.slice(1)}</td>
                            <td>
                                <a href="/users/idview/${user.id}" class="btn btn-sm btn-secondary">View</a>
                                <a href="/users/edit/${user.id}" class="btn btn-sm btn-secondary">Edit</a>
                                <a href="/users/disable/${user.id}" class="btn btn-sm btn-danger">Disable</a>
                            </td>
                        `;
                        
                        tableBody.appendChild(row);
                    });
                } else {
                    // No results found
                    const row = document.createElement('tr');
                    row.innerHTML = '<td colspan="5" class="text-center">No users found matching your search criteria.</td>';
                    tableBody.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error searching users:', error);
                tableBody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Error searching users. Please try again.</td></tr>';
            });
    }, 300); // 300ms debounce
    
    // Add event listeners
    if (searchInput) {
        searchInput.addEventListener('input', searchUsers);
    }
    
    roleFilters.forEach(filter => {
        filter.addEventListener('change', searchUsers);
    });
    
    // Clear search button
    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            document.querySelector('input[name="roleFilter"][value="all"]').checked = true;
            
            // Reload the page to reset to original state
            window.location.reload();
        });
    }
</script>










