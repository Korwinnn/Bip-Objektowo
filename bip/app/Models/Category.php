<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'content',
        'created_by',
        'updated_by',
        'changes_count',
        'display_order'
    ];

    public $timestamps = true;
    
    // Relacja do kategorii nadrzędnej
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    
    // Relacja do podkategorii
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
                    ->orderBy('display_order', 'asc');
    }
    
    // Metoda pomocnicza do pobrania kategorii głównych z sortowaniem
    public static function mainCategories()
    {
        return self::whereNull('parent_id')
                   ->orderBy('display_order', 'asc')
                   ->with(['children' => function($query) {
                       $query->orderBy('display_order', 'asc');
                   }])
                   ->get();
    }

    // Boot method do automatycznego ustawiania display_order dla nowych kategorii
    protected static function boot()
    {
        parent::boot();

        // Dodajemy domyślne sortowanie dla wszystkich zapytań
        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('display_order', 'asc');
        });

        static::creating(function ($category) {
            if (is_null($category->display_order)) {
                $maxOrder = self::where('parent_id', $category->parent_id)
                               ->max('display_order');
                $category->display_order = is_null($maxOrder) ? 0 : $maxOrder + 1;
            }
        });
    }

    // Metoda pomocnicza do aktualizacji kolejności
    public function updateOrder($newPosition, $newParentId = null)
    {
        $oldParentId = $this->parent_id;
        $oldPosition = $this->display_order;

        // Jeśli zmienia się rodzic
        if ($newParentId !== null && $oldParentId !== $newParentId) {
            // Zmniejsz pozycję wszystkich elementów w starym rodzicu
            self::where('parent_id', $oldParentId)
                ->where('display_order', '>', $oldPosition)
                ->decrement('display_order');

            // Zwiększ pozycję elementów w nowym rodzicu
            self::where('parent_id', $newParentId)
                ->where('display_order', '>=', $newPosition)
                ->increment('display_order');

            $this->parent_id = $newParentId;
            $this->display_order = $newPosition;
        } 
        // Jeśli pozostaje w tym samym rodzicu
        else {
            if ($oldPosition < $newPosition) {
                // Przesuwanie w dół
                self::where('parent_id', $this->parent_id)
                    ->whereBetween('display_order', [$oldPosition + 1, $newPosition])
                    ->decrement('display_order');
            } else {
                // Przesuwanie w górę
                self::where('parent_id', $this->parent_id)
                    ->whereBetween('display_order', [$newPosition, $oldPosition - 1])
                    ->increment('display_order');
            }
            $this->display_order = $newPosition;
        }

        return $this->save();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')
            ->withDefault(['name' => 'Użytkownik został usunięty']);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by')
            ->withDefault(['name' => 'Użytkownik został usunięty']);
    }

    public function history()
    {
        return $this->hasMany(CategoryHistory::class);
    }

    public function visits()
    {
        return $this->hasMany(CategoryVisit::class);
    }

    public function getVisitsCountAttribute()
    {
        return $this->visits()->count();
    }

    public function getVisitsChartDataAttribute()
    {
        return $this->visits()
            ->selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => $item->count
                ];
            });
    }
}