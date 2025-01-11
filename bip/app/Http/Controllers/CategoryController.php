<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BreadcrumbsService;
use App\Models\CategoryHistory;
use App\Models\CategoryVisit;

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


    public function show(Category $category, Request $request)
    {
        // Zapisz odwiedziny
        CategoryVisit::create([
            'category_id' => $category->id,
            'visited_at' => now(),
            'ip_address' => $request->ip()
        ]);

        $breadcrumbs = $this->breadcrumbsService->getBreadcrumbs($category);
        
        $originalVersion = $category->history()
            ->orderBy('created_at', 'asc')
            ->first();
        
        $originalContent = $originalVersion ? $originalVersion->old_content : $category->content;
        $originalName = $originalVersion ? $originalVersion->old_name : $category->name;
        
        // Pobierz dane do wykresu
        $visitChartData = $category->visitsChartData;
        
        return view('categories.show', compact(
            'category', 
            'breadcrumbs', 
            'originalContent', 
            'originalName',
            'visitChartData'
        ));
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

        $category = new Category($validated);
        $category->created_by = auth()->id();
        $category->updated_by = auth()->id();
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();

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
            // Zapisz historię zmian
            CategoryHistory::create([
                'category_id' => $category->id,
                'user_id' => auth()->id(),
                'old_name' => $category->name,
                'new_name' => $validated['name'],
                'old_content' => $category->content,
                'new_content' => $validated['content']
            ]);

            // Aktualizuj licznik zmian
            $category->increment('changes_count');
            
            // Aktualizuj kategorię
            $category->fill($validated);
            $category->updated_by = auth()->id();
            $category->save();
            
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