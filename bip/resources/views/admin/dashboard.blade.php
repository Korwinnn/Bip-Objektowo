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

            <a href="{{ route('settings.edit') }}" class="btn btn-danger">
                <i class="fas fa-cog"></i> Ustawienia instytucji
            </a>
        </div>
    </div>
</div>
@endsection