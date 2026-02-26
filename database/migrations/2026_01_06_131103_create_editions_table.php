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

            $table->string('edition_title')->nullable(); 
            $table->unsignedInteger('edition_number')->default(1);
            $table->text('edition_description')->nullable();
            $table->string('language');

            $table->timestamp('published_at')->nullable(); // nullable for staging/scheduling...
            
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['book_id', 'edition_number']);
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
