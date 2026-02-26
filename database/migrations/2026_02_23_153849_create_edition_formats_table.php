<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Edition;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('edition_formats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Edition::class)->constrained()->cascadeOnDelete();
            $table->enum('format', ['hardcover', 'paperback', 'e-book', 'audiobook']);
            $table->string('ISBN')->unique()->nullable();
            $table->string('cover_image_path')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('pages')->nullable();
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
