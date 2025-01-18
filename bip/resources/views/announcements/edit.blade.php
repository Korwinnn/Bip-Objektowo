@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edytuj ogłoszenie</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('announcements.update', $announcement) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Tytuł ogłoszenia</label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $announcement->title) }}" 
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Treść ogłoszenia</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" 
                          name="content" 
                          rows="5" 
                          required>{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" 
                           type="checkbox" 
                           id="is_important" 
                           name="is_important" 
                           {{ old('is_important', $announcement->is_important) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_important">
                        Ważne ogłoszenie
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label for="expire_at" class="form-label">Data wygaśnięcia (opcjonalnie)</label>
                <input type="datetime-local" 
                       class="form-control" 
                       id="expire_at" 
                       name="expire_at" 
                       value="{{ old('expire_at', $announcement->expire_at ? $announcement->expire_at->format('Y-m-d\TH:i') : '') }}">
            </div>

            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
            <a href="{{ route('announcements.show', $announcement) }}" class="btn btn-secondary">Anuluj</a>
        </form>
    </div>
</div>
@endsection