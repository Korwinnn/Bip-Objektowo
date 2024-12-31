@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $category->name }}</h3>
        </div>
        <div class="card-body">
            {!! $category->content !!}
            
            @if(auth()->check())
                <div class="mt-3">
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edytuj</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">Usuń</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection