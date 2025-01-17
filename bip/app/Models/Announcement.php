<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'is_important',
        'publish_at',
        'expire_at',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_important' => 'boolean',
        'publish_at' => 'datetime',
        'expire_at' => 'datetime'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->where('publish_at', '<=', now())
                ->where(function($q) {
                    $q->whereNull('expire_at')
                        ->orWhere('expire_at', '>', now());
                });
        });
    }

    public function scopeImportant($query)
    {
        return $query->where('is_important', true);
    }
}