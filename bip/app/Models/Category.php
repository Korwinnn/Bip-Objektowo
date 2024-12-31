<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'content', 'parent_id'];
    
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
}