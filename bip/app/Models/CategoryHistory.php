<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryHistory extends Model
{
    protected $table = 'category_history';
    
    protected $fillable = [
        'category_id',
        'user_id',
        'old_content',
        'new_content',
        'old_name',
        'new_name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}