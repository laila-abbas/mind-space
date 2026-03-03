<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditionReview extends Model
{
    use HasFactory;
    
    protected $fillable = ['edition_id', 'user_id', 'rating', 'review'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function edition() {
        return $this->belongsTo(Edition::class);
    }
}
