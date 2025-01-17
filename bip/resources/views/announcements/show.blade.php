@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0">
                @if($announcement->is_important)
                    <span class="badge bg-danger me-2">Ważne</span>
                @endif
                {{ $announcement->title }}
            </h3>
            @auth
                <div>
                    <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edytuj
                    </a>
                    <form action="{{ route('announcements.destroy', $announcement) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Czy na pewno chcesz usunąć to ogłoszenie?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Usuń
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <p class="text-muted">
                <i class="fas fa-calendar-alt me-2"></i>
                Dodano: {{ $announcement->created_at->format('d.m.Y H:i') }}
            </p>
            @if($announcement->publish_at)
                <p class="text-muted">
                    <i class="fas fa-clock me-2"></i>
                    Opublikowano: {{ $announcement->publish_at->format('d.m.Y H:i') }}
                </p>
            @endif
            @if($announcement->expire_at)
                <p class="text-muted">
                    <i class="fas fa-hourglass-end me-2"></i>
                    Data wygaśnięcia: {{ $announcement->expire_at->format('d.m.Y H:i') }}
                </p>
            @endif
        </div>

        <div class="announcement-content">
            {!! nl2br(e($announcement->content)) !!}
        </div>

        <div class="mt-4">
            <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Powrót do listy
            </a>
        </div>
    </div>
</div>

@if(auth()->check())
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Informacje dodatkowe</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <tr>
                    <th style="width: 200px">Utworzył:</th>
                    <td>{{ optional($announcement->creator)->name ?? 'System' }}</td>
                </tr>
                @if($announcement->updated_by)
                    <tr>
                        <th>Ostatnio edytował:</th>
                        <td>{{ optional($announcement->editor)->name ?? 'System' }}</td>
                    </tr>
                    <tr>
                        <th>Data ostatniej edycji:</th>
                        <td>{{ $announcement->updated_at->format('d.m.Y H:i') }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
@endif
@endsection

@push('styles')
<style>
    .announcement-content {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.8em;
    }
</style>
@endpush