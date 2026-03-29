<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EditionFormat extends Model
{
     use HasFactory, SoftDeletes;
     
    protected $fillable = ['edition_id', 'format', 'ISBN', 'cover_image_path', 'price', 'stock', 'pages', 'duration_seconds', 'file_path', 'file_extension', 'size_MB', 'narrator'];

    public function Edition() {
        return $this->belongsTo(Edition::class);
    }

    public function getCoverImageAttribute() {
        return $this->cover_image_path
            ? asset('storage/' . $this->cover_image_path)
            : asset('images/default_cover.jpg');
    }

    public function getIsDigitalAttribute() {
        return in_array($this->format, ['e-book', 'audiobook']);
    }

    public function getIsFreeAttribute() {
        return $this->price == 0;
    }

    public function getFileUrlAttribute() {
        return $this->file_path
            ? asset('storage/' . $this->file_path)
            : null;
    }
}
