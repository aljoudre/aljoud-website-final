<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->default(Str::uuid7());
            $table->json('name')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('image')->nullable();
            $table->json('location')->nullable();
            $table->json('type')->nullable();
            $table->string('category')->default('lands_auctions'); // 'lands_auctions' or 'residential_commercial'
            $table->json('status')->nullable();
            $table->string('status_color')->nullable();
            
            // Map fields
            $table->string('map_type')->nullable(); // 'marker' or 'polygon'
            $table->decimal('marker_lat', 10, 8)->nullable();
            $table->decimal('marker_lng', 11, 8)->nullable();
            $table->json('polygon_coordinates')->nullable(); // Array of [lat, lng] pairs
            $table->string('polygon_color')->default('#005A58');
            
            // Page Layout Settings
            $table->string('page_layout')->default('standard'); // 'standard', 'minimal', 'villa'
            $table->boolean('has_header_image')->default(true);
            $table->json('header_description')->nullable(); // Brief description in header
            $table->string('external_website_url')->nullable(); // Link to separate website
            
            // 3D Tour Settings
            $table->boolean('enable_3d_tour')->default(false);
            $table->text('tour_360_url')->nullable(); // URL or embed code for 360 tour
            
            // Project Description & Stats
            $table->json('description')->nullable(); // Full project description
            $table->json('owner')->nullable(); // Owner/Developer info
            $table->json('developer')->nullable();
            $table->json('contractor')->nullable();
            
            // Statistics
            $table->integer('total_area')->nullable(); // in square meters
            $table->integer('building_area')->nullable();
            $table->integer('total_units')->nullable();
            $table->decimal('market_value', 15, 2)->nullable(); // in millions
            
            // Additional content
            $table->json('additional_content')->nullable(); // For extra custom content
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
