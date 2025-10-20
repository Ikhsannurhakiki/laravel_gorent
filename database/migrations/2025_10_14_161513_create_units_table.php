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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();        // Contoh: "Car", "Motorcycle", "Room"
            $table->text('description')->nullable();
            $table->decimal('price_per_day', 10, 2);   // Harga per hari sewa

            // Status ketersediaan
            $table->boolean('is_available')->default(true);

            // Opsional: gambar utama
            $table->string('thumbnail')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
