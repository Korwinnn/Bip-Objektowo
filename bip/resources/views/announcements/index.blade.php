@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Aktualności</h3>
        @auth
            <a href="{{ route('announcements.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Dodaj ogłoszenie
            </a>
        @endauth
    </div>
    <div class="card-body">
        @if($announcements->isEmpty())
            <div class="alert alert-info">
                Brak aktualnych ogłoszeń.
            </div>
        @else
            <div class="list-group">
                @foreach($announcements as $announcement)
                    <div class="list-group-item {{ $announcement->is_important ? 'bg-light border-danger' : '' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-1">
                                @if($announcement->is_important)
                                    <span class="badge bg-danger me-2">Ważne</span>
                                @endif
                                {{ $announcement->title }}
                            </h5>
                            <small class="text-muted">{{ $announcement->created_at->format('d.m.Y') }}</small>
                        </div>
                        <p class="mb-1">{{ Str::limit($announcement->content, 200) }}</p>
                        <div class="mt-2">
                            <a href="{{ route('announcements.show', $announcement) }}" 
                               class="btn btn-sm btn-primary" style="">
                                Czytaj więcej
                            </a>
                            @auth
                                <a href="{{ route('announcements.edit', $announcement) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edytuj
                                </a>
                                <form action="{{ route('announcements.destroy', $announcement) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Czy na pewno chcesz usunąć to ogłoszenie?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Usuń
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-3">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .list-group-item {
        transition: all 0.2s ease;
    }
    
    .list-group-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .badge {
        font-size: 0.8rem;
    }
</style>
@endpush