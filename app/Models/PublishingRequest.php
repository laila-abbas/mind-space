<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishingRequest extends Model
{
    use HasFactory, SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['book_id', 'publishing_house_id', 'submitted_by', 'status', 'reviewer_id', 'review_notes', 'submitted_at', 'reviewed_at'];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function publishingHouse() {
        return $this->belongsTo(PublishingHouse::class);
    }

    public function submittedBy() {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewer() {
        return $this->belongsTo(PublishingHouseUser::class, 'reviewer_id');
    }
}
