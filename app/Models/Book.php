<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\BookObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([BookObserver::class])]
class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'slug'];

    public function authors() {
        return $this->belongsToMany(Author::class)->withPivot('role');
    }

    public function editions() {
        return $this->hasMany(Edition::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function publishingRequest() {
        return $this->hasMany(PublishingRequest::class);
    }

    public function scopeHasPublishedEdition($query) {
        return $query->whereHas('editions', fn($q) => $q->published());
    }

    public function getPublishedEditionsAttribute() {
        return $this->editions
                    ->whereNotNull('published_at')
                    ->sortBy('published_at')
                    ->values();
    }

    public function getCoverImageAttribute() {
        $firstFormat = $this->published_editions->flatMap->formats->first();
        return $firstFormat?->cover_image_path
            ? asset('storage/' . $firstFormat->cover_image_path)
            : asset('images/default_cover.jpg');
    }

    public function getFormatsAttribute() {
        return $this->published_editions->flatMap->formats->pluck('format')->unique();
    }
}
