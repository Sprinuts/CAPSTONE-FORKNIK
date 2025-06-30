<link rel="stylesheet" href="{{ asset('style/patientconcerns.css') }}">

<div class="container mt-4">
    <div class="concerns-header">
        <h2><i class="fas fa-comments"></i> Patient Concerns</h2>
        <div class="header-actions">
            <div class="search-box">
                <input type="text" id="concernSearch" placeholder="Search concerns...">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    <div class="concerns-container">
        <table class="concerns-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($concerns as $concern)
                    <tr>
                        <td>{{ $concern->name }}</td>
                        <td>{{ $concern->email }}</td>
                        <td>{{ $concern->subject }}</td>
                        <td class="message-cell">{{ Str::limit($concern->message, 50) }}</td>
                        <td>{{ $concern->created_at->format('Y-m-d H:i') }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('concerns.show', $concern->id) }}" class="btn-action view">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('concerns.reply', $concern->id) }}" class="btn-action reply">
                                <i class="fas fa-reply"></i> Reply
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>No concerns found</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('concernSearch');
    const tableRows = document.querySelectorAll('.concerns-table tbody tr:not(.empty-row)');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value.toLowerCase();
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>

