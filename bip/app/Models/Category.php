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
        'changes_count'
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
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    // Metoda pomocnicza do pobrania kategorii głównych
    public static function mainCategories()
    {
        return self::whereNull('parent_id')->with('children')->get();
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