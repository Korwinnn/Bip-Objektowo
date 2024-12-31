<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private function getCategories()
    {
        return Category::with('children')
            ->whereNull('parent_id')
            ->get();
    }
    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $categories = $this->getCategories(); // Dodane
        return view('categories.show', compact('category', 'categories'));
    }

    public function create()
    {
        $categories = Category::all(); // do wyboru kategorii nadrzędnej
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'content' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create($validated);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'content' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $category->update($validated);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $results = Category::where('name', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();
            
        return response()->json($results);
    }
}