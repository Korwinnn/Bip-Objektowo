@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card">
            <div class="card-header">
                <h3>Mapa strony</h3>
            </div>
            
            <div class="card-body">
                <ul class="space-y-4">
                    @foreach($categories as $category)
                        <li>
                            <div class="flex items-center">
                                <a href="{{ route('categories.show', $category) }}" 
                                   class="text-blue-600 hover:text-blue-800 font-medium">
                                    {{ $category->name }}
                                </a>
                            </div>
                            
                            @if($category->children->count() > 0)
                                <ul class="ml-6 mt-2 space-y-2">
                                    @foreach($category->children as $child)
                                        <li>
                                            <a href="{{ route('categories.show', $child) }}" 
                                               class="text-gray-600 hover:text-gray-800">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection