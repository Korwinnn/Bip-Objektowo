<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BreadcrumbsService;

class CategoryController extends Controller
{
    private $categories;

    private $breadcrumbsService;

    public function __construct(BreadcrumbsService $breadcrumbsService)
    {
        $this->breadcrumbsService = $breadcrumbsService;
    }

    public function index()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->get();
        
        // Dodajemy breadcrumbs dla strony głównej
        $breadcrumbs = [];  // Pusta tablica, bo jesteśmy na stronie głównej
        
        return view('categories.index', compact('categories', 'breadcrumbs'));
    }


    public function show(Category $category)
    {
        $breadcrumbs = $this->breadcrumbsService->getBreadcrumbs($category);
        return view('categories.show', compact('category', 'breadcrumbs'));
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
        // zmiana z route('categories.index') na route('dashboard')
        return redirect()->route('admin.dashboard')->with('success', 'Kategoria została dodana');
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
        
        try {
            $category->update($validated);
            return redirect()
                ->route('categories.show', $category)
                ->with('success', 'Kategoria została zaktualizowana');
        } catch (\Exception $e) {
            \Log::error('Błąd aktualizacji kategorii: ' . $e->getMessage());
            return back()
                ->with('error', 'Wystąpił błąd podczas aktualizacji kategorii');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.dashboard');
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