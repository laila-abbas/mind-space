<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Book;
use App\Models\PublishingHouse;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PublishingHouse::class)->constrained()->cascadeOnDelete();
            $table->enum('format', ['hardcover', 'paperback', 'e-book', 'audiobook']);
            $table->string('ISBN')->unique()->nullable();
            $table->string('language');
            $table->string('cover_image_path')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('pages')->nullable();
            $table->timestamp('published_at')->nullable(); // nullable for staging/scheduling...
            $table->integer('stock')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['book_id', 'publishing_house_id', 'format']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
