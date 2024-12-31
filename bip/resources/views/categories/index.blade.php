@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Strona główna BIP</h3>
        </div>
        <div class="card-body">
            <p>Witamy w Biuletynie Informacji Publicznej.</p>
            @if(auth()->check())
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Dodaj nową kategorię</a>
            @endif
        </div>
    </div>
@endsection