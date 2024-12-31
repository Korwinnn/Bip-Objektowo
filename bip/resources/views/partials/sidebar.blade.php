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
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>