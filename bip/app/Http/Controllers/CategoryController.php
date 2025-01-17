<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BreadcrumbsService;
use App\Models\CategoryHistory;
use App\Models\CategoryVisit;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
DB::enableQueryLog();

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
        $categories = Category::with(['children' => function($query) {
                $query->orderBy('display_order', 'asc');
            }])
            ->whereNull('parent_id')
            ->orderBy('display_order', 'asc')
            ->get();
        
        $breadcrumbs = [];
        
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

    public function create(Request $request)
    {
        $categories = Category::all(); // do wyboru kategorii nadrzędnej
        $selectedParentId = $request->get('parent_id'); // pobierz parent_id z URL
        return view('categories.create', compact('categories', 'selectedParentId'));
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
    public function printView(Category $category)
    {
        $now = now();
        $institution = Setting::where('key', 'institution_name')->first()->value ?? 'Biuletyn Informacji Publicznej';
        
        return view('categories.print', compact('category', 'now', 'institution'));
    }

    public function generatePdf(Category $category)
    {
        $now = now();
        $institution = Setting::where('key', 'institution_name')->first()->value ?? 'Biuletyn Informacji Publicznej';
        
        $pdf = PDF::loadView('categories.pdf', compact('category', 'now', 'institution'));
        
        return $pdf->download($category->name . '.pdf');
    }

    public function print(Category $category)
    {
        $now = Carbon::now();
        $institution = config('app.name', 'BIP');
        
        return view('categories.print', compact('category', 'now', 'institution'));
    }

    public function pdf(Category $category)
    {
        $now = Carbon::now();
        $institution = config('app.name', 'BIP');
        
        $pdf = PDF::loadView('categories.pdf', compact('category', 'now', 'institution'));
        
        return $pdf->download($category->name . '.pdf');
    }

    public function showInWindow(Category $category)
    {
        $now = Carbon::now();
        $institution = config('app.name', 'BIP');
        
        return view('categories.window', compact('category', 'now', 'institution'));
    }
    public function statistics(Request $request)
    {
        $selectedYear = $request->input('year', now()->year);
        $selectedCategoryId = $request->input('category_id');
        
        // Pobierz wszystkie kategorie do dropdowna
        $categories = Category::all();
        
        // Pobierz dostępne lata
        $visitsQuery = CategoryVisit::query();
        if ($selectedCategoryId) {
            $visitsQuery->where('category_id', $selectedCategoryId);
        }
        
        $availableYears = $visitsQuery
            ->selectRaw('YEAR(visited_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Statystyki miesięczne
        $monthlyQuery = CategoryVisit::whereYear('visited_at', $selectedYear);
        if ($selectedCategoryId) {
            $monthlyQuery->where('category_id', $selectedCategoryId);
        }
        
        $monthlyStats = $monthlyQuery
            ->selectRaw('MONTH(visited_at) as month, COUNT(*) as visits')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('visits', 'month')
            ->toArray();

        // Wypełnij brakujące miesiące zerami
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = [
                'month' => date('F', mktime(0, 0, 0, $i, 1)),
                'visits' => $monthlyStats[$i] ?? 0
            ];
        }

        // Statystyki dzienne dla aktualnego miesiąca
        $dailyQuery = CategoryVisit::whereYear('visited_at', $selectedYear)
            ->whereMonth('visited_at', now()->month);
        if ($selectedCategoryId) {
            $dailyQuery->where('category_id', $selectedCategoryId);
        }
        
        $dailyStats = $dailyQuery
            ->selectRaw('DAY(visited_at) as day, COUNT(*) as visits')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->pluck('visits', 'day')
            ->toArray();

        // Wypełnij brakujące dni zerami
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, now()->month, $selectedYear);
        $dailyData = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dailyData[] = [
                'day' => $i,
                'visits' => $dailyStats[$i] ?? 0
            ];
        }

        // Statystyki godzinowe
        $hourlyQuery = CategoryVisit::whereYear('visited_at', $selectedYear)
            ->whereMonth('visited_at', now()->month)
            ->whereDay('visited_at', now()->day);
        if ($selectedCategoryId) {
            $hourlyQuery->where('category_id', $selectedCategoryId);
        }
        
        $hourlyStats = $hourlyQuery
            ->selectRaw('HOUR(visited_at) as hour, COUNT(*) as visits')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->pluck('visits', 'hour')
            ->toArray();

        // Wypełnij brakujące godziny zerami
        $hourlyData = [];
        for ($i = 0; $i < 24; $i++) {
            $hourlyData[] = [
                'hour' => sprintf('%02d:00', $i),
                'visits' => $hourlyStats[$i] ?? 0
            ];
        }

        return view('categories.statistics', compact(
            'categories',
            'selectedCategoryId',
            'selectedYear',
            'availableYears',
            'monthlyData',
            'dailyData',
            'hourlyData'
        ));
    }
    public function reorder(Request $request)
    {
        \DB::beginTransaction();
        
        try {
            $categoryId = $request->categoryId;
            $newPosition = $request->newPosition;
            $newParentId = $request->parentId;
            
            \Log::info('Otrzymane dane:', [
                'categoryId' => $categoryId,
                'newPosition' => $newPosition,
                'newParentId' => $newParentId
            ]);

            $category = Category::findOrFail($categoryId);
            
            // Jeśli zmienia się parent_id lub jest to kategoria główna (null parent_id)
            if ($newParentId !== $category->parent_id || $category->parent_id === null) {
                // Zmniejsz pozycję wszystkich elementów w starym rodzicu/poziomie
                $query = Category::query();
                if ($category->parent_id === null) {
                    $query->whereNull('parent_id');
                } else {
                    $query->where('parent_id', $category->parent_id);
                }
                $query->where('display_order', '>', $category->display_order)
                    ->decrement('display_order');

                // Zwiększ pozycję elementów w nowym rodzicu/poziomie
                $query = Category::query();
                if ($newParentId === null) {
                    $query->whereNull('parent_id');
                } else {
                    $query->where('parent_id', $newParentId);
                }
                $query->where('display_order', '>=', $newPosition)
                    ->increment('display_order');

                $category->parent_id = $newParentId;
                $category->display_order = $newPosition;
                $category->save();
            } else {
                // Jeśli przesuwamy w tym samym poziomie
                if ($category->display_order < $newPosition) {
                    // Przesuwanie w dół
                    Category::where('parent_id', $category->parent_id)
                        ->where('display_order', '>', $category->display_order)
                        ->where('display_order', '<=', $newPosition)
                        ->decrement('display_order');
                } else {
                    // Przesuwanie w górę
                    Category::where('parent_id', $category->parent_id)
                        ->where('display_order', '>=', $newPosition)
                        ->where('display_order', '<', $category->display_order)
                        ->increment('display_order');
                }
                
                $category->display_order = $newPosition;
                $category->save();
            }

            // Napraw numerację dla odpowiedniego poziomu
            $query = Category::query();
            if ($category->parent_id === null) {
                $query->whereNull('parent_id');
            } else {
                $query->where('parent_id', $category->parent_id);
            }
            
            $categories = $query->orderBy('display_order')->get();
            
            foreach($categories as $index => $cat) {
                if ($cat->display_order !== $index) {
                    $cat->update(['display_order' => $index]);
                }
            }

            \DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Kolejność zaktualizowana'
            ]);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Błąd podczas zmiany kolejności: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
