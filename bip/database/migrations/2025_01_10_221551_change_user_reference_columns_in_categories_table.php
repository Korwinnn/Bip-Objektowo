<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Usuwamy stare foreign key constraints
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            
            // Zmieniamy typ kolumn na varchar
            $table->string('created_by')->nullable()->change();
            $table->string('updated_by')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            // Konwertujemy z powrotem na bigInteger
            $table->bigInteger('created_by')->unsigned()->nullable()->change();
            $table->bigInteger('updated_by')->unsigned()->nullable()->change();
            
            // Przywracamy foreign keys
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }
};