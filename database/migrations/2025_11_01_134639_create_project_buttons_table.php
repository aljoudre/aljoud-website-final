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
        Schema::create('project_buttons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->json('title')->nullable(); // Translatable button title
            $table->string('type')->default('external_url'); // 'external_url', '360_tour', 'brochure', 'website'
            $table->text('url')->nullable(); // URL for external links, brochure, or external website
            $table->text('form_url')->nullable(); // External form URL for interest registration
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_buttons');
    }
};
