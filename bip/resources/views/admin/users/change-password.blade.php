@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">
                @if(Auth::user()->is_admin && Auth::id() !== $user->id)
                    Zmiana hasła użytkownika {{ $user->username }}
                @else
                    Zmiana hasła
                @endif
            </h3>
        </div>
        <div class="card-body">
            @if(Auth::user()->is_admin && Auth::id() !== $user->id)
                <form method="POST" action="{{ route('users.admin-change-password', $user) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password" class="form-label">Nowe hasło</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Potwierdź nowe hasło</label>
                        <div class="input-group">
                            <input type="password" class="form-control" 
                                id="password_confirmation" name="password_confirmation" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
            @else
                <form method="POST" action="{{ route('users.update-password') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Aktualne hasło</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" name="current_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Nowe hasło</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Potwierdź nowe hasło</label>
                        <div class="input-group">
                            <input type="password" class="form-control" 
                                id="password_confirmation" name="password_confirmation" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>
            @endif

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Zmień hasło</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Anuluj</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId, buttonId) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    
    button.addEventListener('click', function() {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        button.querySelector('i').classList.toggle('fa-eye');
        button.querySelector('i').classList.toggle('fa-eye-slash');
    });
}

togglePasswordVisibility('password', 'togglePassword');
togglePasswordVisibility('password_confirmation', 'togglePasswordConfirmation');
@if(!Auth::user()->is_admin || Auth::id() === $user->id)
    togglePasswordVisibility('current_password', 'toggleCurrentPassword');
@endif
</script>
@endsection