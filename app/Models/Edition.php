<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\EditionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

// #[ObservedBy([EditionObserver::class])]
class Edition extends Model
{
    /** @use HasFactory<\Database\Factories\EditionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'publishing_house_id', 'edition_title', 'edition_number', 'edition_description', 'language', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function publishingHouse() {
        return $this->belongsTo(PublishingHouse::class);
    }

    public function formats() {
        return $this->hasMany(EditionFormat::class);
    }

    public function scopePublished($query) {
        return $query->whereNotNull('published_at');
    }

    public function getDisplayTitleAttribute() {
        $number = $this->edition_number;

        $suffixes = __('book.suffix');

        $suffix = match(true) {
            $number % 100 >= 11 && $number % 100 <= 13 => $suffixes['th'],
            $number % 10 === 1 => $suffixes['st'],
            $number % 10 === 2 => $suffixes['nd'],
            $number % 10 === 3 => $suffixes['rd'],
            default => $suffixes['th'],
        };

        $base = "{$number}{$suffix} " . __('book.edition');

        if (app()->getLocale() === 'ar') {
            return $this->edition_title
                ? __('book.edition') . " {$number} - {$this->edition_title}"
                : __('book.edition') . " {$number}";
        }

        return $this->edition_title
            ? "{$base} – {$this->edition_title}"
            : $base;
    }
}

