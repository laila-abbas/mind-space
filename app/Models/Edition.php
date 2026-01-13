<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Edition extends Model
{
    /** @use HasFactory<\Database\Factories\EditionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['book_id', 'format', 'price', 'pages', 'publication_date', 'stock'];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}

