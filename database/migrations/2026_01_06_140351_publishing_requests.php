<?php

use App\Models\Book;
use App\Models\PublishingHouse;
use App\Models\PublishingHouseUser;
use App\Models\User;
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
        Schema::create('publishing_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Book::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(PublishingHouse::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class, 'submitted_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'under review', 'approved', 'rejected'])->default('pending');
            $table->foreignIdFor(PublishingHouseUser::class, 'reviewer_id')->nullable()->constrained('publishing_house_user')->nullOnDelete();
            $table->text('review_notes')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishing_requests');
    }
};
