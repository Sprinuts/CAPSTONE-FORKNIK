<div class="container mt-4">
    <h2>Patient Concerns</h2>
    <table class="table table-bordered mt-3">
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
                    <td>{{ Str::limit($concern->message, 50) }}</td>
                    <td>{{ $concern->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('concerns.show', $concern->id) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('concerns.reply', $concern->id) }}" class="btn btn-success btn-sm">Replied</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No concerns found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
