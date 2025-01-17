<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $categories = \App\Models\Category::whereNull('parent_id')->get();
        foreach($categories as $index => $category) {
            $category->update(['display_order' => $index]);
            
            // Napraw też podkategorie
            $children = $category->children;
            foreach($children as $childIndex => $child) {
                $child->update(['display_order' => $childIndex]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
