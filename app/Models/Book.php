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

    protected $fillable = ['title', 'description', 'ISBN', 'language', 'cover_image_path', 'status'];

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
}
