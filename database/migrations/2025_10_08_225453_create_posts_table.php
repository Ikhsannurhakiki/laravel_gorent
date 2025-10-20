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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->String('title');
            $table->String('slug');
            // $table->UnsignedBigInteger('author_id');
            // $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            // $table->UnsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('author_id')->constrained(table:'users', indexName:'posts_author_id_foreign'); //Menggantikan 2 baris diatas *users
            $table->foreignId('category_id')->constrained(table:'categories', indexName:'posts_category_id_foreign');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
