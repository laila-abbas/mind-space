<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Edition extends Model
{
    /** @use HasFactory<\Database\Factories\EditionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'publishing_house_id', 'format', 'ISBN', 'language', 'cover_image_path', 'price', 'pages', 'published_at', 'stock'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function scopePublished($query) {
        return $query->whereNotNull('published_at');
    }
}

