@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Panel administracyjny</h3>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger">Wyloguj</button>
            </form>
        </div>
        <div class="card-body">
            <h4>Witaj, {{ Auth::user()->name }}!</h4>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('settings.edit') }}" class="btn btn-danger">
                    <i class="fas fa-cog"></i> Ustawienia instytucji
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Dodaj użytkownika
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Lista użytkowników</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nazwa użytkownika</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\User::all() as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(Auth::user()->is_admin)
                                            {{-- Admin widzi wszystkie akcje dla wszystkich użytkowników (oprócz usuwania siebie) --}}
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-edit"></i> Edytuj
                                            </a>
                                            <a href="{{ route('users.change-password', $user) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-key"></i> Zmień hasło
                                            </a>
                                            @if(!$user->is_admin) {{-- Admina nie można usunąć --}}
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Czy na pewno chcesz usunąć tego użytkownika?')">
                                                        <i class="fas fa-trash"></i> Usuń
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            {{-- Zwykły użytkownik widzi tylko swoje akcje --}}
                                            @if($user->id === Auth::id())
                                                <a href="{{ route('users.edit', $user) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i> Edytuj
                                                </a>
                                                <a href="{{ route('users.change-password') }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-key"></i> Zmień hasło
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection