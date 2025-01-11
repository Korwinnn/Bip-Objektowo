<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryVisit extends Model
{
    protected $fillable = [
        'category_id',
        'visited_at',
        'ip_address'
    ];

    protected $dates = [
        'visited_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}