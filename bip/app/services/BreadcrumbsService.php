<?php

namespace App\Services;

use App\Models\Category;

class BreadcrumbsService
{
    public function getBreadcrumbs($category = null)
    {
        $breadcrumbs = [];
        
        if ($category) {
            $current = $category;
            
            do {
                array_unshift($breadcrumbs, [
                    'title' => $current->name,
                    'url' => route('categories.show', $current->id)
                ]);
                $current = $current->parent;
            } while ($current);
        }
        
        return $breadcrumbs;
    }
}