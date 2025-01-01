@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Dodaj nową kategorię</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nazwa kategorii</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Treść (opcjonalnie)</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" 
                          name="content" 
                          rows="3">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Kategoria nadrzędna (opcjonalnie)</label>
                <select class="form-select @error('parent_id') is-invalid @enderror" 
                        id="parent_id" 
                        name="parent_id">
                    <option value="">Brak (kategoria główna)</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Dodaj kategorię</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Anuluj</a>
        </form>
    </div>
</div>
@endsection