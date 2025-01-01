<div class="sidebar">
    <ul class="category-list">
        @foreach($categories ?? [] as $category)
            @if(!$category->parent_id)
                <li class="category-item">
                    <a href="{{ route('categories.show', $category) }}" class="category-link">
                        {{ $category->name }}
                        @if($category->children->count() > 0)
                            <span class="arrow">›</span>
                        @endif
                    </a>
                    @if($category->children->count() > 0)
                        <ul class="subcategory-list">
                            @foreach($category->children as $child)
                                <li>
                                    <a href="{{ route('categories.show', $child) }}" class="subcategory-link">
                                        {{ $child->name }}
                                    </a>
                                </li>
                                @if(!$loop->last) <!-- Sprawdź, czy to nie ostatni element -->
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
                    <i class="bi bi-plus-circle"></i> Dodaj kategorię
                </a>
            </div>
        @endauth
    </ul>
</div>