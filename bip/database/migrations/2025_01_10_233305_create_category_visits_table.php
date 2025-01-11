<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('category_visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->dateTime('visited_at');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');

            $table->index('visited_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_visits');
    }
};