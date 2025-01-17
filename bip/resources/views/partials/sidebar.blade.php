<div class="sidebar">
    <ul class="category-list" id="sortable-categories">
        @auth
        <div class="list-group mt-3">
            <a id="go-dashboard-btn" href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                Panel Administracyjny
            </a>
        </div>
        @endauth
        @foreach($categories ?? [] as $category)
            @if(!$category->parent_id)
                <li class="category-item" data-id="{{ $category->id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        @auth
                            <div class="drag-handle me-2">
                                <i class="fas fa-grip-vertical"></i>
                            </div>
                        @endauth
                        <a href="{{ route('categories.show', $category) }}" class="category-link flex-grow-1">
                            {{ $category->name }}
                            @if($category->children->count() > 0)
                                <span class="arrow">›</span>
                            @endif
                        </a>
                        @auth
                            <div class="category-actions">
                                <a href="{{ route('categories.create', ['parent_id' => $category->id]) }}" 
                                   class="btn btn-sm btn-success" 
                                   title="Dodaj podkategorię">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                    @if($category->children->count() > 0)
                        <ul class="subcategory-list" data-parent="{{ $category->id }}">
                            @foreach($category->children as $child)
                                <li class="subcategory-item" data-id="{{ $child->id }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @auth
                                            <div class="drag-handle me-2">
                                                <i class="fas fa-grip-vertical"></i>
                                            </div>
                                        @endauth
                                        <a href="{{ route('categories.show', $child) }}" class="subcategory-link flex-grow-1">
                                            {{ $child->name }}
                                        </a>
                                        @auth
                                            <div class="category-actions">
                                                <a href="{{ route('categories.edit', $child) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $child) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endauth
                                    </div>
                                </li>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
                <hr>
            @endif
        @endforeach
        @auth
            <div class="list-group mt-3">
                <a id="add-category-btn" href="{{ route('categories.create') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-plus-circle"></i> Dodaj kategorię
                </a>
            </div>
        @endauth
    </ul>
</div>

<!-- Dodaj te style do pliku CSS -->
<style>
.drag-handle {
    cursor: grab;
    color: #6c757d;
    padding: 0.25rem;
    opacity: 0.5;
    transition: opacity 0.2s;
}

.drag-handle:hover {
    opacity: 1;
}

.category-item, .subcategory-item {
    list-style: none;
    padding: 0.5rem;
    background: #fff;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.category-item.sortable-ghost,
.subcategory-item.sortable-ghost {
    opacity: 0.5;
    background-color: #e9ecef;
}

.category-item.sortable-drag,
.subcategory-item.sortable-drag {
    opacity: 0.8;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.category-list, .subcategory-list {
    padding-left: 0;
    margin-bottom: 0;
}

.subcategory-list {
    padding-left: 1.5rem;
}
</style>

<!-- Dodaj ten skrypt na końcu pliku -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>