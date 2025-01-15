<div class="sidebar">
    <ul class="category-list">
        @auth
        <div class="list-group mt-3">
            <a id="go-dashboard-btn" href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">
                Panel Administracyjny
            </a>
        </div>
        @endauth
        @foreach($categories ?? [] as $category)
            @if(!$category->parent_id)
                <li class="category-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('categories.show', $category) }}" class="category-link">
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
                        <ul class="subcategory-list">
                            @foreach($category->children as $child)
                                <li>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('categories.show', $child) }}" class="subcategory-link">
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