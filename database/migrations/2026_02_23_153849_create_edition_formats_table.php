<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Edition;

return new class extends Migration
{
    /* single table for all formats 
        1. avoids unnecessary joins, 
        2. the differences are minimal among formats
        3. nulls don't usually cause significant performance issues
        fields like pages, duration_seconds, size_MB, narrator, etc.
        are stored as columns instead of JSON to keep queries simple and efficient. */

    public function up(): void
    {
        Schema::create('edition_formats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Edition::class)->constrained()->cascadeOnDelete();
            $table->enum('format', ['hardcover', 'paperback', 'e-book', 'audiobook']);
            $table->string('ISBN')->unique()->nullable();
            $table->string('cover_image_path')->nullable();
            $table->decimal('price', 10, 2)->default(0);

            $table->integer('stock')->nullable();
            $table->integer('pages')->nullable(); 
            $table->integer('duration_seconds')->nullable(); 
            $table->string('file_path')->nullable();           
            $table->string('file_extension')->nullable();           
            $table->decimal('size_MB', 8, 2)->nullable(); 
            $table->string('narrator')->nullable(); // for audio 

            $table->softDeletes();
            $table->timestamps();
            $table->unique(['edition_id', 'format']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edition_formats');
    }
};
