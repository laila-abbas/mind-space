<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'pen_name', 'biography', 'website_url'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function books() {
        return $this->belongsToMany(Book::class)->withPivot('role');
    }

    public function getDisplayNameAttribute() {
        return $this->pen_name
            ?? $this->user->first_name . ' ' . $this->user->last_name;
    }
}
