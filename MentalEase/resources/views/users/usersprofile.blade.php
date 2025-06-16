<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<div class="d-flex flex-column align-items-center mt-4">
    <!-- Profile Picture -->
    <img src="{{ asset('style/assets/defaultprofile.jpg') }}" alt="Profile Picture" class="rounded-circle shadow mb-3" style="width: 130px; height: 130px; object-fit: cover;">

    <!-- User Details -->
    <div class="card text-center" style="width: 100%; max-width: 400px;">
        <div class="card-body position-relative">
            <!-- Toggle Eye Icon -->
            <button onclick="toggleName()" class="btn btn-link position-absolute end-0 top-0 mt-2 me-2 p-0" style="font-size: 1.25rem;">
                <i id="eyeIcon" class="bi bi-eye"></i>
            </button>

            <!-- Name (toggle between asterisks and actual name) -->
            <h2 id="userName" class="card-title">
                {{ str_repeat('*', strlen($user->name)) }}
            </h2>

            <!-- Email -->
            <p class="card-text text-muted">{{ $user->email }}</p>

            <!-- Contact Number -->
            <p class="card-text text-muted">
                @if($user->contactnumber)
                    {{ $user->contactnumber }}
                @else
                    <span class="text-secondary">No contact number provided</span>
                @endif
            </p>
            <!-- Address -->
            <p class="card-text text-muted">
                @if($user->address)
                    {{ $user->address }}
                @else
                    <span class="text-secondary">No address provided</span>
                @endif
            </p>

            <!-- Age -->
            <p class="card-text text-muted">
                @if($user->age)
                    {{ $user->age }} years old
                @else
                    <span class="text-secondary">No age provided</span>
                @endif
            </p>

            <!-- Gender -->
            <p class="card-text text-muted">
                @if($user->gender)
                    {{ ucfirst($user->gender) }}
                @else
                    <span class="text-secondary">No gender provided</span>
                @endif
            </p>

            <!-- Civil Status -->
            <p class="card-text text-muted">
                @if($user->civil_status)
                    {{ ucfirst($user->civil_status) }}
                @else
                    <span class="text-secondary">No civil status provided</span>
                @endif
            </p>

            <!-- Birthdate -->
            <p class="card-text text-muted">
                @if($user->birthdate)
                    {{ \Carbon\Carbon::parse($user->birthdate)->format('F d, Y') }}
                @else
                    <span class="text-secondary">No birthdate provided</span>
                @endif
            </p>

            <!-- Birthplace -->
            <p class="card-text text-muted">
                @if($user->birthplace)
                    {{ $user->birthplace }}
                @else
                    <span class="text-secondary">No birthplace provided</span>
                @endif
            </p>

            <!-- Religion -->
            <p class="card-text text-muted">
                @if($user->religion)
                    {{ $user->religion }}
                @else
                    <span class="text-secondary">No religion provided</span>
                @endif
            </p>
        </div>
    </div>
</div>

<!-- JavaScript to toggle name -->
<script>
    const actualName = @json($user->name);
    const hiddenName = '*'.repeat(actualName.length);

    function toggleName() {
        const nameEl = document.getElementById("userName");
        const icon = document.getElementById("eyeIcon");

        if (nameEl.textContent === hiddenName) {
            nameEl.textContent = actualName;
            icon.classList.replace("bi-eye", "bi-eye-slash");
        } else {
            nameEl.textContent = hiddenName;
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }
    }
</script>

