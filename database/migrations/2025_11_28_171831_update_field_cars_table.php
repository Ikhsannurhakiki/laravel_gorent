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
        Schema::table('cars', function (Blueprint $table) {
            // Brand dan Model
            $table->string('brand')->nullable(); // Toyota, Honda, BMW, etc.
            $table->string('model')->nullable(); // Camry, Civic, X5, etc.
            $table->string('variant')->nullable(); // Sport, Luxury, Base, etc.
            $table->integer('manufacture_year')->nullable();
            $table->string('color')->nullable();
            $table->integer('doors')->nullable();
            $table->integer('engine_capacity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'brand',
                'model',
                'variant',
                'manufacture_year',
                'color',
                'doors',
                'engine_capacity',
            ]);
        });
    }
};
