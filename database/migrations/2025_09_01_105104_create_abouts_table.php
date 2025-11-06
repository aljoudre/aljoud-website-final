<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            // $table->string('section_tu')->nullable();
            // $table->json('title')->nullable();        // {"en": "Title EN", "ar": "Title AR"}
            // $table->json('description')->nullable();  // {"en": "...", "ar": "..."}
            $table->json('header')->nullable();   // {"en": "...", "ar": "..."}
            $table->json('content')->nullable();   // {"en": "...", "ar": "..."}
            // $table->longText('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
