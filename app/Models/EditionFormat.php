<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditionFormat extends Model
{
     use HasFactory;
     
    protected $fillable = ['edition_id', 'format', 'ISBN', 'cover_image_path', 'price', 'stock', 'pages'];

    public function Edition() {
        return $this->belongsTo(Edition::class);
    }

    public function getCoverImageAttribute() {
        return $this->cover_image_path
            ? asset('storage/' . $this->cover_image_path)
            : asset('images/default_cover.jpg');
    }
}
